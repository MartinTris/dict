<style>
  /* Sidebar styles */
  .navbar-nav.sidebar {
    background: #003566 !important;
    /* Set the main background color */
    background-image: none !important;
    /* Remove any gradient */
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

  /* Logo styles */
  .sidebar-logo-mini {
    display: none;
  }

  .sidebar-logo-full {
    display: inline;
  }

  .sidebar.toggled .sidebar-logo-full {
    display: none !important;
  }

  .sidebar.toggled .sidebar-logo-mini {
    display: inline !important;
  }
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark" id="sidebarMenu">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
    <span class="sidebar-brand-icon">
      <img src="{{ asset('images/DICTMS_Logo.png') }}" alt="DICT Monitoring System Logo" style="height: 80px;"
        class="sidebar-logo-full">
      <img src="{{ asset('images/DICT_Logo.png') }}" alt="DICT Logo" style="height: 50px; display: none;"
        class="sidebar-logo-mini">
    </span>
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

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Leave Record -->
  <li class="nav-item">
    <a class="nav-link custom-active" href="{{ route('employees.index')}}">
      <i class="fas fa-fw fa-circle-user"></i>
      <span>Profile</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Profile -->
  <li class="nav-item">
    <a class="nav-link custom-active" href="/profile">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Notifications</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Attendance Record -->
  <li class="nav-item">
    <a class="nav-link custom-active" href="{{ route('employees.index')}}">
      <i class="fas fa-fw fa-circle-user"></i>
      <span>Attendance</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Daily Time Record -->
  <li class="nav-item">
    <a class="nav-link custom-active" href="{{ route('employees.index')}}">
      <i class="fas fa-fw fa-circle-user"></i>
      <span>DTR</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Leave Record -->
  <li class="nav-item">
    <a class="nav-link custom-active" href="{{ route('employees.index')}}">
      <i class="fas fa-fw fa-circle-user"></i>
      <span>Leaves</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>