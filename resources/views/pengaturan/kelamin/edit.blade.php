@extends('adminlte::page')

@section('title', 'Edit Kelamin')
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
                <h5 class="card-title">Edit Kelamin</h5>
            </div>
            <form role="form" action="{{ route('kelamin.update', $results->uid)}}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kelamin">Nama Kelamin</label>
                        <input type="text" inputmode="numeric" class="form-control" id="kelamin" name="kelamin" value="{{$results->nama}}"
                            placeholder="Nama Kelamin" autocomplete="off">
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