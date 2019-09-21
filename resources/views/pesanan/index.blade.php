@extends('layouts.app')

@section('content')

<div class="container mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h5>Create new Order</h5>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <form method="POST" id="formOrder">
                            <span id="result"></span>
                            <table class="table table-bordered table-striped" id="tablePesanan">
                                <thead>
                                    <tr>
                                        <th width="40%">Nama Produk</th>
                                        <th width="20%">Item</th>
                                        <th width="20%">Harga</th>
                                        <th width="20%">Jumlah</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" align="center"><b>Total</b></td>
                                        <td><input type="text" class="form-control" name="total" id="total" readonly />
                                        </td>
                                        <td>@csrf
                                            <button type="button" id="ok_simpan" class="btn btn-primary"><i
                                                    class="fa fa-check-circle"></i> Simpan</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
                <h5 class="modal-title">Konfirmasi Pesanan</h5>
                <button type="button" class="close" id="keluar" data-dismiss="modal" onClick="window.location.reload();"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <input type="text" class="form-control" v-model="bayar" id="asdas" autofocus> --}}
            <div class="modal-body" id="kembalian">
                <table id="newtable" class="table table-sm table-bordered table-striped">
                    <span id="hasilflash"></span>
                    <thead>
                        <h5>orders id : <a href="{{route('daftarOrder')}}"
                                class="badge badge-pill badge-info text-white" id="order_id"></a>
                        </h5>
                        <tr class="text-center">
                            <th width="35%">Nama Produk</th>
                            <th width="5%">Item</th>
                            <th width="20%">Harga</th>
                            <th width="30%">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td colspan="3" align="center"><b>Total<b></td>
                        <td>
                            <div name="totals" id="totals" class="text-center" ref="dey"></div>
                            {{-- <input type="text" name="totals" id="totals" ref="total"> --}}
                        </td>
                    </tbody>
                </table>
                <div class="form-group row">
                    <div class="col-md-2 offset-md-2"></div>
                    <label for="name" class="col-sm-2 col-form-label">Bayar:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" v-model="bayar" id="bayar" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 offset-md-1"></div>
                    <div v-if="bayar" class="col-md-3">
                        <tampil></tampil>
                    </div>
                    <div v-if="bayar" class="col-md-6">
                        <h2 v-text="hasil"></h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" name="ok_button" id="ok_button"><i
                        class="fa fa-print"></i> Cetak</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onClick="window.location.reload();">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection