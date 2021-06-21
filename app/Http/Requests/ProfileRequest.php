<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'display_name'      => 'required',
            'email'             => 'required|email:rfc,dns',
            'password'          => 'nullable|min:8|required_with:password_verify',
            'password_verify'   => 'required_with:password|same:password'

 /*            'password_verify'     => 'required', */
/*             'password_verify' => 'same:password',
            'password_verify' => 'required_with:password' */
            
        ];
    }

        public function messages()
    {
        return [
            'display_name.required'         => 'Foto harap diisi',
            'email.required'                => 'Kolom :attribute tidak boleh dikosongkan.',
            'email.email'                   => 'Email tidak valid.',
            'password.required_with'        => 'Kolom :attribute tidak boleh kosong.',
            'password_verify.required_with' => 'Kolom :attribute tidak boleh kosong.',
            'password_verify.same'          => 'Kolom verifikasi tidak sama dengan Kolom password',
        ];
    }

    public function attributes()
    {
        return [
            'display_name'      => 'Nama',
            'email'             => 'Email',
            'password'          => 'Kolom Password',
            'password_verify'   => 'Kolom Verifikasi password',
        ];
    }
}
