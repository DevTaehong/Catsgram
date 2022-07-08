<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            'name' => 'Cerulean',
            'cdn_url' => 'https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css',
            'created_by' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('themes')->insert([
            'name' => 'Cosmo',
            'cdn_url' => 'https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css',
            'created_by' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('themes')->insert([
            'name' => 'Cyborg',
            'cdn_url' => 'https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css',
            'created_by' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
