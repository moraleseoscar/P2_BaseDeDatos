<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'perfil';
    protected $fillable = ['id', 'nombre', 'id_usuario', 'activo', 'icon'];
    public $timestamps = false;
}
