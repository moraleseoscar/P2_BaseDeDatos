<?php

namespace App\Http\Controllers\ActorMovie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActorMovie;
use Illuminate\Support\Facades\Validator;


class ActorMovieController extends Controller
{
    public function index() {
        try {
            $actors_movies = ActorMovie::all();
            return response(["result" => 'success', 'data' => $actors_movies], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $actor_movie_validator = Validator::make($data, [
                'id_actores' => 'required',
                'id_pelicula' => 'required'

            ]);
            
            if ($actor_movie_validator->fails()) {
                return response(['result' => 'fail', 'message' => $actor_movie_validator->errors()], 500);
            }

            /* $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true; */
            
            ActorMovie::create($data);
            
            return ['result' => 'success', "message"=> 'Actor_Pelicula almacenado exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(ActorMovie $actor_movie) {
        try {
            return response(["result" => 'success', "data" => $actor_movie], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, ActorMovie $actor_movie) {
        try {
            $actor_movie->update($request->all());
            return response(["result" => "success", "message" => 'Actor_Pelicula actualizado exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(ActorMovie $actor_movie) {
        try {
            $actor_movie->delete();
            return response(['result' => 'fail', 'message' => 'Actor_Pelicula eliminado exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
