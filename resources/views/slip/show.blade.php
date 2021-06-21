@extends('adminlte::master')

@section('title', 'Slip Gaji ')

@section('plugins.assets', true)

@section('adminlte_js')
<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
@stop

@section('adminlte_css')
<style>
    .table_title {
    margin: 1em 0 0 0;
    border: none;
    border-style: none;
    }
    
    
    
    th,
    td {
    padding: 0.25em 0.5em 0.25em 1em;
    vertical-align: text-top;
    text-align: left;
    text-indent: -0.5em;
    }
</style>
@stop

@section('classes_body', 'landing')

@section('body')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-5 invoice-col">
                            <table class="table_title">
                            
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{$results->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td>{{$results->nip}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td>{{$results->posisi}}</td>                        
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>
                                            <address>
                                                {{$results->alamat}}
                                            </address>
                                    </td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-5 invoice-col">
                            <table class="table_title">
                                <tbody>
                                    <tr>
                                        <td>Periode</td>
                                        <td>:</td>
                                        <td>{{$results->periode}}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Struk Gaji</td>
                                        <td>:</td>
                                        <td>{{$results->no_struk}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tangal Penerimaan</td>
                                        <td>:</td>
                                        <td>{{$results->waktu_penerimaan}}</td>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <p class="lead">Potongan</p>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results->potongan as $potongan)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$potongan['nama']}}</td>
                                        <td>{{$potongan['nilai_format']}}</td>
                                        <td>{{$potongan['nilai_potongan']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <p class="lead">Tunjangan</p>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results->tunjangan as $tunjangan)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$tunjangan['nama']}}</td>
                                        <td>{{$tunjangan['nilai_format']}}</td>
                                        <td>{{$tunjangan['nilai_tunjangan']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-5 offset-md-7">

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Total Potongan:</th>
                                        <td>{{$results->total_potongan}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Tunjangan</th>
                                        <td>{{$results->total_tunjangan}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Gaji Pokok:</th>
                                        <td>{{$results->gaji_pokok}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total diterima:</th>
                                        <td>{{$results->gaji_bersih}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@stop
