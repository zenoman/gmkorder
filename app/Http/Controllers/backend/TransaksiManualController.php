<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class TransaksiManualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $kode = $this->carikode();
        $barang = DB::table('produk')->orderby('id','desc')->get();
        $pelanggan = DB::table('pengguna')->orderby('id','desc')->get();
        return view('backend.transaksimanual.index',compact('barang','kode','pelanggan'));
    }

    //==================================================================
    public function carikode(){
        $tanggal    = date('dmy');
        $kodeuser = sprintf("%02s",Auth::user()->id);
        $lastuser = $tanggal."-".$kodeuser;
        $kode = DB::table('transaksi')
        ->where('kode','like','%'.$lastuser.'-%')
        ->max('kode');

        if(!$kode){
            $finalkode = "TRX-".$tanggal."-".$kodeuser."-000001";
        }else{
            $newkode    = explode("-", $kode);
            $nomer      = sprintf("%06s",$newkode[2]+1);
            $finalkode  = "TRX-".$tanggal."-".$kodeuser."-".$nomer;
        }
        return $finalkode;
    }

    //==================================================================
    public function caridetailbarang($kode)
    {
        $barang = DB::table('produk')->where('id',$kode)->get();
        return response()->json($barang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
