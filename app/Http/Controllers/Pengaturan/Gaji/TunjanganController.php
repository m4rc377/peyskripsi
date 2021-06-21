<?php

namespace App\Http\Controllers\Pengaturan\Gaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\Pengaturan\Gaji\TunjanganRequest;

class TunjanganController extends Controller
{
    public function __construct()
    {
        $this->tabel = "pengaturan/gaji/tunjangan"; // Firebase File for for access from this controller
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
            if ($item->formula == 'persen') {
                collectionSuffixPrefix($item, 'nilai', ' %', 'suffix', false);
            } elseif ($item->formula == 'nilai') {
                collectionSuffixPrefix($item, 'nilai', 'Rp. ', 'prefix', false);
            } else {
                debug_pesan_error('Perhatikan kembali fungsi ' . __FUNCTION__);
            }
            return $item;
        });

        /* Firebase not support Pagination for now - https://github.com/kreait/firebase-php/issues/203 */
        return view('pengaturan.gaji.tunjangan.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengaturan.gaji.tunjangan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TunjanganRequest $request)
    {
        $data = $request->only('nama', 'nilai', 'formula');
        $slug = slugify($request->nama);
        $data = pushArray($data, "slug", $slug);

        // pepare db pegawai in firebase
        $results = FirebaseCreate($this->tabel, $data, true);

        // if result true then uploading images and return back if false
        if ($results) {
            if ($request->submit == 'save') {
                return redirect(route('gaji-tunjangan.index'))->with('success', 'Anda sukses menginput data.');
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
        $results = fbSelect($this->tabel, $token, 'token');
        return view('pengaturan.gaji.tunjangan.edit', compact('results'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TunjanganRequest $request, $token)
    {
        $data = $request->only('nama', 'nilai', 'formula');
        $slug = slugify($request->nama);
        $data = pushArray($data, "slug", $slug);
        
        $refer = $this->tabel . '/' . $token;
        $results = FirebaseUpdate($refer, $data);

        if ($results) {
            return redirect(route('gaji-tunjangan.index'))->with('success', 'Anda sukses menginput data.');
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
            return redirect(route('gaji-tunjangan.index'))->with('success', 'Anda sukses menghapus data.');
        }else{
            return redirect(route('gaji-tunjangan.index'))->with('error', 'Ada kesalahan dalam menghapus data coba lagi.');
        }
    }
}
