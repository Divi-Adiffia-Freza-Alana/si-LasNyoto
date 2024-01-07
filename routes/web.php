<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BagDapurController;
use App\Http\Controllers\PelayanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController; 
use App\Http\Controllers\TransaksiSuplierController; 
use App\Http\Controllers\SuplierController; 
use App\Http\Controllers\ProdukController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');*/
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/createregistration', [AuthController::class, 'createregistration']);
Route::post('/login', [AuthController::class, 'authenticate']);

// Route Users
Route::get('/users', [UsersController::class, 'index'])->name('user.index');
Route::any('/usersstore', [UsersController::class, 'store']);
Route::get('/users-add', [UsersController::class, 'add']);
Route::any('/users-edit/{id}', [UsersController::class, 'edit']);
Route::any('/users-delete/{id}', [UsersController::class, 'delete']);
Route::any('/selectuser', [UsersController::class, 'selectUser']);
Route::any('/selectdapurs', [UsersController::class, 'selectDapur']);
Route::any('/selectpelayans', [UsersController::class, 'selectPelayan']);

// Route Suplier
Route::get('/suplier', [SuplierController::class, 'index'])->name('suplier.index');
Route::any('/suplierstore', [SuplierController::class, 'store']);
Route::get('/suplier-add', [SuplierController::class, 'add']);
Route::any('/suplier-edit/{id}', [SuplierController::class, 'edit']);
Route::any('/suplier-delete/{id}', [SuplierController::class, 'delete']);
Route::any('/selectsuplier', [SuplierController::class, 'selectSuplier']);


// Route Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::any('/produkstore', [ProdukController::class, 'store']);
Route::get('/produk-add', [ProdukController::class, 'add']);
Route::any('/produk-edit/{id}', [ProdukController::class, 'edit']);
Route::any('/produk-delete/{id}', [ProdukController::class, 'delete']);
Route::any('/selectproduk', [ProdukController::class, 'selectProduk']);
Route::any('/bahanbakuproduk/{id}', [ProdukController::class, 'bahanbakuproduk']);
Route::any('/bahanbakuprodukstore', [ProdukController::class, 'bahanbakuprodukstore']);
Route::any('/bahanbakuprodukindex', [ProdukController::class, 'bahanbakuprodukindex'])->name('bahanbakuproduk.index');
Route::any('/bahanbakuproduk-delete/{id}', [ProdukController::class, 'bahanbakuprodukdelete']);






//Route Bag Dapur
Route::get('/bagdapur', [BagDapurController::class, 'index'])->name('bagdapur.index');
Route::any('/bagdapurstore', [BagDapurController::class, 'store']);
Route::get('/bagdapur-add', [BagDapurController::class, 'add']);
Route::any('/bagdapur-edit/{id}', [BagDapurController::class, 'edit']);
Route::any('/bagdapur-delete/{id}', [BagDapurController::class, 'delete']);
Route::any('/selectbagdapur', [BagDapurController::class, 'selectBagdapur']);


//Route Pelayan
Route::get('/pelayan', [PelayanController::class, 'index'])->name('pelayan.index');
Route::any('/pelayanstore', [PelayanController::class, 'store']);
Route::get('/pelayan-add', [PelayanController::class, 'add']);
Route::any('/pelayan-edit/{id}', [PelayanController::class, 'edit']);
Route::any('/pelayan-delete/{id}', [PelayanController::class, 'delete']);
Route::any('/selectpelayan', [PelayanController::class, 'selectPelayan']);



//Route Bahan Baku
Route::get('/bahanbaku', [BahanBakuController::class, 'index'])->name('bahanbaku.index');
Route::any('/bahanbakustore', [BahanBakuController::class, 'store']);
Route::get('/bahanbaku-add', [BahanBakuController::class, 'add']);
Route::any('/bahanbaku-edit/{id}', [BahanBakuController::class, 'edit']);
Route::any('/bahanbaku-delete/{id}', [BahanBakuController::class, 'delete']);
Route::any('/bahanbaku-transaction/{id}', [BahanBakuController::class, 'transaksi']);
Route::any('/bahanbakustoretransaction', [BahanBakuController::class, 'storetransaction']);
Route::any('/selectbahanbaku', [BahanBakuController::class, 'selectBahanbaku']);
//SRoute::get('/transaksibahanbaku/{id}', [BahanBakuController::class, 'indextransactionbahanbaku'])->name('transaksibahanbaku.index/{id}');

