@extends('adminlte::page')

@section('title', 'Daftar Pegawai')
@section('plugins.Datatables', true)
@section('plugins.bootstrap-table', true)

@section('content_header')
<h1 class="m-0 text-dark">Daftar Pegawai</h1>
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
                <h5 class="card-title">Daftar Pegawai</h5>
                <div class="card-tools mr-1">
                    <button type="button" class="btn btn-primary"
                        onclick="window.location.href='{{route('pegawai.create')}}'">
                        <i class="far fa-plus-square"></i> Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped  table-responsive">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">No.</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th style="text-align: center;width:160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td class="products-list product-list-in-card pl-2 pr-2">
                                        <div class="product-img">
                                            <img src="{{getAvatarDir().'/'.$result->foto}}" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                            <div class="product-title">{{$result->nama}}</div>
                                            <span class="product-description">
                                                <small>NIP: {{$result->nip}}</small>
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{$result->posisi}}</td>
                                    <td style="text-align: center;">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Edit" onclick="window.location='{{ route("pegawai.show", $result->token ) }}'">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button class="btn btn-success btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    onclick="window.location='{{ route("pegawai.edit", $result->token ) }}'">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <form action="{{ route('pegawai.destroy', $result->token)}}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm rounded-0" type="submit"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width: 1%;">No.</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th style="text-align: center;width:150px;">Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
@stop
