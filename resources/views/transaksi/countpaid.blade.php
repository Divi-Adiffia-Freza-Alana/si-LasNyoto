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
                <h3 class="card-title">Form Bayar</h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/paid" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">

                    <input type="hidden" name="id" id="id" value="<?php echo (isset($data->id)?$data->id:""); ?>">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Total </label>
                      <input type="text" class="form-control" name="nomor" id="total" placeholder="" value="<?php echo (isset($data->total)?$data->total:""); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1"> Bayar </label>
                      <input type="text" class="form-control" name="bayar" id="bayar" placeholder="" value=""  required>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="exampleInputEmail1"> Kembali </label>
                      <input type="text" class="form-control" name="kembali" id="kembali" placeholder="" value=""  required>
                    </div>
          
                 

                  </div>
                 
                      
              

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn bg-green">Bayar</button>
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

