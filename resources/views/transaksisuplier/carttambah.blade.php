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
               <div style="float:right;"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart </div>
              </div>
              <!-- /.card-header -->
              <form action="/transaksistoretambah" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="card-body">
                    <div class="row">
                       <!-- <div class="form-group col-md-6">
                            <label>Tanggal Transaksi</label>
                              <div class="input-group date">
                                  <input id="tgl_transaksi" type="text" class="form-control datepicker" name="tgl_transaksi"  required/>
                                  <div class="input-group-append">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div> 
                          </div>-->
                         <!-- <div class="form-group col-md-6">
                            <label>Bag dapur</label>
                            <select id="selectbagdapur" name="bag_dapur" class="form-control" style="width: 100%;">
      
                            </select>
                          </div>-->
                          <!--<div class="form-group col-md-6">
                            <label>Konsumen</label>
                            <select id="selectuser" name="konsumen" class="form-control" style="width: 100%;">
      
                            </select>
                          </div>-->
                         <!-- <div class="form-group  col-md-6">
                            <label for="exampleInputEmail1">No Meja </label>
                            <input type="text" class="form-control" name="no_meja" id="no_meja" placeholder="No Meja"  required>
                          </div>-->
                         <!-- <div class="form-group col-md-6">
                            <label>Meja</label>
                            <select id="selectmeja" name="meja" class="form-control" style="width: 100%;" required>
      
                            </select>
                          </div>-->
                    </div>
                 
  
    
                  </div>
  
                  <!-- /.card-body -->
  
        
             
              <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%"></th>
                </tr>
                </thead>
                <tbody>
        
                <?php $total = 0 ?>
        
                @if($data != NULL)
                    @foreach($data as $id => $details)
        
                        <?php $total += $details['price'] * $details['quantity'] ?>
        
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                  <!--  <div class="col-sm-3 hidden-xs"><img src="" width="100" height="100" class="img-responsive"/></div>-->
                                    <div class="col-sm-12">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </div>
                                </div> 
                            </td>
                            <td data-th="Price">Rp.{{ $details['price'] }}</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" min="1"/>
                            </td>
                            <td data-th="Subtotal" class="text-center">Rp.{{ $details['price'] * $details['quantity'] }}</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
        
                </tbody>
                <tfoot>
                <tr>
                    <td><a href="{{ url('/chooseproduct-tambah') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Lanjut Pilih Menu</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total Rp.{{ $total }}</strong></td>
                </tr>
                </tfoot>
            </table>
            <div class="card-footer">
              <div class="row">

                <div class="col-4"> <button type="submit" class="btn bg-green">Submit</button></div>
                <div class="col-4"></div>
                <div class="col-4"> <a class="btn btn-danger" href="/deletecart" style="color:#ffff;float:right;" >Clear Cart</a></div>
              </div>
               

              </div>
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

