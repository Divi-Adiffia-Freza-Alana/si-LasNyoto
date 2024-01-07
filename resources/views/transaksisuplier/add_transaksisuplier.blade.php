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
                <h3 class="card-title">Form Transaksi Belanja Bahan Baku</h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/transaksi-suplier-store" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Kode Transaksi </label>
                      <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Transaksi"  value="<?php echo(isset($data)?$data:"");?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Suplier</label>
                      <select id="selectsuplier" name="suplier" class="form-control" style="width: 100%;" required>

                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tanggal</label>
                        <div class="input-group date">
                            <input id="tgl_transaksi" type="text" class="form-control datepicker" name="tgl_transaksi" value="<?php echo (isset($tgllahir_indo)?$tgllahir_indo:""); ?>" required/>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> 
                    </div>
                  <div class="col-md-12">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Keterangan </label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..."  id="keterangan" name="keterangan"><?php echo (isset($data->keterangan)?$data->keterangan:""); ?></textarea>
                    </div>
                  </div>
              </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn bg-blue">Lanjut Isi Data Barang</button>
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

