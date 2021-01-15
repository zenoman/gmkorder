<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use File;
use Image;
use DB;

class KategoriProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.kategoriproduk.index');
    }


    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('kategori_produk')->get())->make(true);
    }

    //=================================================================
    public function create()
    {
        return view('backend.kategoriproduk.create');
    }

    //=================================================================
    public function store(Request $request)
    {
        if($request->hasFile('gambar')) {
            
            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('img/kategoriproduk/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint){$constraint->aspectRatio();})
            ->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('img/kategoriproduk');
            $image->move($destinationPath, $input['imagename']);
       
        }
        DB::table('kategori_produk')->insert([
            'nama'=>$request->nama,
            'slug'=>str_replace(' ','-',strtolower($request->nama)),
            'gambar'=>$input['imagename'],
            'status'=>$request->status,
        ]);
        return redirect('backend/kategori-produk')->with('status','Sukses menyimpan data');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('kategori_produk')->where('id',$id)->first();
            if($data->gambar != ''){
                File::delete('img/kategoriproduk/'.$data->gambar);
                File::delete('img/kategoriproduk/thumbnail/'.$data->gambar);
            }
            DB::table('kategori_produk')->where('id',$id)->delete();
    }
}
