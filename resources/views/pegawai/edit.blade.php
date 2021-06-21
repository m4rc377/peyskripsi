@extends('adminlte::page')

@section('title', 'Edit Data Pegawai')

@section('plugins.Select2', true)
@section('plugins.moment', true)
@section('plugins.inputmask', true)
@section('plugins.croppie', true)
@section('plugins.assets', true)


@section('plugins.tempusdominusbs4', true)

@section('content_header')
<h1 class="m-0 text-dark">Edit Data Pegawai</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        @include('component.alert')
        <div class="card">
            <div class="card-body">
                <form id="form" method="POST" action="{{route('pegawai.update', $results->token)}}" enctype="multipart/form-data" autocorrect="off" autocapitalize="off" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-5 col-xl-3">
                            @isset($results->foto)
                            <script>
                                var avatar = '{{getAvatarDir() .'/'.$results->foto}}';
                            </script>
                            @endisset

                            <div class="avatar">
                                <div class="upload-demo">
                                    <input type="file" id="upload" accept="image/*" data-role="none" />
                                    <input type="hidden" id="foto" value="{{$results->foto}}" name="foto" />
                                    <div class="col-1-2" style="margin: 0 auto;">
                                        <div class="upload-msg">
                                            Click to upload a title image
                                        </div>

                                        <div id="upload-demo"></div>

                                    </div>
                                </div>
                                <div class="buttons">
                                    <div id="upload-result" class="btn btn-primary" data-role="none" >Use This Image</div>
                                    <div id="reset" class="btn btn-danger" data-role="none" style="margin-left:5px;">Remove Image</div>
                                </div>
                                <div class="desc_drag" style="margin:0 auto;display:table;">
                                    Geser untuk menyesuaikan foto atau tarik slide untuk mendapatkan hasil yang sesuai
                                </div>
                                <div class="desc" style="margin:0 auto;display:table;">
                                    Klik untuk mengunggah gambar, maksimal gambar 2MB dan berformat .bmp, .gif, .jpg, .jpeg, atau .png
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-8 col-lg-7 col-xl-9">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <!-- ini satu -->
                                    <fieldset>
                                        <legend>Data Kepegawaian</legend>
                                        <div class="form-group">
                                            <label for="nip">Nomor Induk Pegawai</label>
                                            <input type="text" inputmode="numeric" class="form-control" id="nip" name="nip"
                                                placeholder="NIP (Nomor Induk Pegawai)" value="{{$results->nip}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="posisi">Posisi Jabatan</label>
                                            <select name="posisi" id="posisi" class="form-control select2noadd" style="width: 100%;">
                                                <option selected="selected" disabled>Pilih</option>
                                                @foreach ($data->jabatan_posisi as $jabatan_posisi)
                                                <option value="{{$jabatan_posisi->nama}}" {{($jabatan_posisi->nama == $results->posisi) ? 'selected' : ''}}>
                                                    {{$jabatan_posisi->nama}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="golongan">Jabatan Golongan</label>
                                            <select name="golongan" id="golongan" class="form-control select2noadd" style="width: 100%;">
                                                <option selected="selected" disabled>Pilih</option>
                                                @foreach ($data->jabatan_golongan as $jabatan_golongan)
                                                <option value="{{$jabatan_golongan->nama}}" {{($jabatan_golongan->nama == $results->golongan) ? 'selected' : ''}}>
                                                    {{$jabatan_golongan->nama}} ({{$jabatan_golongan->kode}})
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_month_years"><i class="fab fa-trash-undo"></i>Tahun Pengangkatan</label>
                                            <div class="input-group date" id="month_years" data-target-input="nearest">
                                                <input type="text" value="{{$results->tahun_pengangkatan}}" class="form-control datetimepicker-input" aria-labelledby='ttl' data-target="#month_years"
                                                    name="tahun_pengangkatan" id="input_month_years" data-toggle="datetimepicker" />
                                                <div class="input-group-append" data-target="#month_years" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Data Pendidikan</legend>
                                        <div class="form-group">
                                            <label for="pendididkan_jenjang_awal">Awal</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pendididkan_gelar_awal"><small>Gelar</small></label>
                                                        <select name="pendididkan_gelar_awal" id="pendididkan_gelar_awal"
                                                            class="form-control select2noadd" style="width: 100%;">
                                                            <option selected="selected" disabled>Pilih</option>
                                                            @foreach ($data->pendididkan_gelar as $pendididkan_gelar)
                                                            <option value="{{$pendididkan_gelar->nama}}" {{($pendididkan_gelar->nama == $results->pendididkan_gelar_awal) ? 'selected' : ''}}>{{$pendididkan_gelar->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pendididkan_institusi_awal"><small>Sekolah</small></label>
                                                        <select name="pendididkan_institusi_awal" id="pendididkan_institusi_awal"
                                                            class="form-control select2noadd" style="width: 100%;">
                                                            <option selected="selected" disabled>Pilih</option>
                                                            @foreach ($data->pendididkan_institusi as $pendididkan_institusi)
                                                            <option value="{{$pendididkan_institusi->nama}}" {{($pendididkan_institusi->nama == $results->pendididkan_institusi_awal) ? 'selected' : ''}}>
                                                                {{$pendididkan_institusi->nama}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <label for="pendididkan_jenjang_terakhir">Terakhir</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pendididkan_gelar_terakhir"><small>Gelar</small></label>
                                                        <select name="pendididkan_gelar_terakhir" id="pendididkan_gelar_terakhir"
                                                            class="form-control select2noadd" style="width: 100%;">
                                                            <option selected="selected" disabled>Pilih</option>
                                                            @foreach ($data->pendididkan_gelar as $pendididkan_gelar)
                                                            <option value="{{$pendididkan_gelar->nama}}" {{($pendididkan_gelar->nama == $results->pendididkan_gelar_terakhir) ? 'selected' : ''}}>
                                                                {{$pendididkan_gelar->nama}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pendididkan_institusi_terakhir"><small>Sekolah</small></label>
                                                        <select name="pendididkan_institusi_terakhir" id="pendididkan_institusi_terakhir"
                                                            class="form-control select2noadd" style="width: 100%;">
                                                            <option selected="selected" disabled>Pilih</option>
                                                            @foreach ($data->pendididkan_institusi as $pendididkan_institusi)
                                                            <option value="{{$pendididkan_institusi->nama}}" {{($pendididkan_institusi->nama == $results->pendididkan_institusi_terakhir) ? 'selected' : ''}}>
                                                                {{$pendididkan_institusi->nama}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <!-- ini dua -->
                                    <fieldset>
                                        <legend>Data Identitas</legend>
                                        <div class="form-group">
                                            <label for="npwp">Nomor Wajib pajak (NPWP)</label>
                                            <input type="text" inputmode="numeric" class="form-control" id="npwp" name="npwp"
                                                placeholder="Nomor Wajib pajak (NPWP)" value="{{$results->npwp}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="rekening">Nomor Rekening</label>
                                            <input type="text" inputmode="numeric" class="form-control" id="rekening" name="rekening"
                                                placeholder="Nomor Rekening" value="{{$results->rekening}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="{{$results->nama}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kelamin">Jenis Kelamin</label>
                                            <select name="kelamin" id="kelamin" class="form-control select2noadd" style="width: 100%;">
                                                <option selected="selected" disabled>Pilih</option>
                                                @foreach ($data->kelamin as $kelamin)
                                                <option value="{{$kelamin->nama}}" {{($kelamin->nama == $results->kelamin) ? 'selected' : ''}}>{{$kelamin->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select id="agama" name="agama" class="form-control select2noadd" style="width: 100%">
                                                <option selected="selected" disabled>Pilih</option>
                                                @foreach ($data->agama as $agama)
                                                <option value="{{$agama->nama}}" {{($agama->nama == $results->agama) ? 'selected' : ''}}>{{$agama->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label id='ttl'>Tempat Tanggal Lahir</label>
                                            <div class="row">
                                                <div class="col-md-8 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="kota_lahir"><small>Kota</small></label>
                                                        <input type="text" class="form-control" id="kota_lahir" aria-labelledby='ttl' name="kota_lahir"
                                                            placeholder="Tempat" value="{{$results->kota_lahir}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="input_tanggal_lahir"><small>Tanggal</small></label>
                                                        <div class="input-group date" id="tanggal_lahir" data-target-input="nearest">
                                                            <input type="text" class="form-control datetimepicker-input" aria-labelledby='ttl' value="{{$results->tanggal_lahir}}"
                                                                data-target="#tanggal_lahir" name="tanggal_lahir" id="input_tanggal_lahir" data-toggle="datetimepicker"/>
                                                            <div class="input-group-append" data-target="#tanggal_lahir" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><div class="form-group">
                                            <label for="status_pernikahan">Status Menikah</label>
                                            <select name="status_pernikahan" id="status_pernikahan" class="form-control select2noadd" style="width: 100%;">
                                                <option selected="selected" disabled>Pilih</option>
                                                @foreach ($data->status_pernikahan as $status_pernikahan)
                                                <option value="{{$status_pernikahan->nama}}" {{($status_pernikahan->nama == $results->status_pernikahan) ? 'selected' : ''}}>{{$status_pernikahan->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" rows="3" id="alamat" name="alamat" placeholder="Alamat ...">{{$results->alamat}}</textarea>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
@stop
