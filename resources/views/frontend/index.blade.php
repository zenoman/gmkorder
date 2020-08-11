@extends('layouts/base_user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if (session('msg'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Peringantan !</h4>
                {{ session('msg') }}
            </div>
            @endif
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Cara Penggunaan</h5>
                </div>
                <div class="card-body">
                    <ol>
                        <li>Setting Env</li>
                        <li>Run migration</li>
                        <li>Enjoy</li>
                    </ol>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection