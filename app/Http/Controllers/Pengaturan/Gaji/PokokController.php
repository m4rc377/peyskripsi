<?php

namespace App\Http\Controllers\Pengaturan\Gaji;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pengaturan\Gaji\PokokRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PokokController extends Controller
{
    public function __construct()
    {
        $this->tabel = "pengaturan/gaji/pokok"; // Firebase File for for access from this controller
        $this->golongan = "pengaturan/jabatan/golongan";
        $this->timestamp = ['.sv' => 'timestamp']; // definisi timestamp firebase
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = fbSelect($this->tabel, null, 'token');

        $results = collect($results)->map(function ($item) {
            collectionSuffixPrefix($item, 'nilai', 'Rp. ', 'prefix', false);
            return $item;
        });

        /* Firebase not support Pagination for now - https://github.com/kreait/firebase-php/issues/203 */
        return view('pengaturan.gaji.pokok.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = fbSelect($this->golongan, null, 'token');
        return view('pengaturan.gaji.pokok.create', compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('nama', 'golongan', 'masa_dari', 'masa_sampai','nilai'); // this for bypass kids input sesuatu
        $results = FirebaseCreate($this->tabel, $data, true);
        // if result true then uploading images and return back if false
        if ($results) {
            if ($request->submit == 'save') {
                return redirect(route('gaji-pokok.index'))->with('success', 'Anda sukses menginput data.');
            } else {
                return redirect()->back()->with('success', 'Anda sukses menginput data.');
            }
        } else {
            return back()->withInput()->with('warning', 'Terjadi kesalahan coba sekali lagi.');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($token)
    {
        $data = fbSelect($this->tabel, $token, 'token');
        $golongan = fbSelect($this->golongan, null, 'token');
        
        $results = pushArray($data, 'golongan_list', $golongan);
        return view('pengaturan.gaji.pokok.edit', compact('results'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PokokRequest $request, $token)
    {
        $data = $request->only('nama', 'nilai', 'golongan', 'masa_dari', 'masa_sampai'); // this for bypass kids input sesuatu
        $refer = $this->tabel . '/' . $token;
        $results = FirebaseUpdate($refer, $data);

        if ($results) {
            return redirect(route('gaji-pokok.index'))->with('success', 'Anda sukses menginput data.');
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
        $refer = $this->tabel.'/'.$token;
        $db = Firebaseinit($refer);
        $delete = $db->remove();
        if ($delete) {
            return redirect(route('gaji-pokok.index'))->with('success', 'Anda sukses menghapus data.');
        }else{
            return redirect(route('gaji-pokok.index'))->with('error', 'Ada kesalahan dalam menghapus data coba lagi.');
        }
    }
}
