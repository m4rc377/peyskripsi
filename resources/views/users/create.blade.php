@extends('adminlte::page')

@section('title', 'Tambah Pengguna')
@section('plugins.Select2', true)
@section('plugins.moment', true)
{{-- @section('plugins.inputmask', true) --}}
@section('plugins.assets', true)

@section('content_header')
<h1 class="m-0 text-dark">Pengguna</h1>
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
                <h5 class="card-title">Tambah Pengguna</h5>
            </div>
            <form role="form" action="{{ route('users.store') }}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nama Pengguna"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Pengguna</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Pengguna"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password Pengguna</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password Pengguna"
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
