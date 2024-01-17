<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Menu;
use App\Models\Produk;
use App\Models\BahanBaku;

class DashboardController extends Controller
{
    public function index(){
        $countbahanbaku = BahanBaku::all()->count();
        $countmenu = Menu::all()->count();
        $countkurir = Produk::all()->count();

        return view('dashboard',["bahanbaku"=>$countbahanbaku,"menu"=>$countmenu,"kurir"=>$countkurir]);

    }

    public function indexcustomer(){
        $produk = Produk::query()->get();
   
        return view('main',["dataproduk"=>$produk]);

    }

    //
}
