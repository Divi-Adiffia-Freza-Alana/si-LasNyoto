@extends('include.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header bg-green">
                <h3 class="card-title">Form Users</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/usersstore" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                  <input type="hidden" id="id" name="id" value="<?php echo (isset($data->id)?$data->id:""); ?>">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Nama </label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="name"  value="<?php echo(isset($data->name)?$data->name:"");?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Email </label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="email" placeholder="Email"  value="<?php echo(isset($data->email)?$data->email:"");?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Password </label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="password" placeholder="Password" value="<?php echo(isset($data->password)?$data->password:"");?>">
                    </div>
                    <div class="col-md-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Role</label>
                        <select id="role" name="role" class="form-control" required>
                        <option <?php echo (isset($data->role)&&$data->role=="superadmin"?"selected":""); ?> value="superadmin">Superadmin</option>
                        <option <?php echo (isset($data->role)&&$data->role=="bag_dapur"?"selected":""); ?> value="bag_dapur">Bag Dapur</option>
                        <option <?php echo (isset($data->role)&&$data->role=="pelayan"?"selected":""); ?> value="pelayan">Pelayan</option>
                        <option <?php echo (isset($data->role)&&$data->role=="konsumen"?"selected":""); ?> value="konsumen">Konsumen</option>
                        </select>
                      </div>
                    </div>
                    <!--<div class="col-md-4">
                      select
                      <div class="form-group">
                        <label>Role</label>
                        <select id="is_pic" name="is_pic" class="form-control" required>
                        <option  value="superadmin">superadmin</option>
                        <option <?php echo (isset($data->is_pic)&&$data->is_pic=="Tidak"?"selected":""); ?> value="Tidak">admin</option>
                        <option <?php echo (isset($data->is_pic)&&$data->is_pic=="Tidak"?"selected":""); ?> value="Tidak">kurator</option>
                        </select>
                      </div>
                    </div>-->
                   <!-- <div class="col-md-6">
                      
                      <div class="form-group">
                        <label>Role</label>
                        <select class="form-control">
                          <option>Admin</option>
                          <option>Dokter</option>
                          <option>Kurator</option>
                        </select>
                      </div>
                    </div>
                     <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Alamat">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Tanggal Lahir </label>
                        <div class="input-group date">
                            <input id="tglmasuk" type="text" class="form-control datepicker" name="tglmasuk"/>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                     
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control">
                          <option>Laki-Laki</option>
                          <option>Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">No. Telp </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="No. Telp ">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputFile">Foto</label>
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
              
                      </div>
                    </div>
              
                  </div>-->
   
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