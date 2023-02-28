<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        /* $this->call([
            RoomTypeSeeder::class,
            RoleSeeder::class,
            permissionSeeder::class,
            OwnerSeeder::class,
        ]); */
        DB::table('settings')->insert([
            'name' => "Acme Inc.",
            'name_loc' => "شركة آكمي المحدودة",
            'type' => "Corporation",
            'cr_no' => "12345",
            'phone' => "555-1234",
            'mobile' => "555-5678",
            'email' => "info@acme.com",
            'city' => "New York",
            'address' => "123 Main St.",
            'vat_no' => "5",
        ]);
        DB::table('ledger_cats')->insert([
            'name' => "category",
            'name_loc' => "cat",
        ]);
    }
}
