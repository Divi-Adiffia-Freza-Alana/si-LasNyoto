<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Marketing;
use App\Models\Kurir;
use App\Models\Produksi;
use App\Models\Purchasing;
use App\Models\Produk;
use App\Models\Metode_Pembayaran;
use Spatie\Permission\Models\Permission;

class ProduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $role7 = Role::create(['name' => 'produksi']);

   
        $user7 = User::create([
            'id' => Str::uuid(),
            'name' => "Staf Produksi",
            'email' => 'stafproduksi@gmail.com',
            'password' => Hash::make('stafproduksi12345'),

            ]); 


        $mode7 = DB::table('model_has_roles')->insert([
            'role_id' => 7,
            'model_type' => "App\Models\User",
            'model_id' => $user7->id,
        ]);

        $produksi = DB::table('produksi')->insert([
            'id' => Str::uuid(),
            'id_user' => $user7->id,
            'no_hp' => '087828737385',
            'jk' => 'Laki-Laki'
        ]);

       // $user->assignRole('superadmin');
    
    
    }
}
