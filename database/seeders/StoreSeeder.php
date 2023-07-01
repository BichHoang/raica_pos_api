<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            [
                'name' => "Hột Vịt Lộn Con Rái Cá",
                'address' => "Địa chỉ vỉa hè",
                'province_id' => null,
                'city_id' => null,
                'district_id' => null,
                'ward_id' => null,
                'phone' => "0989898984",
            ],
            [
                'name' => "Bún Đậu Chíp Chíp",
                'address' => "Cạnh Hột Vịt Lộn Con Rái Cá",
                'province_id' => null,
                'city_id' => null,
                'district_id' => null,
                'ward_id' => null,
                'phone' => "0989898904",
            ],
            [
                'name' => "Cửa hàng 1",
                'address' => "Địa chỉ 1",
                'province_id' => null,
                'city_id' => null,
                'district_id' => null,
                'ward_id' => null,
                'phone' => "0989898981",
            ],
            [
                'name' => "Cửa hàng 2",
                'address' => "Địa chỉ 2",
                'province_id' => null,
                'city_id' => null,
                'district_id' => null,
                'ward_id' => null,
                'phone' => "0989898982",
            ],
        ]);
    }
}
