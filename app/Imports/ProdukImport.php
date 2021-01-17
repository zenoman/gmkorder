<?php

namespace App\Imports;
use App\models\ProdukModel;
use Illuminate\Support\Collection;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class ProdukImport implements ToModel, WithHeadingRow,WithValidation
{

    use Importable;
    public function model(array $row)
    {
        return new ProdukModel([
            'kode' => $row['kode'],
            'nama'=>$row['nama'],
            'hpp'=>$row['hpp'],
            'harga_jual'=>$row['harga_jual'],
            'kategori_produk'=>$row['kategori_id'],
            'deskripsi'=>$row['deskripsi'],
            'status'=>$row['status'],
        ]);
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|string|unique:produk,kode',
            'nama' => 'required|string',
            'hpp' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status' => 'required|in:Aktif,Non Aktif,Habis',
            'kategori_id' => 'required|numeric',
        ];
    }
}