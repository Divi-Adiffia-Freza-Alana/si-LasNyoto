<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Bag_Dapur;
use App\Models\Pelayan;
use App\Models\Users;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Kurir;
use App\Models\Marketing;
use App\Models\Metode_Pembayaran;
use App\Models\Pembayaran;
use App\Models\Sph;
use App\Models\Transaksi_detail;
use App\Models\BahanBaku;
use App\Models\Pengiriman;

use Illuminate\Http\RedirectResponse;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class TransaksiController extends Controller
{
    //



    public function index(Request $request){

        // var_dump(Barang::with('category')->get()->find('f997b850-662e-4f19-b0b6-4dc33a8b9c5b'));
     
      //exit();
          if ($request->ajax()) {
  
    
              $transaksi = Transaksi::with(['produk','kurir','konsumen','pembayaran']);
              return  DataTables::of($transaksi)
                      ->addIndexColumn()
                      ->editColumn('tgl_transaksi', function($data){ 
                          return dateformat($data->tgl_transaksi);
                      })
                      ->editColumn('estimasi', function($data){ 
                        if($data->estimasi == null){
                            return '';
                           }
                          return dateformat($data->estimasi);
                      })
                      ->editColumn('kurir.nama', function($data){
                          if($data->kurir->name == null){
                              return '';
                          }
                          return $data->kurir->name;
                      })

                      ->editColumn('jenispembayaran', function($data){
                        if($data->jenispembayaran == 'lunas'){
                            return 'Tunai';
                        }else{
                        return $data->jenispembayaran;}
                    })
                 
                      ->addColumn('detail', function($row){
                          $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                           return $btn;
                   })
                   ->addColumn('statusorder', function($data){
                    $last = count($data->pembayaran)-1;
                    if($data->pembayaran[$last]->status != "Lunas"){
                        $btn = '<a class="btn bg-blue" href="" style="color:#00000;display:inline-block;" >Pembayaran Terlebih Dahulu</a>';
                    }
                      if($data->statusorder == 1){
                          $btn = '<a class="btn bg-blue" href="/done/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Proses Pesanan</a>';
                      }
  
                      else if($data->statusorder == 2){
                          $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Siap Dikirim</a>';
                      }
                      else if($data->statusorder == 3){
                        $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Dalam Pengiriman</a>';
                    }
                     
                      else{
                      
                          $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Dikirim </a>';
                      }
                     
                       return $btn;
               })
                   ->addColumn('statusbayar', function($data){
                              //pembayaran Kredit                        
                              if($data->jenispembayaran == "Kredit"){
                                //jenis pembayaran Bayar ditempat
                                if($data->metodepembayaran->jenis == "Cash"){
                                      $last = count($data->pembayaran)-1;
                                       //Cicilan 1
                                      if($data->pembayaran[0]->status == NULL){
                                          $btn = '<a class="btn btn-warning" href="/validatepaid/'.(isset($data->pembayaran[0]->id)?$data->pembayaran[0]->id:"").'" style="color:#00000;display:inline-block;" >Cicilan 1</a>';
                                      }
                                     //Cicilan 2
                                      else if($data->pembayaran[1]->status == NULL){
                                          $btn = '<a class="btn btn-warning" href="/validatepaid/'.(isset($data->pembayaran[1]->id)?$data->pembayaran[1]->id:"").'" style="color:#00000;display:inline-block;" >Cicilan 2</a>';
                                       //Lunas
                                      }else{
                                          $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                          }
                                  }
                                  else{
                                  //jenis pembayaran TF
                                      $last = count($data->pembayaran)-1;
                                        //Cicilan 1
                                        if($data->pembayaran[0]->status == NULL){
                                            $btn = '<a class="btn btn-warning" href="/validatepaid/'.(isset($data->pembayaran[0]->id)?$data->pembayaran[0]->id:"").'" style="color:#00000;display:inline-block;" >Cicilan 1</a>';
                                        }
                                       //Cicilan 2
                                        else if($data->pembayaran[1]->status == NULL){
                                            $btn = '<a class="btn btn-warning" href="/validatepaid/'.(isset($data->pembayaran[1]->id)?$data->pembayaran[1]->id:"").'" style="color:#00000;display:inline-block;" >Cicilan 2</a>';
                                         //Lunas
                                        }else{
                                            $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                            }
                                 }
                          }                  
     
                           //pembayaran Lunas (1x bayar)
                          else{
                             //jenis pembayaran Bayar ditempat
                             if($data->metodepembayaran->jenis == "Cash"){
                                  $last = count($data->pembayaran)-1;
                                  //awal pembayaran
                                  if($data->pembayaran[$last]->status == NULL){
                                       //if(){}

                                      $btn = '<a class="btn btn-warning" href="/validatepaid/'.(isset($data->pembayaran[$last]->id)?$data->pembayaran[$last]->id:"").'" style="color:#00000;display:inline-block;" >Validasi Pembayaran</a>';
                                  }
                                  //Lunas
                                  else{
                                      $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                      } 
                              }
                              else{
                              //jenis pembayaran Bayar TF
                                  $last = count($data->pembayaran)-1;
                                  //awal pembayaran
                                  if($data->pembayaran[$last]->url_foto == ""){
                                      $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Menunggu Pembayaran</a>';
                                  }
                                  else if($data->pembayaran[$last]->status == "Lunas"){
   
                                    $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                  }
                                  //Lunas
                                  else{
                                    $btn = '<a class="btn btn-warning" href="/validatepaid/'.(isset($data->pembayaran[$last]->id)?$data->pembayaran[$last]->id:"").'" style="color:#00000;display:inline-block;" >Validasi Pembayaran</a>';

                                      } 
  
                              }
                          }
             
                       return $btn;
               })
               ->addColumn('tambahpesanan', function($data){
                  if($data->status_bayar == 1){
                      $btn = '<a class="btn bg-green" href="/chooseproduct-tambah" style="color:#00000;display:inline-block;" >Tambah Pesanan</a>';
  
                  }
                  else{
                      $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Tidak dapat menambah pesanan</a>';
                  }
                 
                   return $btn;
           })
                      ->addColumn('action', function($row){
                             $btn ='<a class="btn btn-danger" href="/transaksi-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                              return $btn;
                      })
  
                      ->filter(function ($instance) use ($request) {
  
                          if ($request->get('filtermonth') ) {
  
                             // var_dump("HAHA");
                              //exit();
   
                              $instance->whereMonth('tgl_transaksi', $request->get('filtermonth')->orderBy('status')->orderBy('status_bayar'));
  
                          }else{
                              $instance->orderBy('created_at','asc');
                          }
  
               
  
                      })
                      
                      ->rawColumns(['action','detail','statusbayar','statusorder','tambahpesanan'])
                      ->make(true);
  
              }
          
          
          return view('transaksi.transaksi'); 
      }


      public function indextransaksikurir(Request $request){

        // var_dump(Barang::with('category')->get()->find('f997b850-662e-4f19-b0b6-4dc33a8b9c5b'));
     
      //exit();
          if ($request->ajax()) {
  
              
          
              $transaksi = Transaksi::with(['produk','kurir','konsumen',]);
              return  DataTables::of($transaksi)
                      ->addIndexColumn()
                   /* ->editColumn('category.nama', function($data){
                          return $data->category[0]->nama;
                      })*/
                      ->editColumn('tgl_transaksi', function($data){ 
                          return dateformat($data->tgl_transaksi);
                      })
                      ->editColumn('kurir.nama', function($data){
                          if($data->kurir->name == null){
                              return '';
                          }
                          return $data->kurir->name;
                      })
                 
                      ->addColumn('detail', function($row){
                          $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                           return $btn;
                   })
                   ->addColumn('statusorder', function($data){
                      if($data->statusorder == 1){
                          $btn = '<a class="btn bg-blue" href="/done/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Sedang Produksi </a>';
                      }
  
                      else if($data->statusorder == 2){
                          $btn = '<a class="btn btn-warning" href="/deliver/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Siap Dikirim</a>';
                      }
                      else if($data->statusorder == 3){
                        $btn = '<a class="btn btn-warning" href="/donedeliver/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Sedang Dikirim</a>';
                    }
                    else if($data->statusorder == 4){
                        $btn = '<a class="btn btn-warning" href="/deliverconfirm/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Konfirmasi Pengiriman</a>';
                    }
                    
                   
                      else{
                      
                          $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Dikirim </a>';
                      }
                     
                       return $btn;
               })
                   ->addColumn('statusbayar', function($data){
                      if($data->status_bayar == 1){
                          $btn = '<a class="btn btn-warning" href="/countpaid/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Belum Lunas</a>';
                      }
                      
                      else{
                          $btn = '<a class="btn bg-green" href="" style="color:#00000;display:inline-block;" >Sudah Lunas</a>';
                      }
                     
                       return $btn;
               })
               ->addColumn('tambahpesanan', function($data){
                  if($data->status_bayar == 1){
                      $btn = '<a class="btn bg-green" href="/chooseproduct-tambah" style="color:#00000;display:inline-block;" >Tambah Pesanan</a>';
  
                  }
                  else{
                      $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Tidak dapat menambah pesanan</a>';
                  }
                 
                   return $btn;
           })
                      ->addColumn('action', function($row){
                             $btn ='<a class="btn btn-danger" href="/transaksi-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                              return $btn;
                      })
  
                      ->filter(function ($instance) use ($request) {
  
                          if ($request->get('filtermonth') ) {
  
                             // var_dump("HAHA");
                              //exit();
   
                              $instance->whereMonth('tgl_transaksi', $request->get('filtermonth')->orderBy('status')->orderBy('status_bayar'));
  
                          }else{
                              $instance->orderBy('created_at','asc');
                          }
  
               
  
                      })
                      
                      ->rawColumns(['action','detail','statusbayar','statusorder','tambahpesanan'])
                      ->make(true);
  
              }
          
          
          return view('transaksi.transaksikurir'); 
      }



  
    

    
  
    public function countpaid($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $transaksidata = Transaksi::findOrFail($id);

       // $transaksidata->status_bayar = 2;
        
        // /$transaksidata->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        //ar_dump($transaksidata);
        //exit();
        return view('transaksi.countpaid',['data' =>$transaksidata]);
       // return redirect('/transaksi');

    }


    public function paid(Request $request){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $transaksidata = Transaksi::findOrFail($request->id);

        $transaksidata->status_bayar = 2;
        
        $transaksidata->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/transaksi');

    }


    public function done($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $transaksidata = Transaksi::findOrFail($id);

       // var_dump($transaksidata->produk[1]->bahanbaku[0]->stok);
       // exit();    

      //  var_dump($transaksidata->produk[1]->pivot->qty);
       // exit();        

       // var_dump($transaksidata->produk[1]->bahanbaku[0]->id);
       // exit();        

        // Cek Berapa Produk
        foreach($transaksidata->produk as $produk) {
            //simpen banyak produk qty
            $produkqty = $produk->pivot->qty;

           

          // Cek Banyak Bahan Baku
            foreach($produk->bahanbaku as $bahan) {
             

                $bahanbakudata = BahanBaku::findOrFail($bahan->id);
               // var_dump($bahanbakudata->stok - $produkqty * $bahan->pivot->qty);
               // exit();
                //update
                $bahanbakudata->stok = $bahanbakudata->stok - $produkqty * $bahan->pivot->qty;
                $bahanbakudata->save();
    
             }
         }

            

        $transaksidata->statusorder = 2;
        
        $transaksidata->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/transaksi');

    }

    public function deliver($id){
        


        $transaksi = Transaksi::query()->get()->find($id);
    
 
    
        return view('transaksi.deliver',["datatransaksi"=>$transaksi]);        

    }

    
   public function deliverstore(Request $request): RedirectResponse
   {
   
    $transaksidata = Transaksi::findOrFail($request->id);
    $transaksidata->statusorder = 4;
    $transaksidata->save();

    $pengirimandata = Pengiriman::findOrFail($request->id_pengiriman);
    $pengirimandata->nopol = $request->nopol;
    $pengirimandata->kendaraan = $request->merk;
    $pengirimandata->tgl_kirim =  date("Y-m-d", strtotime($request->tgl_kirim));
    $pengirimandata->nama_penerima = $request->nama_penerima;
    $pengirimandata->save();
     
    Session::flash('status', 'success');
    Session::flash('message', 'Data Pengirim Berhasil');

    return redirect('/transaksi-kurir');

   }

   public function deliverconfirm($id){
        


    $transaksi = Transaksi::query()->get()->find($id);



    return view('transaksi.deliverconfirm',["datatransaksi"=>$transaksi]);        

}


public function deliverconfirmstore(Request $request): RedirectResponse
{
  

$transaksidata = Transaksi::findOrFail($request->id);
$transaksidata->statusorder = 5;
$transaksidata->save();

$pengirimandata = Pengiriman::findOrFail($request->id_pengiriman);

$pengirimandata->nama_penerima = $request->penerima;
$pengirimandata->save();
 
Session::flash('status', 'success');
Session::flash('message', 'Data Konfirmasi Pengiriman Berhasil');

return redirect('/transaksi-kurir');

}

    public function donedeliver($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $transaksidata = Transaksi::findOrFail($id);

        $transaksidata->statusorder = 6;
        
        $transaksidata->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/transaksi-kurir');
    }

    public function choose(){
        
        //$transaksidata = Transaksi::with(['barang'])->get()->find($id);
        $menumakanan = Menu::select("*")->where('jenis','=','makanan')->get();
        $menuminuman = Menu::select("*")->where('jenis','=','minuman')->get();
       // $menu = Menu::select('id','kd_menu','nama','foto_url','harga')->groupBy('jenis')->get();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit(); 
        return view('transaksi.menu_cart',['datamakanan' =>$menumakanan, 'dataminuman' =>$menuminuman]);

    }


    public function updateCart(Request $request){

       // dd($request->id);

        if($request->id and $request->quantity)
        {
           /* \Cart::update($request->id, array(
                'quantity' => $request->quantity, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
              ));*/
              \Cart::update($request->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
              ));
        } 
    }

    public function remove(Request $request){

        // dd($request->id);
 
         if($request->id)
         {
            
            \Cart::remove($request->id);
         } 
     }
    /*public function add(){

        return view('transaksi.add_menus');

    }


    public function edit($id){
        
        $transaksidata = Transaksi::with(['menu'])->get()->find($id);
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);
        return view('barang.add_barang',['data' =>$barangdata]);

    }*/

    public function detail($id){

        // dd($request->id);
 
         if($id)
         {
             
          $transaksidata = Transaksi::with(['produk','kurir','konsumen'])->get()->find($id);
          
          //var_dump($transaksidata);
          //exit();
         
            
         } 
        

         return view('transaksi.detail',['data' =>$transaksidata]);
     }

    public function addToCart($id)
    {
        $produkall = Produk::query()->get();
        $produk = Produk::find($id);
        $userId = auth()->user()->id; // or any string represents user identifier
        //var_dump($userId);
        //exit();

        //DELETE TOTAL
       /* $items = \Cart::getContent();

        foreach($items as $row) {

           // echo $row->id;
            \Cart::remove($row->id); 
        }*/

       // Cart::remove(456);
        \Cart::add(array(
            'id' => $produk->id, // inique row ID
            'name' => $produk->nama,
            'price' =>  $produk->harga,
            'photo' =>  $produk->foto_url,
            'quantity' =>  1
        ));

        return view('main',["dataproduk"=>$produkall]);


        
    }

    public function deleteallcart(){
        $items = \Cart::getContent();
         //delete dataa
         foreach($items as $row) {

            // echo $row->id;
             \Cart::remove($row->id); 
         }

         return redirect('/cart');
    }


    public function cart()
    {
        $metodepembayaran = Metode_Pembayaran::orderBy('jenis', 'asc')->get();
        //var_dump($metodepembayaran);
        //exit();
        $items = \Cart::getContent();
       // var_dump($items);
        //dexit();

        
        return view('transaksi.cart',['data' => $items, 'metodepembayaran' => $metodepembayaran]);
    }


    
    public function storetambah(Request $request): RedirectResponse
    {   
    

            $items = \Cart::getContent();
            $transaksi = Transaksi::select("*")->where('id_konsumen','=',auth()->user()->id )->latest()->get();
           // var_dump($transaksi[0]->id);

            $total = $transaksi[0]->total +  \Cart::getTotal();
           // var_dump($total);
            //exit();
                        
            $transaksidata = Transaksi::findOrFail($transaksi[0]->id);
    
            $transaksidata->total = $total;
            
            $transaksidata->save();
            
            foreach ($items as $row) {
                Transaksi_detail::create([  
                    'id' => Str::uuid(),
                    'id_transaksi' => $transaksi[0]->id, 
                    'id_menu' => $row->id,
                    'qty' => $row->quantity,
                    'harga' => $row->price,
                    'subtotal' => $row->price * $row->quantity,
                ]);
            }
            //delete dataa
            foreach($items as $row) {
    
               // echo $row->id;
                \Cart::remove($row->id); 
            }
    
    
    
    
    
                Session::flash('status', 'success');
                Session::flash('message', 'Data Transaksi Berhasil');
            
    
    
    
          
    
              
    
            return redirect('/transaksi');
        }
    


   public function store(Request $request): RedirectResponse
{   

   // var_dump($request->jenispembayaran);
    //exit();

   /* $validator = Validator::make($request->all(), [
        'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        Session::flash('status', 'error');
        Session::flash('message', $validator->messages()->first());
        return redirect()->back()->withInput();
    }*/ /*else {*/
        // dd(Carbon::now()->format('d-m-Y'));
       // $sph = Sph::where('tgl_transaksi', '=', Carbon::now()->format('Y-m-d'))->get();
       // $number = count($sph)+1;
        //$kode_sph = "SPH".Carbon::now()->format('Ymd').$number;





        $kurir = Users::select("id")->whereRelation('kurir', 'id_user', '!=', NULL)->get();
        $marketing = Users::select("id")->whereRelation('marketing', 'id_user', '!=', NULL)->get();
       // var_dump($kurir);
        //exit();
      //  $bagdapur = Users::select("id")->whereRelation('bagdapur', 'status_kehadiran', '=', 'Hadir')->get();
           
       // $bagdapur = User::select("id")->bagdapur()->where('status_kehadiran', '=', "Hadir")->get();
       // $pelayan = Users::select("id")->whereRelation('pelayan', 'status_kehadiran', '=', 'Hadir')->get();;
        //var_dump($pelayan[]->id);
        //exit();
        $transaksi = Transaksi::where('tgl_transaksi', '=', Carbon::now()->format('Y-m-d'))->get();
        $num = count($transaksi)+1;
        $id_transaksi = "INV".Carbon::now()->format('Ymd').$num;
        //$nownum = intval($num)+1;

       // var_dump($id_transaksi);

        //exit();
        //var_dump(count($bagdapur));
       // var_dump($bagdapur[rand(0,count($bagdapur)-1)]->id);
        //exit();
         //  var_dump($pelayan[rand(0,count($pelayan)-1)]->id);
       // exit();

        //var_dump($bagdapur);
        //exit()

        $items = \Cart::getContent();

        $tipe = '';
        // BUG BACA REGULER
        //CUSTOM 2 AMAN
  
        foreach ($items as $index=> $row) {    

            $produkjenis = Produk::Where('id','=',$row->id)->get();

            if($produkjenis[0]->tipe == "Custom"){
             $tipe = "Custom";
            }
            else{
                $tipe = "Regular";
            }
        }


        $sph = NULL ;
    
        if($tipe == "Custom"){
          
            $sph = SPH::create([
                'id' => Str::uuid(),
                'kode' => '',
                'deskripsi' => '',
                
            ]);
        }




       // var_dump($kurir[rand(0,count($kurir)-1)]->id);
       // exit();
        
        $pengiriman = Pengiriman::create([
            'id' => Str::uuid(),
            'id_kurir' => $kurir[rand(0,count($kurir)-1)]->id,
            'nopol' => '',
            'kendaraan' => '',
            'tgl_kirim' => NULL,
            'alamat' => $request->alamat,
            'nama_penerima' => '',
            
        ]);

    

        if ($request->id == NULL || $request->id == "") {
 
            $transaksi = Transaksi::create([
                'id' => Str::uuid(),
                'kode' => $id_transaksi,
                'id_konsumen' => auth()->user()->id,
                'id_kurir' => $kurir[rand(0,count($kurir)-1)]->id,
                'id_marketing' => $marketing[rand(0,count($marketing)-1)]->id,
                'id_metode_pembayaran' => $request->metode_pembayaran,
                'id_sph' => (isset($sph->id)?$sph->id:NULL),
                'id_pengiriman' => $pengiriman->id,
                'tgl_transaksi' =>Carbon::now()->format('Y-m-d'),
                'estimasi' =>NULL,
                //'nama' => $request->nama,
                //'no_hp' => $request->no_hp,
               
                'total' => \Cart::getTotal(),
                'tipe' => $tipe,
                'jenispembayaran' => $request->jenispembayaran,
                'statusorder' => 1,

              
            ]);
        
            if($request->jenispembayaran == "Tunai"){

                $pembayaran1 =  Pembayaran::create([  
                     'id' => Str::uuid(),
                     'id_transaksi' => $transaksi->id, 
                     'foto' => '',
                     'url_foto' => '', 
                 ]);
             }
             else{
     
                 $pembayaran1 =  Pembayaran::create([  
                     'id' => Str::uuid(),
                     'id_transaksi' => $transaksi->id, 
                     'foto' => '',
                     'url_foto' => '',
                 
                
                 ]);
     
                 $pembayaran2 =  Pembayaran::create([  
                     'id' => Str::uuid(),
                     'id_transaksi' => $transaksi->id, 
                     'foto' => '',
                     'url_foto' => '',
                
               
                 ]);

    }

  
     
        foreach ($items as $row) {
            Transaksi_detail::create([  
            
                'id' => Str::uuid(),
                'id_transaksi' => $transaksi->id, 
                'id_produk' => $row->id,
                'qty' => $row->quantity,
                'harga' => $row->price,
                'subtotal' => $row->price* $row->quantity,
            
            ]);
        

        

   }
        //delete dataa
        foreach($items as $row) {

           // echo $row->id;
            \Cart::remove($row->id); 
        }





            /*if ($request->file('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $namefile = $request->nama . '-' . now()->timestamp . '.' . $extension;
                $request->file('foto')->move('foto', $namefile);

                Keeper_foto::create([
                    'id' => Str::uuid(),
                    'id_keeper' => $menu->id, // Assuming $menu object is available and has the necessary id
                    'nama' => $namefile,
                    'url' => urlimage($namefile),
                ]);

                Session::flash('status', 'success');
                Session::flash('message', 'Tambah Data Menu Berhasil');
            }*/
            Session::flash('status', 'success');
            Session::flash('message', 'Data Transaksi Berhasil');
        }      
          

        return redirect('/transaksi-customer');
    }

    public function delete($id){

        // $deleteKeeper = Keeper::findorFail($id);
        // $deleteKeeper->delete();

        // /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        // $deleteKeeperfoto->delete();*/
        // Session::flash('status', 'success');
        // Session::flash('message', 'Delete Data Keeper Berhasil');

        // return redirect('/keeper');

    $transaksi = Transaksi::findOrFail($id);
    $transaksi->delete();

    Session::flash('status', 'success');
    Session::flash('message', 'Delete Data Transaksi Berhasil');

    return redirect('/transaksi');
}



