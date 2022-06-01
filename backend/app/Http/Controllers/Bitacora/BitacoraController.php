<?php

namespace App\Http\Controllers\Bitacora;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function getBitacora() {
        $data = \DB::select("SELECT * FROM bitacora INNER JOIN users ON bitacora.id_usuario = users.id");
        return response(["result" => 'success', 'data' => $data], 200);
    }
}
