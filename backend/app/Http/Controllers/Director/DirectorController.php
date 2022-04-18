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
            
            return ['result' => 'success', "message"=> 'Director almacenado exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id) {
        try {
            $director = Director::where('id', $id)->first();
            return response(["result" => 'success', "data" => $director], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    } 


    public function update(Request $request, Director $director) {
        try {
            $director->update($request->all());
            return response(["result" => "success", "message" => 'Director actualizado exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Director $director) {
        try {
            $director->delete();
            return response(['result' => 'fail', 'message' => 'Director eliminado exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
