<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'suscripciones';
    protected $fillable = ['id', 'tipo', 'fecha_inicio', 'fecha_caducidad', 'id_usuario'];
    public $timestamps = false;
}
