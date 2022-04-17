<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favoritos';
    protected $fillable = ['id', 'id_pelicula', 'id_perfil'];
    public $timestamps = false;
}
