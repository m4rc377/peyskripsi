<?php

namespace App\Http\Controllers\Pengaturan\Pendidikan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InstitusiController extends Controller
{
    public function __construct()
    {
        $this->tabel = "pengaturan/pendidikan/institusi"; // Firebase File for for access from this controller
        $this->timestamp = ['.sv' => 'timestamp']; // definisi timestamp firebase
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institusi = fbSelect($this->tabel, null, 'token');
        $results = collect($institusi)->map(function ($item) {
            return $item;
        });

        /* Firebase not support Pagination for now - https://github.com/kreait/firebase-php/issues/203 */
        return view('pengaturan.pendidikan.institusi.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengaturan.pendidikan.institusi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->filled('institusi')){
            return redirect()->back()->with('error', 'Anda harus mengisi data terlebih dahulu.');
        }
        // prepare data
        $data = [
            'nama'=> $request->institusi,
            'create_at'=> $this->timestamp,
            'update_at'=> '',

        ];

        // pepare db pegawai in firebase
        $create = FirebaseCreate($this->tabel, $data);
        $postKey = $create->getKey();

        // if result true then uploading images and return back if false
        if ($postKey) {
            if ($request->submit == 'save') {
                return redirect(route('institusi.index'))->with('success', 'Anda sukses menginput data.');
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
    public function edit($uid)
    {
        $data =  FirebaseSelect($this->tabel, $uid);
        // add uid to array
        $data = Arr::add($data, 'uid', $uid); // push uid to array
        $results = (object)$data;
        return view('pengaturan.pendidikan.institusi.edit', compact('results'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid)
    {
        $data = [
            'nama' => $request->institusi,
            'update_at' => $this->timestamp,
        ];

        $refer = $this->tabel . '/' . $uid;
        $db = Firebaseinit($refer);
        $update = $db->update($data);

        if ($update) {
            return redirect(route('institusi.index'))->with('success', 'Anda sukses menginput data.');
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
        try {
            $result = FirebaseDelete($this->tabel, $token);
            if ($result) {
                return redirect(route('institusi.index'))->with('success', 'Anda sukses menghapus data.');
            }else{
                return redirect(route('institusi.index'))->with('error', 'Ada kesalahan dalam menghapus data coba lagi.');
            }
        } catch (ApiException $e) {
            return back()->with('warning', $e->getMessage());
        }
    }
}
