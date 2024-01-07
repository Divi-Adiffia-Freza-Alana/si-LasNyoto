<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UsersController extends Controller
{
    //
    public function index(Request $request){
        if ($request->ajax()) {
            $user = User::query();
            return  DataTables::eloquent($user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/users-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/users-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.users');

    }

    public function selectUser (Request $request)
    {
        $kurir = [];
        if($request->has('q')){
            $search = $request->q;
            $kurir =Users::select("id", "name")
                    ->where('name', 'LIKE', "%$search%")
                    ->get();
        }else{ 
            $kurir =Users::select("id", "name")->orderBy('id')->get(10);
        }
        return response()->json($kurir);
    }

    public function selectDapur (Request $request)
    {
        $kurir = [];
        if($request->has('q')){
            $search = $request->q;
            $kurir =Users::select("id", "name")
                    ->where('name', 'LIKE', "%$search%")
                    ->where('role', '=', "bag_dapur")
                    ->get();
        }else{ 
            $kurir =Users::select("id", "name")->where('role', '=', "bag_dapur")->orderBy('id')->get(10);
        }
        return response()->json($kurir);
    }


    public function selectPelayan (Request $request)
    {
        $kurir = [];
        if($request->has('q')){
            $search = $request->q;
            $kurir =Users::select("id", "name")
                    ->where('name', 'LIKE', "%$search%")
                    ->where('role', 'LIKE', "pelayan")
                    ->get();
        }else{ 
            $kurir =Users::select("id", "name")->where('role', 'LIKE', "pelayan")->orderBy('id')->get(10);
        }
        return response()->json($kurir);
    }

    public function add(){

        return view('users.add_users');

    }

    public function edit($id){
        
        $user = User::find($id);
        return view('users.add_users',['data' =>$user]);

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
       $user = User::create([
        'id' => Str::uuid(),
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,

    ]); 
        //$user->id;
        $user->assignRole($request->role);}
    else{
      
       $user= User::updateOrCreate(
            ['id' => $request->id],
            [          
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            ]

            );

            $user->assignRole($request->role);
            
        }

        return redirect('/users');
    }





}