// tambah transaksi

public function choosetambah(){
        
    //$transaksidata = Transaksi::with(['barang'])->get()->find($id);
    $menumakanan = Menu::select("*")->where('jenis','=','makanan')->get();
    $menuminuman = Menu::select("*")->where('jenis','=','minuman')->get();

    //var_dump($idtransaksi);
    //exit();
   // $menu = Menu::select('id','kd_menu','nama','foto_url','harga')->groupBy('jenis')->get();
   // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
    //dd($keeperdata);

    //var_dump($barang);
    //exit(); 
    return view('transaksi.menu_cart_tambah',['datamakanan' =>$menumakanan, 'dataminuman' =>$menuminuman]);

}


public function updateCarttambah(Request $request){

   // dd($request->id);

    if($request->id and $request->quantity)
    {
       /* \Cart::update($request->id, array(
            'quantity' => $request->quantity, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
          ));*/
          \Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
          ));
    } 
}

public function removetambah(Request $request){

    // dd($request->id);

     if($request->id)
     {
        
        \Cart::remove($request->id);
     } 
 }

 
 public function addToCarttambah($id)
 {
     $menuall = Menu::all();
     $menu = Menu::find($id);
     $menumakanan = Menu::select("*")->where('jenis','=','makanan')->get();
     $menuminuman = Menu::select("*")->where('jenis','=','minuman')->get();
     $userId = auth()->user()->id; // or any string represents user identifier
     //var_dump($userId);
     //exit();

     //DELETE TOTAL
    /* $items = \Cart::getContent();

     foreach($items as $row) {

        // echo $row->id;
         \Cart::remove($row->id); 
     }*/

    // Cart::remove(456);
     \Cart::add(array(
         'id' => $menu->id, // inique row ID
         'name' => $menu->nama,
         'price' =>  $menu->harga,
         'photo' =>  $menu->foto_url,
         'quantity' =>  1
     ));

     return view('transaksi.menu_cart_tambah',['datamakanan' =>$menumakanan, 'dataminuman' =>$menuminuman]);


     
 }

 public function deleteallcarttambah(){
     $items = \Cart::getContent();
      //delete dataa
      foreach($items as $row) {

         // echo $row->id;
          \Cart::remove($row->id); 
      }

      return redirect('/cart');
 }


 public function carttambah()
 {
     $items = \Cart::getContent();
     //$transaksi = Transaksi::select("*")->where('id_konsumen','=',auth()->user()->id )->latest()->get();
   //  var_dump($transaksi->id);
     //exit();

     
     return view('transaksi.carttambah',['data' => $items]);
 }


 public function paidtransfer($id){
    $transaksi = Transaksi::with(['produk','pembayaran'])->get()->find($id);

    //var_dump($transaksi->produk[0]->pivot);
    //exit();

    return view('transaksi.paidtf',["datatransaksi"=>$transaksi]);

}

