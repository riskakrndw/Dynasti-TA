<!-- header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('beranda')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>IC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Dynasti </b>Ice Cream</span>
    </a>
    
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>

            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              
                <p>
                  {{Auth::user()->name}}
                  @if(Auth::user()->level == "manager")
                  <small>Bagian Manager</small>
                  @elseif(Auth::user()->level == "pengadaan")
                  <small>Bagian Pengadaan</small>
                  @elseif(Auth::user()->level == "produksi")
                  <small>Bagian Produksi</small>
                  @elseif(Auth::user()->level == "keuangan")
                  <small>Bagian Keuangan</small>
                  @endif
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('profilman')}}" class="btn btn-default btn-flat fa fa-user">  Profil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat fa fa-power-off" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"> Keluar</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      
    </nav>
  </header>
<!-- /header -->