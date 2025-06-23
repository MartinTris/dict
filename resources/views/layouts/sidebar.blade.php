
<style>
/* Sidebar styles */
.navbar-nav.sidebar {
    background: #003566 !important; /* Set the main background color */
    background-image: none !important; /* Remove any gradient */
}

/* Sidebar brand (header) area */
.sidebar-brand {
    background: #003566 !important;
    color: white !important;
}

/* Links and items styling */
.nav-link,
.collapse-item {
    color: white !important;
    text-decoration: none !important;
}

.nav-link:hover,
.collapse-item:hover {
    background-color: #0056b3 !important;
    color: white !important;
}

/* Dropdown container background */
.collapse-inner {
    background-color: #003566 !important;
}

/* Dividers */
.sidebar-divider {
    border-top: 1px solid rgba(255, 255, 255, 0.15) !important;
}

/* Remove focus outline */
.nav-link:focus,
.collapse-item:focus {
    outline: none !important;
}

/* Override any existing gradient classes */
.bg-gradient-primary {
    background-color: #003566 !important;
    background-image: none !important;
}

/* Collapse menu background */
#sidebarMenu .collapse,
#sidebarMenu .collapsing {
    background-color: #003566 !important;
}
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark" id="sidebarMenu">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15"></div>
    <div class="sidebar-brand-text mx-3">DICT Monitoring System</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link custom-active" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Overview</span>
    </a>
  </li>


 

  <!-- Nav Item - Profile -->
  <li class="nav-item">
    <a class="nav-link custom-active" href="/profile">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Profile</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Sidebar - CREATE -->
  <li class="nav-item">
    <a class="nav-link collapsed custom-active" href="#" data-toggle="collapse" data-target="#collapseCreate" aria-expanded="false" aria-controls="collapseCreate">
      <span>CONNECT</span>
    </a>
    <div id="collapseCreate" class="collapse">
      <div class="collapse-inner">
        <a class="collapse-item custom-active" href="{{ route('nbp') }}">NBP</a>
        <a class="collapse-item custom-active" href="#">FW4A</a>
      </div>
    </div>
  </li>

  <!-- Sidebar - HARNESS -->
  <li class="nav-item">
    <a class="nav-link collapsed custom-active" href="#" data-toggle="collapse" data-target="#collapseHarness" aria-expanded="false" aria-controls="collapseHarness">
      <span>HARNESS</span>
    </a>
    <div id="collapseHarness" class="collapse">
      <div class="collapse-inner">
        <a class="collapse-item custom-active" href="#">ILCDB</a>
        <a class="collapse-item custom-active" href="#">SPARK</a>
        <a class="collapse-item custom-active" href="{{ route('tech4ed') }}">TECH4ED</a>
      </div>
    </div>
  </li>

  <!-- Sidebar - INNOVATE -->
  <li class="nav-item">
    <a class="nav-link collapsed custom-active" href="#" data-toggle="collapse" data-target="#collapseInnovate" aria-expanded="false" aria-controls="collapseInnovate">
      <span>INNOVATE</span>
    </a>
    <div id="collapseInnovate" class="collapse">
      <div class="collapse-inner">
        <a class="collapse-item custom-active" href="{{ route('bplo') }}">BPLO</a>
        <a class="collapse-item custom-active" href="{{ route('egov') }}">eGOV</a>
        <a class="collapse-item custom-active" href="{{ route('ibpls') }}">BPLS</a>
        <a class="collapse-item custom-active" href="#">IIDB</a>
      </div>
    </div>
  </li>

  <!-- Sidebar - PROTECT -->
  <li class="nav-item">
    <a class="nav-link collapsed custom-active" href="#" data-toggle="collapse" data-target="#collapseProtect" aria-expanded="false" aria-controls="collapseProtect">
      <span>PROTECT</span>
    </a>
    <div id="collapseProtect" class="collapse">
      <div class="collapse-inner">
      <a class="collapse-item custom-active" href="{{ route('gecs') }}">GECS</a>
        <a class="collapse-item custom-active" href="{{ route('cybersecurity') }}">Cybersecurity</a>
        <a class="collapse-item custom-active" href="{{ route('pnpki') }}">PNPKI</a>
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