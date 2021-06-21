@extends('adminlte::page')

@section('title', 'Tambah Agama')
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
                <h5 class="card-title">Tambah Agama</h5>
            </div>
            <form role="form" action="{{ route('agama.store') }}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="agama">Nama Agama</label>
                        <input type="text" inputmode="numeric" class="form-control" id="agama" name="agama" placeholder="Nama Agama"
                            autocomplete="off">
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
