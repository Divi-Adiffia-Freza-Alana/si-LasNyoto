
@extends('keranjang.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            @if (Session::has('status'))
            
              <div class="alert alert-success" role="alert">
              {{Session::get('message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
 

             
            @endif
        
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <!-- <div class="col">
            <div class="card"> -->
              <!-- <div class="card-header">
                <div class="row">
                  <div class="col-10">
                    <h3 class="card-title">DataTable Keeper</h3> 
                  </div>
                  <div class="col-2">
                      <a class="btn btn-block bg-green" href="/keeper-add" style="color:#ffff;float:right;" >Add New +</a>
                  </div>
                </div>
              </div> -->

                 @foreach($products as $product)
                        <div class="col">
                        <div class="card">
                <!-- <div class="col-xs-18 col-sm-6 col-md-3"> -->
                    <div class="thumbnail">
                        <img src="{{ $product->photo }}" width="300" height="300">
                        <div class="caption">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ Illuminate\Support\Str::limit(strtolower($product->description), 50) }}</p>
                            <p><strong>Price: </strong> {{ $product->price }}$</p>
                            <p class="btn-holder"><a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                        </div>
                    </div>
                </div>
                  </div>
            <!-- /.card -->
          <!-- </div> -->
          <!-- /.col -->
            @endforeach


          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @stop

