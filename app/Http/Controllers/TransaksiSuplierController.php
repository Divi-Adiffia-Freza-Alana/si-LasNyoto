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
use App\Models\Transaksi_Suplier;
use App\Models\Transaksi_Suplier_Detail;
use App\Models\Transaksi_detail;
use Illuminate\Http\RedirectResponse;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class TransaksiSuplierController extends Controller
{
    //

    
    public function index(Request $request){








        if ($request->ajax()) {
              //  if( auth()->user()->hasRole('konsumen')){
                 //   $transaksisuplier = Transaksi_Suplier::with(['menu','bagdapur','meja','pelayan','konsumen'])->where('id_konsumen', '=', auth()->user()->id);
                 $transaksisuplier = Transaksi_Suplier::with(['suplier','bahanbaku']);
                    return  DataTables::of($transaksisuplier)
                            ->addIndexColumn()
                   
                            ->editColumn('tgl_transaksi', function($data){ 
                                return dateformat($data->tgl_transaksi);
                            })
                         
                            ->addColumn('detail', function($row){
                                $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                                 return $btn;
                         })
    
                            ->addColumn('action', function($row){
                                   $btn ='<a class="btn btn-danger" href="/transaksi-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                                    return $btn;
                            })
    
                            
                            ->rawColumns(['action','detail'])
                           ->make(true);
        }
    
        return view('transaksisuplier.transaksisuplier'); 
    }

    public function addbarang(){

        return view('transaksisuplier.add_transaksisuplierbarang');

    }



    public function add(){

        return view('transaksisuplier.add_transaksisuplier');

    }



    public function store(Request $request)
    
    {   
        
       //dd($request->all());
        
      /* $namefile='';
       if ($request->file('foto')){
       $extension = $request->file('foto')->getClientOriginalExtension();
       $namefile = $request->kode_kandang.'-'.now()->timestamp.'.'.$extension;
       $request->file('foto')->move('foto', $namefile);
       }

       else{
           $namefile=$request->fotolabel;
       }*/


    if($request->id == NULL || $request->id == "" ){

        //dd($request->all());
       $transaksisuplier = Transaksi_Suplier::create([
        'id' => Str::uuid(),
        'id_suplier' => $request->suplier,
        'kode' => $request->kode,
        'tgl_transaksi' => date("Y-m-d", strtotime($request->tgl_transaksi)),
        'total' => 0,
        'status_bayar' => 'Lunas'

    ]); }

    else{
      
       $transaksisuplier= Transaksi_Suplier::updateOrCreate(
            ['id' => $request->id],
            [          
                'id_suplier' => $request->suplier,
                'kode' => $request->kode,
                'tgl_transaksi' => $request->tgl_transaksi,
                'total' => 0,
                'status_bayar' => 'Lunas'        
            ]

            );

           
        }

       //dd($transaksisuplier);
      // return view('transaksisuplier.add_transaksisuplierbarang', compact('image'));
        return view('transaksisuplier.add_transaksisuplierbarang',['data' =>$transaksisuplier->id]);
      //  return redirect('/suplier')->with('id',$transaksisuplier->id);
        //return redirect('/suplier');
    }

    public function suplierbarangindex(Request $request){
            

        if ($request->ajax()) {
           // $kurir = Kurir::with('');

           $barangsuplier = Transaksi_Suplier_Detail::with(['transaksi','bahanbaku'])->where('id_transaksi', '=', $request->get('id_transaksi'))->get();
            return  DataTables::of($barangsuplier)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-danger" href="/transaksi-suplier-deletebarang/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
    
    
    }


    public function transaksisuplierstorebarang(Request $request)
{   
  
        //dd($request->all());
        
        $transaksibarangsuplier = Transaksi_Suplier_Detail::create([
            'id' => Str::uuid(),
            'id_transaksi' => $request->id_transaksi,
            'id_bahanbaku' => $request->bahanbaku,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'subtotal' => $request->subtotal,
    
       ]);
        Session::flash('status', 'success');
        Session::flash('message', 'Tambah Data Barang Suplier Berhasil');

      // return redirect()->back();
        return view('transaksisuplier.add_transaksisuplierbarang',['data' =>$transaksibarangsuplier->id_transaksi]);


    }

    public function transaksisuplierdeletebarang($id){

        // $deleteKeeper = Keeper::findorFail($id);
        // $deleteKeeper->delete();

        // /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        // $deleteKeeperfoto->delete();*/
        // Session::flash('status', 'success');
        // Session::flash('message', 'Delete Data Keeper Berhasil');

        // return redirect('/keeper');
    $transaksibarangsuplier = Transaksi_Suplier_Detail::findOrFail($id);
    $transaksibarangsuplier->delete();

    Session::flash('status', 'success');
    Session::flash('message', 'Delete Data Barang Suplier Berhasil');

    return view('transaksisuplier.add_transaksisuplierbarang',['data' =>$transaksibarangsuplier->id_transaksi]);
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
             
          $transaksidata = Transaksi::with(['menu','bagdapur','konsumen'])->get()->find($id);
          
          //var_dump($transaksidata);
          //exit();
         
            
         } 

         return view('transaksi.detail',['data' =>$transaksidata]);
     }

    public function addToCart($id)
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

        return view('transaksi.menu_cart',['datamakanan' =>$menumakanan, 'dataminuman' =>$menuminuman]);


        
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
    


   public function storelama(Request $request): RedirectResponse
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
        $bagdapur = Users::select("id")->whereRelation('bagdapur', 'status_kehadiran', '=', 'Hadir')->get();
           
       // $bagdapur = User::select("id")->bagdapur()->where('status_kehadiran', '=', "Hadir")->get();
        $pelayan = Users::select("id")->whereRelation('pelayan', 'status_kehadiran', '=', 'Hadir')->get();;
        //var_dump($pelayan[]->id);
        //exit();
        $transaksi = Transaksi::where('tgl_transaksi', '=', Carbon::now()->format('Y-m-d'))->get();
        $num = count($transaksi)+1;
        $id_transaksi = "TR".Carbon::now()->format('Ymd').$num;
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
                'id_konsumen' => auth()->user()->id,
                'id_bag_dapur' => $bagdapur[rand(0,count($bagdapur)-1)]->id,
                'id_pelayan' => $pelayan[rand(0,count($pelayan)-1)]->id,
                'id_meja' => $request->meja,
                'kode' => $id_transaksi,
                //'tgl_transaksi' =>date("Y-m-d", strtotime($request->tgl_transaksi)),
                'tgl_transaksi' =>Carbon::now()->format('Y-m-d'),
                'total' => \Cart::getTotal(),
                'status' => 1,
               // 'no_meja' => $request->no_meja,
                'status_bayar' => 1,
             
            ]);
        
        $mejadata = Meja::findOrFail($transaksi->id_meja);

        $mejadata->status = "Terpakai";
        
        $mejadata->save();

        foreach ($items as $row) {
            Transaksi_detail::create([  
                'id' => Str::uuid(),
                'id_transaksi' => $transaksi->id, 
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
    
     else{
        //dd($namefile);
         Barang::updateOrCreate(
             ['id' => $request->id],
             [
                'id_category' => $request->category,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
             ]
             );
 
           /*  $namefile='';
             if ($request->file('foto')){
             $extension = $request->file('foto')->getClientOriginalExtension();
             $namefile = $request->nama.'-'.now()->timestamp.'.'.$extension;
             $request->file('foto')->move('foto', $namefile);
             Keeper_foto::create([
                'id' => Str::uuid(),
                'id_keeper' => $request->id,
                'nama' => $namefile,
                'url' => urlimage($namefile) 

            ]);
            }
     
             else{ 
                 $namefile=$request->fotolabel;
             }
 
             if($request->fotolabel != NULL){
                 $flight = Keeper_foto::find($request->id_foto);
             
                 $flight->nama = $namefile;
                 $flight->url = urlimage($namefile); 
                 $flight->save();
             }*/
 
     
 
             /*Keeper_foto::updateOrCreate(
                 ['id' => $request->id_foto],
                 ['nama' => $namefile]);*/
             
 
             Session::flash('status', 'success');
             Session::flash('message', 'Edit Data Barang Berhasil');
             
         }
            
        /*  }*/



      

          

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
