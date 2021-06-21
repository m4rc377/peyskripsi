@extends('adminlte::page')

@section('title', 'Edit Agama')
@section('plugins.assets', true)

@section('content_header')
<h1 class="m-0 text-dark">Pengaturan</h1>
@stop
@section('js')
@stop

@section('css')
@stop

@section('content')
<div class="row">
    <div class="col-12">
        @include('component.alert')
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Agama</h5>
            </div>
            <form role="form" action="{{ route('golongan.update', $results->uid)}}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode">Kode Golongan</label>
                        <input type="text" inputmode="numeric" class="form-control" id="kode" name="kode" placeholder="Kode Golongan"
                            value="{{$results->kode}}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Golongan</label>
                        <input type="text" inputmode="numeric" class="form-control" id="nama" name="nama" placeholder="Nama Golongan"
                            value="{{$results->nama}}" autocomplete="off">
                    </div>
                </div>
                <div class="card-footer">
                    @csrf
                    @method('PATCH')
                    <div class="margin">
                        <div class="savebtn">
                            <button type="type" class="btn btn-primary btn-block" id="submit" name="submit" value="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@stop