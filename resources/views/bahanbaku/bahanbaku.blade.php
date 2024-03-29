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
                    <h3 class="card-title">DataTable Bahan Baku</h3> 
                  </div>
                  <div class="col-2">
                      <a class="btn btn-block bg-blue" href="/bahanbaku-add" style="color:#ffff;float:right;" >Add New +</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                <div class="form-group col-md-4">
                  <label>Bahan Baku</label>
                  <select id="selectbahanbaku" name="bahanbaku" class="form-control" style="width: 100%;" required>

                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Status</label>
                  <select id="selectstok" name="stok" class="form-control" required>
                  <option value=" ">Pilih Status</option>
                  <option value="> 5">Aman</option>
                  <option value="> 1">Menipis</option>
                  <option value="= 0">Habis</option>
                  </select>
                </div>
              </div>
   
                <table id="data-tables-bahanbaku" class="table table-bordered table-striped" style="width:100%!important">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Status</th>
                   <!-- <th>Manajemen Stok</th> -->
                   <!--<th>Foto</th>-->
                  
                   <!-- <th>Log</th> -->
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

