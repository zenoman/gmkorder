<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class WarnaExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        $export =DB::table('warna')
        ->select(DB::raw('id,nama'))
        ->orderby('id','desc')
        ->get();
        return $export;
    }
    public function headings(): array
    {
        return [
            'id',
            'nama',
        ];
    }
}
