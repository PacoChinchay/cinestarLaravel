<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cine extends Model
{
    protected $table = 'Cine';

     protected $fillable = [
        'RazonSocial',
        'Salas',
        'idCiudad',
        'idDistrito',
        'Formatos',
        'Direccion',
        'Telefonos'
    ];
}
