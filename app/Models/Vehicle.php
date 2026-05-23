<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['plate_number', 'default_driver_id', 'default_item_id'];

    public function defaultDriver() { 
        return $this->belongsTo(Driver::class, 'default_driver_id'); 
    }
    
    public function defaultItem() { 
        return $this->belongsTo(Item::class, 'default_item_id'); 
    }
}
