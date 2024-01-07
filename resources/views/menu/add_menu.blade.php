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
                <h3 class="card-title">Form Menu</h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/menustore" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">


                    <div class="col-6">
                      <img id="avatar" src="<?php echo (isset($data->foto_url)?$data->foto_url:""); ?>" class="avatar"> </img>
                 

                    <div class="form-group" style="margin-top:25px;">
                   <!-- <label for="exampleInputFile">Foto</label>-->
                    <div class="input-group"  style="max-width:300px;margin:auto;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto" >
                        <label class="custom-file-label" for="exampleInputFile"><?php echo (isset($data->foto)?$data->foto:"Choose File"); ?></label>
                        <input type="hidden" id="fotolabel" name="fotolabel" value="<?php echo (isset($data->foto)?$data->foto:""); ?>">
                      </div>
                        <!--<div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>-->
                      </div>
                    </div>
                    </div>
                    <div class="col-6">
                      <br>
                    <input type="hidden" name="id" id="id" value="<?php echo (isset($data->id)?$data->id:""); ?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Menu </label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Menu" value="<?php echo (isset($data->nama)?$data->nama:""); ?>" required>
                    </div>
                      <div class="form-group">
                        <label>Jenis</label>
                        <select id="jenis" name="jenis" class="form-control" required>
                        <option <?php echo (isset($data->jk)&&$data->jk=="Makanan"?"selected":""); ?> value="Makanan">Makanan</option>
                        <option <?php echo (isset($data->jk)&&$data->jk=="Minuman"?"selected":""); ?> value="Minuman">Minuman</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kode Menu </label>
                        <input type="text" class="form-control" name="kd_menu" id="kd_menu" placeholder="Kode Menu" value="<?php echo (isset($data->kd_menu)?$data->kd_menu:""); ?>" required>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Komposisi</label>
                      <input type="text" class="form-control" name="komposisi" id="komposisi" placeholder="Komposisi" value="<?php echo (isset($data->komposisi)?$data->komposisi:""); ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo (isset($data->harga)?$data->harga:""); ?>" required>
                    </div>
                    <!--<div class="form-group">
                      <label>status</label>
                      <select id="status" name="status" class="form-control" required>
                      <option <?php echo (isset($data->status)&&$data->status=="Tersedia"?"selected":""); ?> value="Tersedia">Tersedia</option>
                      <option <?php echo (isset($data->status)&&$data->status=="Habis"?"selected":""); ?> value="Habis">Habis</option>
                      </select>
                    </div>-->
                    <div class="form-group">
                      <label>Bahan Baku</label>
                      <select id="selectbahanbakus" name="id_bahanbaku" class="form-control" style="width: 100%;">
                      <option value=<?php echo (isset($data->bahanbaku->id)?$data->bahanbaku->id:"")?> selected><?php echo (isset($data->bahanbaku->nama)?$data->bahanbaku->nama:"")?></option>
                      </select>
                    </div>

  
                  </div>
                  <div class="col-md-12">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Deskripsi </label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..."  id="deskripsi" name="deskripsi"><?php echo (isset($data->deskripsi)?$data->deskripsi:""); ?></textarea>
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

