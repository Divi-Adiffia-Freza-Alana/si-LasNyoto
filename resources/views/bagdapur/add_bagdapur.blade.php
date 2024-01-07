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
                <h3 class="card-title">Form Bag Dapur</h3>
              </div>
              <!-- /.card-header -->
             
              <form action="/bagdapurstore" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
  

                  <div class="row">
                    <div class="form-group col-md-4">
                      <label>User</label>
                      <select id="selectdapurs" name="user" class="form-control" style="width: 100%;">
                      <option value=<?php echo (isset($data->user[0]->id)?$data->user[0]->id:"")?> selected><?php echo (isset($data->user[0]->name)?$data->user[0]->name:"")?></option>
                      </select>
                    </div>
                  <div class="col-md-4">
                      <!-- select -->
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select id="jk" name="jk" class="form-control" required>
                        <option <?php echo (isset($data->jk)&&$data->jk=="Laki-Laki"?"selected":""); ?> value="Laki-Laki">Laki-Laki</option>
                        <option <?php echo (isset($data->jk)&&$data->jk=="Perempuan"?"selected":""); ?> value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
               
                    <div class="form-group col-md-4">
                      <label for="exampleInputEmail1">No. Telp </label>
                      <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP" value="<?php echo (isset($data->no_hp)?$data->no_hp:""); ?>" required>
                    </div>

                    <div class="col-md-4">
                      <!-- select -->
                      <div class="form-group">
                        <label>Kehadiran</label>
                        <select id="status_kehadiran" name="status_kehadiran" class="form-control" required>
                        <option <?php echo (isset($data->status_kehadiran)&&$data->status_kehadiran=="Hadir"?"selected":""); ?> value="Hadir">Hadir</option>
                        <option <?php echo (isset($data->status_kehadiran)&&$data->status_kehadiran=="Tidak Hadir"?"selected":""); ?> value="Tidak Hadir">Tidak Hadir</option>
                        </select>
                      </div>
                    </div>

                    
                  </div>
                  

    
                  <!--<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
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

