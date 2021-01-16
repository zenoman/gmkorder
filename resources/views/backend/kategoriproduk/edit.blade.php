@extends('layouts/base')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Kategori Produk</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                @foreach($data as $row)
                <div class="col-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit Kategori Produk</h3>
                        </div>
                        <form method="POST" role="form" enctype="multipart/form-data"
                            action="{{url('backend/kategori-produk/'.$row->id)}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" class="form-control" value="{{$row->nama}}" name="nama" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Aktif" @if($row->status=='Aktif')selected @endif>Aktif</option>
                                        <option value="Non Aktif" @if($row->status=='Non Aktif')selected @endif>Non Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Gambar</label>
                                    @if($row->gambar!='')
                                    <br>
                                    <img src="{{asset('img/kategoriproduk/thumbnail/'.$row->gambar)}}" alt="" class="img-thumbnail">
                                    <br><br>
                                    @endif
                                    <input type="file" class="form-control" name="gambar" accept="image/*">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" class="btn btn-dark float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection