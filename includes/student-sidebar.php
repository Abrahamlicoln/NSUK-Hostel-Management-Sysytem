<!-- Sidebar navigation-->
<?php

$id = $_SESSION['id'];

$regno = $_SESSION['regno'];
include '../includes/dbconn.php';

?>
<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="dashboard.php" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">MENU</span></li>
        <?php
        $select = "SELECT date_start FROM date_amendment WHERE id = '1'";
        $query = mysqli_query($mysqli, $select);
        $row = mysqli_fetch_assoc($query);
        $start = $row['date_start'];

        // Compare the current time with the start date
        if (strtotime($start) <= time()) {
        ?>

            <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="book-hostel.php" aria-expanded="false">
                    <i class="fas fa-h-square"></i>
                    <span class="hide-menu">Book Hostel</span>
                </a>
            </li>

        <?php
        }
        ?>


        <?php
        $select = "SELECT payment_status FROM payment_history WHERE reg_no = '$regno' AND payment_status='Success'";
        $query = mysqli_query($mysqli, $select);
        if ($numRow = mysqli_num_rows($query) > 0) { ?>
            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="room-details.php" aria-expanded="false"><i class="fas fa-bed"></i><span class="hide-menu">My Room Details</span></a></li>
        <?php
        } else { ?>

        <?php
        }
        ?>
        <?php
        $select = "SELECT payment_status FROM payment_history WHERE reg_no = '$regno' AND payment_status='Success'";
        $query = mysqli_query($mysqli, $select);
        if ($numRow = mysqli_num_rows($query) > 0) { ?>
            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="paymentreceipts.php" aria-expanded="false"><i class="fas fa-credit-card"></i><span class="hide-menu">View Payment Receipt</span></a></li>
        <?php
        } else { ?>

        <?php
        }
        ?>

        <?php
        $select = "SELECT status_update FROM userregistration WHERE id = '$id' ";
        $query = mysqli_query($mysqli, $select);
        $row = mysqli_fetch_assoc($query);
        if ($row['status_update'] == '1') {
        } else { ?>

            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="update-details.php" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Update Details</span></a></li>
        <?php
        }
        ?>






    </ul>
</nav>

<!-- End Sidebar navigation -->