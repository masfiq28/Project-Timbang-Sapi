<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Weighing;
use Carbon\Carbon;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';
    public $periodFilter = 'today';

    public $showPrintModal = false;
    public $showViewModal = false;
    public $printUrl = '';
    public $selectedWeighing = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingPeriodFilter()
    {
        $this->resetPage();
    }

    public function openViewModal($id)
    {
        $this->selectedWeighing = \App\Models\Weighing::with(['vehicle', 'sender', 'driver', 'item'])->find($id);
        if ($this->selectedWeighing) {
            $this->showViewModal = true;
        }
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->selectedWeighing = null;
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Hapus Data?',
            'text' => "Data timbangan ini akan dihapus secara permanen dan tidak dapat dikembalikan!",
            'icon' => 'warning',
            'method' => 'executeDelete',
            'id' => $id
        ]);
    }

    #[\Livewire\Attributes\On('executeDelete')]
    public function executeDelete($id)
    {
        $weighing = \App\Models\Weighing::find($id);
        if ($weighing) {
            $weighing->delete();
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Data berhasil dihapus!'
            ]);
            $this->showViewModal = false;
        }
    }

    public function openPrintModal($id)
    {
        $this->printUrl = route('weighings.print', $id);
        $this->showPrintModal = true;
    }

    public function closePrintModal()
    {
        $this->showPrintModal = false;
        $this->printUrl = '';
    }

    public function exportExcel()
    {
        $filename = "Export_Timbangan_" . date('Y-m-d_H-i-s') . ".xlsx";
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\WeighingsExport($this->search, $this->periodFilter), $filename);
    }

    public function render()
    {
        $today = Carbon::today();
        
        $totalWeighingsToday = Weighing::whereDate('receipt_date', $today)->count();
        $totalNetWeightToday = Weighing::whereDate('receipt_date', $today)->sum('net_weight');

        $query = Weighing::with(['vehicle', 'driver', 'item', 'sender']);

        // Apply period filter
        if ($this->periodFilter === 'today') {
            $query->whereDate('receipt_date', Carbon::today());
        } elseif ($this->periodFilter === 'weekly') {
            $query->whereBetween('receipt_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($this->periodFilter === 'monthly') {
            $query->whereMonth('receipt_date', Carbon::now()->month)
                  ->whereYear('receipt_date', Carbon::now()->year);
        } elseif ($this->periodFilter === 'yearly') {
            $query->whereYear('receipt_date', Carbon::now()->year);
        }

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('ticket_number', 'like', '%' . $this->search . '%')
                  ->orWhereHas('vehicle', function($v) {
                      $v->where('plate_number', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('sender', function($s) {
                      $s->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $weighings = $query->latest('receipt_date')->paginate(10);

        return view('livewire.dashboard', [
            'weighings' => $weighings,
            'totalWeighingsToday' => $totalWeighingsToday,
            'totalNetWeightToday' => $totalNetWeightToday,
        ])->layout('layouts.app');
    }
}
