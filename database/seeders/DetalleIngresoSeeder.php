<?php

namespace Database\Seeders;

use App\Models\DetalleIngreso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleIngresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetalleIngreso::factory(30)->create();
    }
}
