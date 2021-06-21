<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function __construct()
    {
        // Firebase File for for access from this controller
        $this->gaji = "gaji";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $results = fbSelect($this->gaji, $token, 'token');
        return view('slip.show', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lihat(Request $request)
    {
        $results = fbSelectWhere('gaji', 'nip', $request->search, true);
        if($results){
            return view('slip.show', compact('results'));
        }else{
            return back()->withInput()->with('warning', 'NIP yang anda masukan tidak ditemukan.');
            //return redirect(route('home.index'))->with('warning', 'Anda sukses menginput data.');
        }
    }
}
