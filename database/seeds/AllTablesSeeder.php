<?php

use Illuminate\Database\Seeder;

class AllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Maroje',
            'email' => 'maroje.macola@gmail.com',
            'password' => '$2y$10$S1WPYy5Alw.IJMDJZ5C8V..QJr6PC/vqR3SqQbiGal608j4hSoZvK', // 123123
        ]);

        DB::table('types')->insert([
            [
                'id' => 1,
                'name' => 'Osobna iskaznica',
            ],
            [
                'id' => 2,
                'name' => 'Domovnica',
            ],
            [
                'id' => 3,
                'name' => 'Rodni list',
            ],
        ]);
    }
}
