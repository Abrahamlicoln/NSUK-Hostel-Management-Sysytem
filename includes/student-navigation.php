<nav class="navbar top-navbar navbar-expand-md">
    <div class="navbar-header" data-logobg="skin6">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-brand">
            <!-- Logo icon -->
            <a href="dashboard.php">
                <b class="logo-icon">
                    <!-- Dark Logo icon -->
                    <img src="../assets/images/logo.png" alt="homepage" class="dark-logo" height="45" width="45" />
                    <!-- Light Logo icon -->
                    <img src="../assets/images/logo.png" alt="homepage" class="light-logo" height="45" width="45" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text" style="font-weight:800; color:#18A08B;">
                    <!-- dark Logo text -->
                    NSUK | HMS
                    <!-- Light Logo text -->

                </span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-left mr-auto ml-3 pl-1">

            <!-- ============================================================== -->
            <!-- create new IF REQUIRED-->
            <!-- ============================================================== -->

        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-right">

            <!-- ============================================================== -->
            <!-- User profile -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $aid = $_SESSION['id'];
                    $ret = "select * from userregistration where id=?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $aid);
                    $stmt->execute();
                    $res = $stmt->get_result();

                    while ($row = $res->fetch_object()) {
                        $passport = base64_encode($row->passport); // assuming the passport field contains the binary data of the image
                    ?>
                        <img src="data:image/jpeg;base64,<?php echo $passport; ?>" alt="user" class="rounded-circle" height="50" width="50">
                        <span class="ml-2 d-none d-lg-inline-block"><span></span> <span class="text-dark"><?php echo $row->firstName; ?></span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                    <?php
                    }
                    ?>
                </a>

                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                    <a class="dropdown-item" href="profile.php"><i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                        My Profile</a>


                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="acc-setting.php"><i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                        Account Setting</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                        Logout</a>


                </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile -->
            <!-- ============================================================== -->
        </ul>
    </div>
</nav>