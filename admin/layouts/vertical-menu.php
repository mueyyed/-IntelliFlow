<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?= $_ENV['APP_URL'] ?>index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= $_ENV['APP_URL'] ?>assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= $_ENV['APP_URL'] ?>assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">INTELLIFLOW</span>
                    </span>
                </a>

                <a href="<?= $_ENV['APP_URL'] ?>index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= $_ENV['APP_URL'] ?>assets/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= $_ENV['APP_URL'] ?>assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">INTELLIFLOW</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">


            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end"
                        id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="https://ui-avatars.com/api/?name=<?= $_SESSION['username'] ?>"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= $_SESSION['username'] ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= $_ENV['APP_URL'] ?>logout.php"><i
                                class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>
                <li>
                    <a href="<?= $_ENV['APP_URL'] ?>proposes" class="">
                        <i class="mdi mdi-clipboard-check"></i>
                        <span data-key="t-horizontal">Proposes</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $_ENV['APP_URL'] ?>reports" class="">
                        <i class="mdi mdi-file-document"></i>
                        <span data-key="t-horizontal">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= $_ENV['APP_URL'] ?>users">All users</a></li>
                        <li><a href="<?= $_ENV['APP_URL'] ?>users/new.php">Add new user</a></li>
                    </ul>
                </li>
            </ul>

            
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
