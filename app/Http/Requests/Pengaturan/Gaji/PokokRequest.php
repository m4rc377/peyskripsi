<?php

namespace App\Http\Requests\Pengaturan\Gaji;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class PokokRequest extends FormRequest
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
            'nama'          => 'required|min:3|max:255',
            'golongan'      => 'required',
            'masa_dari'     => 'required|numeric|max:2',
            'masa_sampai'   => 'required|numeric|max:2',
            'nilai'         => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            //'required' => 'Kolom ":attribute" tidak boleh dikosongkan.',

            'nama.required' => 'Kolom ":attribute" tidak boleh dikosongkan.',
            'nama.min' => 'Panjang karakter pada kolom ":attribute" minimal :min karakter.',
            'nama.max' => 'Panjang karakter pada kolom ":attribute" maksimal :max karakter.',

            'masa_dari.required' => 'Kolom ":attribute" tidak boleh dikosongkan.',
            'masa_dari.min' => 'Panjang karakter pada kolom ":attribute" minimal :min karakter.',
            'masa_dari.max' => 'Panjang karakter pada kolom ":attribute" maksimal :max karakter.',
            'masa_dari.numeric'     => 'Kolom ":attribute" harus berupa angka.',

            'masa_sampai.required' => 'Kolom ":attribute" tidak boleh dikosongkan.',
            'masa_sampai.min' => 'Panjang karakter pada kolom ":attribute" minimal :min karakter.',
            'masa_sampai.max' => 'Panjang karakter pada kolom ":attribute" maksimal :max karakter.',
            'masa_sampai.numeric'     => 'Kolom ":attribute" harus berupa angka.',

            'nilai.required'     => 'Kolom ":attribute" tidak boleh kosong.',
            'nilai.numeric'     => 'Kolom ":attribute" harus berupa angka.',

        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama Gaji Pokok',
            'golongan' => 'Jabatan',
            'masa_dari' => 'Lama Masa Kerja Dari Tahun',
            'masa_sampai' => 'Lama Masa Kerja Sampai Tahun',
            'nilai' => 'Nilai Gaji',
            
        ];
    }
}
