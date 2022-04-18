<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieSerie extends Model
{
    use HasFactory;
    protected $table = 'peliculas_series';
    protected $fillable = ['id', 'nombre', 'id_director', 'tipo', 'fecha_estreno', 'descripcion', 'duracion', 'link_video', 'portada'];
    public $timestamps = false;
}
