<?php

namespace App\Http\Controllers\MovieSerie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovieSerie;
use Illuminate\Support\Facades\Validator;

class MovieSerieController extends Controller
{   
    public function index() {
        try {
            $movieSeries = MovieSerie::all();
            return response(["result" => 'success', 'data' => $movieSeries], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $mov_serie_validator = Validator::make($data, [
                'nombre' => 'required',
                'id_director' => 'required',
                'tipo' => 'required',
                'fecha_estreno' => 'required',
                'descripcion' => 'required',
                'duracion' => 'required',
                'link_video' => 'required'
            ]);
            
            if ($mov_serie_validator->fails()) {
                return response(['result' => 'fail', 'message' => $mov_serie_validator->errors()], 500);
            }

            /* $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true; */
            
            MovieSerie::create($data);
            
            return ['result' => 'success', "message"=> 'Movie_serie almacenada exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(MovieSerie $movieSerie) {
        try {
            return response(["result" => 'success', "data" => $movieSerie], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, MovieSerie $movieSerie) {
        try {
            $movieSerie->update($request->all());
            return response(["result" => "success", "message" => 'Movie_serie actualizada exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(MovieSerie $movieSerie) {
        try {
            $movieSerie->delete();
            return response(['result' => 'fail', 'message' => 'Favorito eliminada exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
