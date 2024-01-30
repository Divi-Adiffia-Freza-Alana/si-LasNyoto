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
              <div class="card-header bg-blue">
                <h3 class="card-title">Form Pembayaran</h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/paidtfstore" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                    <input type="hidden" name="id_pembayaran" id="id_pembayaran" value="{{$datatransaksi->id}}">
                    <input type="hidden" name="id_transaksi" id="id_transaksi" value="{{$datatransaksi->transaksi->id}}">
                    
                    <div class="col-12">
                      <img id="avatar" src="" class="avatar"> </img>
                 

                    <div class="form-group" style="margin-top:25px;">
                   <!-- <label for="exampleInputFile">Foto</label>-->
                    <div class="input-group"  style="max-width:300px;margin:auto;">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="foto" name="foto" required>
                          <label class="custom-file-label" for="exampleInputFile"><?php echo (isset($data->keeperfoto[0]->nama)?$data->keeperfoto[0]->nama:"Choose File"); ?></label>
                        </div>
                        <!--<div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>-->
                      </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                      <?php
                      if($datatransaksi->url_foto != ''){
                       echo '<img src="'.$datatransaksi->url_foto.'" alt="" width="300" height="400">';
                      }
                        ?>
      
                    </div>
                    @foreach ($datatransaksi->transaksi->produk as $p)
                    <input type="hidden" name="id_pivot[]" id="id_pivot" value="{{$p->pivot->id}}">
                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail1">Produk </label>
                      <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP" value="{{$p->nama}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail1">Qty </label>
                      <input type="text" class="form-control" id="qty" name="qty[]" placeholder="No. HP" value="{{$p->pivot->qty}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail1">Harga </label>
                      <input type="text" class="form-control" id="harga" name="harga[]" placeholder="Harga" value="{{$p->pivot->harga}}" readonly>
                    </div>
                    @endforeach
       

    
                  <!--<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>-->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn bg-blue">Submit</button>
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

