<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $user = User::create([
            'firstname' => 'amr', 
            'lastname' => 'amr', 
            'phonenumber' => '1234565', 
            'email' => 'kamr944@gmail.com',
            'role' => 'owner',
            'password' => bcrypt('123456789'),
            ]);
       
            $role = Role::where('name','owner')->first();
       
            $permissions = Permission::pluck('id','id')->all();
      
          //  $role->syncPermissions($permissions);
       
            $user->assignRole([$role->id]);
    }
}
