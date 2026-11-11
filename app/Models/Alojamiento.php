<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alojamiento extends Model
{
    use SoftDeletes;

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

    public function propietario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function scopeDisponibles(Builder $query): Builder
    {
        return $query->where('estado', 'disponible')->whereNotNull('user_id');
    }
}
