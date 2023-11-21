<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
date_default_timezone_set("Africa/Lagos");
?>

<?php
$title = "Other Services | NSUK-HMS";
include 'includes/general.php';
if (isset($_POST['submit'])) {
    $start_date = strtotime($_POST['start_date']);
    $end_date = strtotime($_POST['end_date']);
    $start_date = date('Y-m-d H:i:s', $start_date);
    $end_date = date('Y-m-d H:i:s', $end_date);

    $sql = "UPDATE date_amendment SET date_start = ?, date_end = ? WHERE id = '1'";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('ss', $start_date, $end_date);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->affected_rows;
    if ($row_cnt > 0) {
        echo "<script>
        
           const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Date Updated Successfully'
})


        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "dashboard.php";
}, 2000);
            </script>';
    } else {
        echo "<script>
        
           const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: 'Date Update Failed'
})


        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "otherservices.php";
}, 2000);
            </script>';
    }
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Other Services</h4>
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

        <form action="otherservices.php" method="POST">

            <div class="row">


                <div class=" col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">When Will Student Start Collecting Hostel?</h4>
                            <div class="form-group">
                                <input type="date" name="start_date" class="form-control" required>
                            </div>

                        </div>
                    </div>

                </div>
                <div class=" col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">When will the Collection of Hostel End</h4>
                            <div class="form-group">
                                <input type="date" name="end_date" class="form-control" required>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <div class="form-actions">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </div>

            </div>
        </form>


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