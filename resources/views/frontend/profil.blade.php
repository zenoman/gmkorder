@extends('layouts/base_user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Profil Saya</h5>
                </div>
                <div class="card-body">
                    <h1 class="card-title">Mantab Kamu sudah login {{Auth::guard('pengguna')->user()->nama}}</h1>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection