@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Import and Export</div>
                <div class="card-body">
                    <form action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <div class="col-md-5">
                                <input type="file" name="file" accept=".csv">
                            </div>
                            <div class="col-md-7">
                                <button class="btn btn-warning"><i class="fa fa-download"></i> Import Produk
                                    Data</button>

                                <a href="{{route('export')}}" class="btn btn-success"><i class="fa fa-upload"></i>
                                    Export
                                    Produk Data</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection