<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();
        \DB::table('categories')->insert([
            [
                'id' => 1,
                'parent_id' => 0,
                'name' => 'مواد غذایی',
                'is_active' => 1
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'name' => 'آرایشی و بهداشتی',
                'is_active' => 1
            ],
        ]);
    }
}
