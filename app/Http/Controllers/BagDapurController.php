<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bag_Dapur;
use Illuminate\Http\RedirectResponse;

use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class BagDapurController extends Controller
{
    //

    public function selectBagdapur (Request $request)
    {
        $bagdapur = [];
        if($request->has('q')){
            $search = $request->q;
            $bagdapur =Bag_Dapur::select("id", "nama")
                    ->where('nama', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $bagdapur =Bag_Dapur::select("id", "nama")->orderBy('id')->get(10);
        }
        return response()->json($bagdapur);
    }

    public function index(Request $request){

        //dd(Keeper::with(['keeperfoto']));

        

        if ($request->ajax()) {
           // $kurir = Kurir::query('');
           $bagdapur = Bag_Dapur::with('user');
            return  DataTables::of($bagdapur)
                    ->addIndexColumn()
                  ->editColumn('user.name', function($data){
                        return $data->user->name;
                    })
                    ->editColumn('status_kehadiran', function($data){
                        if($data->status_kehadiran == "Hadir"){
                            $btn = '<a class="btn btn-warning" href="/unpresent-dapur/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Hadir</a>';
                        }
                        else{
                            $btn = '<a class="btn bg-green" href="/present-dapur/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Tidak hadir</a>';
                        }
                       
                         return $btn;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/bagdapur-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/bagdapur-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action','status_kehadiran'])
                    ->make(true);
        }
        return view('bagdapur.bagdapur');

    }

    public function add(){

        return view('bagdapur.add_bagdapur');

    }


    public function edit($id){
        
        $bagdapurdata = Bag_Dapur::query()->get()->find($id);
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);
        return view('bagdapur.add_bagdapur',['data' =>$bagdapurdata]);

    }

    

    public function store(Request $request): RedirectResponse
    
    {   


 
            if($request->id == NULL || $request->id == "" ){

           
                
                $bagdapur = Bag_Dapur::create([
                     'id' => Str::uuid(),
                     'id_user' => $request->user,
                     'jk' => $request->jk,
                     'no_hp' => $request->no_hp,
                     'status_kehadiran' => $request->status_kehadiran,
                 ]); 
                 
             
                 Session::flash('status', 'success');
                 Session::flash('message', 'Tambah Data Dapur Berhasil');
              }
     else{
        //dd($namefile);

        Bag_Dapur::updateOrCreate(
             ['id' => $request->id],
             [
                'id_user' => $request->user,
                'jk' => $request->jk,
                'no_hp' => $request->no_hp,
                'status_kehadiran' => $request->status_kehadiran,
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
             Session::flash('message', 'Edit Data Bag Dapur Berhasil');
             
         }
            
        



      

          

        return redirect('/bagdapur');
    }


    
    public function present($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $data = Bag_Dapur::findOrFail($id);

        $data->status_kehadiran = "Hadir";
        
        $data->save(); 

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/bagdapur');

    }

    public function unpresent($id){
        
        //$transaksidata = Transaksi::query()->get()->find($id);
        $data = Bag_Dapur::findOrFail($id);

        $data->status_kehadiran = "Tidak Hadir";
        
        $data->save();

        //$menu = Menu::all();
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);

        //var_dump($barang);
        //exit();
        return redirect('/bagdapur');

    }


    public function delete($id){

        $delete = Bag_Dapur::findorFail($id);
        $delete->delete();

        /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        $deleteKeeperfoto->delete();*/
        Session::flash('status', 'success');
        Session::flash('message', 'Delete Data Bag Dapur Berhasil');

        return redirect('/bagdapur');

    }
}
