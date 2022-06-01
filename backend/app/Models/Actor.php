<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    protected $table = 'actores';
    protected $fillable = ['id', 'nombre', 'id_usuario'];
    public $timestamps = false;
}
