<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Storage;
use Kreait\Firebase\Database;
use Kreait\Firebase\Exception\ApiException;
use Illuminate\Support\Arr;
use App\DummyModel;
use Illuminate\Support\Carbon;
use App\Http\Requests\PegawaiRequest;
use File;
use Storage as Penyimpanan;

class PegawaiController extends Controller
{
    public function __construct(Database $database, Storage $storage)
    {
        $this->database = $database;
        $this->storage = $storage;
        $this->tabel = "pegawai";
        $this->timestamp = ['.sv' => 'timestamp'];
        $this->gaji_pokok = "pengaturan/gaji/pokok";
        $this->gaji_potongan = "pengaturan/gaji/potongan";
        $this->gaji_tunjangan = "pengaturan/gaji/tunjangan";
    }

    /**
     * Ini adalah reusable Firebase Select ke model, yang diperlukan pada index create dan edit
     * Menggunakan helper yang di buat pada Helpers/Puskesmas agar memuat semua data yang diperlukan pada controller ini.
     * sehingga tidak menggunakan kode yang berulang ulang.
     * Panjang booo bisa berulang makan 3 buku 3 lemari dan 1 perpustakaan
     *
     * @param string $ref
     * @param string $inputdata
     * @param string $inputdataname
     * @return \Illuminate\Http\Response
     */
    public function loadAllData()
    {
        $ref_golongan = 'pengaturan/jabatan/golongan';
        $jabatan_golongan = fbSelect($ref_golongan, null, 'token');

        $ref_posisi = 'pengaturan/jabatan/posisi';
        $jabatan_posisi = fbSelect($ref_posisi, null, 'token');

        $ref_kelamin = 'pengaturan/kelamin';
        $kelamin = fbSelect($ref_kelamin, null, 'token');

        $ref_agama = 'pengaturan/agama';
        $agama = fbSelect($ref_agama, null, 'token');

        $ref_status = 'pengaturan/status';
/* 
        $ref_status_pegawai = $ref_status . '/pegawai';
        $status_pegawai = fbSelect($ref_status_pegawai, null, 'token');
*/

        $ref_status_pernikahan = $ref_status . '/pernikahan';
        $status_pernikahan = fbSelect($ref_status_pernikahan, null, 'token');

        $ref_pendidikan = 'pengaturan/pendidikan';
        $ref_institusi = $ref_pendidikan.'/institusi';
        $pendididkan_institusi = fbSelect($ref_institusi, null, 'token');
        $ref_jenjang = $ref_pendidikan . '/jenjang';
        $pendididkan_jenjang = fbSelect($ref_jenjang, null, 'token');

        $arr = array(
            'jabatan_golongan' => $jabatan_golongan,
            'jabatan_posisi' => $jabatan_posisi,
            'kelamin' => $kelamin,
            'agama' => $agama,
            /* 'status_pegawai' => $status_pegawai, */
            'status_pernikahan' => $status_pernikahan,
            'pendididkan_institusi' => $pendididkan_institusi,
            'pendididkan_gelar' => $pendididkan_jenjang
        );

        //$results = toObjectCollection($arr, true);
        $results = toObject($arr, false);
        return $results;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pegawai = FirebaseSelect($this->tabel);
            $results = collect($pegawai)->map(function ($value, $key) /* use ($pegawaiModel) */ {
                $pegawaiModel = new DummyModel;
                $keyparrent = $key;
                collect($value)->map(function ($value, $key) use ($pegawaiModel, $keyparrent) {
                    $pegawaiModel->$key = $value;
                    Arr::add($pegawaiModel, 'token', $keyparrent); // add token to inside, just in case (this will be error if token not loaded fro begining )
                });
                return $pegawaiModel;
            });

            /* Firebase not support Pagination for now - https://github.com/kreait/firebase-php/issues/203 */
            return view('pegawai.index', compact('results'));
        } catch (ApiException $e) {
            //return view('pegawai.index');
            return view('pegawai.index')->with('warning', $e->getMessage());
        }


    }


    public function show($token)
    {

        // load database pegawai selected
        $pegawai = fbSelect($this->tabel, $token, 'token');
        $daftar_gaji_pokok = fbSelect($this->gaji_pokok, '', 'token');
        $masakerja = masakerja($pegawai->tahun_pengangkatan);
        $gaji_pokok = perkiraanGajiPokok($daftar_gaji_pokok, $masakerja, $pegawai);

        $daftar_gaji_potongan = fbSelect($this->gaji_potongan);
        $daftar_gaji_potongan = arrayToCollection($daftar_gaji_potongan, true);


        $daftar_gaji_tunjangan = fbSelect($this->gaji_tunjangan, '', 'token');
        $daftar_gaji_tunjangan = arrayToCollection($daftar_gaji_tunjangan, true);

        $total_potongan = hitunganKomponenGaji($daftar_gaji_potongan, $gaji_pokok);
        $total_tunjangan = hitunganKomponenGaji($daftar_gaji_tunjangan, $gaji_pokok);
        
        $daftar_potongan = daftar_hitung_potongan($daftar_gaji_potongan, $gaji_pokok);

        $daftar_tunjangan = daftar_hitung_tunjangan($daftar_gaji_tunjangan, $gaji_pokok);

        $pegawai->gaji_pokok = nilai_format($gaji_pokok, 2, '.', ',', 'Rp. ', '');

        $pegawai->daftar_potongan = $daftar_potongan;
        $pegawai->daftar_tunjangan = $daftar_tunjangan;
        $pegawai->total_potongan = nilai_format($total_potongan, 2, '.', ',', 'Rp. ', '');
        $pegawai->total_tunjangan = nilai_format($total_tunjangan, 2, '.', ',', 'Rp. ', '');

        $gaji_kotor = $gaji_pokok+ $total_tunjangan;
        $pegawai->gaji_kotor = nilai_format($gaji_kotor, 2, '.', ',', 'Rp. ', '');

        $gaji_bersih = ($gaji_pokok + $total_tunjangan) - $total_potongan;
        $pegawai->gaji_bersih = nilai_format($gaji_bersih, 2, '.', ',', 'Rp. ', '');
        $pegawai->periode = Carbon::now()->format('m/Y');
        $pegawai->waktu_penerimaan = Carbon::now();

        $no_struk = Carbon::now()->format('mY').$pegawai->nip;
        $pegawai->no_struk = $no_struk;

        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = $this->loadAllData();
        return view('pegawai.create', compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        $foto_ready = false; // inisialization foto for detection action
        $submit = $request->submit; // initilization for end cheking button

        try {
            if (($request->foto) && (isBase64Image($request->foto))) {
                $base64 = $request->foto;
                $image = base64ToImage($base64);
                $image_name = time() . '.' . $image->ext;
                $fileImage = $image->binary;
                $foto_ready = 'base64';
            } else {
                $fileImage = public_path('img/' . 'pegawai.png');
                $ext = File::extension($fileImage);
                $image_name = time() . '.' . $ext;
                $foto_ready = 'binary';
            }

            data_set($request, 'foto', $image_name); // reinitilization request

            $request = $request->except('_method', '_token', 'submit');
            try {
                $create = FirebaseCreate($this->tabel,$request, true);
            } catch (ApiException $e) {
                return redirect(route('pegawai.index'))->with('error', $e->message());
            }

            // Detecvt If Succesfull Inset to database
            if ($create) {
                // Then uploading foto
                if ($foto_ready == 'base64'){
                    File::put(public_path('upload/' . $image_name),$fileImage);
                } elseif ($foto_ready == 'binary') {
                    File::copy($fileImage, public_path('upload/' . $image_name));
                }else{
                    return redirect(route('pegawai.index'))->with('warning', 'Terdapat kesalahan dalam mengunduh Foto.');
                }

                // Then checking if back or keep on this page
                if ($submit == 'save') {
                    return redirect(route('pegawai.index'))->with('success', 'Anda sukses menginput data.');
                } else {
                    return redirect()->back()->with('success', 'Anda sukses menginput data.');
                }
            } else {
                return back()->withInput()->with('warning', 'Terjadi kesalahan coba sekali lagi.');
            }
        } catch (ApiException $e) {
            return back()->withInput()->with('warning', $e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
        // load database pegawai selected
        $dbPegawai = FirebaseSelect($this->tabel.'/'. $token);
        $results = new DummyModel;
        collect($dbPegawai)->map(function ($value, $key) use ($results, $token) {
            $results->$key = $value;
            Arr::add($results, 'token', $token); // add token to inside, just in case (this will be error if token not loaded fro begining )
        });

        $data = $this->loadAllData();
        return view('pegawai.edit', compact('results', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, $token)
    {
        $foto_ready = false;
        if ($request->foto){
            if (isBase64Image($request->foto)){
                $image = base64ToImage($request->foto);
                // get images name
                $image_name = time() . '.' . $image->ext;
                // change data_pegawai foto data as foto name
                // u can use helpers arr set or data set funtion  | see https://laravel.com/docs/helpers
                // Arr::set($data_pegawai, 'foto', 200);
                data_set($request, 'foto', $image_name);
                $foto_ready = true;
            }
        }

        $request = $request->except('_method', '_token', 'submit');
        $refer = $this->tabel . '/' . $token;
        try {
            $update = FirebaseUpdate($refer, $request);
        } catch (ApiException $e) {
            return redirect(route('pegawai.index'))->with('error', $e->message());
        }

        if ($update) {
            if ($foto_ready) {
                // jika success create data maka upload gambar ke server
                $path = public_path('upload/' . $image_name);
                file_put_contents($path, $image->binary);
            }
            return redirect(route('pegawai.index'))->with('success', 'Anda sukses mengubah data.');
        } else {
            return back()->withInput()->with('warning', 'Terjadi kesalahan coba sekali lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($token)
    {
        // for this time foto not delete need some funtion/action later
        try {
            FirebaseDelete($this->tabel, $token);
            return redirect(route('pegawai.index'))->with('success', 'Anda sukses menghapus data.');
        } catch (ApiException $e) {
            return back()->withInput()->with('warning', $e->getMessage());
        }
    }
}
