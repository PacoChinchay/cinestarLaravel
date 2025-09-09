<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $table = 'Pelicula';

       protected $fillable = [
        'Titulo',
        'FechaEstreno',
        'Director',
        'Generos',
        'idClasificacion',
        'idEstado',
        'Duracion',
        'Link',
        'Reparto',
        'Sinopsis'
    ];
}
