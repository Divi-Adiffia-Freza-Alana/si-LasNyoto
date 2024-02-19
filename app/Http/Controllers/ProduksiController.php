<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produksi;
use Illuminate\Http\RedirectResponse;

use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class ProduksiController extends Controller
{
    //

    public function selectBagproduksi (Request $request)
    {
        $produksi = [];
        if($request->has('q')){
            $search = $request->q;
            $produksi =Produksi::select("id", "nama")
                    ->where('nama', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $produksi =Produksi::select("id", "nama")->orderBy('id')->get(10);
        }
        return response()->json($produksi);
    }

    public function index(Request $request){

        //dd(Keeper::with(['keeperfoto']));

        if ($request->ajax()) {
           // $kurir = Kurir::query('');
           $produksi =Produksi::with('user');
            return  DataTables::of($produksi)
                    ->addIndexColumn()
                  ->editColumn('user.name', function($data){
                        return $data->user->name;
                    })
                   /* ->editColumn('status_kehadiran', function($data){
                        if($data->status_kehadiran == "Hadir"){
                            $btn = '<a class="btn btn-warning" href="/unpresent/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Hadir</a>';
                        }
                        else{
                            $btn = '<a class="btn bg-green" href="/present/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Tidak hadir</a>';
                        }
                       
                         return $btn;
                    })*/
                 
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/produksi-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/produksi-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('produksi.produksi');

    }

    public function add(){

        return view('produksi.add_produksi');

    }


    public function edit($id){
        
        $produksidata = Produksi::query()->get()->find($id);
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);
        return view('produksi.add_produksi',['data' =>$produksidata]);

    }

    

    public function store(Request $request): RedirectResponse
    
    {   


 
            if($request->id == NULL || $request->id == "" ){

                
                $produksi = Produksi::create([
                     'id' => Str::uuid(),
                     'id_user' => $request->user,
                     'jk' => $request->jk,
                     'no_hp' => $request->no_hp,
                  //   'status_kehadiran' => $request->status_kehadiran,
                 ]); 
                 
             
                 Session::flash('status', 'success');
                 Session::flash('message', 'Tambah Data Produksi Berhasil');
              }
     else{
        //dd($namefile);
            
        Produksi::updateOrCreate(
             ['id' => $request->id],
             [
                'id_user' => $request->user,
                'jk' => $request->jk,
                'no_hp' => $request->no_hp,
      
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
             Session::flash('message', 'Edit Data Staf Produksi Berhasil');
             
         
            
        }



      

          

        return redirect('/produksi');
    }

    public function delete($id){

        $delete = Produksi::findorFail($id);
        $delete->delete();

        /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        $deleteKeeperfoto->delete();*/
        Session::flash('status', 'success');
        Session::flash('message', 'Delete Data Staf Produksi Berhasil');

        return redirect('/produksi');

    }

    public function present($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $data = Pelayan::findOrFail($id);

        $data->status_kehadiran = "Hadir";
        
        $data->save(); 

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/pelayan');

    }

    public function unpresent($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $data = Pelayan::findOrFail($id);

        $data->status_kehadiran = "Tidak Hadir";
        
        $data->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/pelayan');

    }

}
