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
             
              <form action="/bahanbakustore" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">

                    <div class="col-12">
                      <br>
                    <input type="hidden" name="id" id="id" value="<?php echo (isset($data->id)?$data->id:""); ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Bahan Baku </label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Bahan Baku" value="<?php echo (isset($data->nama)?$data->nama:""); ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stok</label>
                      <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo (isset($data->stok)?$data->stok:""); ?>" readonly>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Satuan </label>
                      <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo (isset($data->satuan)?$data->satuan:""); ?>" required>
                    </div>
  
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

