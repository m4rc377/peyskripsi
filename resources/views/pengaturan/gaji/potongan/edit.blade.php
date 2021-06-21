@extends('adminlte::page')

@section('title', 'Edit Potongan Gaji')
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
                <h5 class="card-title">Edit Potongan Gaji</h5>
            </div>
            <form role="form" action="{{ route('gaji-potongan.update', $results->token) }}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Potongan Gaji</label>
                        <input type="text" inputmode="numeric" class="form-control" id="nama" name="nama" value="{{$results->nama}}" placeholder="Nama Potongan Gaji" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nilai">Besaran Potongan</label>
                        <div class="input-group">
                            <label for="nilai">
                                <div class="input-group-prepend" for="nilai">
                                    <span class="input-group-text">
                                        <input class="mr-1" id="nilai" type="radio" name="formula" {{ ($results->formula=="nilai")? "checked value=nilai" : "" }}>
                                        Rp.
                                    </span>
                                </div>
                            </label>
                            <input type="text" value="{{$results->nilai}}" inputmode="numeric" class="form-control nilai" id="nilai" name="nilai" placeholder="Nilai Potongan Gaji" autocomplete="off">
                            <label for="persen">
                                <div class="input-group-append" for="persen">
                                    <span class="input-group-text">
                                        %
                                        <input class="ml-1" type="radio" id="persen" name="formula" value="persen" {{ ($results->formula=="persen")? "checked value=persen" : "" }}>
                                    </span>
                                </div>
                            </label>
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
