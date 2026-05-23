<?php

namespace App\Exports;

use App\Models\Weighing;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class WeighingsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $search;
    protected $periodFilter;

    public function __construct($search = '', $periodFilter = 'all')
    {
        $this->search = $search;
        $this->periodFilter = $periodFilter;
    }

    public function query()
    {
        $query = Weighing::query()->with(['vehicle', 'driver', 'item', 'sender', 'user']);

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

        return $query->orderBy('receipt_date', 'desc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'No. TTBM',
            'Tanggal Terima',
            'Pengirim',
            'Kendaraan (Plat)',
            'Sopir',
            'Barang',
            'Bruto (KG)',
            'Tara (KG)',
            'Netto (KG)',
            'Operator'
        ];
    }

    public function map($weighing): array
    {
        return [
            $weighing->id,
            $weighing->ticket_number,
            $weighing->receipt_date->format('Y-m-d H:i:s'),
            $weighing->sender->name ?? '-',
            $weighing->vehicle->plate_number ?? '-',
            $weighing->driver->name ?? '-',
            $weighing->item->name ?? '-',
            $weighing->gross_weight,
            $weighing->tare_weight,
            $weighing->net_weight,
            $weighing->user->name ?? '-',
        ];
    }
}
