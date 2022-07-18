<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function authenticate(Request $request)
    {
        //Validatin input
        $credentials = $request->validate(
            [
             'email' => 'required|email:dns',
             'password' => 'required|max:20'
            ],
            [
             'email.required' => 'Email harus diisi',
             'password.required' => 'Password harus diisi',
             'password.max' => 'Password Maksimal 20 karakter'
            ]
         );

        //Authenticating
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return back()->with(['info' => 'Email atau Password salah']);
        };
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

}
