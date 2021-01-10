<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use DB;

class PenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    
    public function index()
    {
        return view('backend.pengguna.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('pengguna')->get())->make(true);
    }

    //=================================================================
    public function create()
    {
        return view ('backend.pengguna.create');
    }

    //=================================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'telp' => 'required|unique:pengguna',
            'email' => 'required|unique:pengguna',
            'username' => 'required|unique:pengguna',
        ]);

        $nameland=$request->file('gambar')->getClientOriginalname();
        $lower_file_name=strtolower($nameland);
        $replace_space=str_replace(' ', '-', $lower_file_name);
        $finalname=time().'-'.$replace_space;
        $destination=public_path('img/pengguna');
        $request->file('gambar')->move($destination,$finalname);
        
        DB::table('pengguna')->insert([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'email'=>$request->email,
            'telp'=>$request->telp,
            'gambar'=>$finalname,
            'password'=>Hash::make($request->password),
        ]);
        
        return redirect('backend/pengguna')->with('status','Sukses menyimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    //=================================================================
    public function destroy($id)
    {
        $data = DB::table('pengguna')->where('id',$id)->get();
        foreach($data as $row){
            if($row->gambar != ''){
                File::delete('img/pengguna'.$row->gambar);
            }
        }
        DB::table('pengguna')->where('id',$id)->delete();
    }
}
