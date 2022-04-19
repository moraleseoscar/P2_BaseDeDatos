<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public function index() {
        try {
            $favoritos = Favorite::all();
            return response(["result" => 'success', 'data' => $favoritos], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $favs_validator = Validator::make($data, [
                'id_pelicula' => 'required',
                'id_perfil' => 'required'
            ]);
            
            if ($favs_validator->fails()) {
                return response(['result' => 'fail', 'message' => $favs_validator->errors()], 500);
            }

            /* $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true; */
            
            Favorite::create($data);
            
            return ['result' => 'success', "message"=> 'Favorito almacenada exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Favorite $favorito) {
        try {
            return response(["result" => 'success', "data" => $favorito], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Favorite $fav) {
        try {
            $fav->update($request->all());
            return response(["result" => "success", "message" => 'Favorito actualizada exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Favorite $fav) {
        try {
            $fav->delete();
            return response(['result' => 'fail', 'message' => 'Favorito eliminada exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
