<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $table = 'premios';
    protected $fillable = ['id', 'nombre','id_pelicula'];
    public $timestamps = false;
}
