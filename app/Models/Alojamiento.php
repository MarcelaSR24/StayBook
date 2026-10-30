<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    protected $table = 'alojamientos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'direccion',
        'ciudad',
        'precio_por_noche',
        'capacidad',
        'estado',
    ];
}
