<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="../../pages/dashboards/dashboard.html">
          {{-- <img src="../../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> --}}
          <div class="text-center" style="width: 40px;">
            <h3>DAGKOP SYSTEM</h3>
            <br>
            <p style="font-size: 9px; margin-top: -40px;">Dinas Perdagangan, Koperasi Dan UKM</p>
          </div>
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="/admin">
                    <i class="ni ni-laptop text-primary"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            {!! MenuLib::getRole(Auth::user()->getRoleNames()) !!}
          </ul>
        </div>
      </div>
    </div>
  </nav>
