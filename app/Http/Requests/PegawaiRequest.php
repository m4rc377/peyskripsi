<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'foto'      => 'required',
            'nip'     => 'required|numeric',
            'posisi'   => 'required',
            'golongan'   => 'required',
            'tahun_pengangkatan'   => 'required',
            /* 'status_pegawai'   => 'required', */
            'pendididkan_gelar_awal'   => 'required',
            'pendididkan_institusi_awal'   => 'required',
            'pendididkan_gelar_terakhir'   => 'required',
            'pendididkan_institusi_terakhir'   => 'required',
            'npwp'   => 'required',
            'rekening'   => 'required',
            'nama'   => 'required',
            'kelamin'   => 'required',
            'agama'   => 'required',
            'kota_lahir'   => 'required',
            'tanggal_lahir'   => 'required',
            'status_pernikahan'   => 'required',
            'alamat'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'foto.required'                             => 'Foto harap diisi',

            'nip.required'                              => 'Kolom :attribute tidak boleh dikosongkan.',
            'nip.numeric'                               => 'Kolom ":attribute" harus berupa angka.',
            
            'posisi.required'                           => ':attribute Harus dipilih terlebih dahulu',
            'golongan.required'                         => ':attribute harus dipilih terlebih dahulu',
            'tahun_pengangkatan.required'               => 'Kolom :attribute tidak boleh dikosongkan.',
            /* 'status_pegawai.required'                   => ':attribute harus dipilih terlebih dahulu', */
            'pendididkan_gelar_awal.required'           => ':attribute harus dipilih terlebih dahulu',
            'pendididkan_institusi_awal.required'       => ':attribute harus dipilih terlebih dahulu',
            'pendididkan_gelar_terakhir.required'       => ':attribute harus dipilih terlebih dahulu',
            'pendididkan_institusi_terakhir.required'   => ':attribute harus dipilih terlebih dahulu',

            'npwp.required'                             => 'Kolom :attribute tidak boleh dikosongkan.',
            'npwp.numeric'                              => 'Kolom ":attribute" harus berupa angka.',
            
            'rekening.required'                         => 'Kolom :attribute tidak boleh dikosongkan.',
            'rekening.numeric'                          => 'Kolom ":attribute" harus berupa angka.',

            'nama.required'                             => 'Kolom :attribute tidak boleh dikosongkan.',

            'kelamin.required'                          => ':attribute harus dipilih terlebih dahulu',
            'agama.required'                            => ':attribute harus dipilih terlebih dahulu',
            'kota_lahir.required'                       => 'Kolom :attribute tidak boleh dikosongkan.',
            'tanggal_lahir.required'                    => 'Kolom :attribute tidak boleh dikosongkan.',
            'status_pernikahan.required'                => ':attribute harus dipilih terlebih dahulu',
            'alamat.required'                           => 'Kolom :attribute tidak boleh dikosongkan.',
/*             'nama.required' => 'Kolom ":attribute" tidak boleh dikosongkan.',
            'nama.min' => 'Panjang karakter pada kolom ":attribute" minimal :min karakter.',
            'nama.max' => 'Panjang karakter pada kolom ":attribute" maksimal :max karakter.',
            'nilai.required'     => 'Kolom ":attribute" tidak boleh kosong.',
            'nilai.numeric'     => 'Kolom ":attribute" harus berupa angka.',
            'formula.required' => 'Jenis Tunjangan harus dipilih.', */
        ];
    }

    public function attributes()
    {
        return [
            'foto'      => 'Foto|sometimes',
            'nip'     => 'NIP (Nomor Induk Pegawai)',
            'posisi'   => 'Posisi Jabatan',
            'golongan'   => 'Golongan',
            'tahun_pengangkatan'   => 'Tahun Pengangkatan',
            /* 'status_pegawai'   => 'Status Pegawai', */
            'pendididkan_gelar_awal'   => 'Gelar Saat Diangkat',
            'pendididkan_institusi_awal'   => 'Lulusan Saat Diangkat',
            'pendididkan_gelar_terakhir'   => 'Gelar Saat Ini',
            'pendididkan_institusi_terakhir'   => 'Lulusan Saat Ini',
            'npwp'   => 'NPWP (Nomor Wajib Pajak)',
            'rekening'   => 'Rekening',
            'nama'   => 'Nama Lengkap',
            'kelamin'   => 'Jenis Kelamin',
            'agama'   => 'Agama',
            'kota_lahir'   => 'Kota Kelahiran',
            'tanggal_lahir'   => 'Tanggal Lahir',
            'status_pernikahan'   => 'Status Pernikahan',
            'alamat'   => 'Alamat',
        ];
    }
}
