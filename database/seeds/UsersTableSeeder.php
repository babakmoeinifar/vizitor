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
        DB::table('users')->delete();
        DB::table('users')->insert([
            [   'id' => 1,
                'category_id' => 1,
                'city_id' => 1070,
                'role_id' => 1,
                'is_active' => 1,
                'name' => 'admin',
                'email' => 'admin@viz.com',
                'mobile' => '88888888',
                'password' => bcrypt('88888888')
            ],
            [   'id' => 2,
                'category_id' => 1,
                'city_id' => 1070,
                'role_id' => 2,
                'is_active' => 1,
                'name' => 'support',
                'email' => 'info@viz.com',
                'mobile' => '999999999',
                'password' => bcrypt('88888888')
            ]
        ]);
    }
}
