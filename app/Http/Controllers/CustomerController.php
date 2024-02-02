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

class CustomerController extends Controller
{
    //

    public function indexcustomer(){
        $produk = Produk::query()->get();
   
        return view('main',["dataproduk"=>$produk]);

    }

    public function indextransaksicustomer(Request $request){

        // var_dump(Barang::with('category')->get()->find('f997b850-662e-4f19-b0b6-4dc33a8b9c5b'));
  
      //exit();
          if ($request->ajax()) {
  
                  $transaksi = Transaksi::with(['produk','kurir','konsumen','marketing','sph','pembayaran','metodepembayaran'])->where('id_konsumen', '=', auth()->user()->id)->whereRelation('sph', 'status','diterima');
                  return  DataTables::of($transaksi)
                          ->addIndexColumn()
                       /* ->editColumn('category.nama', function($data){
                              return $data->category[0]->nama;
                          })*/
                          ->editColumn('tgl_transaksi', function($data){ 
                              return dateformat($data->tgl_transaksi);
                          })
                          ->editColumn('marketing.nama', function($data){
                              if($data->marketing == null){
                                  return '';
                              }
                              return $data->marketing->name;
                          }) 
                          ->editColumn('jenispembayaran', function($data){
                              if($data->jenispembayaran == 'Lunas'){
                                  return 'Tunai';
                              }else{
                              return $data->jenispembayaran;}
                          })
                          ->editColumn('konsumen.name', function($data){
                              return $data->konsumen->name;
                          })
                          ->addColumn('detail', function($row){
                              $btn = '<a class="btn bg-blue" href="/transaksi-detail/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-eye"></i> </a>';
                               return $btn;
                       })
                       ->addColumn('sph', function($data){
                          if($data->sph->kode == ''){
                              $btn = '<a class="btn bg-blue" href="/" style="color:#00000;display:inline-block;" >Menunggu SPH</a>';
                          }
  
                          else if($data->sph->status == 'diterima' OR $data->sph->status == 'ditolak' ){
                              $btn = '<a class="btn bg-green" href="/" style="color:#00000;display:inline-block;" > Balasan SPH Sudah Dikirim</a>';
                              
                          }
  
                          else {
                              $btn = '<a class="btn bg-green" href="/detailsph/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Lihat Penawaran</a>';
                          }
                         
  
                          
                           return $btn;
                   })
                       ->addColumn('statusorder', function($data){
                          if($data->statusorder == 1){
                              $btn = '<a class="btn bg-blue" href="" style="color:#00000;display:inline-block;" >Silahkan Tunggu</a>';
                          }
  
                          else if($data->statusorder == 2){
                              $btn = '<a class="btn bg-green" href=""  style="color:#00000;display:inline-block;" >Sedang Dikirim</a>';
                          }
                         
                          else{
                          
                              $btn = '<a class="btn bg-green" href="" style="color:#ffff;display:inline-block;" >Selesai Diantar </a>';
                          }
                          
                           return $btn;
                      })
                       ->addColumn('statusbayar', function($data){
                          //pembayaran Kredit                        
                          if($data->jenispembayaran == "Kredit"){
                                //jenis pembayaran Bayar ditempat
                                if($data->metodepembayaran->jenis == "Cash"){
                                      
                                      //Cicilan 1
                                      if($data->pembayaran[0]->status == NULL){
                                          $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Bayar Cicilan 1</a>';
                                      }
                                      //Cicilan 2
                                      else if($data->pembayaran[1]->status == NULL){
                                          $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Bayar Cicilan 2</a>';
                                      //Lunas
                                      }else{
                                          $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                          }
                                  }
                                  else{
                                  //jenis pembayaran TF
                                      //Cicilan 1
                                      if($data->pembayaran[0]->url_foto == ""){
                                          $btn = '<a class="btn btn-warning" href="/paidtf/'.(isset($data->pembayaran[0]->id)?$data->pembayaran[0]->id:"").'" style="color:#00000;display:inline-block;" >Bayar Cicilan 1</a>';
                                      }
                                      //Cicilan 2
                                      else if($data->pembayaran[1]->url_foto == ""){
                                          $btn = '<a class="btn btn-warning" href="/paidtf/'.(isset($data->pembayaran[1]->id)?$data->pembayaran[1]->id:"").'" style="color:#00000;display:inline-block;" >Bayar Cicilan 2</a>';
                                          //lunas
                                      }else{
                                          $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                          }
                                 }
                          }                  
     
                           //pembayaran Lunas
                          else{
                             //jenis pembayaran Bayar ditempat
                             if($data->metodepembayaran->jenis == "Cash"){
                                  $last = count($data->pembayaran)-1;
                                  //awal pembayaran
                                  if($data->pembayaran[$last]->status == NULL){
                                      $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lakukan Pembayaran</a>';
                                  }
                                  //Lunas
                                  else{
                                      $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                      } 
                              }
                              else{
                              //jenis pembayaran Bayar TF
                                  $last = count($data->pembayaran)-1;
                                  //awal pembayaran
                                  if($data->pembayaran[$last]->status == NULL){
                                      $btn = '<a class="btn btn-warning" href="/paidtf/'.(isset($data->pembayaran[$last]->id)?$data->pembayaran[$last]->id:"").'" style="color:#00000;display:inline-block;" >Lakukan Pembayaran</a>';
                                  }
                                  //Lunas
                                  else{
                                      $btn = '<a class="btn btn-warning" href="" style="color:#00000;display:inline-block;" >Lunas</a>';
                                      } 
  
                              }
                          }
                       return $btn;
                      })
  
  
                          ->addColumn('action', function($row){
                                 $btn ='<a class="btn btn-danger" href="/transaksi-delete/'.(isset($row->id)?$row->id:"").'" style="color:#ffff;display:inline-block;" ><i class="fa-solid fa-trash"></i></a>';
                                  return $btn;
                          })
  
                          ->filter(function ($instance) use ($request) {
  
                              if ($request->get('filtermonth') == NULL ) {
      
      
      
                                  $instance->with(['produk','kurir','konsumen'])->where('id_konsumen', '=', auth()->user()->id);
                                  //exit();
      
      
                                //  $instance->whereMonth('tgl_transaksi', $request->get('filtermonth'));
      
                              }
                              
                              else{
                                //  var_dump($request->get('filtermonth'));
                                  //$instance = Transaksi::with(['pelayan'=> function ($query) {
                                    //  $query->where('id_user', '=', auth()->user()->id);}])->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                                 //$instance = Transaksi::with(['pelayan'])->get();
                                 //$instance[0]->whereMonth('tgl_transaksi', $request->get('filtermonth'))
                                 $instance->with(['produk','kurir','konsumen'])->where('id_konsumen', '=', auth()->user()->id)->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                         
                                // $instance = Transaksi::with(['pelayan'=> function ($query) {
                                 // $query->where('id_user', '=', auth()->user()->id);}]);
                              
                                 //$instance = Transaksi::whereMonth('tgl_transaksi', $request->get('filtermonth'));
                                  //var_dump($instance);
                              }
      
                   
      
                          })
                          
                          ->rawColumns(['action','sph','detail','statusbayar','statusorder','tambahpesanan'])
                          ->make(true);
  
              }
             
          return view('transaksi.transaksicustomer'); 
      }


