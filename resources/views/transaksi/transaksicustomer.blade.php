@extends('include.master')
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-10">
                    <h3 class="card-title">DataTable Transaksi Customer </h3> 
                  </div>
                 <!-- @hasrole('konsumen')
                  <div class="col-2">
                      <a class="btn btn-block bg-green" href="/chooseproduct" style="color:#ffff;float:right;" >Add New +</a>
                  </div>
                 
                  @endhasrole-->
                 
                </div>
             
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group col-2">
                  <label>Month</label>
                  <select id="filtermonth" name="filtermonth" class="form-control" required>
                  <option value=" ">Pilih Bulan</option>
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option value="6">Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  </select>
                </div>
                <table id="data-tables-transaksicustomer" class="table table-bordered table-striped" style="width:100%!important">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                  <!--  <th>No Meja</th>
                    <th>Bag Dapur</th>
                    <th>Pelayan</th>-->
                    <th>Staf Penjualan</th>
                    <th>SPH</th>
                    <th>Jenis Pembayaran</th>       
                    <th>Status Bayar</th>
                    <th>Status Pesanan</th>
                    <th>Detail</th>
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @stop

