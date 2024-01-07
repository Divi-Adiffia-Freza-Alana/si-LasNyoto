<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\RedirectResponse;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class MejaController extends Controller
{
    //

    public function selectMeja (Request $request)
    {
        $meja = [];
        if($request->has('q')){
            $search = $request->q;
            $meja =Meja::select("id", "nomor")
                    ->where('nomor', 'LIKE', "%$search%")
                    ->where('status', '=', "Kosong")
                    ->orderBy('nomor', 'asc')
                    ->get();
        }else{ 
            $meja =Meja::select("id", "nomor")->orderBy('nomor', 'asc')->where('status', '=', "Kosong")->get(10);
        }
        return response()->json($meja);
    }
    
    public function index(Request $request){

        //dd(Keeper::with(['keeperfoto']));

        if ($request->ajax()) {
           // $kurir = Kurir::with('');
           $meja = Meja::query();
            return  DataTables::of($meja)
                    ->addIndexColumn()
                  /*->editColumn('keeperfoto.nama', function($data){
                        return $data->keeperfoto->nama;
                    })*/
                    ->editColumn('status', function($data){ 
                        if($data->status == "Terpakai"){
                            $btn = '<a class="btn btn-warning" href="/update/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Terpakai</a>';
                        }
                        else{
                            $btn = '<a class="btn bg-green" href="" style="color:#00000;display:inline-block;" >Kosong</a>';
                        }
                         return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/meja-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/meja-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
        return view('meja.meja');

    }

    public function add(){

        return view('meja.add_meja');

    }


    public function edit($id){
        
        $mejadata = Meja::query()->get()->find($id);
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);
        return view('meja.add_meja',['data' =>$mejadata]);

    }

    

   public function store(Request $request): RedirectResponse
{   


        if ($request->id == NULL || $request->id == "") {
            $meja = Meja::create([
                'id' => Str::uuid(),
                'nomor' => $request->nomor,
                'status' => "Kosong",
                'deskripsi' => $request->deskripsi,
            ]);

        

                Session::flash('status', 'success');
                Session::flash('message', 'Tambah Data Meja Berhasil');
            
        }
    
     else{
        //dd($namefile);
         Meja::updateOrCreate(
             ['id' => $request->id],
             [
                'nomor' => $request->nomor,
                'status' => "$request->status",
                'deskripsi' => $request->deskripsi,
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
             Session::flash('message', 'Edit Data Meja Berhasil');
             
         }
            
        



      

          

        return redirect('/meja');
    }

    public function delete($id){

        // $deleteKeeper = Keeper::findorFail($id);
        // $deleteKeeper->delete();

        // /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        // $deleteKeeperfoto->delete();*/
        // Session::flash('status', 'success');
        // Session::flash('message', 'Delete Data Keeper Berhasil');

        // return redirect('/keeper');

    $meja = Meja::findOrFail($id);
    $meja->delete();

    Session::flash('status', 'success');
    Session::flash('message', 'Delete Data Meja Berhasil');

    return redirect('/meja');
}

public function update($id){
        
    //$transaksidata = Transaksi::query()->get()->find($id);
    $mejadata = Meja::findOrFail($id);

    $mejadata->status = "Kosong";
    
    $mejadata->save();

    //$menu = Menu::all();
   // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
    //dd($keeperdata);

    //var_dump($barang);
    //exit();
    return redirect('/meja');

}
    
}