    public function indextransaksisphcustomer(Request $request){

        // var_dump(Barang::with('category')->get()->find('f997b850-662e-4f19-b0b6-4dc33a8b9c5b'));
  
      //exit();
          if ($request->ajax()) {
  
                  $transaksi = Transaksi::with(['produk','kurir','konsumen','marketing','sph','pembayaran','metodepembayaran'])->where('id_konsumen', '=', auth()->user()->id);
                  return  DataTables::of($transaksi)
                          ->addIndexColumn()
                       /* ->editColumn('category.nama', function($data){
                              return $data->category[0]->nama;
                          })*/
                          ->editColumn('tgl_transaksi', function($data){ 
                              return dateformat($data->tgl_transaksi);
                          })
                          ->editColumn('marketing.nama', function($data){
                              if($data->marketing == null){
                                  return '';
                              }
                              return $data->marketing->name;
                          }) 
                          
                          ->editColumn('konsumen.name', function($data){
                              return $data->konsumen->name;
                          })
                       ->addColumn('sph', function($data){
                          if($data->sph->kode == ''){
                              $btn = '<a class="btn bg-blue" href="/" style="color:#00000;display:inline-block;" >Menunggu SPH</a>';
                          }
  
                          else if($data->sph->harga_penawaran != NULL ){
                              $btn = '<a class="btn bg-green" href="/" style="color:#00000;display:inline-block;" > Penawaran Telah Dikirim</a>';
                              
                          }
  
                          else {
                              $btn = '<a class="btn bg-green" href="/detailsph/'.(isset($data->id)?$data->id:"").'" style="color:#00000;display:inline-block;" >Lihat Penawaran</a>';
                          }
                         
  
                          
                           return $btn;
                   })
                       ->addColumn('status_sph', function($data){
                          if($data->sph->status == null){
                              $btn = '<a class="btn bg-blue" href="" style="color:#00000;display:inline-block;" >Dalam Proses</a>';
                          }
  
                          else if($data->sph->status == "diterima"){
                              $btn = '<a class="btn bg-green" href=""  style="color:#00000;display:inline-block;" >Diterima</a>';
                          }
                         
                          else{
                          
                              $btn = '<a class="btn btn-danger" href="" style="color:#ffff;display:inline-block;" >Ditolak </a>';
                          }
                          
                           return $btn;
                      })
                                     
     
     
  
                          ->filter(function ($instance) use ($request) {
  
                              if ($request->get('filtermonth') == NULL ) {
      
      
      
                                  $instance->with(['produk','kurir','konsumen'])->where('id_konsumen', '=', auth()->user()->id);
                                  //exit();
      
      
                                //  $instance->whereMonth('tgl_transaksi', $request->get('filtermonth'));
      
                              }
                              
                              else{
                                //  var_dump($request->get('filtermonth'));
                                  //$instance = Transaksi::with(['pelayan'=> function ($query) {
                                    //  $query->where('id_user', '=', auth()->user()->id);}])->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                                 //$instance = Transaksi::with(['pelayan'])->get();
                                 //$instance[0]->whereMonth('tgl_transaksi', $request->get('filtermonth'))
                                 $instance->with(['produk','kurir','konsumen'])->where('id_konsumen', '=', auth()->user()->id)->whereMonth('tgl_transaksi', $request->get('filtermonth'));
                         
                                // $instance = Transaksi::with(['pelayan'=> function ($query) {
                                 // $query->where('id_user', '=', auth()->user()->id);}]);
                              
                                 //$instance = Transaksi::whereMonth('tgl_transaksi', $request->get('filtermonth'));
                                  //var_dump($instance);
                              }
      
                   
      
                          })
                          
                          ->rawColumns(['sph','status_sph'])
                          ->make(true);
  
              }
             
          return view('transaksi.transaksisphcustomer'); 
      }

      
public function paidtf($id){
    $pembayaran = Pembayaran::with(['transaksi'])->get()->find($id);


    //var_dump($transaksi->produk[0]->pivot);
    //exit();

    return view('transaksi.paidtf',["datatransaksi"=>$pembayaran]);

}


public function paidtfstore(Request $request): RedirectResponse
{
    // upload bukti foto
    if ($request->file('foto')){
        $extension = $request->file('foto')->getClientOriginalExtension();
        $namefile = $request->id_pembayaran.'-'.now()->timestamp.'.'.$extension;
        $request->file('foto')->move('foto', $namefile);

        $pembayaran = Pembayaran::with(['transaksi'])->get()->find($request->id_pembayaran);
        $pembayaran->foto = $namefile;
        $pembayaran->url_foto = urlimage($namefile);
        $pembayaran->save();

    }


    


    //var_dump($transaksi->produk[0]->pivot);
    //exit();

    Session::flash('status', 'success');
    Session::flash('message', 'Pembayaran Berhasil');
   
  

return redirect('/transaksi-customer');

}
  
}
