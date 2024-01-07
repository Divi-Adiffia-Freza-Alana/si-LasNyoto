<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::create(['name' => 'superadmin']);
        $role = Role::create(['name' => 'konsumen']);
        $role = Role::create(['name' => 'kurir']);

        
      /*  $users = DB::table('users')->create([
            'id' => Str::uuid(),
            'name' => "admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
        ]);*/
        

        $user = User::create([
            'id' => Str::uuid(),
            'name' => "admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),

            ]); 
        $user2 = User::create([
            'id' => Str::uuid(),
            'name' => "konsumen",
            'email' => 'konsumen@gmail.com',
            'password' => Hash::make('konsumen12345'),

            ]); 
        $user3 = User::create([
            'id' => Str::uuid(),
            'name' => "kurir",
            'email' => 'kurir@gmail.com',
            'password' => Hash::make('dokter12345'),

            ]); 


        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => "App\Models\User",
            'model_id' => $user->id,
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => "App\Models\User",
            'model_id' => $user2->id,
        ]);
        DB::table('model_has_roles')->insert([
            'role_id' => 3,
            'model_type' => "App\Models\User",
            'model_id' => $user3->id,
        ]);

       // $user->assignRole('superadmin');
    
    
    }
}
