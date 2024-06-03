<header class="header header-sticky mb-4">
  <div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="#">
            
            </a>
    <ul class="header-nav d-none d-md-flex" style="display: none !important;">
      <li class="nav-item">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Settings</a>
      </li>
    </ul>
    
    <ul class="header-nav ms-auto" style="display: ;">
      <li class="nav-item">
        Hello, <?php echo $_SESSION['user_name']; ?>
      </li>
    </ul>
    
    <ul class="header-nav ms-3">
      <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button">
        <div class="avatar avatar-md">

          <svg class="icon icon-lg"><use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use></svg>
          <!--<img alt="user@email.com" class="avatar-img" src="assets/img/avatars/8.jpg">-->
        </div></a>
        <div class="dropdown-menu dropdown-menu-end pt-0">
          <div class="dropdown-header bg-light py-2">
            <div class="fw-semibold">
              Account
            </div>
          </div>
          

          <a class="dropdown-item" href="?logout"><svg class="icon me-2"><use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use></svg> Logout</a>
        </div>
      </li>
    </ul>
  </div>
  <div class="header-divider" style="display: none;"></div>
  <div class="container-fluid" style="display: none;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><span>Home</span>
        </li>
        <li class="breadcrumb-item active">
          <span>Dashboard</span>
        </li>
      </ol>
    </nav>
  </div>
</header>