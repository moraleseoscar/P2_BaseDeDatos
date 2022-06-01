<?php

namespace App\Http\Controllers\Anuncio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Validator;

class AnuncioController extends Controller
{
    public function index() {
        try {
            $categorias = Anuncio::all();
            return response(["result" => 'success', 'data' => $categorias], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $categories_validator = Validator::make($data, [
                'nombre' => 'required|max:255',
                'imagen' => 'required',
                'background' => 'required',
                'nombre' => 'required',
                'descripcion' => 'required'
            ]);
            
            if ($categories_validator->fails()) {
                return response(['result' => 'fail', 'message' => $categories_validator->errors()], 500);
            }

            $data['id_usuario'] = auth()->user()->id;
            /*$data['activo'] = true; */
            
            Anuncio::create($data);
            
            return ['result' => 'success', "message"=> 'Anuncio almacenado exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id) {
        try {
            $anuncio = Anuncio::where('id', $id)->first();
            return response(["result" => 'success', "data" => $anuncio], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    } 


    public function update(Request $request, Anuncio $anuncio) {
        try {
            $anuncio->update($request->all());
            return response(["result" => "success", "message" => 'Anuncio actualizado exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Anuncio $anuncio) {
        try {
            $anuncio->delete();
            return response(['result' => 'fail', 'message' => 'Anuncio eliminado exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
