<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Las Nyoto</title>
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/')}}dist/css/adminlte.min.css?v=<?php echo time();?>">
  <!-- Main style -->
  <link rel="stylesheet" href="{{asset('/')}}css/main.css?v=<?php echo time();?>">
  



  <!-- DataTables -->
  <link  href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- datepicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="max-width: 900px;">
        <div class="row">

          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header bg-blue">
                <h3 class="card-title">Add to Cart</h3>
               <div style="float:right;"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart </div>
              </div>
              <!-- /.card-header -->
              <form action="/transaksistore" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="card-body">
                    <div class="row">
                       <!-- <div class="form-group col-md-6">
                            <label>Tanggal Transaksi</label>
                              <div class="input-group date">
                                  <input id="tgl_transaksi" type="text" class="form-control datepicker" name="tgl_transaksi"  required/>
                                  <div class="input-group-append">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div> 
                          </div>-->
                         <!-- <div class="form-group col-md-6">
                            <label>Bag dapur</label>
                            <select id="selectbagdapur" name="bag_dapur" class="form-control" style="width: 100%;">
      
                            </select>
                          </div>-->
                          <!--<div class="form-group col-md-6">
                            <label>Konsumen</label>
                            <select id="selectuser" name="konsumen" class="form-control" style="width: 100%;">
      
                            </select>
                          </div>-->
                         <!-- <div class="form-group  col-md-6">
                            <label for="exampleInputEmail1">No Meja </label>
                            <input type="text" class="form-control" name="no_meja" id="no_meja" placeholder="No Meja"  required>
                          </div>-->
                          <div class="form-group col-md-6">
                            <label>Nama Pemesan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"  required>
                          </div>
                          <div class="form-group col-md-6">
                            <label>No. HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP"  required>
                          </div>
                          <div class="form-group col-md-12">
                            <label>Alamat </label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."  id="alamat" name="alamat"></textarea>
                          </div>
            
                    </div>
                 
  
    
                  </div>
  
                  <!-- /.card-body -->
  
        
             
              <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%"></th>
                </tr>
                </thead>
                <tbody>
        
                <?php $total = 0 ?>
        
                @if($data != NULL)
                    @foreach($data as $id => $details)
        
                        <?php $total += $details['price'] * $details['quantity'] ?>
        
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                  <!--  <div class="col-sm-3 hidden-xs"><img src="" width="100" height="100" class="img-responsive"/></div>-->
                                    <div class="col-sm-12">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </div>
                                </div> 
                            </td>
                            <td data-th="Price">Rp.{{ $details['price'] }}</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" min="1" />
                            </td>
                            <td data-th="Subtotal" class="text-center">Rp.{{ $details['price'] * $details['quantity'] }}</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
        
                </tbody>
                <tfoot>
                <tr>
                    <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Kembali Pilih Produk</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total Rp.{{ $total }}</strong></td>
                </tr>
                </tfoot>
            </table>
            <div class="card-footer">
              <div class="row">

                <div class="col-4"> <button type="submit" class="btn bg-blue">Submit</button></div>
                <div class="col-4"></div>
                <div class="col-4"> <a class="btn btn-danger" href="/deletecart" style="color:#ffff;float:right;" >Clear Cart</a></div>
              </div>
               

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
 

  <!--Footer-->
  
  <footer class=" no-print text-center">
    <strong>Copyright &copy; 2023 <a href="">Las Nyoto</a>.</strong>
    All rights reserved.
  </footer>

    <!--Footer-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('/')}}plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/')}}plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('/')}}plugins/chart.js/Chart.min.js"></script>


<!-- AdminLTE App -->
<script src="{{asset('/')}}dist/js/adminlte.js"></script>



<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.js" integrity="sha512-HaEy0QUW4eX9WTwu1vDg2AroxE2oAZl0FSGcsLo3OZcwDzhdccdZRUJsed3BHaZgb8ZDj7Ve8iL2nQ6dfkazsA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/')}}dist/js/pages/dashboard.js"></script>


<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!--Jquery Datepicker -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
  $(document).ready(() => {
      $("#foto").change(function () {
          const file = this.files[0];
          if (file) {
              let reader = new FileReader();
              reader.onload = function (event) {
                $('#avatar').attr('src', event.target.result);
                  
              };
              reader.readAsDataURL(file);
          }
      });
  });
