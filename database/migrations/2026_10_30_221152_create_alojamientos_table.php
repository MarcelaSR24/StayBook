
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alojamientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->string('tipo', 30);
            $table->string('direccion', 255);
            $table->string('ciudad', 100);
            $table->decimal('precio_por_noche', 10, 2);
            $table->unsignedSmallInteger('capacidad');
            $table->string('estado', 30)->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alojamientos');
    }
};
