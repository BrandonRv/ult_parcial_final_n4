<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_ingresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_venta')->constrained('ventas')->nullable();
            $table->foreignId('id_articulo')->constrained('articulos')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('precio_compra')->nullable();
            $table->string('precio_venta')->nullable();
            $table->string('descuento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ingresos');
    }
};
