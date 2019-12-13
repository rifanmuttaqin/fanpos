<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-cart-plus"></i>
        </div>
        <div class="sidebar-brand-text mx-3">FANPOS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Home -->
      <li class="nav-item <?= $active != 'home' ? '' : 'active' ?>">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Produk</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="{{route('product')}}">Daftar Produk</a>
            <a class="collapse-item" href="">Penyesuaian</a>
            <a class="collapse-item" href="">Pembelian</a>
            <!-- <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6> -->
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="">Penjualan</a>
            <a class="collapse-item" href="">Pembelian</a>
            <a class="collapse-item" href="">Pengembalian</a>
            <!-- <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6> -->
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Stock</span>
        </a>
        <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="">History</a>
            <!-- <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6> -->
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Promo Toko</span>
        </a>
        <div id="collapsePages4" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="">Diskon</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('customer-url') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Customer</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('supplier-url') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Supplier</span></a>
      </li>

      <!-- Nav Item - Customer -->
      <!-- <li class="nav-item <?= $active != 'customer' ? '' : 'active' ?>">
        <a class="nav-link" href="{{ route('customer-url') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>Customer</span></a>
      </li> -->

      <!-- Nav Item - Customer -->
      <!-- <li class="nav-item <?= $active != 'supplier' ? '' : 'active' ?>">
        <a class="nav-link" href="{{ route('supplier-url') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>Supplier</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengaturan
      </div>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Pengaturan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Pendukung</h6>
            <a class="collapse-item" href="{{ route('kategori-url') }}">Kategori</a>
            <a class="collapse-item" href="{{ route('satuan-url') }}">Satuan</a>
            <a class="collapse-item" href="">Tax / Pajak</a>
            <h6 class="collapse-header">Data Aplikasi</h6>
            <a class="collapse-item" href="{{ route('toko') }}">Toko</a>
            <a class="collapse-item" href="{{ route('employee') }}">Pegawai</a>
          </div>
        </div>
      </li>


      <!-- Heading -->
      <div class="sidebar-heading">
        Sistem
      </div>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-eye"></i>
          <span>Log Aktifitas</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="">Log Sistem</a>
            <a class="collapse-item" href="">Log Print Laporan</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>