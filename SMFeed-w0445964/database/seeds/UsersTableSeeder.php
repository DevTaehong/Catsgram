<?php

use Illuminate\Database\Seeder;

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
            'password' => '$2y$10$usOlfAWnFaaYuzpY8p1zK.zXPpM6JVEr7Vbdon/gOJU9bKSEkk.oO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Bob Moderator',
            'email' => 'bob@example.com',
            'password' => '$2y$10$1kFifjqOLD5QlKN/TpWfY.kWh0sfXqDT8TnhgqwF2QPJLiXInEA72',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Susan ThemeAdmin',
            'email' => 'susan@example.com',
            'password' => '$2y$10$IugYSnffAAiTt5xjyku4ZOlisDH/ckD8w1k/YZAokWJeLMivVuHXy',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
