<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProdukVarianModel extends Model
{
    protected $table = 'produk_varian';
    protected $guarded = ['id'];
    public $timestamps = false;
}
