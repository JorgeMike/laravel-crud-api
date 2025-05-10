<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = "tarea"; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_tarea';

    // datos que se pueden llenar
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];
}
