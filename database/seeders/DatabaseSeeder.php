<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Sender;
use App\Models\Item;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        Sender::create(['name' => 'PT.PAM']);
        Sender::create(['name' => 'CV. MAJU BERSAMA']);
        
        $item1 = Item::create(['name' => 'KING GRASS']);
        $item2 = Item::create(['name' => 'SAPI BRAHMAN']);
        
        $driver1 = Driver::create(['name' => 'USMAN/ASEMAN']);
        $driver2 = Driver::create(['name' => 'BUDI']);
        
        Vehicle::create([
            'plate_number' => 'FORD 02',
            'default_driver_id' => $driver1->id,
            'default_item_id' => $item1->id,
        ]);
        
        Vehicle::create([
            'plate_number' => 'H 1234 XX',
            'default_driver_id' => $driver2->id,
            'default_item_id' => $item2->id,
        ]);
    }
}
