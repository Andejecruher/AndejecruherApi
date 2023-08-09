<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $tags = ['Tecnología', 'Desarrollo', 'Programación', 'Laravel', 'Vue.js', 'PHP', 'Base de Datos', 'Frontend', 'Backend'];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'nombre' => $tag,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
