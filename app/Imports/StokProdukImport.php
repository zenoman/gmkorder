<?php

namespace App\Imports;
use App\models\ProdukModel;
use Illuminate\Support\Collection;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Batch;
use Auth;
use DB;

class StokProdukImport implements ToCollection, WithHeadingRow, WithValidation
{

    use Importable;
    public function collection(Collection $collection)
    {
        $value=[];
        $datalog=[];
        foreach ($collection as $row){
            $kproduk = $row['kode_produk'];
            $barang = DB::table('produk')->where('kode',$kproduk)->first();
            if($row['aksi']=='Tambah'){
                $value[] = [
                    'kode' => $row['kode_produk'],
                    'stok' => $barang->stok + $row['jumlah'],
                ];
                $datalog[] =[
                    'kode_produk'=>$row['kode_produk'],
                    'user_id'=>Auth::user()->id,
                    'status'=>'Import Penyesuaian Stok',
                    'aksi'=>'Menambahkan',
                    'deskripsi'=>'Mengedit stok produk',
                    'jumlah'=>$row['jumlah'],
                    'jumlah_akhir'=>$barang->stok + $row['jumlah'],
                    'tanggal'=>date('Y-m-d H:i:s')
                ];
            }else{
                $value[] = [
                    'kode' => $row['kode_produk'],
                    'stok' => $barang->stok - $row['jumlah'],
                ];
                $datalog[] =[
                    'kode_produk'=>$row['kode_produk'],
                    'user_id'=>Auth::user()->id,
                    'status'=>'Import Penyesuaian Stok',
                    'aksi'=>'Mengurangi',
                    'deskripsi'=>'Mengedit stok produk',
                    'jumlah'=>$row['jumlah'],
                    'jumlah_akhir'=>$barang->stok - $row['jumlah'],
                    'tanggal'=>date('Y-m-d H:i:s')
                ];
            }
        }
        $userInstance = new ProdukModel;
        $index = 'kode';
        Batch::update($userInstance, $value, $index);
        DB::table('stok_log')->insert($datalog);
    }

    public function rules(): array
    {
        return [
            'kode_produk' => 'required|string',
            'jumlah' => 'required|numeric',
            'aksi' => 'required|in:Tambah,Kurangi',
            'deskripsi' => 'required|string',
        ];
    }
}