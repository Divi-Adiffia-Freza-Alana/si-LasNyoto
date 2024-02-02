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
use App\Models\Purchasing;
use App\Models\Produk;
use App\Models\Metode_Pembayaran;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role1 = Role::create(['name' => 'superadmin']);
        $role2 = Role::create(['name' => 'konsumen']);
        $role3 = Role::create(['name' => 'kurir']);
        $role4 = Role::create(['name' => 'owner']);
        $role5 = Role::create(['name' => 'marketing']);
        $role6 = Role::create(['name' => 'purchasing']);

        
      /*  $users = DB::table('users')->create([
            'id' => Str::uuid(),
            'name' => "admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
        ]);*/
        $produk = Produk::create([
            'id' => Str::uuid(),
            'kode_produk' => "RD01",
            'nama' => 'Railing Deck',
            'jenis' => 'Besi',
            'deskripsi' => 'abc',
            'foto' => 'Railing Deck-1705594868.jpg',
            'foto_url' => 'http://localhost:8000/foto/Railing Deck-1705594868.jpg',
            'harga' => 300000,
            'status' => 'tersedia',
            ]); 

            $produk2 = Produk::create([
                'id' => Str::uuid(),
                'kode_produk' => "K01",
                'nama' => 'Kanopi',
                'jenis' => 'Besi',
                'deskripsi' => 'abc',
                'foto' => 'Kanopi-1705855191.jpg',
                'foto_url' => 'http://127.0.0.1:8000/foto/Kanopi-1705855191.jpg',
                'harga' => 2000000,
                'status' => 'tersedia',
                ]); 

        $user = User::create([
            'id' => Str::uuid(),
            'name' => "kasir",
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir12345'),

            ]); 
        $user2 = User::create([
            'id' => Str::uuid(),
            'name' => "konsumen",
            'email' => 'konsumen@gmail.com',
            'no_hp' => '087828845123',
            'password' => Hash::make('konsumen12345'),

            ]); 
        $user3 = User::create([
            'id' => Str::uuid(),
            'name' => "Staf Pengiriman",
            'email' => 'stafpengiriman@gmail.com',
            'password' => Hash::make('stafpengiriman12345'),

            ]); 

        $user4 = User::create([
            'id' => Str::uuid(),
            'name' => "pemilik",
            'email' => 'pemilik@gmail.com',
            'password' => Hash::make('pemilik12345'),

            ]); 

        $user5 = User::create([
            'id' => Str::uuid(),
            'name' => "Staf Penjualan",
            'email' => 'stafpenjualan@gmail.com',
            'password' => Hash::make('stafpenjualan12345'),

            ]); 

            $user6 = User::create([
                'id' => Str::uuid(),
                'name' => "Staf Bahan Baku",
                'email' => 'stafbahanbaku@gmail.com',
                'password' => Hash::make('stafbahanbaku12345'),
    
                ]); 
    

         $model1 = DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => "App\Models\User",
            'model_id' => $user->id,
        ]);
        $model2 = DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => "App\Models\User",
            'model_id' => $user2->id,
        ]);
        $model3 = DB::table('model_has_roles')->insert([
            'role_id' => 3,
            'model_type' => "App\Models\User",
            'model_id' => $user3->id,
        ]);

        $model4 = DB::table('model_has_roles')->insert([
            'role_id' => 4,
            'model_type' => "App\Models\User",
            'model_id' => $user4->id,
        ]);

        $model5 = DB::table('model_has_roles')->insert([
            'role_id' => 5,
            'model_type' => "App\Models\User",
            'model_id' => $user5->id,
        ]);

        $model6 = DB::table('model_has_roles')->insert([
            'role_id' => 6,
            'model_type' => "App\Models\User",
            'model_id' => $user6->id,
        ]);


        $metode1 = DB::table('metode_pembayaran')->insert([
            'id' => Str::uuid(),
            'jenis' => "Cash",
            'no_rek' => 'Bayar Di Gerai'
        ]);
        $metode2 = DB::table('metode_pembayaran')->insert([
            'id' => Str::uuid(),
            'jenis' => "Transfer Bank BRI",
            'no_rek' => '0343000091'
        ]);
        $metode3 = DB::table('metode_pembayaran')->insert([
            'id' => Str::uuid(),
            'jenis' => "Transfer Bank BNI",
            'no_rek' => '0243000091'
        ]);
        $metode4 = DB::table('metode_pembayaran')->insert([
            'id' => Str::uuid(),
            'jenis' => "Transfer Bank BCA",
            'no_rek' => '0143000091'
        ]);

        $kurir = DB::table('kurir')->insert([
            'id' => Str::uuid(),
            'id_user' => $user3->id,
            'no_hp' => '087828737389',
            'jk' => 'Laki-Laki'
        ]);

        $marketing = DB::table('marketing')->insert([
            'id' => Str::uuid(),
            'id_user' => $user5->id,
            'no_hp' => '087828737383',
            'jk' => 'Laki-Laki'
        ]);

        $purchasing = DB::table('purchasing')->insert([
            'id' => Str::uuid(),
            'id_user' => $user6->id,
            'no_hp' => '087828737384',
            'jk' => 'Laki-Laki'
        ]);

       // $user->assignRole('superadmin');
    
    
    }
}
