<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandang;
use App\Models\Satwa;
use App\Models\Keeper;
use App\Models\Bag_Dapur;
use App\Models\Menu;
use App\Models\BahanBaku;

class DashboardController extends Controller
{
    public function index(){
        $countbahanbaku = BahanBaku::all()->count();
        $countmenu = Menu::all()->count();
        $countkurir = Bag_Dapur::all()->count();

        return view('dashboard',["bahanbaku"=>$countbahanbaku,"menu"=>$countmenu,"kurir"=>$countkurir]);

    }

    //
}
