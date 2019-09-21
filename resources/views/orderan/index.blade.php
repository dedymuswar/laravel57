@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Daftar Order
                </div>
                <span id="result"></span>
                <div class="row input-daterange ml-3 mt-3">
                    <div class="col-md-4">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-primary"> Filter</button><button
                            type="button" name="refresh" id="refresh" class="btn btn-warning ml-2">Refresh</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="tableDateRange">
                        <thead>
                            <th>OrderId</th>
                            <th>Kode Order</th>
                            <th>Total</th>
                            <th>Tgl Order</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" id="keluar" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="bodyku">
                </div>
                <div>
                    <table id="detailOrder" class="table table-sm table-bordered table-striped">
                        <span id="hasilflash"></span>
                        <thead>
                            <h5>orders id : <a href="{{route('daftarOrder')}}"
                                    class="badge badge-pill badge-info text-white" id="order_id"></a>
                            </h5>
                            <tr class="text-center">
                                <th width="5%">No.</th>
                                <th width="35%">Nama Produk</th>
                                <th width="5%">Item</th>
                                <th width="20%">Harga</th>
                            </tr>
                        </thead>
                        <tbody id="hasil">
                            <tr id="totalsi"></tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" name="ok_button" id="ok_button"><i
                        class="fa fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>
</div>
@endsection