<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $table = 'contenido';
    protected $fillable = ['id', 'id_pelicula', 'id_perfil', 'tiempo'];
    public $timestamps = false;
}
