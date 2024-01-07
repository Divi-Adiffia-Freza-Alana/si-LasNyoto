<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\Transaksi_BahanBaku;
use Illuminate\Http\RedirectResponse;

use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class BahanBakuController extends Controller
{
    //


    
    public function index(Request $request){

        //dd(Keeper::with(['keeperfoto']));

        if ($request->ajax()) {
           // $kurir = Kurir::with('');
           $bahanbaku = BahanBaku::query();
            return  DataTables::of($bahanbaku)
                    ->addIndexColumn()
                  /*->editColumn('keeperfoto.nama', function($data){
                        return $data->keeperfoto->nama;
                    })*/
                    /*->editColumn('tgl_lah ir', function($data){ 
                        return dateformat($data->tgl_lahir);
                    })*/
                    ->addColumn('status', function($data){
                       
                        if($data->stok >= 5 ){
                            $btn = '<span class="badge badge-pill badge-primary">Aman</span>';
         
                        }
                        
                        else if($data->stok >= 1){
                        
                            $btn = '<span class="badge badge-pill badge-warning">Menipis</span>';
                        }
                        else if($data->stok == 0){
                            $btn = '<span class="badge badge-pill badge-danger">Habis</span>';
                        }
                        else {
                        
                            $btn = '<span class="badge badge-pill badge-primary">Aman</span>';
                        }
                       
                         return $btn; 
                 }) 
                    ->addColumn('manajemenstok', function($row){
                           $btn = '<a class="btn btn-primary" href="/bahanbaku-transaction/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>';
                            return $btn;
                    })
                  
                    ->addColumn('action', function($row){
                        $btn = '<a class="btn btn-primary" href="/bahanbaku-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                <a class="btn btn-danger" href="/bahanbaku-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                         return $btn;
                 })
                    ->rawColumns(['manajemenstok','log','status','action'])
                    ->make(true);
        }
        return view('bahanbaku.bahanbaku');

    }

   /* public function indextransactionbahanbaku(Request $request,$id){

        //dd(Keeper::with(['keeperfoto']));

        if ($request->ajax()) {
           // $kurir = Kurir::with('');
           $transactionbahanbaku = Transaksi_BahanBaku::query()->where('id_bahanbaku', '=' , $id);
            return  DataTables::of($transactionbahanbaku)
                    ->addIndexColumn()
                  ->editColumn('bahanbaku.nama', function($data){
                        return $data->bahanbaku->nama;
                    })
                    ->editColumn('bahanbaku.satuan', function($data){ 
                        return $data->bahanbaku->satuan;
                    })
                   
                    ->make(true);
        }
        return view('bahanbaku.transaksibahanbaku');

    }*/

    public function selectBahanbaku(Request $request)
    {
        $bahanbaku = [];
        if($request->has('q')){
            $search = $request->q;
            $bahanbaku =BahanBaku::select("id", "nama")
                    ->where('nama', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $bahanbaku =BahanBaku::select("id", "nama")->orderBy('id')->get(10);
        }
        return response()->json($bahanbaku);
    }

    public function add(){

        return view('bahanbaku.add_bahanbaku');

    }

  

    public function edit($id){
        
        $bahanbakudata = BahanBaku::query()->get()->find($id);
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);
        return view('bahanbaku.add_bahanbaku',['data' =>$bahanbakudata]);

    }


    
    public function transaksi($id){
        
        $bahanbakudata = BahanBaku::query()->get()->find($id);
        $bahanbakutransaksidata = Transaksi_BahanBaku::query()->where('id_bahanbaku', '=' , $id)->latest()->first();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
       // dd($bahanbakudata);
        return view('bahanbaku.add_bahanbakutransaksi',['data' =>$bahanbakudata,'transaksi' =>$bahanbakutransaksidata]);

    }


    public function storetransaction(Request $request): RedirectResponse
    
    {   
 
            if($request->id == NULL || $request->id == "" ){

               // dd($request->All());
           
                $sisa = floatval($request->stok) + floatval($request->sisa) - floatval($request->stok_terpakai) ;
                //dd($sisa);
                
                $bahanbakutransaksi = Transaksi_BahanBaku::create([
                     'id' => Str::uuid(),
                     'id_bahanbaku' =>$request->id_bahanbaku ,
                     'stok_awal' => $request->stok,
                     'stok_terpakai' => $request->stok_terpakai,
                     'sisa' => $sisa,

                 ]); 

                 $bahanbaku = BahanBaku::query()->get()->find($bahanbakutransaksi->id_bahanbaku);
                 
                 $bahanbaku->stok = $bahanbakutransaksi->sisa;
        
                 $bahanbaku->save();
         
             
                 Session::flash('status', 'success');
                 Session::flash('message', 'Tambah Data Manajemen Stok Bahan Baku Berhasil');
              }
     else{
        //dd($namefile);
         BahanBaku::updateOrCreate(
             ['id' => $request->id],
             [
                'nama' => $request->nama,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
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
             Session::flash('message', 'Edit Data Bahan Baku Berhasil');
             
         }
            
        
          

        return redirect('/bahanbaku');
    }

    

    public function store(Request $request): RedirectResponse
    
    {   

 
            if($request->id == NULL || $request->id == "" ){

               // dd($request->All());
                
                $bahanbaku = BahanBaku::create([
                     'id' => Str::uuid(),
                     'nama' => $request->nama,
                     'stok' => 0,
                     'satuan' => $request->satuan,

                 ]); 
                 
                 Session::flash('status', 'success');
                 Session::flash('message', 'Tambah Data Bahan Baku Berhasil');
              }
     else{
        //dd($namefile);
         BahanBaku::updateOrCreate(
             ['id' => $request->id],
             [
                'nama' => $request->nama,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
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
             Session::flash('message', 'Edit Data Bahan Baku Berhasil');
             
         }
            
        return redirect('/bahanbaku');
    }

    public function delete($id){

        $delete = Bahanbaku::findorFail($id);
        $delete->delete();

        /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        $deleteKeeperfoto->delete();*/
        Session::flash('status', 'success');
        Session::flash('message', 'Delete Data Bahan Baku Berhasil');

        return redirect('/bahanbaku');

    }
}
