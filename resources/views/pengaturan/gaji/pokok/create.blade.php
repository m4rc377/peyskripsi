@extends('adminlte::page')

@section('title', 'Buat Pengajuan Gaji')
@section('plugins.Select2', true)
@section('plugins.inputmask', true)
@section('plugins.assets', true)

@section('content_header')
<h1 class="m-0 text-dark">Pengajuan Gaji</h1>
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
                <h5 class="card-title">Buat Pengajuan Gaji</h5>
            </div>
            <form role="form" action="{{ route('gaji-pokok.store') }}" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Gaji Pokok</label>
                        <input type="text" inputmode="numeric" class="form-control" id="nama" name="nama"
                            placeholder="Nama Gaji Pokok" autocomplete="off" value="">
                    </div>
                    <div class="form-group">
                        <label for="golongan">Jabatan Golongan</label>
                        <select name="golongan" id="golongan" class="form-control select2noadd" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                            @foreach ($results as $golongan)
                            <option value="{{$golongan->nama}}">{{$golongan->nama}} ({{$golongan->kode}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dari">Lama masa kerja</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="masa_dari"><small>Dari tahun</small></label>
                                    <input type="text" inputmode="numeric" class="form-control" id="masa_dari" name="masa_dari"
                                        placeholder="Nama Gaji Pokok" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="masa_sampai"><small>Sampai Tahun</small></label>
                                    <input type="text" inputmode="numeric" class="form-control" id="masa_sampai" name="masa_sampai"
                                        placeholder="Nama Gaji Pokok" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai Gaji</label>
                        <input type="text" inputmode="numeric" class="form-control nilai" id="nilai" name="nilai"
                            placeholder="Nilai Gaji Pokok" autocomplete="off">
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
