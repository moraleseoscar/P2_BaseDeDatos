<?php

namespace App\Http\Controllers\Director;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Director;
use Illuminate\Support\Facades\Validator;

class DirectorController extends Controller
{
    public function index() {
        try {
            $categorias = Director::all();
            return response(["result" => 'success', 'data' => $categorias], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $categories_validator = Validator::make($data, [
                'nombre' => 'required|max:255'
            ]);
            
            if ($categories_validator->fails()) {
                return response(['result' => 'fail', 'message' => $categories_validator->errors()], 500);
            }

            /* $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true; */
            
            Director::create($data);
            
            return ['result' => 'success', "message"=> 'Categoria almacenada exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Director $category) {
        try {
            return response(["result" => 'success', "data" => $category], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function getSomeDirectors() {
        try {
            $actors = Director::paginate(10);
            return response(["result" => 'success', 'data' => $actors], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Director $category) {
        try {
            $category->update($request->all());
            return response(["result" => "success", "message" => 'Categoria actualizada exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Director $category) {
        try {
            $category->delete();
            return response(['result' => 'fail', 'message' => 'Categoria eliminada exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
