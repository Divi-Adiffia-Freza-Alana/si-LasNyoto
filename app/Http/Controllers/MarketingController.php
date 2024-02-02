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
use App\Models\Produk;
use App\Models\Kurir;
use App\Models\Marketing;
use App\Models\Metode_Pembayaran;
use App\Models\Pembayaran;
use App\Models\Sph;
use App\Models\Transaksi_detail;
use Illuminate\Http\RedirectResponse;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Validator;

class MarketingController extends Controller
{
    //

    public function indexcustomer(){
        $produk = Produk::query()->get();
   
        return view('main',["dataproduk"=>$produk]);

    }

    public function indextransaksimarketing(Request $request){

        // var_dump(Barang::with('category')->get()->find('f997b850-662e-4f19-b0b6-4dc33a8b9c5b'));

      //  var_dump($transaksimarketing = Transaksi::with(['produk','konsumen','marketing','sph'])->where('id_marketing', '=', auth()->user()->id)->get());
       // exit();
     
      //exit();
          if ($request->ajax()) {
  
              $transaksimarketing = Transaksi::with(['produk','konsumen','sph'])->where('id_marketing', '=', auth()->user()->id);
              return  DataTables::of($transaksimarketing)
                      ->addIndexColumn()
                   /* ->editColumn('category.nama', function($data){
                          return $data->category[0]->nama;
                      })*/
                      ->editColumn('tgl_transaksi', function($data){ 
                          return dateformat($data->tgl_transaksi);
                      })
             
             
                    ->editColumn('konsumen.no_hp', function($data){
                        if($data->konsumen->no_hp == null){
                            return '';
                        }
                        return $data->konsumen->no_hp;
                    })
           
                   /*   ->addColumn('detail', function($row){
                          $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                           return $btn;
                   })*/
                 /*  ->addColumn('statuspesanan', function($data){
                      if($data->status == 1){
                          $btn = '<a class="btn bg-blue" href="/done/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Silahkan Tunggu</a>';
                      }
  
                      else if($data->status == 2){
                          $btn = '<a class="btn btn-warning" href="/deliver/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >sedang dikirim</a>';
                      }
                     
                      else{
                      
                          $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Diantar </a>';
                      }
                     
                       return $btn;
               })*/
 
                        ->addColumn('sph', function($data){
                            if($data->sph->kode == NULL){
                                $btn = '<a class="btn bg-blue" href="/sph/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Isi SPH </a>';

                            }else if($data->sph->deskripsi != " "){
                                $btn ='<a class="btn bg-green" href="/validasisph/'.(isset($data->id)?$data->id:"").'" style="color:#ffff;display:inline-block;" >Validasi SPH </a>';
                            }  
                            
                            else{
                                $btn ='<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >SPH Telah Dikirim</a>';
                            }                      
                        return $btn;
                        })
                        ->addColumn('statussph', function($data){
                            if($data->sph->status == NULL AND $data->sph->kode == '' ){
                                
                                $btn = '<a class="btn btn-warning" href="/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Silahkan Pengajuan </a>';
                                                            



                            }
        
                            else if($data->sph->status == 'diterima'){
                                $btn = '<a class="btn bg-green" href="/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Diterima</a>';
                            }

                            else if($data->sph->status == 'ditolak'){
                                                          
                                $btn = '<a class="btn bg-danger" href="" style="color:#ffff;display:inline-block;" >Ditolak </a>';
                            }
                           
                            else{
                            
                                $btn = '<a class="btn bg-blue" href="" style="color:#ffff;display:inline-block;" >Menunggu Balasan </a>';
                            }
                            
                            return $btn;
                        })
                      ->addColumn('action', function($row){
                             $btn ='<a class="btn btn-danger" href="/transaksi-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                              return $btn;
                      })
  
                      ->filter(function ($instance) use ($request) {
  
                          if ($request->get('filtermonth') ) {
  
                             // var_dump("HAHA");
                              //exit();
   
                              $instance->whereMonth('tgl_transaksi', $request->get('filtermonth')->orderBy('status')->orderBy('status_bayar'));
  
                          }else{
                            //  $instance->orderBy('status')->orderBy('status_bayar');
                                $instance->orderBy('created_at','asc');
                          }
  
               
  
                      })
                      
                      ->rawColumns(['sph','statussph','action'])
                      ->make(true);
          
          }
          return view('transaksi.transaksimarketing'); 
      }

      public function validasisph($id){
        $transaksi = Transaksi::with(['sph','produk'])->get()->find($id);
    
        //var_dump($transaksi->produk[0]->pivot);
        //exit();
    
        return view('transaksi.validasisph',["datatransaksi"=>$transaksi]);
    
    }

    public function sphapprove($id)
    {
        
    
        $sph = Sph::find($id);
        //set cicilan 1
    
    
        $sph->status = 'diterima';
        $sph->save();
                         
        return redirect('/transaksi-marketing');
        
    
        
      }

      
  public function sphdecline($id)
  {
      
  
      $sph = Sph::find($id);
      $sph->status = 'ditolak';
      $sph->save();
                       
      return redirect('/transaksi-marketing');
      
  
      
    }

  
}
