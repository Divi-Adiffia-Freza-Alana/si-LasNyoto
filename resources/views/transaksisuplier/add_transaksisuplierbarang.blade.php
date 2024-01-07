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
                <h3 class="card-title">Form Barang Belanja Bahan Baku </h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/transaksi-suplier-storebarang" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                    <input type="text" name="id_transaksi" id="id_transaksi" value="<?php echo (isset($data)?$data:""); ?>">

                    <div class="form-group col-md-6">
                      <label>Bahan Baku</label>
                      <select id="selectbahanbaku" name="bahanbaku" class="form-control" style="width: 100%;" required>

                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Qty</label>
                      <input type="number" class="form-control" name="qty" id="qtytransaksisuplier" placeholder="Qty" min= "0" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">harga</label>
                      <input type="number" class="form-control" name="harga" id="hargatransaksisuplier" placeholder="harga" min= "0" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">subtotal</label>
                      <input type="number" class="form-control" name="subtotal" id="subtotaltransaksisuplier" placeholder="total" min= "0" readonly>
                    </div>
                  </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn bg-blue">Submit</button>
                </div>
              </form>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data-tables-transaksisuplierbarang" class="table table-bordered table-striped" style="width:100%!important">
                  <thead>
                  <tr>
                    <th>Bahan Baku</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
          
                </table>
              </div>
              <!-- /.card-body -->
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

