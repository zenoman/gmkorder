<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    public $timestamps = false;
    protected $table = 'slider';
    protected $guarded = ['id'];
}
