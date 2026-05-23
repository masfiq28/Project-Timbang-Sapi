<?php

namespace App\Http\Controllers;

use App\Models\Weighing;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function print(Weighing $weighing)
    {
        $weighing->load(['sender', 'vehicle', 'driver', 'item', 'user']);
        return view('weighings.print', compact('weighing'));
    }
}
