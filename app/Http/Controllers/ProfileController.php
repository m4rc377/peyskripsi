<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Auth;
use App\Http\Requests\ProfileRequest;


class ProfileController extends Controller
{
    public function __construct(Auth $auth)
    {
        $this->tabel = "users"; // Firebase File for for access from this controller
        $this->auth = $auth;
        $this->timestamp = ['.sv' => 'timestamp']; // definisi timestamp firebase
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $results = $this->auth->getUser($user->localId);
        return view('profile.index', compact('results'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {

        $uid = $request->uid;
        $properties = [
            'displayName' => $request->display_name
        ];

        try {
            $updateName = $this->auth->updateUser($uid, $properties);
            if (!$updateName) {
                return back()->withInput()->with('warning', 'Terjadi kesalahan coba sekali lagi.');
            } 
            if (isset($request->email)) {
                $updateEmail = $this->auth->changeUserEmail($uid, $request->email);
                if (!$updateEmail) {
                    return back()->withInput()->with('warning', 'Terjadi kesalahan coba sekali lagi.');
                } 
            }
            if ((isset($request->password) && (isset($request->password_verify))) && ($request->password == $request->password_verify)) {
                $updatePassword = $this->auth->changeUserPassword($uid, $request->password);
                if (!$updatePassword) {
                    return back()->withInput()->with('warning', 'Terjadi kesalahan coba sekali lagi.');
                } 
            }
            return redirect(route('profile.index'))->with('success', 'Anda sukses mengubah data.');
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return back()->with('warning', $e->getMessage());
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            return back()->with('warning', $e->getMessage());
        }
    }
}