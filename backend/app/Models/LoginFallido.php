<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginFallido extends Model
{
    use HasFactory;
    protected $table = 'login_fallido';
    protected $fillable = ['id', 'id_usuario', 'veces'];
    public $timestamps = false;
}
