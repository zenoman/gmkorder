<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\StokProdukExport;
use App\Imports\StokProdukImport;
use Session;
use DataTables;
use Excel;
use Hash;
use File;
use Auth;
use Image;
use DB;


class PenyesuaianStokController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.stok.index');
    }
    
    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('stok_log')->select(DB::raw('stok_log.*,users.username'))->leftjoin('users','stok_log.user_id','=','users.id')->get())->make(true);
    }
    //=================================================================
    public function create()
    {
        $barang = DB::table('produk')->orderby('id','desc')->get();
        return view('backend.stok.create',compact('barang'));
    }

    //=================================================================
    public function detailbarang($id)
    {
        $barang = DB::table('produk')->where('id',$id)->get();
        return response()->json($barang);
    }
    
    //=================================================================
    public function store(Request $request)
    {
        $dataproduk = DB::table('produk')->where('id',$request->produk)->first();
        if($request->aksi=='Tambah'){
            $newstock = $dataproduk->stok + $request->jumlah;
            DB::table('produk')->where('id',$request->produk)->update(['stok'=>$newstock]);
            DB::table('stok_log')
            ->insert([
                'kode_produk'=>$dataproduk->kode,
                'user_id'=>Auth::user()->id,
                'status'=>'Penyesuaian Stok',
                'aksi'=>'Menambahkan',
                'deskripsi'=>'Mengedit stok produk',
                'jumlah'=>$request->jumlah,
                'jumlah_akhir'=>$newstock,
                'tanggal'=>date('Y-m-d H:i:s')
            ]);
        }else{
            $newstock = $dataproduk->stok - $request->jumlah;
            DB::table('produk')->where('id',$request->produk)->update(['stok'=>$newstock]);
            DB::table('stok_log')
            ->insert([
                'kode_produk'=>$dataproduk->kode,
                'user_id'=>Auth::user()->id,
                'status'=>'Penyesuaian Stok',
                'aksi'=>'Mengurangi',
                'deskripsi'=>'Mengedit stok produk',
                'jumlah'=>$request->jumlah,
                'jumlah_akhir'=>$newstock,
                'tanggal'=>date('Y-m-d H:i:s')
            ]);
        }
        return redirect('backend/penyesuaian-stok')->with('status','Berhasil mengedit stok produk '.$dataproduk->kode);
    }
    //=================================================================
    public function importexport()
    {
        return view('backend.stok.importexport');
    }

    //=================================================================
    public function export()
    {
        $namafile = "Data_Stok_Produk.xls";   
        return Excel::download(new StokProdukExport(),$namafile);
    }

    //=================================================================
    public function import(Request $request)
    {
        try {
            if($request->hasFile('file_excel')){
                $error = Excel::import(new StokProdukImport, request()->file('file_excel'));
                return redirect('backend/penyesuaian-stok')->with('status','Berhasil Import Data');
             }else{
                return redirect('backend/penyesuaian-stok');
             }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             Session::flash('errorexcel', $failures);
             return back();
        }
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
        //
    }
}
