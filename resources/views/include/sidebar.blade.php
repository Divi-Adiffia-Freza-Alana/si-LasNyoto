<aside style="background:#3081D0!important;" class="main-sidebar elevation-4">
    <!-- Brand Logo -->
  <!-- <a href="index3.html" class="brand-link">
      <img src="{{asset('/')}}img/logowhite.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <div style="color:#fff;font-size:16px;font-weight:700;" class="text-center font-weight-light white">Admin</div>
    </a>-->
    <div style="display: flex; justify-content: center;"><img src="{{asset('/')}}img/logonyotopng.png" width="100px" height="100%" alt="Logo" ></img></div>
    <!--    <div style="color:#fff;font-size:16px;font-weight:700;" class="text-center font-weight-light white"><b>Admin</b></div>-->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div style="width:100% ;text-align: center; color:#ffff;" class="mb-1">Selamat Datang <?php echo auth()->user()->name?></div>
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div style="background:#f9f9f9;" class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

     
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Sidebar Menu Admin-->
          @hasrole('superadmin')
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/transaksi" class="nav-link">
              <i class=" nav-icon fa-solid fa-cart-shopping"></i>
              <p>
                Transaksi Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kurir" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Kurir 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kurir" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Marketing 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kurir" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Purchasing 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/users" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Pengguna 
              </p>
            </a>
          </li>
        @endhasrole

        <!-- Sidebar Menu Konsumen-->
        
        @hasrole('konsumen')
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class=" nav-icon fa-solid fa-box"></i>
            <p>
              Katalog Produk 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/transaksi-sph-customer" class="nav-link">
            <i class=" nav-icon fa-solid fa-file"></i>
            <p>
              SPH
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/transaksi-customer" class="nav-link">
            <i class=" nav-icon fa-solid fa-cart-shopping"></i>
            <p>
              Transaksi Customer
            </p>
          </a>
        </li>
        @endhasrole


      
        <!-- Sidebar Menu Staf Penjualan / Marketing-->
        @hasrole('marketing')
        <li class="nav-item">
          <a href="/transaksi-marketing" class="nav-link">
            <i class=" nav-icon fa-solid fa-cart-shopping"></i>
            <p>
              Transaksi Penjualan
            </p>
          </a>
        </li>
                  
        <li class="nav-item">
          <a href="/produk" class="nav-link">
            <i class=" nav-icon fa-solid fa-box"></i>
            <p>
              Produk 
            </p>
          </a>
        </li>
        @endhasrole
        <!-- Sidebar Menu Staf Pembelian -->
        @hasrole('purchasing')
        <!--<li class="nav-item">
          <a href="/suplier" class="nav-link">
            <i class=" nav-icon fa-solid fa-users"></i>
            <p>
              Suplier 
            </p>
          </a>
        </li>-->
        <li class="nav-item">
          <a href="/bahanbaku" class="nav-link">
            <i class="nav-icon fa-solid fa-toolbox"></i>
            <p>
              Bahan Baku 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/transaksi-suplier" class="nav-link">
            <i class=" nav-icon fa-solid fa-box"></i>
            <p>
              Belanja Bahan Baku 
            </p>
          </a>
        </li>
        @endhasrole

        <!-- Sidebar Pemilik -->
        @hasrole('owner')
  
 

        <li class="nav-item">
          <a href="/transaksi" class="nav-link">
            <i class=" nav-icon fa-solid fa-file"></i>
            <p>
              Laporan Penjualan
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/transaksi-suplier" class="nav-link">
            <i class=" nav-icon fa-solid fa-file"></i>
            <p>
              Laporan Bahan Baku
            </p>
          </a>
        </li>
        
        @endhasrole

        @hasrole('kurir')

        <li class="nav-item">
          <a href="/transaksi-kurir" class="nav-link">
            <i class=" nav-icon fa-solid fa-cart-shopping"></i>
            <p>
              Transaksi Pengiriman
            </p>
          </a>
        </li>
        @endhasrole

        <li class="nav-item">
          <a href="/logout" class="nav-link"> 
            <i class="nav-icon fa-solid fa-right-from-bracket"></i>
            <p>
              Logout 
            </p>
          </a>
        </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>