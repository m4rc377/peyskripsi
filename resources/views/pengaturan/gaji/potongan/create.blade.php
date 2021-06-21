@extends('adminlte::page')

@section('title', 'Tambah Potongan Gaji')
@section('plugins.inputmask', true)
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
                <h5 class="card-title">Tambah Potongan Gaji</h5>
            </div>
            <form role="form" action="{{ route('gaji-potongan.store') }}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Potongan Gaji</label>
                        <input type="text" inputmode="numeric" class="form-control" id="nama" name="nama"
                            placeholder="Nama Potongan Gaji" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nilai">Besaran Potongan</label>
                        <div class="input-group">
                            <label for="nilai">
                                <div class="input-group-prepend" for="nilai">
                                    <span class="input-group-text">
                                        <input class="mr-1" id="formula" type="radio" name="formula" value="nilai">
                                        Rp.
                                    </span>
                                </div>
                            </label>
                            <input type="text" inputmode="numeric" class="form-control nilai" id="nilai" name="nilai" placeholder="Besaran Potongan Gaji" autocomplete="off">
                            <label for="persen">
                                <div class="input-group-append" for="persen">
                                    <span class="input-group-text">
                                        %
                                        <input class="ml-1" type="radio" id="persen" name="formula" value="persen">
                                    </span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @csrf
                    <div class="margin">
                        <div class="savebtn">
                            <div class="btn-group btn-block">
                                <button type="type" class="btn btn-primary btn-block" id="submit" name="submit"
                                    value="save">Save</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="save">Save</a>
                                    <a class="dropdown-item" href="#" id="saveback">Save & Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@stop
