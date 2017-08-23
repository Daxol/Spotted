<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 100; $i++) {
            \Illuminate\Support\Facades\DB::table('messages')->insert([
                'message_thread_id' => 1,
                'user_id' => 1,
                'content' => 'test' . $i
            ]);
        }
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => str_random(10),
            'surname' => str_random(10),
            'email' => 'd@o2.pl',
            'password' => bcrypt('123456'),
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => str_random(10),
            'surname' => str_random(10),
            'email' => 'a@o2.pl',
            'password' => bcrypt('123456'),
        ]);
        for ($i = 0; $i <= 100; $i++) {
            \Illuminate\Support\Facades\DB::table('advertisements')->insert([
                'title' => 'test' . $i,
                'country' => 'pl',
                'category' => 1,
                'place_id' => 'ChIJW-T2Wt7Gt4kRKl2I1CJFUsI',
                'content' => 'test' . $i,
                'user_id' => 1,
                'city_pl'=>'Tychy',
                'city_en'=>'Tychy'

            ]);
        }
    }
}
