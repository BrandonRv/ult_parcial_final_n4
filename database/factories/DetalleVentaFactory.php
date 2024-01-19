<?php

namespace Database\Factories;

use App\Models\Articulo;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_venta' => Venta::all($columns = ['id', 'tipo_comprobante'])->where('tipo_comprobante', 'Ticket')->random(),
            'id_articulo' => Articulo::get("id")->random(),
            'cantidad' => fake()->randomNumber($nbDigits = 2, $strict = false),
            'precio_venta' => fake()->randomFloat($nbMaxDecimals  = 2, $min = 0, $max = 1000),
            'descuento' => fake()->randomFloat($nbMaxDecimals  = 2, $min = 0, $max = 10),
        ];
    }
}
