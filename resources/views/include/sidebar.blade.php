<aside style="background:#3081D0!important;" class="main-sidebar elevation-4">
    <!-- Brand Logo -->
  <!-- <a href="index3.html" class="brand-link">
      <img src="{{asset('/')}}img/logowhite.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <div style="color:#fff;font-size:16px;font-weight:700;" class="text-center font-weight-light white">Admin</div>
    </a>-->
    <div style="display: flex; justify-content: center;"><img src="{{asset('/')}}img/" width="100px" height="100%" ></img></div>
    <!--    <div style="color:#fff;font-size:16px;font-weight:700;" class="text-center font-weight-light white"><b>Admin</b></div>-->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div style="background:#f9f9f9;" class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @hasrole('superadmin')
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        @endhasrole
          <!--<li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" nav-icon fa-solid fa-paw"></i>
              <p>
                Satwa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/satwa" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Data Satwa Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/satwamutasi" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Data Satwa Keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/satwamati" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Data Satwa Kematian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/mastersatwa" class="nav-link">
                  <i class="fa-solid fa-database nav-icon"></i>
                  <p>Master Satwa</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/kandang" class="nav-link">
              <i class="nav-icon fa-solid fa-door-closed"></i>
              <p>
              Kandang 
              </p>
            </a>
          </li>-->
         <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" nav-icon fa-solid fa-door-closed"></i>
              <p>
                Kandang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/satwa" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Data Satwa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/satwa" class="nav-link">
                  <i class="fa-solid fa-database nav-icon"></i>
                  <p>Master Satwa</p>
                </a>
              </li>
            </ul>
          </li>-->
         
         <!-- <li class="nav-item">
            <a href="{{ url('zona') }}" class="nav-link">
              <i class="nav-icon fa-solid fa-location-dot"> </i>
              <p>
                Zona 
              </p>
            </a>
          </li>-->
        

          <!--@hasrole('superadmin')
          <li class="nav-item">
            <a href="{{ url('zona') }}" class="nav-link">
              <i class="nav-icon fa-solid fa-location-dot"> </i>
              <p>
                Zona 
              </p>
            </a>
          </li>
          @endhasrole-->
          <!--<li class="nav-item">
            <a href="{{ url('keeper') }}" class="nav-link">
              <i class="nav-icon fa-solid fa-user"></i>
              <p>
                Keeper 
              </p>
            </a>
          </li>-->
          @hasrole('superadmin')
        <!--  <li class="nav-item">
            <a href="/menu" class="nav-link">
              <i class="nav-icon fa-solid fa-utensils"></i>
              <p>
                Menu 
              </p>
            </a>
          </li>
         

          <li class="nav-item">
            <a href="/bagdapur" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Bag Dapur 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/pelayan" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Pelayan 
              </p>
            </a>
          </li>-->

          <li class="nav-item">
            <a href="/suplier" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Suplier 
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
          <li class="nav-item">
            <a href="/transaksi-suplier" class="nav-link">
              <i class=" nav-icon fa-solid fa-box"></i>
              <p>
                Belanja Bahan Baku 
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
          @endhasrole
          <!--<li class="nav-item">
            <a href="index.html" class="nav-link">
              <i class=" nav-icon fa-solid fa-gear"></i>
              <p>
                Settings 
              </p>
            </a>
          </li>-->
          @hasrole('superadmin')
     
          <li class="nav-item">
            <a href="/users" class="nav-link">
              <i class=" nav-icon fa-solid fa-users"></i>
              <p>
                Pengguna 
              </p>
            </a>
          </li>
          @endhasrole
          <!--<li class="nav-item">
            <a href="/meja" class="nav-link">
              <i class=" nav-icon fa-solid fa-table"></i>
              <p>
                Meja 
              </p>
            </a>
          </li>
      
            <li class="nav-item">
            <a href="/transaksi" class="nav-link">
              <i class=" nav-icon fa-solid fa-cart-shopping"></i>
              <p>
                Transaksi 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/bahanbaku" class="nav-link">
              <i class="nav-icon fa-solid fa-bowl-food"></i>
              <p>
                Bahan Baku 
              </p>
            </a>
          </li>-->
          @hasrole('superadmin')

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