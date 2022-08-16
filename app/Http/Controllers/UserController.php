<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function store(Request $request){
        $request->validate(
           [
            'first_name' => 'required|min:3|max:100',
            'email' => 'required',
            'password' => 'required|max:20'
           ],
           [
            'first_name.required'=> 'First name harus diisi',
            'first_name.min' => 'Minimal 3 karakter',
            'first_name.max' => 'Maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.max' => 'Password Maksimal 20 karakter'
           ]
        );

        $data = [
            'role_id'=>0,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ];
        $store = User::create($data);

        if(!$store) {
            return response()->json([
                'success'=>false,
                'msg'=>"User tidak berhasil disimpan"
            ]);
        }
        return redirect('/login');

    }

    public function show(Request $request, User $user){
       return response()->json([
        'data'=>$user->find($request->user()->id)
       ]);
    }
}
