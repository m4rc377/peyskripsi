<?php

namespace App\Http\Requests\Pengaturan\Gaji;

use Illuminate\Foundation\Http\FormRequest;

class TunjanganRequest extends FormRequest
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
            'nama'      => 'required|min:3|max:255',
            'nilai'     => 'required|numeric',
            'formula'   => 'required|in:nilai,persen',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Kolom ":attribute" tidak boleh dikosongkan.',
            'nama.min' => 'Panjang karakter pada kolom ":attribute" minimal :min karakter.',
            'nama.max' => 'Panjang karakter pada kolom ":attribute" maksimal :max karakter.',
            'nilai.required'     => 'Kolom ":attribute" tidak boleh kosong.',
            'nilai.numeric'     => 'Kolom ":attribute" harus berupa angka.',
            'formula.required' => 'Jenis Tunjangan harus dipilih.',
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama Tunjangan Gaji',
            'nilai' => 'Besaran Tunjangan Gaji',
        ];
    }
}
