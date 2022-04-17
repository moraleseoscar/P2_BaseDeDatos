<?php

namespace App\Http\Controllers\Suggestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Validator;

class SuggestionController extends Controller
{
    public function index() {
        try {
            $suggestions = Suggestion::all();
            return response(["result" => 'success', 'data' => $suggestions], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $sugg_validator = Validator::make($data, [
                'id_categoria' => 'required',
                'id_perfil' => 'required'
            ]);
            
            if ($sugg_validator->fails()) {
                return response(['result' => 'fail', 'message' => $sugg_validator->errors()], 500);
            }

            /* $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true; */
            
            Suggestion::create($data);
            
            return ['result' => 'success', "message"=> 'Movie_serie almacenada exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Suggestion $suggestion) {
        try {
            return response(["result" => 'success', "data" => $suggestion], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Suggestion $suggestion) {
        try {
            $suggestion->update($request->all());
            return response(["result" => "success", "message" => 'Movie_serie actualizada exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Suggestion $suggestion) {
        try {
            $suggestion->delete();
            return response(['result' => 'fail', 'message' => 'Favorito eliminada exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
