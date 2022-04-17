<?php

namespace App\Http\Controllers\CategoryMovie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMovie;
use Illuminate\Support\Facades\Validator;

class CategoryMovieController extends Controller
{
    public function index() {
        try {
            $categorias = CategoryMovie::all();
            return response(["result" => 'success', 'data' => $categorias], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $categories_validator = Validator::make($data, [
                'id_categoria' => 'required',
                'id_pelicula' => 'required'

            ]);
            
            if ($categories_validator->fails()) {
                return response(['result' => 'fail', 'message' => $categories_validator->errors()], 500);
            }

            /* $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true; */
            
            CategoryMovie::create($data);
            
            return ['result' => 'success', "message"=> 'Categoria almacenada exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(CategoryMovie $category) {
        try {
            return response(["result" => 'success', "data" => $category], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, CategoryMovie $category) {
        try {
            $category->update($request->all());
            return response(["result" => "success", "message" => 'Categoria actualizada exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(CategoryMovie $category) {
        try {
            $category->delete();
            return response(['result' => 'fail', 'message' => 'Categoria eliminada exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
