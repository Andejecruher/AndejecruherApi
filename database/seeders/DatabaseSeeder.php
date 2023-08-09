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
        $this->call([
            UsersTableSeeder::class,
            CategoriasTableSeeder::class,
            ArticulosTableSeeder::class,
            ComentariosTableSeeder::class,
            TagsTableSeeder::class,
            ArticuloTagTableSeeder::class,
            // Agrega más seeders aquí si es necesario
        ]);
    }
}
