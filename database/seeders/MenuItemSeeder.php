<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insert([
            [
                'name' => "Trứng vịt luộc",
                'price' => 10000,
                'category_id' => 1,
                'photo' => "link",
                'description' => "Trứng vịt luộc nóng hổi, vừa thổi vừa ăn",
            ],
            [
                'name' => "Trứng cút luộc",
                'price' => 10000,
                'category_id' => 1,
                'photo' => "link",
                'description' => "Trứng cút lộn luộc nóng hổi, vừa thổi vừa ăn",
            ],
        ]);
    }
}
