<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Image;
use Hash;
use File;
use DB;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.produk.index');
    }
    
    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('produk')->get())->make(true);
    }

    //=================================================================
    public function create()
    {
        $kategori=DB::table('kategori_produk')->orderby('id','desc')->get();
        return view('backend.produk.create',compact('kategori'));
    }

    //=================================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:produk',
        ]);
        $namafile ='';
        if($request->hasFile('gambar')) {
            
            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('img/produk/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint){$constraint->aspectRatio();})
            ->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('img/produk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];
        }
        $imgdata = [];
        foreach ($request->file('gambarlain') as $photos) {
            $namaexs = $photos->getClientOriginalName();
            $lower_file_name=strtolower($namaexs);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            $destination = public_path('img/gambarproduk');
            $photos->move($destination,$namagambar);
                $imgdata[] = [
                    'kode_produk' => $request->kode,
                    'nama' => $namagambar
                ];
            }
        DB::table('gambar_produk')->insert($imgdata);
        DB::table('produk')->insert([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'hpp'=>$request->hpp,
            'status'=>$request->status,
            'slug'=>str_replace(' ','-',strtolower($request->nama)),
            'kategori_produk'=>$request->kategori,
            'harga_jual'=>$request->harga_jual,
            'gambar_utama'=>$namafile,
            'deskripsi'=>$request->deskripsi,
        ]);
        
        return redirect('backend/produk')->with('status','Sukses menyimpan data');
    }

    //=================================================================
    public function show($id)
    {
        //
    }

    //=================================================================
    public function edit($id)
    {
        $kodebarang = '';
        $barang = DB::table('produk')->where('id',$id)->get();
        foreach($barang as $row){
            $kodebarang = $row->kode;
        }
        $gambarbarang = DB::table('gambar_produk')->where('kode_produk',$kodebarang)->get();
        $kategori=DB::table('kategori_produk')->orderby('id','desc')->get();
        return view('backend.produk.edit',compact('kategori','barang','gambarbarang'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        $olddata = DB::table('produk')->where('id',$id)->first();

        if($olddata->kode != $request->kode){
            $validated = $request->validate([
                'kode' => 'required|unique:produk',
            ]);
        }

        $namafile ='';
        if($request->hasFile('gambar')) {
            
            File::delete('img/produk/'.$olddata->gambar_utama);
            File::delete('img/produk/thumbnail/'.$olddata->gambar_utama);

            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('img/produk/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint){$constraint->aspectRatio();})
            ->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('img/produk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];

            DB::table('produk')
            ->where('id',$id)
            ->update([
                'kode'=>$request->kode,
                'nama'=>$request->nama,
                'hpp'=>$request->hpp,
                'status'=>$request->status,
                'slug'=>str_replace(' ','-',strtolower($request->nama)),
                'kategori_produk'=>$request->kategori,
                'harga_jual'=>$request->harga_jual,
                'deskripsi'=>$request->deskripsi,
                'gambar_utama'=>$namafile,
            ]);
        }else{
            DB::table('produk')
            ->where('id',$id)
            ->update([
                'kode'=>$request->kode,
                'nama'=>$request->nama,
                'hpp'=>$request->hpp,
                'status'=>$request->status,
                'slug'=>str_replace(' ','-',strtolower($request->nama)),
                'kategori_produk'=>$request->kategori,
                'harga_jual'=>$request->harga_jual,
                'deskripsi'=>$request->deskripsi,
            ]);
        }
        return redirect('backend/produk')->with('status','Sukses mengedit data');
    }

    //=================================================================
    public function destroy($id)
    {
        $data = DB::table('produk')->where('id',$id)->first();
        $dataimage = DB::table('gambar_produk')->where('kode_produk',$data->kode)->get();
        foreach($dataimage as $oldimg){
            File::delete('img/gambarproduk/'.$oldimg->nama);
        }
        if($data->gambar_utama != ''){
            File::delete('img/produk/'.$data->gambar_utama);
            File::delete('img/produk/thumbnail/'.$data->gambar_utama);
        }
        DB::table('gambar_produk')->where('kode_produk',$data->kode)->delete();
        DB::table('produk')->where('id',$id)->delete();
    }

    //=================================================================
    public function addgambar(Request $request)
    {
        $namafile='';
        if($request->hasFile('gambarproduk')) {
            
            $image = $request->file('gambarproduk');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();

            $destinationPath = public_path('img/gambarproduk');
            $image->move($destinationPath, $input['imagename']);
            $namafile=$input['imagename'];
        }
        DB::table('gambar_produk')
        ->insert([
            'nama'=>$namafile,
            'kode_produk'=>$request->kode
        ]);
        return back()->with('statusimage','Gambar berhasil disimpan');
    }

     //=================================================================
     public function hapusgambar(Request $request, $id)
     {
        $dataimage = DB::table('gambar_produk')->where('id',$id)->get();
        foreach($dataimage as $oldimg){
            File::delete('img/gambarproduk/'.$oldimg->nama);
        } 
        DB::table('gambar_produk')->where('id',$id)->delete();
        return back()->with('statusimage','Gambar berhasil dihapus');
     }
}