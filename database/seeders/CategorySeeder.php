<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => "Trứng",
                'parent_id' => null,
                'store_id' => 1,
            ],
            [
                'name' => "Nước ngọt",
                'parent_id' => null,
                'store_id' => 1,
            ],
            [
                'name' => "Thức uống có cồn",
                'parent_id' => null,
                'store_id' => 1,
            ],
            [
                'name' => "Mẹt tre",
                'parent_id' => null,
                'store_id' => 2,
            ],
            [
                'name' => "Nước ngọt",
                'parent_id' => null,
                'store_id' => 2,
            ],
            [
                'name' => "Đồ ăn vặt",
                'parent_id' => null,
                'store_id' => 2,
            ],
        ]);
    }
}
