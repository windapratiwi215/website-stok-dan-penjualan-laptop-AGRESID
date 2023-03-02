<aside class="sidenav z-index-1 bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="./index.php" target="_blank">
      <img src="./assets/img/logoagresid.png" class="navbar-brand-img h-100 ps-5" alt="main_logo">
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link " href="./index.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tachometer-alt text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./menu-stok.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-laptop text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Daftar Stok</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./menu-penjualan.php">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-box-open text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Daftar Penjualan</span>
        </a>
      </li>
    </ul>
    <script>
        const currentLoc = location.href;
        const menuItem = document.querySelectorAll('a');
        const iconMenu = document.querySelectorAll('i');
        const menuLength = menuItem.length;
        for (let i=0; i<menuLength;i++){
            if(menuItem[i].href === currentLoc){
                menuItem[i].className += "active"
                iconMenu[i].classList.remove('text-secondary');
                iconMenu[i].classList.add('text-dark');
            }
        }
    </script>
  </div>
</aside>