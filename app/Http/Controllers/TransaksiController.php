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
use App\Models\Transaksi_detail;
use Illuminate\Http\RedirectResponse;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class TransaksiController extends Controller
{
    //

    public function indexcustomer(){
        $produk = Produk::query()->get();
   
        return view('main',["dataproduk"=>$produk]);

    }
    

    
    public function index(Request $request){

      // var_dump(Barang::with('category')->get()->find('f997b850-662e-4f19-b0b6-4dc33a8b9c5b'));
   
    //exit();
        if ($request->ajax()) {

            if( auth()->user()->hasRole('konsumen')){
                $transaksi = Transaksi::with(['produk','kurir','konsumen'])->where('id_konsumen', '=', auth()->user()->id);
                return  DataTables::of($transaksi)
                        ->addIndexColumn()
                     /* ->editColumn('category.nama', function($data){
                            return $data->category[0]->nama;
                        })*/
                        ->editColumn('tgl_transaksi', function($data){ 
                            return dateformat($data->tgl_transaksi);
                        })
                        ->editColumn('kurir.nama', function($data){
                            if($data->kurir == null){
                                return '';
                            }
                            return $data->kurir->name;
                        }) 
                        ->editColumn('konsumen.name', function($data){
                            return $data->konsumen->name;
                        })/*
                        ->editColumn('meja.nomor', function($data){
                            return $data->meja->nomor;
                        })
                        ->editColumn('pelayan.nama', function($data){
                            return $data->pelayan->name;
                        })
                        ->editColumn('bagdapur.nama', function($data){
                            return $data->bagdapur->name;
                        })*/
                        ->addColumn('detail', function($row){
                            $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                             return $btn;
                     })
                     ->addColumn('statuspesanan', function($data){
                        if($data->status == 1){
                            $btn = '<a class="btn bg-blue" href="/done/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Silahkan Tunggu</a>';
                        }

                        else if($data->status == 2){
                            $btn = '<a class="btn bg-green" href="/deliver/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Sedang Dikirim</a>';
                        }
                       
                        else{
                        
                            $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Diantar </a>';
                        }
                        
                         return $btn;
                 })
                     ->addColumn('statusbayar', function($data){
                        if($data->status_bayar == 1){
                            $btn = '<a class="btn btn-warning" href="/paid/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Belum Lunas</a>';
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

                            if ($request->get('filtermonth') == NULL ) {
    
    
    
                                $instance->with(['produk','kurir','konsumen'])->where('id_konsumen', '=', auth()->user()->id);
                                //exit();
    
    
                              //  $instance->whereMonth('tgl_transaksi', $request->get('filtermonth'));
    
                            }
                            
                            else{
                              //  var_dump($request->get('filtermonth'));
                                //$instance = Transaksi::with(['pelayan'=> function ($query) {
                                  //  $query->where('id_user', '=', auth()->user()->id);}])->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                               //$instance = Transaksi::with(['pelayan'])->get();
                               //$instance[0]->whereMonth('tgl_transaksi', $request->get('filtermonth'))
                               $instance->with(['produk','kurir','konsumen'])->where('id_konsumen', '=', auth()->user()->id)->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                       
                              // $instance = Transaksi::with(['pelayan'=> function ($query) {
                               // $query->where('id_user', '=', auth()->user()->id);}]);
                            
                               //$instance = Transaksi::whereMonth('tgl_transaksi', $request->get('filtermonth'));
                                //var_dump($instance);
                            }
    
                 
    
                        })
                        
                        ->rawColumns(['action','detail','statusbayar','statuspesanan','tambahpesanan'])
                        ->make(true);

            }
            
            if( auth()->user()->hasRole('kurir')){
                $transaksi = Transaksi::with(['produk','kurir','konsumen'])->where('id_kurir', '=', auth()->user()->id);
                return  DataTables::of($transaksi)
                        ->addIndexColumn()
                     /* ->editColumn('category.nama', function($data){
                            return $data->category[0]->nama;
                        })*/
                        ->editColumn('tgl_transaksi', function($data){ 
                            return dateformat($data->tgl_transaksi);
                        })
                        ->editColumn('konsumen.name', function($data){
                            return $data->konsumen->name;
                        })
                        ->editColumn('kurir.nama', function($data){
                            if($data->kurir == null){
                                return '';
                            }
                            return $data->kurir->name;
                        }) 
                
                        ->addColumn('detail', function($row){
                            $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                             return $btn;
                     })
                     ->addColumn('statuspesanan', function($data){
                        if($data->status == 1){
                            $btn = '<a class="btn bg-blue" href="/done/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Silahkan Tunggu</a>';
                        }

                        else if($data->status == 2){
                            $btn = '<a class="btn bg-green" href="/deliver/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Sedang Dikirim</a>';
                        }
                       
                        else{
                        
                            $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Diantar </a>';
                        }
                        
                         return $btn;
                 })
                     ->addColumn('statusbayar', function($data){
                        if($data->status_bayar == 1){
                            $btn = '<a class="btn btn-warning" href="/paid/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Belum Lunas</a>';
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

                        if ($request->get('filtermonth') == NULL ) {



                            //var_dump($request->get('filtermonth'));
                            $instance = Transaksi::with(['produk','kurir','konsumen'])->where('id_kurir', '=', auth()->user()->id);
                            //exit();


                          //  $instance->whereMonth('tgl_transaksi', $request->get('filtermonth'));

                        }
                        
                        else{
                          //  var_dump($request->get('filtermonth'));
                            //$instance = Transaksi::with(['pelayan'=> function ($query) {
                              //  $query->where('id_user', '=', auth()->user()->id);}])->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                           //$instance = Transaksi::with(['pelayan'])->get();
                           //$instance[0]->whereMonth('tgl_transaksi', $request->get('filtermonth'))
                           $instance->with(['produk','kurir','konsumen'])->where('id_kurir', '=', auth()->user()->id)->whereMonth('tgl_transaksi', $request->get('filtermonth'));

                          // $instance = Transaksi::with(['pelayan'=> function ($query) {
                           // $query->where('id_user', '=', auth()->user()->id);}]);
                        
                           //$instance = Transaksi::whereMonth('tgl_transaksi', $request->get('filtermonth'));
                            //var_dump($instance);
                        }

             

                    })
                        
                        ->rawColumns(['action','detail','statusbayar','statuspesanan','tambahpesanan'])
                        ->make(true);

            }

         /*   else if( auth()->user()->hasRole('bag_dapur')){
                $transaksi = Transaksi::with(['menu','pelayan','konsumen','meja','bagdapur'])->where('id_bag_dapur', '=', auth()->user()->id);
                return  DataTables::of($transaksi)
                        ->addIndexColumn()
                  
                        ->editColumn('tgl_transaksi', function($data){ 
                            return dateformat($data->tgl_transaksi);
                        })
                        ->editColumn('konsumen.name', function($data){
                            return $data->konsumen->name;
                        })
                        ->editColumn('meja.nomor', function($data){
                            return $data->meja->nomor;
                        })
                        ->editColumn('pelayan.nama', function($data){
                            if($data->pelayan->name == null){
                                return '';
                            }
                            return $data->pelayan->name;
                        })
                        ->editColumn('bagdapur.nama', function($data){
                            if($data->bagdapur->name == null){
                                return '';
                            }
                            return $data->bagdapur->name;
                        })
                        ->addColumn('detail', function($row){
                            $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                             return $btn;
                     })
                     ->addColumn('statuspesanan', function($data){
                        if($data->status == 1){
                            $btn = '<a class="btn bg-blue" href="/done/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Silahkan Tunggu</a>';
                        }

                        else if($data->status == 2){
                            $btn = '<a class="btn bg-green" href="/deliver/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Telah Selesai</a>';
                        }
                       
                        else{
                        
                            $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Diantar </a>';
                        }
                        
                         return $btn;
                 })
                     ->addColumn('statusbayar', function($data){
                        if($data->status_bayar == 1){
                            $btn = '<a class="btn btn-warning" href="/paid/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Belum Lunas</a>';
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

                        if ($request->get('filtermonth') == NULL ) {



                            //var_dump($request->get('filtermonth'));
                            $instance = Transaksi::with(['menu','pelayan','meja','konsumen','bagdapur'])->where('id_bag_dapur', '=', auth()->user()->id);
                            //exit();


                          //  $instance->whereMonth('tgl_transaksi', $request->get('filtermonth'));

                        }
                        
                        else{
                          //  var_dump($request->get('filtermonth'));
                            //$instance = Transaksi::with(['pelayan'=> function ($query) {
                              //  $query->where('id_user', '=', auth()->user()->id);}])->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                           //$instance = Transaksi::with(['pelayan'])->get();
                           //$instance[0]->whereMonth('tgl_transaksi', $request->get('filtermonth'))
                           $instance->with(['menu','pelayan','konsumen','meja','bagdapur'])->where('id_bag_dapur', '=', auth()->user()->id)->whereMonth('tgl_transaksi', $request->get('filtermonth'));

                          // $instance = Transaksi::with(['pelayan'=> function ($query) {
                           // $query->where('id_user', '=', auth()->user()->id);}]);
                        
                           //$instance = Transaksi::whereMonth('tgl_transaksi', $request->get('filtermonth'));
                            //var_dump($instance);
                        }

             

                    })
                        
                        ->rawColumns(['action','detail','statusbayar','statuspesanan','tambahpesanan'])
                        ->make(true);

            }*/
            else{
                   // $kurir = Kurir::with('');
           //$barang = Barang::query();
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
                 ->addColumn('statuspesanan', function($data){
                    if($data->status == 1){
                        $btn = '<a class="btn bg-blue" href="/done/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Silahkan Tunggu</a>';
                    }

                    else if($data->status == 2){
                        $btn = '<a class="btn btn-warning" href="/deliver/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >sedang dikirim</a>';
                    }
                   
                    else{
                    
                        $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Diantar </a>';
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
                            $instance->orderBy('status')->orderBy('status_bayar');
                        }

             

                    })
                    
                    ->rawColumns(['action','detail','statusbayar','statuspesanan','tambahpesanan'])
                    ->make(true);

            }
        
        }
        return view('transaksi.transaksi'); 
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

        $transaksidata->status = 2;
        
        $transaksidata->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/transaksi');

    }

    public function deliver($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $transaksidata = Transaksi::findOrFail($id);

        $transaksidata->status = 3;
        
        $transaksidata->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/transaksi');

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
        $items = \Cart::getContent();
       // var_dump($items);
        //dexit();

        
        return view('transaksi.cart',['data' => $items]);
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

   /* $validator = Validator::make($request->all(), [
        'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        Session::flash('status', 'error');
        Session::flash('message', $validator->messages()->first());
        return redirect()->back()->withInput();
    }*/ /*else {*/
        // dd(Carbon::now()->format('d-m-Y'));
        $kurir = Users::select("id")->whereRelation('kurir', 'id_user', '!=', NULL)->get();
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
        if ($request->id == NULL || $request->id == "") {

            $transaksi = Transaksi::create([
                'id' => Str::uuid(),
                'kode' => $id_transaksi,
                'id_konsumen' => auth()->user()->id,
                'id_kurir' => $kurir[rand(0,count($kurir)-1)]->id,
                'id_marketing' => $marketing[rand(0,count($marketing)-1)]->id,
                'id_metode_pembayaran' => $marketing[rand(0,count($marketing)-1)]->id,
                'id_sph' => $marketing[rand(0,count($marketing)-1)]->id,
                'tgl_transaksi' =>Carbon::now()->format('Y-m-d'),
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'total' => 0,
                'status' => 1,

              
                //'id_pelayan' => $pelayan[rand(0,count($pelayan)-1)]->id,
              //  'id_meja' => $request->meja,
               
                //'tgl_transaksi' =>date("Y-m-d", strtotime($request->tgl_transaksi)),
             
               //'total' => \Cart::getTotal(),
          
               // 'no_meja' => $request->no_meja,
            ]);
        
     //   $mejadata = Meja::findOrFail($transaksi->id_meja);

       // $mejadata->status = "Terpakai";
        
        //$mejadata->save();

        foreach ($items as $row) {
            Transaksi_detail::create([  
                'id' => Str::uuid(),
                'id_transaksi' => $transaksi->id, 
                'id_produk' => $row->id,
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
          

        return redirect('/transaksi');
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

    
}
