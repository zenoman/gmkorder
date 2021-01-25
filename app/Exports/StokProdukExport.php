<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class StokProdukExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        $dataproduk = DB::table('produk_varian')
        ->select(DB::raw('produk_varian.id,produk_varian.produk_kode, produk.nama as namaproduk, size.nama as namasize, warna.nama as namawarna, produk_varian.stok,produk_varian.hpp, produk_varian.harga'))
        ->leftjoin('produk','produk.kode','=','produk_varian.produk_kode')
        ->leftjoin('size','size.id','=','produk_varian.size_id')
        ->leftjoin('warna','warna.id','=','produk_varian.warna_id')
        ->get();
        return $dataproduk;
    }
    public function headings(): array
    {
        return [
            'id',
            'kode',
            'nama',
            'size',
            'warna',
            'stok',
            'hpp',
            'harga_jual',
        ];
    }
}