public function validatepaid($id){
    $pembayaran = Pembayaran::with(['transaksi'])->get()->find($id);


    //var_dump($transaksi->produk[0]->pivot);
    //exit();

    return view('transaksi.validatepaid',["datatransaksi"=>$pembayaran]);

}

public function validatepaidstore(Request $request): RedirectResponse
{
    //lempar id transaksi


    
   $transaksi = Transaksi::with(['pembayaran'])->get()->find($request->id_transaksi);
   $pembayaran = Pembayaran::with(['transaksi'])->get()->find($request->id_pembayaran);

    //lunas
    if($pembayaran->transaksi->jenispembayaran == 'Lunas'){
        $pembayaran = Pembayaran::with(['transaksi'])->get()->find($request->id_pembayaran);
        $pembayaran->jumlah = $request->bayar;
        $pembayaran->status = 'Lunas';
        $pembayaran->save();
        $transaksi->estimasi = date("Y-m-d", strtotime($request->estimasi));
        $transaksi->save();
    }
    else{
    //cicilan
    $transaksi = Transaksi::with(['pembayaran'])->get()->find($request->id_transaksi);

    
    //awal pembayaran atau cicilan 1
    if($transaksi->pembayaran[0]->status == NULL){
        $pembayaran = Pembayaran::with(['transaksi'])->get()->find($transaksi->pembayaran[0]->id);
        $pembayaran->jumlah = $request->bayar;
        $pembayaran->status = 'Cicilan1';
        $pembayaran->save();
        $transaksi->estimasi = date("Y-m-d", strtotime($request->estimasi));
        $transaksi->save();

    }
   // cicilan2
    else{

           $pembayaran = Pembayaran::with(['transaksi'])->get()->find($transaksi->pembayaran[1]->id);
            $pembayaran->jumlah = $request->bayar;
            $pembayaran->status = 'Lunas';
            $pembayaran->save();
    
    }

    }


    //var_dump($transaksi->produk[0]->pivot);
    //exit();

    Session::flash('status', 'success');
    Session::flash('message', 'Validasi Pembayaran Berhasil');
   
  

return redirect('/transaksi');

}



 public function sph($id){
    $transaksi = Transaksi::with(['sph','produk'])->get()->find($id);

    //var_dump($transaksi->produk[0]->pivot);
    //exit();

    return view('transaksi.add_sph',["datatransaksi"=>$transaksi]);

}