//Route Transaksi suplier
Route::get('/transaksi-suplier', [TransaksiSuplierController::class, 'index'])->name('transaksisuplier.index');
Route::any('/transaksi-suplier-store', [TransaksiSuplierController::class, 'store']);
Route::get('/transaksi-suplier-add', [TransaksiSuplierController::class, 'add']);
Route::any('/transaksi-suplier-addbarang', [TransaksiSuplierController::class, 'addbarang']);
Route::any('/transaksi-suplier-storebarang', [TransaksiSuplierController::class, 'transaksisuplierstorebarang']);
Route::any('/suplierbarang', [TransaksiSuplierController::class, 'suplierbarangindex'])->name('suplierbarang.index');
Route::any('/transaksi-suplier-deletebarang/{id}', [TransaksiSuplierController::class, 'transaksisuplierdeletebarang']);

Route::any('/transaksi-edit/{id}', [TransaksiController::class, 'edit']);
Route::any('/transaksi-delete/{id}', [TransaksiController::class, 'delete']);
Route::any('/transaksi-detail/{id}', [TransaksiController::class, 'detail']);





//Route Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::any('/menustore', [MenuController::class, 'store']);
Route::get('/menu-add', [MenuController::class, 'add']);
Route::any('/menu-edit/{id}', [MenuController::class, 'edit']);
Route::any('/menu-delete/{id}', [MenuController::class, 'delete']);





//Route Meja
Route::get('/meja', [MejaController::class, 'index'])->name('meja.index');
Route::any('/mejastore', [MejaController::class, 'store']);
Route::get('/meja-add', [MejaController::class, 'add']);
Route::any('/meja-edit/{id}', [MejaController::class, 'edit']);
Route::any('/meja-delete/{id}', [MejaController::class, 'delete']);
Route::any('/selectmeja', [MejaController::class, 'selectMeja']);




//Route Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::any('/transaksistore', [TransaksiController::class, 'store']);
Route::get('/transaksi-add', [TransaksiController::class, 'add']);
Route::any('/transaksi-edit/{id}', [TransaksiController::class, 'edit']);
Route::any('/transaksi-delete/{id}', [TransaksiController::class, 'delete']);
Route::any('/transaksi-detail/{id}', [TransaksiController::class, 'detail']);


Route::any('/chooseproduct', [TransaksiController::class, 'choose']);
Route::any('/cart', [TransaksiController::class, 'cart'])->name('transaksi.cart');
Route::any('/add-to-cart/{id}', [TransaksiController::class, 'addToCart']);
Route::patch('/update-cart', [TransaksiController::class, 'updateCart']);
Route::any('/deletecart', [TransaksiController::class, 'deleteallcart']);
Route::delete('remove-from-cart', [TransaksiController::class, 'remove']);

//transaksi 
Route::any('/transaksistoretambah', [TransaksiController::class, 'storetambah']);
Route::any('/chooseproduct-tambah', [TransaksiController::class, 'choosetambah']);
Route::any('/cart-tambah', [TransaksiController::class, 'carttambah'])->name('transaksitambah.cart');
Route::any('/add-to-cart-tambah/{id}', [TransaksiController::class, 'addToCarttambah']);
Route::patch('/update-cart-tambah', [TransaksiController::class, 'updateCarttambah']);
Route::any('/deletecart-tambah', [TransaksiController::class, 'deleteallcarttambah']);
Route::delete('remove-from-cart-tambah', [TransaksiController::class, 'removetambah']);

Route::group(['middleware' => ['role:superadmin']], function () {
Route::any('/paid', [TransaksiController::class, 'paid']);
Route::any('/update/{id}', [MejaController::class, 'update']);

Route::any('/countpaid/{id}', [TransaksiController::class, 'countpaid']);

Route::any('/present/{id}', [PelayanController::class, 'present']);
Route::any('/unpresent/{id}', [PelayanController::class, 'unpresent']);

Route::any('/present-dapur/{id}', [BagDapurController::class, 'present']);
Route::any('/unpresent-dapur/{id}', [BagDapurController::class, 'unpresent']);

});
Route::group(['middleware' => ['role:bag_dapur']], function () {
Route::any('/done/{id}', [TransaksiController::class, 'done']);

});


Route::group(['middleware' => ['role:pelayan']], function () {
    Route::any('/deliver/{id}', [TransaksiController::class, 'deliver']);
    
    });


    
    
//Keranjang 
/*Route::get('/produk', [KeranjangController::class, 'index']);
Route::get('/cart', [KeranjangController::class, 'cart'])->name('keranjang.cart');

Route::get('/add-to-cart/{id}', [KeranjangController::class, 'addToCart']);
Route::patch('/update-cart', [KeranjangController::class, 'update']);
Route::delete('remove-from-cart', [KeranjangController::class, 'remove']);*/

