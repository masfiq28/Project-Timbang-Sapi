<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\WeighingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export($period)
    {
        if (!in_array($period, ['weekly', 'monthly', 'yearly'])) {
            abort(404);
        }

        $filename = "Export_Timbangan_{$period}_" . date('Y-m-d') . ".xlsx";
        return Excel::download(new WeighingsExport($period), $filename);
    }
}
