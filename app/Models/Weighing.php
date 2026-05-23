<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weighing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ticket_number', 'receipt_date', 'sender_id', 
        'vehicle_id', 'driver_id', 'item_id', 
        'gross_weight', 'tare_weight', 'net_weight', 'user_id'
    ];

    protected $casts = [
        'receipt_date' => 'datetime',
        'gross_weight' => 'decimal:2',
        'tare_weight' => 'decimal:2',
        'net_weight' => 'decimal:2',
    ];

    public function sender() { return $this->belongsTo(Sender::class); }
    public function vehicle() { return $this->belongsTo(Vehicle::class); }
    public function driver() { return $this->belongsTo(Driver::class); }
    public function item() { return $this->belongsTo(Item::class); }
    public function user() { return $this->belongsTo(User::class); }
}
