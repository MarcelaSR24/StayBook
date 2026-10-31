<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }
}
