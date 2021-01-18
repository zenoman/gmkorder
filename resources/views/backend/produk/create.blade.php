@extends('layouts/base')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Produk</h1>
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
                            <h3 class="card-title">Tambah Produk</h3>
                        </div>
                        <form method="POST" role="form" enctype="multipart/form-data"
                            action="{{url('backend/produk')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kode</label>
                                            <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                                value="{{old('kode')}}" name="kode" required autofocus>
                                            @error('kode')
                                            <span class="text-danger">Error : {{ $message }}</span><br>
                                            @enderror
                                            <span class="text-muted">Pastikan Kode produk unik / tidak sama dengan kode
                                                produk
                                                lainnya</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kategori Produk</label>
                                            <select name="kategori" class="form-control">
                                                @foreach($kategori as $kat)
                                                <option value="{{$kat->id}}">{{$kat->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Produk</label>
                                            <input type="text" class="form-control" value="{{old('nama')}}" name="nama"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non Aktif">Non Aktif</option>
                                                <option value="Habis">Habis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">HPP</label>
                                            <input type="number" class="form-control" value="{{old('hpp')}}" name="hpp"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Harga Jual</label>
                                            <input type="number" class="form-control" value="{{old('harga_jual')}}"
                                                name="harga_jual" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"
                                        rows="8">{{old('deskripsi')}}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Gambar Utama</label>
                                            <input type="file" class="form-control" name="gambar" accept="image/*"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Gambar Lain</label>
                                            <input type="file" class="form-control" name="gambarlain[]" id="gambarlain"
                                                accept="image/*" multiple required>
                                            <span class="text-muted">Maksimal 9 foto</span>
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
@push('customscripts')
<script>
$("#gambarlain").on("change", function() {
    if ($("#gambarlain")[0].files.length > 9) {
        alert("You can select only 9 images");
        $("#gambarlain").val('');
    }
});
</script>
@endpush