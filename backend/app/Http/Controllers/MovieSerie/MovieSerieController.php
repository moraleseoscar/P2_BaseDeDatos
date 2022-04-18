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

    public function filterMovies($search, $tipo, $id) {
        try {
            $query = null;
            if($tipo == 'categoria') {
                $query = "SELECT * FROM peliculas_series INNER JOIN categoria_pelicula ON categoria_pelicula.id_pelicula = peliculas_series.id WHERE categoria_pelicula.id_categoria = $id";
                if($search != '-') {
                    $query = $query . " AND peliculas_series.nombre ILIKE '%$search%'";
                }
            } else if($tipo == 'actor') {
                $query = "SELECT * FROM peliculas_series INNER JOIN actores_peliculas ON actores_peliculas.id_pelicula = peliculas_series.id WHERE actores_peliculas.id_actores = $id";
                if($search != '-') {
                    $query = $query . " AND peliculas_series.nombre ILIKE '%$search%'";
                }
            } else if($tipo == 'director') {
                $query = "SELECT * FROM peliculas_series WHERE id_director = $id";
                if($search != '-') {
                    $query = $query . " AND peliculas_series.nombre ILIKE '%$search%'";
                }
            } else if($tipo == 'premio') {
                $query = "SELECT * FROM peliculas_series INNER JOIN premios ON premios.id_pelicula = peliculas_series.id WHERE premios.id = $id";
                if($search != '-') {
                    $query = $query . " AND peliculas_series.nombre ILIKE '%$search%'";
                }
            } else {
                $query = "SELECT * FROM peliculas_series";
                if($search != '-') {
                    $query = $query . " WHERE peliculas_series.nombre ILIKE '%$search%'";
                }
            }
            $movieSeries = \DB::select($query);
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

    public function showDetails($id) {
        try {
            $movieSerie = MovieSerie::where('id', $id)->first();
            return response(["result" => 'success', "data" => $movieSerie], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, MovieSerie $movieSerie) {
        try {
            $movieSerie-> update($request->all());
            return response(["result" => $movieSerie, "message" => 'Actor actualizado exitósamente.'], 200);
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
