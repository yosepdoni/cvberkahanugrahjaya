<style>
.menu-item.active a {
  background-color: grey; 
  border-radius: 5px;
  color: white; 
  padding-right:10px ;
}


.menu-item a {
  padding: 5px;
  text-decoration: none;
  color: black;
}
.menu-icon {
  font-size: 20px;
  margin-right: 10px;
}
</style>
<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <li class="menu-item <?= $_GET['page'] == '' || $_GET['page'] == 'dashboard' ? 'active' : '' ?>">
                    <a href="?page=dashboard" class="menu-link m-3">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item <?= $_GET['page'] == 'kategori' ? 'active' : '' ?>">
                    <a href="?page=kategori" class="menu-link m-3">
                        <i class="menu-icon tf-icons bx bx-folder"></i>
                        <div data-i18n="Basic">Kategori</div>
                    </a>
                </li>
                <li class="menu-item <?= $_GET['page'] == 'supplier' ? 'active' : '' ?>">
                    <a href="?page=supplier" class="menu-link m-3">
                        <i class="menu-icon tf-icons bx bx-buildings"></i>
                        <div data-i18n="Basic">Supplier</div>
                    </a>
                </li>
                <li class="menu-item <?= $_GET['page'] == 'produk' ? 'active' : '' ?>">
                    <a href="?page=produk" class="menu-link m-3">
                        <i class="menu-icon tf-icons bx bx-box"></i>
                        <div data-i18n="Basic">Produk</div>
                    </a>
                </li>
                <li class="menu-item <?= $_GET['page'] == 'pelanggan' ? 'active' : '' ?>">
                    <a href="?page=pelanggan" class="menu-link m-3">
                        <i class="menu-icon tf-icons bx bx-user-pin"></i>
                        <div data-i18n="Basic">Pelanggan</div>
                    </a>
                </li>
                <li class="menu-item <?= $_GET['page'] == 'pesanan' ? 'active' : '' ?>">
                    <a href="?page=pesanan" class="menu-link m-3">
                        <i class="menu-icon tf-icons bx bx-gift"></i>
                        <div data-i18n="Basic">Pesanan</div>
                    </a>
                </li>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="assets/img/avatars/8.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="assets/img/avatars/8.png" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"><?= $_SESSION['nama'] ?></span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <span class="d-flex align-items-center align-middle">
                                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                    <span class="flex-grow-1 align-middle">Billing</span>
                                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                </span>
                            </a>
                        </li> -->
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="logout.php">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <!-- / Navbar -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->