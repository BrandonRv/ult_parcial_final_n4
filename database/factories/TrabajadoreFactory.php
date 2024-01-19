<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trabajadore>
 */
class TrabajadoreFactory extends Factory
{

    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'sexo' => fake()->randomElement(['male', 'female']),
            'fecha_nacimiento' => fake()->date(),
            'tipo_documento' => fake()->randomElement(['DNI', 'Pasaporte', 'Licencia de conducir']),
            'num_documento' => fake()->randomNumber($nbDigits = 9, $strict = false),
            'direccion' => fake()->address(),
            'telefono' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'acceso' => fake()->randomElement(['acesor', 'supervisor', 'almacenista', 'vendedor']),
            'password' => Static::$password ??= Hash::make('1234'),
        ];
    }
}
