
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Warkah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('warkah.show') }}" class="nav-link {{ request()->routeIs('warkah.show') ? 'active' : '' }}">
              <i class="fa fa-fw fa-cog nav-icon"></i>
              <p>Cari Document</p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="{{ route('warkah.create') }}" class="nav-link {{ request()->routeIs('warkah.create') ? 'active' : '' }}">
                <i class="fa fa-fw fa-desktop nav-icon"></i>
            
              <p>Submit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('warkah.index') }}" class="nav-link {{ request()->routeIs('warkah.index') ? 'active' : '' }}">
              <i class="fa fa-fw fa-book nav-icon"></i>
              <p>Pelaporan Dokumen</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>