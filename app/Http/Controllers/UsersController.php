<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\Auth\EmailExists;

class UsersController extends Controller
{
    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->tabel = "users"; // Firebase File for for access from this controller
        $this->timestamp = ['.sv' => 'timestamp']; // definisi timestamp firebase
        $this->auth = $auth;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);

        // doing mapping for change & add data array
        $results = collect($users)->map(function ($value, $key) {
            $result = (object) $value;
            return $result;
        });

        /* Firebase not support Pagination for now - https://github.com/kreait/firebase-php/issues/203 */
        return view('users.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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

            if (!$request->filled('username') || !$request->filled('password') || !$request->filled('email') /* || !$request->filled('role') */) {
                return redirect()->back()->with('error', 'Anda harus mengisi data terlebih dahulu.');
            }

            $userProperties = [
            'email' => $request->email,
            'emailVerified' => false,
            'password' => $request->password,
            'displayName' =>$request->username,
            'disabled' => false,
            ];

            $createdUser = $this->auth->createUser($userProperties);
            if ($createdUser) {
                if ($request->submit == 'save') {
                    return redirect(route('users.index'))->with('success', 'Anda sukses menginput data.');
                } else {
                    return redirect()->back()->with('success', 'Anda sukses menginput data.');
                }
            } 
        } catch (AuthException $e) {
            return back()->withInput()->with('warning', $e->getMessage());
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
        $results = $this->auth->getUser($uid);
        return view('users.edit', compact('results'/* , 'roles', 'user_role' */));
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
       
        if (!$request->filled('displayName') || !$request->filled('email') ) {
            return redirect()->back()->with('error', 'Anda harus melengkapi data terlebih dahulu.');
        }

        $properties = [
            'email' => $request->email,
            'displayName' => $request->displayName,
        ];
        
        try {
            $this->auth->updateUser($uid, $properties);
            //$this->auth->setCustomUserClaims($uid, ['role' => $request->role]);
            if ($request->filled('password')) {
                $this->auth->changeUserPassword($uid, $request->password);
            }
            $dataOk = true;
        } catch (FirebaseException $e) {
            return redirect(route('users.index'))->with('error', $e->getMessage());
        }


        if ($dataOk) {
            return redirect(route('users.index'))->with('success', 'Anda sukses merubah data.');
        } else {
            return back()->withInput()->with('warning', 'Terjadi kesalahan saat merubah data, coba sekali lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        // checking user in use before delete
        // mencegah untuk menghapus diri sendiri, untuk menghindari lockout.
        if (auth()->user()->localId == $uid){
            return redirect(route('users.index'))->with('error', 'User ini sedang duginakan sekarang dan tidak dapat dihapus.');
        }else{
            try {
                $delete = $this->auth->deleteUser($uid);
            } catch (FirebaseException $e) {
                return redirect(route('users.index'))->with('error', $e->getMessage());
            }
        }
        return redirect(route('users.index'))->with('success', 'Anda sukses menghapus data.');
    }
}
