<?php

namespace App\Http\Controllers\Award;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Award;
use Illuminate\Support\Facades\Validator;

class AwardController extends Controller
{
    public function index() {
        try {
            $awards = Award::all();
            return response(["result" => 'success', 'data' => $awards], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $award_validated = Validator::make($data, [
                'nombre' => 'required|max:255',
                'id_pelicula' => 'required'
            ]);
            
            if ($award_validated->fails()) {
                return response(['result' => 'fail', 'message' => $award_validated->errors()], 500);
            }

      /*       $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true; */
            
            Award::create($data);
            
            return ['result' => 'success', "message"=> 'Premio almacenado exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Award $award) {
        try {
            return response(["result" => 'success', "data" => $award], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Award $award) {
        try {
            $award->update($request->all());
            return response(["result" => "success", "message" => 'Premio actualizado exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Award $award) {
        try {
            $award->delete();
            return response(['result' => 'fail', 'message' => 'Premio eliminado exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

}
