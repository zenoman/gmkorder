@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Penyesuaian Stok</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit Stok Produk</h3>
                        </div>
                        <form method="POST" onsubmit="return validasiinput();" role="form" enctype="multipart/form-data"
                            action="{{url('backend/penyesuaian-stok')}}">
                            @csrf

                            <div class="card-body" id="panelnya">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning alert-dismissible">
                                            <h4>Warning !</h4>
                                            Pastikan penyesuaian stok produk dilakukan disaat traffic transaksi sedang
                                            rendah, untuk meminimalisir kesalahan perubahan stok produk.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Produk</label>
                                            <select name="produk" class="form-control select2">
                                                <option selected disabled hidden>Pilih Produk</option>
                                                @foreach($barang as $brg)
                                                <option value="{{$brg->id}}">{{$brg->kode}} - {{$brg->nama}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stok Sekarang</label>
                                            <input type="text" class="form-control" name="stok" id="stok" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Aksi</label>
                                            <select name="aksi" id="aksi" class="form-control">
                                                <option value="Tambah">Tambah</option>
                                                <option value="Kurangi">Kurangi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">HPP</label>
                                            <input type="number" value="0" id="hpp" class="form-control" name="hpp"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Harga Jual</label>
                                            <input type="number" value="0" id="harga_jual" class="form-control"
                                                name="harga_jual" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" class="btn btn-dark float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('loading/jquery.loading.js')}}"></script>
@endpush

@push('customscripts')
<script src="{{asset('customjs/backend/penyesuaian_stok.js')}}"></script>
@endpush