</script>


<script>
  $(document).ready(() => {
    
      $("#bayar").change(function () {
         var int = $("#total").val() - $("#bayar").val();
         //console.log(int);
         $("#kembali").val(int);
      });


      $("#hargatransaksisuplier").keyup(function () {
         var int1 = $("#qtytransaksisuplier").val() * $("#hargatransaksisuplier").val();
         console.log(int1);
         $("#subtotaltransaksisuplier").val(int1);
      });

      $("#qtytransaksisuplier").keyup(function () {
         var int2 = $("#qtytransaksisuplier").val() * $("#hargatransaksisuplier").val();
         console.log(int2);
         $("#subtotaltransaksisuplier").val(int2);
      });

      
  });
</script>

<script>
  $(function () {



      
  var tabledapur = $('#data-tables-bagdapur').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      //ajax: "{{ route('bagdapur.index') }}",
      ajax: {

        url: "{{ route('bagdapur.index') }}",

        },
      columns: [ 
        {data: 'id', name: 'id', visible:false},
          {data: 'user.name', name: 'user.name'},
          {data: 'no_hp', name: 'no_hp'},
          {data: 'jk', name: 'jk'},
          {data: 'status_kehadiran', name: 'status_kehadiran'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]

  });

  $('#filtermonth').change(function(){
    console.log("asup");
    tabletransaksi.draw();

  });

  var table = $('#data-tables-pelayan').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      ajax: "{{ route('pelayan.index') }}",
      columns: [ 
         {data: 'id', name: 'id', visible:false},
          {data: 'user.name', name: 'user.name'},
          {data: 'no_hp', name: 'no_hp'},
          {data: 'jk', name: 'jk'},
          {data: 'status_kehadiran', name: 'status_kehadiran'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]

  });

  var table = $('#data-tables-kurir').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      ajax: "{{ route('kurir.index') }}",
      columns: [ 
         {data: 'id', name: 'id', visible:false},
          {data: 'user.name', name: 'user.name'},
          {data: 'no_hp', name: 'no_hp'},
          {data: 'jk', name: 'jk'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]

  });

  var tabletransaksi = $('#data-tables-transaksi').DataTable({
      processing: true,
      serverSide: true,
     // ajax: "{{ route('transaksi.index') }}",
     ajax: {

          url: "{{ route('transaksi.index') }}",

          data: function (d) {

                d.filtermonth = $('#filtermonth').val(),

                d.search = $('input[type="search"]').val()

            }

          },
      columns: [
        {data: 'id', name: 'id',orderable: false, searchable: false,visible:false},
        {data: 'kode', name: 'kode'},
        {data: 'tgl_transaksi', name: 'tgl_transaksi'},
        {data: 'konsumen.name', name: 'konsumen.name'},
        {data: 'meja.nomor', name: 'meja.nomor'},
        {data: 'bagdapur.nama', name: 'bagdapur.nama'},
       {data: 'pelayan.nama', name: 'pelayan.nama'},
        {data: 'total', name: 'total'},
        {data: 'tambahpesanan', name: 'tambahpesanan', visible: false},
        {data: 'statuspesanan', name: 'statusbayar'},
        {data: 'statusbayar', name: 'statusbayar'},
        {data: 'detail', name: 'detail', orderable: false, searchable: false}, 
        {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });

  var auth = '<?php echo auth()->user()->role; ?>';
      if(auth == 'konsumen'){
      tabletransaksi.columns( [5,6] ).visible( false );
      tabletransaksi.columns( [8] ).visible( true );
      }

  var table = $('#data-tables-bahanbaku').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      ajax: "{{ route('bahanbaku.index') }}",
      columns: [ 
          {data: 'nama', name: 'nama'},
          {data: 'stok', name: 'stok'},
          {data: 'satuan', name: 'satuan'},
          {data: 'status', name: 'status'},
          {data: 'manajemenstok', name: 'manajemenstok', orderable: false, searchable: false},
         // {data: 'log', name: 'log', orderable: false, searchable: false},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]

  });





  var table = $('#data-tables-menu').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      ajax: "{{ route('menu.index') }}",
      columns: [ 
          {data: 'nama', name: 'nama'},
          {data: 'jenis', name: 'jenis'},
          {data: 'komposisi', name: 'komposisi'},
          {data: 'deskripsi', name: 'deskripsi'},

          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]

  });

  var table = $('#data-tables-meja').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      ajax: "{{ route('meja.index') }}",
      columns: [ 
          {data: 'nomor', name: 'nomor'},
          {data: 'status', name: 'status'},
          {data: 'deskripsi', name: 'deskripsi'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]

  });






 
  var tableuser = $('#data-tables-user').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('user.index') }}",
      columns: [
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'role', name: 'role'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });

  
  var tableproduk = $('#data-tables-produk').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('produk.index') }}",
      columns: [
          {data: 'kode_produk', name: 'kode_produk'},
          {data: 'nama', name: 'nama'},
          {data: 'jenis', name: 'jenis'},
          {data: 'deskripsi', name: 'deskripsi'},
          {data: 'harga', name: 'harga'},
          {data: 'bahanbaku', name: 'bahanbaku', orderable: false, searchable: false},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });

 // var bla = $('#id_produk').val();
  var tableproduk = $('#data-tables-bahanbakuproduk').DataTable({
      processing: true,
      serverSide: true,
      ajax: {

      url: "{{ route('bahanbakuproduk.index') }}",

      data: function (d) {
        d.id = $('#id_produk').val(),
        d.search = $('input[type="search"]').val()
        }

      },
      columns: [
          {data: 'bahanbaku.nama', name: 'bahanbaku.nama'},
          {data: 'qty', name: 'qty'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });



  var tablesuplier = $('#data-tables-suplier').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('suplier.index') }}",
      columns: [
          {data: 'nama', name: 'nama'},
          {data: 'no_hp', name: 'no_hp'},
          {data: 'email', name: 'email'},
          {data: 'alamat', name: 'alamat'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });


  var tabletransaksisuplier = $('#data-tables-transaksisuplier').DataTable({
      processing: true,
      serverSide: true,
     // ajax: "{{ route('transaksi.index') }}",
     ajax: {

          url: "{{ route('transaksisuplier.index') }}",

          data: function (d) {

                d.filtermonth = $('#filtermonth').val(),

                d.search = $('input[type="search"]').val()

            }

          },
      columns: [
        {data: 'id', name: 'id',orderable: false, searchable: false,visible:false},
        {data: 'kode', name: 'kode'},
        {data: 'suplier.nama', name: 'suplier.nama'},
        {data: 'tgl_transaksi', name: 'tgl_transaksi'},
        {data: 'total', name: 'total'},
        {data: 'detail', name: 'detail', orderable: false, searchable: false}, 
        {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });


  var tableproduk = $('#data-tables-transaksisuplierbarang').DataTable({
      processing: true,
      serverSide: true,
      ajax: {

      url: "{{ route('suplierbarang.index') }}",

      data: function (d) {
        d.id_transaksi = $('#id_transaksi').val(),
        d.search = $('input[type="search"]').val()
        }

      },
      columns: [
          {data: 'bahanbaku.nama', name: 'bahanbaku.nama'},
          {data: 'qty', name: 'qty'},
          {data: 'harga', name: 'harga'},
          {data: 'subtotal', name: 'subtotal'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });







    
    $(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd-mm-yy',
        yearRange: "-70:+0",
        changeMonth: true,
        changeYear: true,
     });

    });

    //Initialize Select2 Elements
    $('.select2').select2()

  
    $(document).ready(function () {
      bsCustomFileInput.init()
      
    })    
 

  });


  $(".update-cart").click(function (e) {

    console.log("test");
     e.preventDefault();

     var ele = $(this);

      $.ajax({
         url: '{{ url('update-cart') }}',
         method: "patch",
         data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
         success: function (response) {
             window.location.reload();
         }
      });
  });



  
</script>

<script type="text/javascript">



 $(".remove-from-cart").click(function (e) {
      e.preventDefault();

      var ele = $(this);

      if(confirm("Are you sure")) {
          $.ajax({
              url: '{{ url('remove-from-cart') }}',
              method: "DELETE",
              data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
              success: function (response) {
                  window.location.reload();
              }
          });
      }
  });

</script>

<!-- Select logic -->
<script src="{{asset('/')}}js/select.js"></script>

<!-- datatble 
<script type="text/javascript" src="{{asset('/')}}js/datatable.js"></script>
logic -->

</body>
</html>



