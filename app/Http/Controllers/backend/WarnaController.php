<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class WarnaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('warna')->orderby('id','desc')->get();
        return view('backend.warna.index',compact('data'));
    }

    //=================================================================
    public function store(Request $request)
    {
        DB::table('warna')->insert([
            'nama'=>$request->nama
        ]);
        return redirect('backend/warna')->with('status','Data berhasil disimpan');
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('warna')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama
        ]);
        return redirect('backend/warna')->with('status','Data berhasil diupdate');
    }

    //=================================================================
    public function destroy($id)
    {
        DB::table('warna')->where('id',$id)->delete();
        return redirect('backend/warna')->with('status','Data berhasil dihapus');
        
    }
}
