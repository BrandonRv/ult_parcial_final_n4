<?php

namespace Database\Seeders;

use App\Models\Trabajadore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trabajadore::factory(30)->create();
    }
}
