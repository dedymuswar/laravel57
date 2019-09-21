@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar User
                    @role('admin')
                    <a href="javascript:void(0)" class="btn btn-info ml-3 text-white" id="create-new-user"><i
                            class="fa fa-plus-circle"></i> Add New</a>
                    @endrole
                </div>
                <div class="alert" id="message" style="display:none"></div>
                <div class="card-body">
                    <table class="table table-hover" id="mytable">
                        <thead>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Updated At</th>
                            <th>action</th>
                            {{-- @if ( auth()->user()->can('edit post') && auth()->user()->can('delete post'))
                                    <th style="width:10%" colspan="2">Action</th>
                                @endif --}}
                        </thead>
                        {{-- <tbody> --}}
                        {{-- @foreach ($users as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        @if ( auth()->user()->can('edit post') && auth()->user()->can('delete post'))
                        <td>
                            <a href="{{route('edituser', $item->id)}}">
                                <button class="btn btn-warning btn-sm">Edit</button></a></td>
                        <td>
                            {!! Form::open(['action' => ['UserController@destroy',$item->id], 'method' => 'POST'])!!}
                            {{ form::hidden('_method', 'POST')}}
                            <button type="submit" class="btn btn-danger btn-sm">delete</button>
                            {!! Form::close()!!}
                        </td>
                        @endif
                        </tr>
                        @endforeach --}}
                        {{-- </tbody> --}}
                    </table>
                    {{-- {{ $daftaruser->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal ">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group row justify-content-center">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email"
                                value="" required="">
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter Password" value="">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 col-form-label">LevelAdmin</label>
                        <div class="col-sm-8" id="selek">
                            <select id="roleh" name="roleh" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-8 offset-sm-2">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                changes</button>
                        </div>
                    </div>
                </form>
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