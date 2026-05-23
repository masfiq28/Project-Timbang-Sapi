<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Sender;
use App\Models\Driver;
use App\Models\Item;
use App\Models\Weighing;
use Illuminate\Support\Facades\Auth;

class WeighingForm extends Component
{
    public $vehicle_name = '';
    public $sender_name = '';
    public $driver_name = '';
    public $item_name = '';
    
    public $gross_weight = null;
    public $tare_weight = null;
    public $net_weight = 0;

    public $vehicles;
    public $senders;
    public $drivers;
    public $items;

    public ?Weighing $weighingModel = null;

    public function mount(Weighing $weighing = null)
    {
        $this->vehicles = Vehicle::all();
        $this->senders = Sender::all();
        $this->drivers = Driver::all();
        $this->items = Item::all();

        if ($weighing && $weighing->exists) {
            $this->weighingModel = $weighing;
            $this->vehicle_name = $weighing->vehicle->plate_number ?? '';
            $this->sender_name = $weighing->sender->name ?? '';
            $this->driver_name = $weighing->driver->name ?? '';
            $this->item_name = $weighing->item->name ?? '';
            $this->gross_weight = $weighing->gross_weight;
            $this->tare_weight = $weighing->tare_weight;
            $this->net_weight = $weighing->net_weight;
        }
    }

    public function updatedVehicleName($value)
    {
        if ($value) {
            $vehicle = Vehicle::where('plate_number', $value)->first();
            if ($vehicle) {
                if ($vehicle->default_driver_id && empty($this->driver_name)) {
                    $this->driver_name = Driver::find($vehicle->default_driver_id)?->name ?? '';
                }
                if ($vehicle->default_item_id && empty($this->item_name)) {
                    $this->item_name = Item::find($vehicle->default_item_id)?->name ?? '';
                }
            }
        }
    }

    public function calculateNet()
    {
        $gross = floatval($this->gross_weight);
        $tare = floatval($this->tare_weight);
        $this->net_weight = max(0, $gross - $tare);
    }

    public function updatedGrossWeight() { $this->calculateNet(); }
    public function updatedTareWeight() { $this->calculateNet(); }

    public function save()
    {
        $this->validate([
            'vehicle_name' => 'required|string',
            'sender_name' => 'required|string',
            'driver_name' => 'required|string',
            'item_name' => 'required|string',
            'gross_weight' => 'required|numeric|min:0',
            'tare_weight' => 'required|numeric|min:0',
        ]);

        $vehicle = Vehicle::firstOrCreate(['plate_number' => strtoupper(trim($this->vehicle_name))]);
        $sender = Sender::firstOrCreate(['name' => trim($this->sender_name)]);
        $driver = Driver::firstOrCreate(['name' => trim($this->driver_name)]);
        $item = Item::firstOrCreate(['name' => trim($this->item_name)]);

        if (!$vehicle->default_driver_id) { $vehicle->default_driver_id = $driver->id; $vehicle->save(); }
        if (!$vehicle->default_item_id) { $vehicle->default_item_id = $item->id; $vehicle->save(); }

        if ($this->weighingModel) {
            $this->weighingModel->update([
                'sender_id' => $sender->id,
                'vehicle_id' => $vehicle->id,
                'driver_id' => $driver->id,
                'item_id' => $item->id,
                'gross_weight' => $this->gross_weight,
                'tare_weight' => $this->tare_weight,
                'net_weight' => $this->net_weight,
                'user_id' => Auth::id(),
            ]);
            
            session()->flash('toast', [
                'type' => 'success',
                'title' => 'Perubahan data berhasil disimpan!'
            ]);
            
        } else {
            $ticket_number = date('dmY') . rand(100, 999);
            Weighing::create([
                'ticket_number' => $ticket_number,
                'receipt_date' => now(),
                'sender_id' => $sender->id,
                'vehicle_id' => $vehicle->id,
                'driver_id' => $driver->id,
                'item_id' => $item->id,
                'gross_weight' => $this->gross_weight,
                'tare_weight' => $this->tare_weight,
                'net_weight' => $this->net_weight,
                'user_id' => Auth::id(),
            ]);

            session()->flash('toast', [
                'type' => 'success',
                'title' => 'Data baru berhasil disimpan!'
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.weighing-form')
            ->layout('layouts.app');
    }
}
