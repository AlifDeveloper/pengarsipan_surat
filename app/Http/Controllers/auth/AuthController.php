<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthVerifyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.auth');
    }

    public function verify(UserAuthVerifyRequest $request) : RedirectResponse
    {
        $data = $request->validated();

        if (Auth::guard('petugas')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level_user' => 'petugas'])){
            $request->session()->regenerate();
            return redirect()->intended('/klasifikasi-arsip');
        } else if (Auth::guard('kades')->attempt(['username' => $data['username'], 'password' => $data['password'], 'level_user' => 'kades'])){
            $request->session()->regenerate();
            return redirect()->intended('/pengarsipan-surat-masuk');
        } else {
            return redirect(route('login'))->with('msg', 'Username dan Password salah');
        }
    }


    public function logout(): RedirectResponse
    {
        if(Auth::guard('petugas')->check()){
            Auth::guard('petugas')->logout();
        } else if(Auth::guard('kades')->check()){
            Auth::guard('kades')->logout();
        }

        return redirect(route('login'));
    }
}
