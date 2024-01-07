<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Produk;
use App\Models\Keeper;
use App\Models\BahanBaku;
use App\Models\BahanBaku_Produk_Detail;
use App\Models\Keeper_foto;
use Illuminate\Http\RedirectResponse;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class ProdukController extends Controller
{
    //




    public function index(Request $request){

        //dd(Keeper::with(['keeperfoto']));

        if ($request->ajax()) {
           // $kurir = Kurir::with('');
           $produk = Produk::query();
            return  DataTables::of($produk)
                    ->addIndexColumn()
                  /*->editColumn('keeperfoto.nama', function($data){
                        return $data->keeperfoto->nama;
                    })*/
                    /*->editColumn('tgl_lahir', function($data){ 
                        return dateformat($data->tgl_lahir);
                    })*/
                    ->addColumn('bahanbaku', function($row){
                        $btns = '<a class="btn btn-primary" href="/bahanbakuproduk/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-plus"></i> </a>';
                         return $btns;
                 })
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/produk-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/produk-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['bahanbaku','action'])
                    ->make(true);
        }
        return view('produk.produk');

    }

    public function add(){

        return view('produk.add_produk');

    }


    public function edit($id){
        
        $produkdata = Produk::query()->get()->find($id);
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);
        return view('produk.add_produk',['data' =>$produkdata]);

    }

    

   public function store(Request $request): RedirectResponse
{   

  
    $validator = Validator::make($request->all(), [
        'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        Session::flash('status', 'error');
        Session::flash('message', $validator->messages()->first());
        return redirect()->back()->withInput();
    } else {
        if ($request->id == NULL || $request->id == "") {
            $namefile = '';
            if($request->file('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $namefile = $request->nama . '-' . now()->timestamp . '.' . $extension;
                $request->file('foto')->move('foto', $namefile);
            }
                       

            $produk = Produk::create([
                'id' => Str::uuid(),
                'kode_produk' => $request->kode_produk,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'foto' => $namefile,
                'foto_url' => urlimage($namefile),
                'harga' => $request->harga,
            ]);



                Session::flash('status', 'success');
                Session::flash('message', 'Tambah Data Produk Berhasil');
            
        }
    
     else{
        //dd($namefile);
        $namefile = '';
        if($request->file('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $namefile = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->move('foto', $namefile);
        }else{
            $namefile = $request->fotolabel;

        }

        $produk = Produk::create([
            'id' => Str::uuid(),
            'kode_produk' => $request->kode_produk,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto' => $namefile,
            'foto_url' => urlimage($namefile),
        ]);

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
             Session::flash('message', 'Edit Data Produk Berhasil');
             
         }
            
        }



      

          

        return redirect('/produk');
    }

    public function delete($id){

        // $deleteKeeper = Keeper::findorFail($id);
        // $deleteKeeper->delete();

        // /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        // $deleteKeeperfoto->delete();*/
        // Session::flash('status', 'success');
        // Session::flash('message', 'Delete Data Keeper Berhasil');

        // return redirect('/keeper');

    $menu = Menu::findOrFail($id);
    $menu->delete();

    Session::flash('status', 'success');
    Session::flash('message', 'Delete Data Menu Berhasil');

    return redirect('/menu');
}



public function bahanbakuprodukindex(Request $request){
            

    if ($request->ajax()) {
       // $kurir = Kurir::with('');
       $bahanbakuproduk = BahanBaku_Produk_Detail::with(['bahanbaku','produk'])->where('id_produk', '=', $request->get('id'))->get();
        return  DataTables::of($bahanbakuproduk)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = '<a class="btn btn-danger" href="/bahanbakuproduk-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }



}


public function bahanbakuproduk($id){
        
    $produkdata = Produk::query()->get()->find($id);

    //$bahanbakuproduk = BahanBaku_Produk_Detail::with(['bahanbaku','produk'])->get();
   //var_dump($bahanbakuproduk[0]->bahanbaku);
   //exit();
   // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
    //dd($keeperdata);
    return view('produk.add_bahanbaku_produk',['data' =>$produkdata]);




}




public function bahanbakuprodukstore(Request $request): RedirectResponse
{   
   // if ($request->id == NULL || $request->id == "") {

    //dd($request->all());

        $bahanbakuproduk = BahanBaku_Produk_Detail::create([
            'id' => Str::uuid(),
            'id_produk' => $request->id,
            'id_bahan_baku' => $request->bahanbaku,
            'qty' => $request->qty,
    
       ]);
        Session::flash('status', 'success');
        Session::flash('message', 'Tambah Data Bahan Baku Produk Berhasil');
       return redirect()->back();

    //}
  
   /* $validator = Validator::make($request->all(), [
        'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        Session::flash('status', 'error');
        Session::flash('message', $validator->messages()->first());
        return redirect()->back()->withInput();
    } else {
        if ($request->id == NULL || $request->id == "") {
            $namefile = '';
            if($request->file('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $namefile = $request->nama . '-' . now()->timestamp . '.' . $extension;
                $request->file('foto')->move('foto', $namefile);
            }
                       

            $produk = Produk::create([
                'id' => Str::uuid(),
                'kode_produk' => $request->kode_produk,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'foto' => $namefile,
                'foto_url' => urlimage($namefile),
                'harga' => $request->harga,
            ]);



                Session::flash('status', 'success');
                Session::flash('message', 'Tambah Data Bahan BakuProduk Berhasil');
            
        }
    
     else{
        //dd($namefile);
        $namefile = '';
        if($request->file('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $namefile = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->move('foto', $namefile);
        }else{
            $namefile = $request->fotolabel;

        }

        $produk = Produk::create([
            'id' => Str::uuid(),
            'kode_produk' => $request->kode_produk,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto' => $namefile,
            'foto_url' => urlimage($namefile),
        ]);

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
             
 
            // Session::flash('status', 'success');
             //Session::flash('message', 'Edit Data Produk Berhasil');
             
      /*   }
            
        }*/



      

          


    }

    public function bahanbakuprodukdelete($id){

        // $deleteKeeper = Keeper::findorFail($id);
        // $deleteKeeper->delete();

        // /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        // $deleteKeeperfoto->delete();*/
        // Session::flash('status', 'success');
        // Session::flash('message', 'Delete Data Keeper Berhasil');

        // return redirect('/keeper');

    $bahanbakuproduk = BahanBaku_Produk_Detail::findOrFail($id);
    $bahanbakuproduk->delete();

    Session::flash('status', 'success');
    Session::flash('message', 'Delete Data Bahan Baku Produk Berhasil');

    return redirect()->back();
}


    
}
