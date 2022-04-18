<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Subscription;
use App\Models\LoginFallido;

class UserController extends Controller
{
    public function register(Request $request) {
        $validar = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'tipo' => 'required',
            'tipo_suscripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_caducidad' => 'required'
        ]);

        if ($validar->fails()) {
            return response(['result' => 'fail', 'message' => $validar->errors()], 500);
        }

        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->tipo = $request->tipo;
        $usuario->password = Hash::make($request->password);
        if(!$usuario->save()) {
            return response(['result' => 'fail', 'message' => 'Error al crear usuario, por favor inténtelo más tarde.'], 500);
        }
        $access_token = $usuario->createToken('authToken')->accessToken;

        $suscripcion = new Subscription();
        $suscripcion->tipo = $request->tipo_suscripcion;
        $suscripcion->fecha_inicio = $request->fecha_inicio;
        $suscripcion->fecha_caducidad = $request->fecha_caducidad;
        $suscripcion->id_usuario = $usuario->id;
        if(!$suscripcion->save()) {
            return response(['result' => 'fail', 'message' => 'Error al crear suscripción, por favor inténtelo más tarde.'], 500);
        }
    
        return response([
            'result' => 'success', 
            "message"=> 'Usuario creado exitósamente.',
            'access_token' => $access_token
        ]);
    }

    public function login(Request $request) {
        $validar = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($validar)) {
            return response(['message' => 'Invalid Credentials'], 500);
        }

        $access_token = auth()->user()->createToken('authToken')->accessToken;

        try {
            $login_fallido = LoginFallido::where('id_usuario', auth()->user()->id)->first();
            $login_fallido->veces = $login_fallido->veces + $request->veces;
            if(!$login_fallido->save()) {
                return response(['result' => 'fail', 'message' => 'Error al actualizar intentos fallidos, por favor inténtelo más tarde.'], 500);
            }
        } catch(\Exception $e) {
            $login_fallido = new LoginFallido();
            $login_fallido->veces = $request->veces;
            $login_fallido->id_usuario =  auth()->user()->id;
            if(!$login_fallido->save()) {
                return response(['result' => 'fail', 'message' => 'Error al actualizar intentos fallidos, por favor inténtelo más tarde.'], 500);
            }
        }

        return response(['message' => 'Sesión iniciada exitósamente', 'access_token' => $access_token]);
    }

    public function get() {
        return response(auth()->user()->id);
    }

    public function verifyType() {
        try {
            $tipo = User::where('id', auth()->user()->id)->first();
            return response(['result' => 'success', 'data' => $tipo->tipo], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

}
