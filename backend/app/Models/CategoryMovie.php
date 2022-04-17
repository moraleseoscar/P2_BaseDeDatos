<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMovie extends Model
{
    use HasFactory;
    protected $table = 'categoria_pelicula';
    protected $fillable = ['id', 'id_categoria', 'id_pelicula'];
    public $timestamps = false;
}
