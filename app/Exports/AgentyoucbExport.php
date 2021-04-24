<?php

namespace App\Exports;

use App\Agent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgentyoucbExport implements FromCollection
{
    public function collection()
    {
        return Agent::all();
    }
}
