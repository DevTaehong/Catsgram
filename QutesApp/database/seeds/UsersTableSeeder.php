<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jane UserAdmin',
            'email' => 'jane@example.com',
            'password' => '$2y$10$udCyy6FfJkB6Jl7lQCD4TOhBPIYa02EYhLFvqipqvPK0xBbeYauFG',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Bob Moderator',
            'email' => 'bob@example.com',
            'password' => '$2y$10$smetdly/V4KKaFBkicNtzeimp2OShWbOsUL4qsKVTEs.0hPYYtGbe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Susan ThemeAdmin',
            'email' => 'susan@example.com',
            'password' => '$2y$10$4RcVeTtAcv53Qk7N.QZey.WK/Srwt2C/S0dOvMDDiOKv1l1jHce/6',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
