<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Keeper;
use App\Models\BahanBaku;
use App\Models\Keeper_foto;
use Illuminate\Http\RedirectResponse;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class MenuController extends Controller
{
    //




    public function index(Request $request){

        //dd(Keeper::with(['keeperfoto']));

        if ($request->ajax()) {
           // $kurir = Kurir::with('');
           $menu = Menu::query();
            return  DataTables::of($menu)
                    ->addIndexColumn()
                  /*->editColumn('keeperfoto.nama', function($data){
                        return $data->keeperfoto->nama;
                    })*/
                    /*->editColumn('tgl_lahir', function($data){ 
                        return dateformat($data->tgl_lahir);
                    })*/
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/menu-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/menu-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('menu.menu');

    }

    public function add(){

        return view('menu.add_menu');

    }


    public function edit($id){
        
        $menudata = Menu::with(['bahanbaku'])->get()->find($id);
       // $kandangdata = Kandang::with('keeperKandang')->get()->find($id);
        //dd($keeperdata);
        return view('menu.add_menu',['data' =>$menudata]);

    }

    

   public function store(Request $request): RedirectResponse
{   

    //dd($request->all());
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

            $bahanbaku = BahanBaku::findOrFail($request->id_bahanbaku);
            $stok =  $bahanbaku->stok;
            $status = '';
            if($stok == 0){
            $status = "Habis";
            }else{
            $status = "Tersedia";
            }
           
            

            $menu = Menu::create([
                'id' => Str::uuid(),
                'kd_menu' => $request->kd_menu,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'komposisi' => $request->komposisi,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'foto' => $namefile,
                'foto_url' => urlimage($namefile),
                'status' =>  $status,
                'id_bahanbaku' =>  $request->id_bahanbaku,
            ]);

//            Tersedia
 //           Habis

                Session::flash('status', 'success');
                Session::flash('message', 'Tambah Data Menu Berhasil');
            
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
         Menu::updateOrCreate(
             ['id' => $request->id],
             [
                'kd_menu' => $request->kd_menu,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'komposisi' => $request->komposisi,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'foto' => $namefile,
                'foto_url' => urlimage($namefile),
                'status' =>  $request->status,
                'id_bahanbaku' =>  $request->id_bahanbaku,
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
             Session::flash('message', 'Edit Data Menu Berhasil');
             
         }
            
        }



      

          

        return redirect('/menu');
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
    
}
