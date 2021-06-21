@extends('adminlte::page')

@section('title', 'Profile User')
@section('plugins.assets', true)

@section('content_header')
<h1 class="m-0 text-dark">Profile</h1>
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
                <h5 class="card-title">Profile</h5>
            </div>
            <form role="form" action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="display_name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Nama lengkap"
                            value="{{$results->displayName}}" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="user@domain.tdl"
                            value="{{$results->email}}" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="password">Password <small>(biarkan kosong jika tidak ingin diganti)</small></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password (biarkan kosong jika tidak ingin diganti)"
                            autocomplete="off" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
                        <div id="popover-password">
                            <div class="progress progress-sm">
                                <div id="password-strength" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label for="password_verify">Checking password</label>
                        <input type="password" class="form-control" id="password_verify" name="password_verify" placeholder="Check password kembali"
                            autocomplete="off">
                    </div>
                </div>
                <div class="card-footer">
                    @csrf
                    @method('POST')
                    <div class="margin">
                        <div class="btn-simpan">
                            <input type="hidden" name="uid" value="{{$results->uid}}">
                            <button type="type" class="btn btn-primary btn-block" id="submit" name="submit" value="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
