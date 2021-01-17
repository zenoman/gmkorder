<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $guarded = ['id'];
    public $timestamps = false;
}
