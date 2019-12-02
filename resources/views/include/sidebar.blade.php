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
          <span>Master</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="{{ route('customer-url') }}">Customer</a>
            <a class="collapse-item" href="{{ route('supplier-url') }}">Supplier</a>
            <a class="collapse-item" href="{{ route('kategori-url') }}">Kategori</a>
            <a class="collapse-item" href="{{ route('satuan-url') }}">Satuan</a>
            <!-- <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6> -->
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Transaksi</span></a>
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

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Pengaturan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan</h6>
            <a class="collapse-item" href="utilities-color.html">Global</a>
            <a class="collapse-item" href="utilities-border.html">Log Sistem</a>
            <a class="collapse-item" href="utilities-animation.html">Pengguna</a>
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