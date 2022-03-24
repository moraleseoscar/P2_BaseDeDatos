<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request) {
        $validar = $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'tipo' => 'required'
        ]);
    
        $validar['password'] = Hash::make($request->password);
    
        $usuario = User::create($validar);
    
        $access_token = $usuario->createToken('authToken')->accessToken;
    
        return response([
            'usuario' => $usuario,
            'access_token' => $access_token
        ]);
    }

    public function login(Request $request) {
        $validar = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($validar)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $access_token = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $access_token]);
    }

    public function get() {
        return response(auth()->user());
    }

}
