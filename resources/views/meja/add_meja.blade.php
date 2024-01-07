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
                <h3 class="card-title">Form Meja</h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/mejastore" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                 
                      
                    <input type="hidden" name="id" id="id" value="<?php echo (isset($data->id)?$data->id:""); ?>">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Nomor Meja </label>
                      <input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor Meja" value="<?php echo (isset($data->nomor)?$data->nomor:""); ?>" required>
                    </div>
             
                  <div class="col-md-12">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Deskripsi </label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..."  id="deskripsi" name="deskripsi"><?php echo (isset($data->deskripsi)?$data->deskripsi:""); ?></textarea>
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

