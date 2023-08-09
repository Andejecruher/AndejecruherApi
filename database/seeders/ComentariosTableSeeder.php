<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComentariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('comentarios')->insert([
                'contenido' => $faker->paragraph,
                'nombre_autor' => $faker->name,
                'articulo_id' => $faker->numberBetween(1, 10), // Cambiar según tu base de datos
                'user_id' => $faker->randomElement([1, 2, 3, null]), // Cambiar según tu base de datos
                'ip_address' => $faker->ipv4,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
