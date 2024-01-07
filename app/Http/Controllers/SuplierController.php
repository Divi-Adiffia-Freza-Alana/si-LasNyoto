<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Suplier;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DataTables;

class SuplierController extends Controller
{
    //
    public function index(Request $request){
        if ($request->ajax()) {
            $suplier = Suplier::query();
            return  DataTables::eloquent($suplier)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/suplier-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/suplier-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('suplier.suplier');

    }

    public function selectSuplier (Request $request)
    {
        $suplier = [];
        if($request->has('q')){
            $search = $request->q;
            $suplier =Suplier::select("id", "nama")
                    ->where('nama', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $suplier =Suplier::select("id", "nama")->orderBy('id')->get(10);
        }
        return response()->json($suplier);
    }


    public function add(){

        return view('suplier.add_suplier');

    }

    public function edit($id){
        
        $suplier = Suplier::find($id);
        return view('suplier.add_suplier',['data' =>$suplier]);

    }

    public function delete($id){

        $delete = User::findorFail($id);
        $delete->delete();

        return redirect('/users');

    }


    public function store(Request $request): RedirectResponse
    
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
       $suplier = Suplier::create([
        'id' => Str::uuid(),
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'alamat' => $request->alamat,

    ]); }

    else{
      
       $suplier= Suplier::updateOrCreate(
            ['id' => $request->id],
            [          
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat,
            ]

            );
            
        }

        return redirect('/suplier');
    }





}
