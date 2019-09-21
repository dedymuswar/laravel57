@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Daftar Produk
                    @role('admin')
                    <a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-primary ml-3"
                        id="create-new-produk"><i class="fa fa-plus-circle"></i> Add New</a>

                    <a href="{{route('eksportData')}}" class="btn btn-warning ml-3 pull-right text-dark"
                        id="create-new-produk"><i class="fa fa-cloud-download"></i> Export and Import</a>
                    @endrole
                </div>
                <div class="alert" id="message" style="display:none"></div>
                <div class="card-body">
                    <table class="table table-hover" id="tableProduk">
                        <thead>
                            <th>Id</th>
                            <th>Nama Produk</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>action</th>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajax-crud-modal-produk" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="produkCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <span id="uploaded_image"></span>
                    </div>
                    <div class="col-md-7">
                        <form method="POST" id="produkForm" name="produkForm" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_produk" id="id_produk">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label text-md-left">Name</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="name_produk" name="name_produk"
                                        placeholder="Enter Name Produk" value="" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-md-left">Kategori</label>
                                <div class="col-sm-10">

                                    <select id="kategor" name="kate" class="form-control">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-md-left">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="harga" name="harga"
                                        placeholder="Enter Price" required="" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-md-left">SelectFile</label>
                                <div class="col-sm-10" class="custom-file">
                                    <input type="file" name="select_file" id="select_file">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-md-left">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea name="deskripsi" class="form-control" id="deskripsi" cols="59" rows="2"
                                        required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-primary" id="btn-simpan" value="create">Save
                                        changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" name="ok_button" id="ok_button">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection