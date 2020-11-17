<?php

use Illuminate\Database\Seeder;

class PesertasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pesertas')->insert([
            [
            'name' => 'iqbal',
            'created_at' => now(),
            'updated_at' => now(), 
        ], [
            'name' => 'ages',
            'created_at' => now(),
            'updated_at' => now(), 
        ],
        [
            'name' => 'ayu',
            'created_at' => now(),
            'updated_at' => now(), 
        ]
        ]);
    }
}
