<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;
    protected $table = 'anuncios';
    protected $fillable = ['id', 'imagen', 'background', 'nombre', 'descripcion', 'id_usuario'];
    public $timestamps = false;
}
