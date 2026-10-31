<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'user_id',
        'alojamiento_id',
        'fecha_entrada',
        'fecha_salida',
        'cantidad_huespedes',
        'precio_total',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_entrada' => 'date',
            'fecha_salida' => 'date',
            'precio_total' => 'decimal:2',
        ];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alojamiento(): BelongsTo
    {
        return $this->belongsTo(Alojamiento::class);
    }
}