public function sphstore(Request $request): RedirectResponse
{
    $countsph = Sph::where('tgl', '=', Carbon::now()->format('Y-m-d'))->get();

    $num = count($countsph)+1;
    $kode_sph = "SPH".Carbon::now()->format('Ymd').$num;

    $sph = Sph::find($request->id_sph);
    $sph->kode = $kode_sph;
    $sph->tgl = Carbon::now()->format('Y-m-d');
    $sph->deskripsi = $request->deskripsi;
    $sph->save();

    for ($i = 0; $i < count($request->id_pivot); $i++)
    {
        $transaksidetail = Transaksi_detail::find($request->id_pivot[$i]);
        $transaksidetail->harga = $request->harga[$i];
        $transaksidetail->subtotal = $request->qty[$i] * $request->harga[$i] ;
        $transaksidetail->save();
    }
    $transaksi = Transaksi::find($request->id);
    $sum = Transaksi_detail::where('id_transaksi', $request->id)->sum('subtotal');
    $transaksi->total = $sum;
    $transaksi->save();
       
        
     
            Session::flash('status', 'success');
            Session::flash('message', 'Isi Data SPH Berhasil');
           
          

        return redirect('/transaksi-marketing');
    

    
  }



  public function sphbergaining(Request $request): RedirectResponse
  {
    //var_dump($request->all());
    //exit();
    $sph = Sph::find($request->id);

    $sph->harga_penawaran = $request->harga_penawaran;
    $sph->save();
                     
    return redirect('/transaksi-sph-customer');
   }



   
 public function detailsph($id){
    $transaksi = Transaksi::with(['sph','produk'])->get()->find($id);

    //var_dump($transaksi->produk[0]->pivot);
    //exit();

    return view('transaksi.detailsph',["datatransaksi"=>$transaksi]);

}


}