<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ActorController extends Controller
{
    public function index() {
        try {
            $actors = Actor::all();
            return response(["result" => 'success', 'data' => $actors], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $actor_validator = Validator::make($data, [
                'nombre' => 'required|max:255'
            ]);
            
            if ($actor_validator->fails()) {
                return response(['result' => 'fail', 'message' => $actor_validator->errors()], 500);
            }
            
            Actor::create($data);
            
            return ['result' => 'success', "message"=> 'Actor almacenado exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Actor $actor) {
        try {
            return response(["result" => 'success', "data" => $actor], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Actor $actor) {
        try {
            $actor->update($request->all());
            return response(["result" => "success", "message" => 'Actor actualizado exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Actor $actor) {
        try {
            $actor->delete();
            return response(['result' => 'fail', 'message' => 'Actor eliminado exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
}
