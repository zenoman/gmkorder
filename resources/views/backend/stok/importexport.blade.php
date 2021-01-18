@extends('layouts/base')

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
                            <h3 class="card-title">Import / Export Penyesuaian Stok</h3>
                        </div>
                        <form action="{{url('/backend/penyesuaian-stok/produk/export')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <h3><b>Cara Import</b></h3>
                                        <ol class="pl-4">
                                            <li>Download Data kategori dengan tekan link <b>Export Data Kategori
                                                    Produk</b></li>
                                        </ol>
                                        <h5><b>Ketentuan Pengisian Data</b></h5>
                                        <ul class="pl-4">
                                            <li><b>Kode</b> harus diisi dan unik / berbeda dari kode produk lain</li>
                                            
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        @if(Session::get('errorexcel'))
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Error Logs :</strong>
                                            <ul>
                                                @foreach (Session::get('errorexcel') as $failure)
                                                @foreach ($failure->errors() as $error)
                                                <li><b>Field {{$failure->attribute()}} error</b> {{ $error }} ( in Line
                                                    {{$failure->row()}} ) </li>
                                                @endforeach
                                                @endforeach
                                            </ul>
                                            <hr>
                                            <b>NB : Semua data tidak disimpan ketika error</b>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Import File Excel</label>
                                            <input type="file" id="excelfile" class="form-control mb-2"
                                                name="file_excel" required>
                                            <a href="{{asset('assets/Template_import_stok.xls')}}"><i
                                                    class="fa fa-file"></i> Download Template Import</a>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" id="submitexport"
                                    class="btn btn-dark float-right ml-2">Simpan</button>
                                <a href="{{url('/backend/penyesuaian-stok/export')}}"
                                    class="btn btn-dark float-right"><i class="fa fa-download"></i> Export Data Stok</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection