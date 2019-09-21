@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                Buat Komentar
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <div class="sb-msg"><i class="icon-thumbs-up"></i>
                        <strong>Well done!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
                </div>
                @endif
                @if (session('salah'))
                <div class="alert alert-danger" role="alert">
                    <div class="sb-msg"><i class="icon-remove"></i>
                        <strong>Oh shit!</strong> {{ session('salah') }}</div>
                </div>
                @endif
                {!! Form::open (['action' => 'CommentController@store', 'method' => 'POST', 'enctype' => 'form-data',
                'name' => 'formKomentar']) !!}
                @csrf
                <br>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">Nama</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label text-md-right"> Komentar </label>
                    <div class="col-md-8">
                        <textarea name="komentar" class="form-control" id="komentar" cols="80" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="btn btn-primary" name="simpan">Kirim</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="card-footer">
                Contoh notification pada komentar
            </div>
        </div>
    </div>
</div>
@endsection