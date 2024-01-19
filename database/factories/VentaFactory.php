<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Trabajadore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_cliente' => Cliente::get("id")->random(),
            'id_trabajador' => Trabajadore::get("id")->random(),
            'fecha' => fake()->date(),
            'tipo_comprobante' => fake()->randomElement(['Factura', 'Boleta de Venta', 'Ticket']),
            'correlativo' => fake()->randomNumber($nbDigits = 8, $strict = false),
            'igv' => fake()->randomFloat($nbMaxDecimals  = 2, $min = 0, $max = 1),
            'estado' => 1,
        ];
    }
}

