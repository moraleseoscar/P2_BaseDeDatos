<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorMovie extends Model
{
    use HasFactory;
    protected $table = 'actores_peliculas';
    protected $fillable = ['id', 'id_actores', 'id_pelicula'];
    public $timestamps = false;
}
