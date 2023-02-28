<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
            'rm_type_code' => "1",
            'rm_type_name' => "dog",
            'rm_type_name_loc' => "كلب",
            'def_pax' => 1,
            'def_price' => 3,
            'no_of_rooms' => 5,
            'rm_type_rentable' =>1,
            'sort_order' =>3,
            'scth_type_code' => 2,
            'def_rate_code' =>"2",
        ]);
    }
}
