@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">Daftar Makanan |
                    @role('admin')
                    <a href="#">Tambah Makanan</a>
                    @endrole
                </div> 
                

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Makanan</th>
                                    <th>Harga</th>
                                    {{-- <th>Last Updated</th> --}}
                                    {{-- @if ( auth()->user()->can('edit post') && auth()->user()->can('delete post'))
                                        <th style="width:10%" colspan="2">Action</th>
                                    @endif --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarmakanan as $item)
                                <tr>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->harga}}</td>
                                    {{-- <td>{{$item->updated_at->toDayDateTimeString()}}</td>  
                                    {{-- @if ( auth()->user()->can('edit post') && auth()->user()->can('delete post'))
                                        <td>
                                        <a href="{{route('edituser', $item->id)}}">
                                            <button class="btn btn-warning btn-sm">Edit</button></a></td><td> --}} --}}
                                        {{-- {!! Form::open(['action' => ['UserController@destroy',$item->id], 'method' => 'POST'])!!}
                                            {{ form::hidden('_method', 'POST')}}
                                        <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                        {!! Form::close()!!} --}}
                                        {{-- </td>   
                                    @endif                --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection