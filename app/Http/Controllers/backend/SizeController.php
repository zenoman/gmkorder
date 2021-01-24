<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('size')->orderby('id','desc')->get();
        return view('backend.size.index',compact('data'));
    }

    //=================================================================
    public function store(Request $request)
    {
        DB::table('size')->insert([
            'nama'=>$request->nama
        ]);
        return redirect('backend/size')->with('status','Data berhasil disimpan');
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('size')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama
        ]);
        return redirect('backend/size')->with('status','Data berhasil diupdate');
    }

    //=================================================================
    public function destroy($id)
    {
        DB::table('size')->where('id',$id)->delete();
        return redirect('backend/size')->with('status','Data berhasil dihapus');
        
    }
}
