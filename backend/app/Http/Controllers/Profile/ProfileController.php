<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index() {
        try {
            $profiles = Profile::all();
            return response(["result" => 'success', 'data' => $profiles], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function getUserProfiles() {
        try {
            $profiles = Profile::where('id_usuario', auth()->user()->id)->get();
            $subscription = Subscription::where('id_usuario', auth()->user()->id)->first();
            return response(["result" => 'success', 'profiles' => $profiles, 'subscription' => $subscription], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            
            $profile_validated = Validator::make($data, [
                'nombre' => 'required|max:255',
                'icon' => 'required|max:20'
            ]);
            
            if ($profile_validated->fails()) {
                return response(['result' => 'fail', 'message' => $profile_validated->errors()], 500);
            }

            $data['id_usuario'] = auth()->user()->id;
            $data['activo'] = true;
            
            Profile::create($data);
            
            return ['result' => 'success', "message"=> 'Perfil almacenado exitósamente.'];
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Profile $profile) {
        try {
            return response(["result" => 'success', "data" => $profile], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Profile $profile) {
        try {
            $profile->update($request->all());
            return response(["result" => "success", "message" => 'Perfil actualizado exitósamente.'], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Profile $profile) {
        try {
            $profile->delete();
            return response(['result' => 'fail', 'message' => 'Perfíl eliminado exitósamente.'], 500);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

}
