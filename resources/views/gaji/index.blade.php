@extends('adminlte::page')

@section('title', 'Daftar Gaji')
@section('plugins.Datatables', true)
@section('plugins.bootstrap-table', true)

@section('content_header')
<h1 class="m-0 text-dark">Daftar Gaji</h1>
@stop

@section('css')
<style>
    table.table th:last-child {
        width: 200px;
    }

    .btn-action {
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
                <h5 class="card-title">Daftar Penerima Gaji</h5>
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
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Periode</th>
                                    <th>Waktu Penerimaan</th>
                                    <th style="text-align: center;width:160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$result->nip}}</td>
                                    <td>{{$result->nama}}</td>
                                    <td>{{$result->periode}}</td>
                                    <td>{{$result->waktu_penerimaan}}</td>
                                    <td style="text-align: center;">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Lihat Struk Gaji" onclick="window.open('{{ route("slip.show", $result->token ) }}','_blank')">
                                                    <i class="fas fa-receipt"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{--
                            <tfoot>
                                <tr>
                                    <th style="width: 1%;">No.</th>
                                    <th>Nama</th>
                                    <th style="text-align: center;width:150px;">Aksi</th>
                                </tr>
                            </tfoot> 
                            --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
