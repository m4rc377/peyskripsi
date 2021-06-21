@extends('adminlte::page')

@section('title', 'Informasi Gaji')
{{--
@section('plugins.Datatables', true)
--}}
@section('plugins.Select2', true, true)
@section('plugins.moment', true)
@section('plugins.inputmask', true)
@section('plugins.croppie', true)
@section('plugins.assets', true)
{{-- @section('plugins.daterangepicker', true) --}}
@section('plugins.tempusdominusbs4', true)

@section('content_header')
<h1 class="m-0 text-dark">Informasi Gaji</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        @include('component.alert')
        <div class="card">
            <div class="card-body">
                <form id="form" method="POST" action="{{route('gaji.store')}}" enctype="multipart/form-data" autocorrect="off"
                    autocapitalize="off" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="input_month_years">
                                    <i class="fab fa-trash-undo"></i>Periode
                                </label>
                                <div class="input-group date" id="month_years" data-target-input="nearest">
                                    <input type="text" value="{{$pegawai->periode}}" class="form-control datetimepicker-input"
                                        aria-labelledby='ttl' data-target="#month_years"
                                        name="periode" id="input_month_years"
                                        data-toggle="datetimepicker" />
                                    <div class="input-group-append" data-target="#month_years" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nip">Nomor Induk Pegawai</label>
                                <input type="text" inputmode="numeric" class="form-control" id="nip" name="nip"
                                    placeholder="NIP (Nomor Induk Pegawai)" value="{{$pegawai->nip}}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="{{$pegawai->nama}}">
                            </div>
                            <div class="form-group">
                                <label for="posisi">Golongan</label>
                                <input type="text" class="form-control" id="golongan" name="golongan" placeholder="Golongan"
                                    value="{{$pegawai->golongan}}">
                            </div>
                            <div class="form-group">
                                <label for="posisi">Jabatan</label>
                                <input type="text" class="form-control" id="posisi" name="posisi"
                                    placeholder="Jabatan" value="{{$pegawai->posisi}}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" rows="3" id="alamat" name="alamat"
                                    placeholder="Alamat ...">{{$pegawai->alamat}}</textarea>
                            </div>

                            <!-- Table row -->
                            <p class="lead">Rincian gaji</p>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 50%;">Nama</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total Tunjangan</td>
                                                <td>{{$pegawai->total_tunjangan}}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Potongan</td>
                                                <td>{{$pegawai->total_potongan}}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Gaji Pokok</td>
                                                <td>{{$pegawai->gaji_pokok}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"><strong class="float-right">Gaji Pokok</strong></td>
                                                <td>{{$pegawai->gaji_bersih}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <p class="lead">Daftar Potongan</p>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%;">No</th>
                                                <th style="width: 30%;">Nama</th>
                                                <th>Besaran Potongan</th>
                                                <th>Sub Total Potongan</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pegawai->daftar_potongan as $potongan)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$potongan->nama}}</td>
                                                <td>{{$potongan->nilai_format}}</td>
                                                <td>{{$potongan->nilai_potongan}}</td>
                                            </tr>
                                            <input type="hidden" name="potongan[{{ $loop->index }}][nilai_format]" value="{{$potongan->nilai_format}}" />
                                            <input type="hidden" name="potongan[{{ $loop->index }}][nilai_potongan]" value="{{$potongan->nilai_potongan}}" />
                                            <input type="hidden" name="potongan[{{ $loop->index }}][nama]" value="{{$potongan->nama}}" />
                                            <input type="hidden" name="potongan[{{ $loop->index }}][slug]" value="{{$potongan->slug}}" />
                                            @endforeach
                                            <tr>
                                                <td colspan="3"><strong class="float-right">Total Potongan</strong></td>
                                                <td>{{$pegawai->total_potongan}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>

                            <!-- Table row -->
                            <p class="lead">Daftar Tunjangan</p>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%;">No</th>
                                                <th style="width: 30%;">Nama</th>
                                                <th>Besaran Tunjangan</th>
                                                <th>Sub Total Tunjangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pegawai->daftar_tunjangan as $tunjangan)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$tunjangan->nama}}</td>
                                                <td>{{$tunjangan->nilai_format}}</td>
                                                <td>{{$tunjangan->nilai_tunjangan}}</td>
                                            </tr>
                                            <input type="hidden" name="tunjangan[{{ $loop->index }}][nilai_format]" value="{{$tunjangan->nilai_format}}" />
                                            <input type="hidden" name="tunjangan[{{$loop->index}}][nilai_tunjangan]" value="{{$tunjangan->nilai_tunjangan}}" />
                                            <input type="hidden" name="tunjangan[{{$loop->index}}][nama]" value="{{$tunjangan->nama}}" />
                                            <input type="hidden" name="tunjangan[{{$loop->index}}][slug]" value="{{$tunjangan->slug}}" />
                                            @endforeach
                                            <tr>
                                                <td colspan="3"><strong class="float-right">Total Tunjangan</strong></td>
                                                <td>{{$pegawai->total_tunjangan}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="hidden" name="waktu_penerimaan" value="{{$pegawai->waktu_penerimaan}}" />
                        <input type="hidden" name="gaji_kotor" value="{{$pegawai->gaji_kotor}}" />
                        <input type="hidden" name="gaji_bersih" value="{{$pegawai->gaji_bersih}}" />
                        <input type="hidden" name="total_tunjangan" value="{{$pegawai->total_tunjangan}}" />
                        <input type="hidden" name="total_potongan" value="{{$pegawai->total_potongan}}" />
                        <input type="hidden" name="gaji_pokok" value="{{$pegawai->gaji_pokok}}" />
                        <input type="hidden" name="gaji_kotor" value="{{$pegawai->gaji_kotor}}" />
                        <input type="hidden" name="no_struk" value="{{$pegawai->no_struk}}" />
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
@stop
