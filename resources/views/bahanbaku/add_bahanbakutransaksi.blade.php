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
                <h3 class="card-title">Form Bahan Baku</h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/bahanbakustoretransaction" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">


                      <br>
                    <input type="hidden" name="id_bahanbaku" id="id_bahanbaku" value="<?php echo (isset($data->id)?$data->id:""); ?>">
                    <div class="form-group col-6">
                      <label for="exampleInputEmail1">Nama Bahan Baku</label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Stok" value="<?php echo (isset($data->nama)?$data->nama:""); ?>" readonly>
                    </div>
                    <div class="form-group col-6">
                      <label for="exampleInputEmail1">Stok</label>
                      <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" value="" required min="1">
                    </div>
                    <div class="form-group col-6">
                      <label for="exampleInputEmail1">Stok Terpakai</label>
                      <input type="number" class="form-control" name="stok_terpakai" id="stok_terpakai" placeholder="Stok terpakai" value="" min="1" required>
                    </div>
                     <div class="form-group col-6">
                      <label for="exampleInputEmail1">Sisa </label>
                      <input type="number" class="form-control" name="sisa" id="sisa" placeholder="" value="<?php echo (isset($transaksi->sisa)?$transaksi->sisa:""); ?>" readonly>
                    </div>
  
                  </div>
              

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn bg-green">Submit</button>
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

