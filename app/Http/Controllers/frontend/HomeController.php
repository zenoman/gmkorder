<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    //==================================================================================
    public function index()
    {
        return view('frontend.index');
    }

    //==================================================================================
    public function profilsaya()
    {
        if(Auth::guard('pengguna')->check()){
            return view('frontend.profil');
        }else{
            return redirect('/')->with('msg','Profil saya adalah halaman yang menggunakan validasi user login, harap login sebagai user untuk mencoba halaman');
        }
    }

    
}
