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
        <div class="col-sm-12">
            @if (Session::has('status'))
            
              <div class="alert alert-danger" role="alert">
              {{Session::get('message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
             
            @endif
        
          </div>
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header bg-green">
                <h3 class="card-title">Add to Cart</h3>
                
                
                
               <div style="float:right;"><a href="/cart-tambah"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart </a></div>
             
              </div>
              <!-- /.card-header -->
             
              <form action="/barangstore" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <h1 class="text-center">Makanan</h1>
                  <div class="row">
                    
                    @foreach ($datamakanan as $d)
                    <div class="col-4">
                      <div class="card" style="width: 18rem;display:block;margin: auto;">
                        <img class="card-img-top" src="{{$d->foto_url}}"  alt="Card image cap" width="100px" height="200px" style="display:block;margin:10px auto;">
                        <div class="card-body">
                          <h5 class="card-title">{{$d->nama}}</h5>
                          <p class="card-text">Rp. {{$d->harga}}.</p>
                          <?php
                          if($d->status == "Tersedia" || $d->status == ""){
                           echo '<a style="display:block;margin: auto;" href="/add-to-cart-tambah/'.$d->id.'" class="btn bg-green">Add</a>';
                          }
                          else{
                            echo ' <a style="display:block;margin: auto;" href="#" class="btn  bg-red">Stok Habis</a>';
                                                     
                          }
                          ?>
                          <br>
                          <p class="card-text">{{$d->deskripsi}}.</p>
                        </div>
                      </div>
                    </div>
                      
                    @endforeach
                    
                  </div>
                  <h1 class="text-center">Minuman</h1>
                  <div class="row">
                    
                    @foreach ($dataminuman as $d)
                    <div class="col-4">
                      <div class="card" style="width: 18rem;display:block;margin: auto;">
                        <img class="card-img-top" src="{{$d->foto_url}}"  alt="Card image cap" width="100px" height="200px" style="display:block;margin:10px auto;">
                        <div class="card-body">
                          <h5 class="card-title">{{$d->nama}}</h5>
                          <p class="card-text">Rp. {{$d->harga}}.</p>
                          <?php
                             if($d->status == "Tersedia" || $d->status == ""){
                           echo '<a style="display:block;margin: auto;" href="/add-to-cart-tambah/'.$d->id.'" class="btn bg-green">Add</a>';
                          }
                          else{
                            echo ' <a style="display:block;margin: auto;" href="#" class="btn  bg-red">Stok Habis</a>';
                                                     
                          }
                          ?> 
                          <br>
                          <p class="card-text">{{$d->deskripsi}}.</p>
                        </div>
                      </div>
                    </div>
                      
                    @endforeach
                    
                  </div>

                </div>

                <!-- /.card-body -->

                <!--<div class="card-footer">
                  <button type="submit" class="btn bg-green">Submit</button>
                </div>-->
              </form>
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

