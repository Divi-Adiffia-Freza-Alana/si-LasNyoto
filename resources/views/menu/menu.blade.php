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
                    <h3 class="card-title">DataTable Menu</h3> 
                  </div>
                  <div class="col-2">
                      <a class="btn btn-block bg-green" href="/menu-add" style="color:#ffff;float:right;" >Add New +</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data-tables-menu" class="table table-bordered table-striped" style="width:100%!important">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Komposisi</th>
                    <th>Deskripsi</th>
                   <!--<th>Foto</th>-->
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

