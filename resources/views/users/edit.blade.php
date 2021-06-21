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
<div class="rona">
    <div class="col-12">
        @include('component.alert')
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Pengguna</h5>
            </div>
            <form role="form" action="{{ route('users.update', $results->uid) }}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="displayName">Nama Pengguna</label>
                        <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Nama Pengguna" value="{{$results->displayName}}"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Pengguna</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Pengguna" value="{{$results->email}}"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password Pengguna</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password Pengguna"
                            autocomplete="off">
                        <div id="popover-password">
                            <div class="progress progress-sm">
                                <div id="password-strength" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%
                                </div>
                            </div>
                        </div>
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
