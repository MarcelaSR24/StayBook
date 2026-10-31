
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('alojamiento_id')
                ->constrained('alojamientos')
                ->cascadeOnDelete();

            $table->date('fecha_entrada');
            $table->date('fecha_salida');

            $table->unsignedSmallInteger('cantidad_huespedes');

            $table->decimal('precio_total', 12, 2);

            $table->enum('estado', [
                'pendiente',
                'confirmada',
                'cancelada'
            ])->default('pendiente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
