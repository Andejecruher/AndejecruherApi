<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('articulos')->insert([
                'titulo' => $faker->sentence,
                'descripcion' => $faker->paragraph,
                'contenido' => $faker->randomHtml(1, 1),
                'imagen_destacada' => $faker->imageUrl(),
                'fecha_publicacion' => $faker->dateTimeThisYear(),
                'categoria_id' => $faker->randomElement([1, 2, 3]), // Cambiar los IDs de categorías según tu base de datos
                'user_id' => $faker->randomElement([1, 2, 3]), // Cambiar los IDs de usuarios según tu base de datos
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
