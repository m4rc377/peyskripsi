<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GajiController extends Controller
{
    public function __construct()
    {
        // Firebase File for for access from this controller
        $this->gaji = "gaji"; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $daftar_gaji = fbSelect($this->gaji, null, 'token');
            $results = arrayToCollection($daftar_gaji, true);
        } catch (ApiException $e) {
            return view('gaji.index')->with('warning', $e->getMessage());
        }
        return view('gaji.index', compact('results'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_method', '_token', 'submit');
            $create = FirebaseCreate('gaji', $data, true);
        } catch (ApiException $e) {
            return back()->withInput()->with('warning', $e->getMessage());
        }

        // Detecvt If Succesfull Inset to database
        if ($create) {
            return redirect(route('gaji.index'))->with('success', 'Mengisi data gaji pegawai.');
        } else {
            return back()->withInput()->with('warning', 'Terjadi kesalahan coba sekali lagi.');
        }
    }

}
