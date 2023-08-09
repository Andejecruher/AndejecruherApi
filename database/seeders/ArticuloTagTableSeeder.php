<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticuloTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $articulos = range(1, 10); // Cambia el rango según la cantidad de artículos que tengas
        $tags = range(1, 9); // Cambia el rango según la cantidad de tags que tengas

        foreach ($articulos as $articuloId) {
            $numTags = $faker->numberBetween(1, 5); // Cambia el rango según la cantidad de tags por artículo
            $selectedTags = $faker->randomElements($tags, $numTags);

            foreach ($selectedTags as $tagId) {
                DB::table('articulo_tag')->insert([
                    'articulo_id' => $articuloId,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
