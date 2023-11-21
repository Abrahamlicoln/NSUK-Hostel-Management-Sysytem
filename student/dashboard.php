<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
?>

<?php
$title = "Dashboard | NSUK-HMS";
include 'header-main.php';

$select = "SELECT date_start, date_end FROM date_amendment WHERE id = '1'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$end_date = $row['date_start'];
$main_end = $row['date_end'];

// Calculate the time difference between the current time and the end_date using PHP
$titles = "";
if (strtotime($end_date) <= time()) {
    $current_time = time();
    $time_diff = strtotime($main_end) - $current_time;
    $titles = "Hostel Booking will be Closed in";
    // Embed the time difference in a JavaScript variable
    echo "<script>
    var time_diff = $time_diff;
</script>";
} else {
    $current_time = time();
    $time_diff = strtotime($end_date) - $current_time;
    $titles = "Hostel Booking will be Available in";
    // Embed the time difference in a JavaScript variable
    echo "<script>
    var time_diff = $time_diff;
</script>";
}

?>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <?php include '../includes/greetings.php' ?>
                <div class="d-flex align-items-center">
                    <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                </div>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- *************************************************************** -->
        <!-- Start First Cards -->
        <!-- *************************************************************** -->
        <div class="row mb-4">
            <div class="col-md-12">
                <!-- Countdown 4-->
                <div class="rounded bg-gradient-4 text-white shadow p-1 py-5 text-center mb-2">
                    <p class="mb-3 font-weight-bold" style="margin-top:-20px;"><?php echo $titles; ?></p>
                    <div id="clock-c" class="countdown mb-0 py-1"></div>


                </div>
            </div>

        </div>
        <div class="card p-4 rounded">
            <div class="card-title">
                <h4><i>Instruction to Student</i></h4>
            </div>
            <div class="card-body">
                <li>Navigate to <i><b>Update Detail Menu</b></i> to Update your Information.</li>
                <li>After you Update your Information Successfully .</li>
                <li>Keep Monitorting the Hostel Booking Countdown to finish in order to Book for an Hostel.</li>
                <li>After you have luckily booked for Hostel you will have <b>One Hour</b> to Pay.</li>
                <li>After One Hour the Room will be allocated to another person else.</li>
            </div>
        </div>

        <!-- *************************************************************** -->
        <!-- End First Cards -->
        <!-- *************************************************************** -->
        <style>
            .sidebar-item .sidebar-link .sidebar-link .active {
                background-color: #18A08B !important;
            }
        </style>

    </div>


    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <?php include '../includes/footer.php' ?>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

<script>
    function updateCountdown() {
        if (time_diff > 0) {
            // Calculate the days, hours, minutes, and seconds remaining
            var days = Math.floor(time_diff / (60 * 60 * 24));
            var hours = Math.floor((time_diff % (60 * 60 * 24)) / (60 * 60));
            var minutes = Math.floor((time_diff % (60 * 60)) / 60);
            var seconds = Math.floor(time_diff % 60);

            // Update the innerHTML of the clock-c element with the countdown
            var countdownHtml = '<span class="h1 font-weight-bold">' + days + '</span> Days' +
                '<span class="h1 font-weight-bold">' + hours + '</span> Hr' +
                '<span class="h1 font-weight-bold">' + minutes + '</span> Min' +
                '<span class="h1 font-weight-bold">' + seconds + '</span> Sec';
            $('#clock-c').html(countdownHtml);

            // Decrement the time difference by 1 second
            time_diff--;

            // Schedule the next update in 1 second
            setTimeout(updateCountdown, 1000);
        }
    }

    // Call the updateCountdown function to start the countdown timer
    updateCountdown();
</script>










<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->

<script src="../dist/js/app-style-switcher.js"></script>
<script src="../dist/js/feather.min.js"></script>
<script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="../dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="../dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="../assets/extra-libs/c3/d3.min.js"></script>
<script src="../assets/extra-libs/c3/c3.min.js"></script>
<script src="../assets/libs/chartist/dist/chartist.min.js"></script>
<script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>

</html>