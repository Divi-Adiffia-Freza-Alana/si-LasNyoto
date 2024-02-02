@extends('include.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
     
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
            
              <!-- /.card-header -->
             
            
              
                <div class="card-body">
                  <div class ="mb-4" style= ""><img src="{{asset('/')}}img/kop.png" height="250px"></div>
                  <div class="row" style="padding-left: 100px;padding-right: 100px;"> 
        
                 

                    <div class="col-6"> Kode SPH :  {{$datatransaksi->sph->kode}} <br> Tanggal:  {{dateformat($datatransaksi->sph->tgl)}}</div>
                   <!-- <div class="col-6"> Nama :  {{$datatransaksi->konsumen->name}}</div>-->
                    <!--<div class="col-6"> Marketing:  {{$datatransaksi->marketing->name}}</div>-->
                  </div>
                
                  <div style="padding-left: 100px;padding-right: 100px;">
                    {{$datatransaksi->sph->deskripsi}}
                  </div>
                  <br>
                  <div style="padding-left: 100px;padding-right: 100px;"> <b>Detail Produk </b></div>
                  
                  <div class="row"  style="padding-left: 100px;padding-right: 100px;"> 
                    <table id="2" class="custom-table" style="width:100%!important;margin:0px 10px;">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kode Produk</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                      </tr>
                      </thead>
                      <tbody>
                         
                        @foreach ($datatransaksi->produk()->get() as $m)                 
                        <tr>
                        <td><?=$loop->iteration?></td> 
                        <td>{{$m->nama}}</td> 
                        <td>{{$m->kode_produk}}</td> 
                        <td>{{$m->pivot->qty}}</td> 
                        <td class="money">{{$m->pivot->harga}}</td> 
                        </tr>          
                        @endforeach
                      </tbody>
                    </table>
                   
                  </div>     
                  <br>

                  <div class="row" style="padding-left: 100px;padding-right: 100px;"> 
                    <div class="col-12 mb-4">Demikian penawaran harga yang kami ajukan. Atas perhatiannya kami ucapkan terima kasih.</div>
                    
                    <form action="/sphbergaining" method="post" enctype="multipart/form-data" class="col-12">
                      @csrf
                      <input type="hidden" class="form-control" id="id" name="id"  value="{{$datatransaksi->sph->id}}">
                  
                        <!-- textarea -->
                        <!--<div class="form-group">
                          <label>Penawaran </label>
                          <textarea class="form-control" rows="3" placeholder="Isi Penawaran ..."  id="deskripsi" name="deskripsi"><?php echo (isset($data->deskripsi)?$data->deskripsi:""); ?></textarea>
                        </div>-->
                        <div class="form-group col-12">
                          <label for="exampleInputEmail1">Ajukan Harga Penawaran </label>
                          <input type="text" class="form-control money" id="harga_penawaran" name="harga_penawaran" placeholder="Harga Penawaran" required>
                        </div>
                 
                    <div class="col-6" > 
                      <button type="submit" class="btn bg-blue">Kirim</button>
                      </div>
                   </form>
                    <!--<div class="col-6" > 
                    <a class="btn bg-blue " href="/sphapprove/{{$datatransaksi->sph->id}}" style="color:#ffff;display:inline-block;" >Setujui </a>
                    <a class="btn bg-danger" href="/sphdecline/{{$datatransaksi->sph->id}}" style="color:#ffff;display:inline-block;" >Tolak </a>
                    </div>-->
                 

                    
                    <div class="col-6" > 
                      <br>
                    <?php  if(auth()->user()->hasRole('superadmin') and $data->status == 3 and $data->status_bayar == 2  ){
                      echo '<input class="no-print" style="float: left;" type="button" value="Print" onClick="window.print()">'; }?>
                    </div>

                  </div>
                             
                

                </div>

                <!-- /.card-body -->

                <!--<div class="card-footer">
                  <button type="submit" class="btn bg-green">Submit</button>
                </div>-->
             
            </div>
            <!-- /.card -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @stop

