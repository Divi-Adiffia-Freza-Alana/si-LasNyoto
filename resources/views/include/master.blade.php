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

  <!-- Navbar -->
  @include('include.navbar')
  <!-- /.navbar -->

  <!--Header-->

  <!-- Main Sidebar Container -->

  @include('include.sidebar')
  <!--Sidebar-->


  @yield('content')

  <!--Footer-->
  
  @include('include.footer')

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
    
      $("#bayar").keyup(function () {
         var int = $("#total").val() - $("#bayar").val();
         //console.log(int);
         $("#kembalian").val(int);
      });


      $("#hargatransaksisuplier").keyup(function () {
         var int1 = $("#qtytransaksisuplier").val() * $("#hargatransaksisuplier").cleanVal();
         console.log(int1);
         $("#subtotaltransaksisuplier").val(int1);
      });

      $("#qtytransaksisuplier").keyup(function () {
         var int2 = $("#qtytransaksisuplier").val() * $("#hargatransaksisuplier").cleanVal();
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

  $('#selectbahanbaku').change(function(){
    console.log("asup");
    tablebahanbaku.draw();

  });

  $('#selectstok').change(function(){
    console.log("asup");
    tablebahanbaku.draw();

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
        {data: 'estimasi', name: 'estimasi'},
        {data: 'konsumen.name', name: 'konsumen.name'},
       // {data: 'meja.nomor', name: 'meja.nomor'},
      //{data: 'bagdapur.nama', name: 'bagdapur.nama'},
      //{data: 'pelayan.nama', name: 'pelayan.nama'},
        {data: 'kurir.nama', name: 'kurir.nama'},
        {data: 'total', name: 'total'},
        {data: 'tambahpesanan', name: 'tambahpesanan', visible: false},
        {data: 'statusorder', name: 'statusorder'},
        {data: 'statusbayar', name: 'statusbayar'},
        {data: 'detail', name: 'detail', orderable: false, searchable: false}, 
        {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });


  var tabletransaksikurir = $('#data-tables-transaksikurir').DataTable({
      processing: true,
      serverSide: true,
     // ajax: "{{ route('transaksi.index') }}",
     ajax: {

          url: "{{ route('transaksikurir.index') }}",

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
       // {data: 'meja.nomor', name: 'meja.nomor'},
      //{data: 'bagdapur.nama', name: 'bagdapur.nama'},
      //{data: 'pelayan.nama', name: 'pelayan.nama'},
        {data: 'kurir.nama', name: 'kurir.nama'},
        {data: 'total', name: 'total'},
        {data: 'tambahpesanan', name: 'tambahpesanan', visible: false},
        {data: 'statusorder', name: 'statusorder'},
        {data: 'statusbayar', name: 'statusbayar',visible: false},
        {data: 'detail', name: 'detail', orderable: false, searchable: false}, 
        {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });



  var tabletransaksicustomer = $('#data-tables-transaksicustomer').DataTable({
      processing: true,
      serverSide: true,
     // ajax: "{{ route('transaksi.index') }}",
     ajax: {

          url: "{{ route('transaksicustomer.index') }}",

          data: function (d) {

                d.filtermonth = $('#filtermonth').val(),

                d.search = $('input[type="search"]').val()

            }

          },
      columns: [
        {data: 'id', name: 'id',orderable: false, searchable: false,visible:false},
        {data: 'kode', name: 'kode'},
        {data: 'tgl_transaksi', name: 'tgl_transaksi'},
        {data: 'estimasi', name: 'estimasi'},
        {data: 'konsumen.name', name: 'konsumen.name'},
        {data: 'marketing.nama', name: 'marketing.nama'},
        {data: 'jenispembayaran', name: 'jenispembayaran'},
        {data: 'statusbayar', name: 'statusbayar'},
        {data: 'statusorder', name: 'statusorder'},
        {data: 'detail', name: 'detail', orderable: false, searchable: false}, 
        {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });

  var tabletransaksicustomerregular = $('#data-tables-transaksicustomerregular').DataTable({
      processing: true,
      serverSide: true,
     // ajax: "{{ route('transaksi.index') }}",
     ajax: {

          url: "{{ route('transaksicustomerregular.index') }}",

          data: function (d) {

                d.filtermonth = $('#filtermonth').val(),

                d.search = $('input[type="search"]').val()

            }

          },
      columns: [
        {data: 'id', name: 'id',orderable: false, searchable: false,visible:false},
        {data: 'kode', name: 'kode'},
        {data: 'tgl_transaksi', name: 'tgl_transaksi'},
        {data: 'estimasi', name: 'estimasi'},
        {data: 'konsumen.name', name: 'konsumen.name'},
        {data: 'marketing.nama', name: 'marketing.nama'},
        {data: 'jenispembayaran', name: 'jenispembayaran'},
        {data: 'statusbayar', name: 'statusbayar'},
        {data: 'statusorder', name: 'statusorder'},
        {data: 'detail', name: 'detail', orderable: false, searchable: false}, 
        {data: 'action', name: 'action', orderable: false, searchable: false},
          
      ]


  });

  
  var tabletransaksisphcustomer = $('#data-tables-transaksisphcustomer').DataTable({
      processing: true,
      serverSide: true,
     // ajax: "{{ route('transaksi.index') }}",
     ajax: {

          url: "{{ route('transaksisphcustomer.index') }}",

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
        {data: 'marketing.nama', name: 'marketing.nama'},
        {data: 'sph', name: 'sph'},
        {data: 'status_sph', name: 'status_sph'},

          
      ]


  });


  var tabletransaksimarketing = $('#data-tables-transaksimarketing').DataTable({
      processing: true,
      serverSide: true,
     // ajax: "{{ route('transaksi.index') }}",
     ajax: {
          url: "{{ route('transaksimarketing.index') }}",

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
        {data: 'konsumen.no_hp', name: 'konsumen.no_hp'},
        {data: 'sph', name: 'sph', orderable: false, searchable: false},
        {data: 'statussph', name: 'statussph',orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false,  visible: false}
          
      ]


  });

 /* var auth = '<?php echo auth()->user(); ?>';
      if(auth == 'konsumen'){
      tabletransaksi.columns( [5,6] ).visible( false );
      tabletransaksi.columns( [8] ).visible( true );
      }*/

  var tablebahanbaku = $('#data-tables-bahanbaku').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: true,
      ajax: {

        url: "{{ route('bahanbaku.index') }}",

        data: function (d) {
          d.id = $('#selectbahanbaku').val(),
          d.search = $('input[type="search"]').val()
          d.stok = $('#selectstok').val()
          }

        },
      columns: [ 
          {data: 'nama', name: 'nama'},
          {data: 'stok', name: 'stok'},
          {data: 'satuan', name: 'satuan'},
         {data: 'status', name: 'status'},
          //{data: 'manajemenstok', name: 'manajemenstok', orderable: false, searchable: false},
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
          {data: 'bahanbaku.satuan', name: 'bahanbaku.satuan'},
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
        {data: 'nama_toko', name: 'nama_toko'},
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){
    // Format mata uang.
    $('.money').mask('0.000.000.000', {reverse: true});
    
  $('form').on('submit', function(){
    $('.money').unmask();
  });
  })
</script>


<!--<script>
  $(document).ready(() => {
    
      $(".money").keyup(function () {
        $('.money').cleanVal();
      });


  });
</script>-->
<!-- datatble 
<script type="text/javascript" src="{{asset('/')}}js/datatable.js"></script>
logic -->

</body>
</html>
