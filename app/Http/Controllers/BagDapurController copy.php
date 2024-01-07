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
                        return $data->user[0]->name;
                    })
                    ->editColumn('tgl_lahir', function($data){ 
                        return dateformat($data->tgl_lahir);
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a class="btn btn-primary" href="/bagdapur-edit/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-pen-to-square"></i> </a>
                                   <a class="btn btn-danger" href="/bagdapur-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
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


        $validator =  Validator::make($request->all(), [
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            
        ]);
    
        if ($validator->fails()) {

            Session::flash('status', 'error');
            Session::flash('message',  $validator->messages()->first());
            return redirect()->back()->withInput();

        } else {
 
            if($request->id == NULL || $request->id == "" ){

               // dd($request->All());
               $namefile = '';
               if($request->file('foto')) {
                   $extension = $request->file('foto')->getClientOriginalExtension();
                   $namefile = $request->nama . '-' . now()->timestamp . '.' . $extension;
                   $request->file('foto')->move('foto', $namefile);
               }
                
                $bagdapur = Bag_Dapur::create([
                     'id' => Str::uuid(),
                     'id_user' => $request->user,
                     'nama' => $request->nama,
                     'alamat' => $request->alamat,
                     'tgl_lahir' => date("Y-m-d", strtotime($request->tgl_lahir)),
                     'jk' => $request->jk,
                     'no_hp' => $request->no_hp,
                     'no_ktp' => $request->no_ktp,
               
                     //'foto' => $namefile,
                     'email' => $request->email,
                     'foto' => $namefile,
                     'foto_url' => urlimage($namefile),
                 ]); 
                 
             
                 Session::flash('status', 'success');
                 Session::flash('message', 'Tambah Data Kurir Berhasil');
              }
     else{
        //dd($namefile);
            
        if($request->file('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $namefile = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->move('foto', $namefile);
        }
        else{
            $namefile=$request->fotolabel;
        }
        Bag_Dapur::updateOrCreate(
             ['id' => $request->id],
             [
                'id_user' => $request->user,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tgl_lahir' => date("Y-m-d", strtotime($request->tgl_lahir)),
                'jk' => $request->jk,
                'no_hp' => $request->no_hp,
                'no_ktp' => $request->no_ktp,
                //'foto' => $namefile,
                'email' => $request->email,
                'foto' => $namefile,
                'foto_url' => urlimage($namefile),
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
             Session::flash('message', 'Edit Data Kurir Berhasil');
             
         }
            
        }



      

          

        return redirect('/bagdapur');
    }

    public function delete($id){

        $delete = Bag_Dapur::findorFail($id);
        $delete->delete();

        /*$deleteKeeperfoto = Keeper_foto::findorFail($id);
        $deleteKeeperfoto->delete();*/
        Session::flash('status', 'success');
        Session::flash('message', 'Delete Data Kurir Berhasil');

        return redirect('/bagdapur');

    }
}
