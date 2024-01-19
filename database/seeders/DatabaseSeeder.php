<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ClienteSeeder::class);
        $this->call(TrabajadoreSeeder::class);
        $this->call(VentaSeeder::class);
        $this->call(ArticuloSeeder::class);
        $this->call(DetalleVentaSeeder::class);
        $this->call(DetalleIngresoSeeder::class);
    }
}
