@extends('adminlte::page')

@section('title', 'Pengguna')
@section('plugins.Datatables', true)
@section('plugins.bootstrap-table', true)
@section('plugins.assets', true)

@section('content_header')
<h1 class="m-0 text-dark">Pengguna</h1>
@stop

@section('css')
<style>
    table.table th:last-child {
        width: 200px;
    }

    .btn-action {
        /* min-width: 35px; */
        padding-bottom: 5px;
        padding-top: 5px;
    }
</style>

@stop
@section('js')

@stop

@section('content')
<div class="row">
    <div class="col-12">
        @include('component.alert')
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Daftar Pengguna</h5>
                <div class="card-tools mr-1">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('users.create')}}'">
                        <i class="far fa-plus-square"></i> Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="box">
                    <div class="box-header">
                        <h3 class="card-title">
                        </h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped  table-responsive">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th style="text-align: center;width:160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $index => $result)

                                <tr>
                                    <td scope="row">{{$index + 1}}</td>
                                    <td>{{$result->displayName}}</td>
                                    <td>{{$result->email}}</td>
                                    <td style="text-align: center;">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Edit" onclick="window.location='{{ route("users.edit", $result->uid ) }}'"><i class="fa fa-edit"></i></button>
                                            </li>
                                            <li class="list-inline-item">
                                                <form action="{{ route('users.destroy', $result->uid)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm rounded-0" type="submit" data-toggle="tooltip" data-placement="top"
                                                        title="Delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
