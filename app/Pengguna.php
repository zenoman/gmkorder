<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $table = "pengguna";
    protected $fillable = [
        'nama', 'email', 'password','username','telp'
    ];
    protected $hidden = [
        'password',
    ];
}
