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
              <div class="card-header bg-blue">
                <h3 class="card-title">Invoice</h3>

              </div>
              <!-- /.card-header -->
             
            
              
                <div class="card-body">
                  <div class="row"> 

                    <div class="col-6"> Kode SPH :  {{$datatransaksi->sph->kode}}</div>
                    <div class="col-6"> Tanggal:  {{dateformat($datatransaksi->sph->tgl)}}</div>
                    <div class="col-6"> Nama :  {{$datatransaksi->konsumen->name}}</div>
                    <div class="col-6"> Marketing:  {{$datatransaksi->marketing->name}}</div>
                    
          

                  </div>
                  <br>
                  <div> <b>Detail Produk </b></div>
                  
                  <div class="row"> 
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
                        <td>{{$m->pivot->harga}}</td> 
                        </tr>          
                        @endforeach
                      </tbody>
                    </table>
                   
                  </div>     
                  <br>
                  <div class="row"> 

                    <div class="col-6" > 
                    <a class="btn bg-blue " href="/sphapprove/{{$datatransaksi->sph->id}}" style="color:#ffff;display:inline-block;" >Setujui </a>
                    <a class="btn bg-danger" href="/sphdecline/{{$datatransaksi->sph->id}}" style="color:#ffff;display:inline-block;" >Tolak </a>
                    </div>
                 

                    
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

