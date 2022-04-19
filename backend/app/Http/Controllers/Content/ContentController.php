<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function index() {
        try {
            $actors = Content::all();
            return response(["result" => 'success', 'data' => $actors], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $login_fallido = Content::where('id_pelicula', $request->id_pelicula)->where('id_perfil', $request->id_perfil)->first();
            $login_fallido->tiempo = $request->tiempo;
            $login_fallido->ultima_vez_visto = $request->ultima_vez_visto;
            if(!$login_fallido->save()) {
                return response(['result' => 'fail', 'message' => 'Error al actualizar intentos fallidos, por favor inténtelo más tarde.'], 500);
            }
        } catch(\Exception $e) {
            $login_fallido = new Content();
            $login_fallido->id_perfil = $request->id_perfil;
            $login_fallido->tiempo = $request->tiempo;
            $login_fallido->id_pelicula = $request->id_pelicula;
            $login_fallido->ultima_vez_visto = $request->ultima_vez_visto;
            if(!$login_fallido->save()) {
                return response(['result' => 'fail', 'message' => 'Error al actualizar intentos fallidos, por favor inténtelo más tarde.'], 500);
            }
        }            
            
        return ['result' => 'success', "message"=> 'Actor almacenado exitósamente.'];
    }

    public function showDetails($perfil, $pelicula) {
        try {
            $login_fallido = Content::where('id_pelicula', $pelicula)->where('id_perfil', $perfil)->first();
            return response(["result" => 'success', "data" => $login_fallido], 200);
        }catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function listProfile($perfil) {
        try {
            $movieSeries = \DB::select("SELECT * FROM peliculas_series ps INNER JOIN contenido c ON c.id_pelicula = ps.id WHERE c.id_perfil = $perfil");
            return response(["result" => 'success', "data" => $movieSeries], 200);
        }catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Content $actor) {
        try {
            return response(["result" => 'success', "data" => $actor], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Content $actor) {
        try {
            $actor->update($request->all());
            return response(["result" => "success", "message" => 'Actor actualizado exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Content $actor) {
        try {
            $actor->delete();
            return response(['result' => 'fail', 'message' => 'Actor eliminado exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
