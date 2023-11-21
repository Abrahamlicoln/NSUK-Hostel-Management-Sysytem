<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
?>

<?php
$title = "Add Room | NSUK-HMS";
include 'includes/general.php';
if (isset($_POST['submit'])) {
    $building = $_POST['building'];
    $seater = $_POST['seater'];
    $roomno = $_POST['rmno'];
    $fees = $_POST['fee'];
    $sql = "SELECT building,room_no FROM rooms where building=? AND room_no=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('si', $building, $roomno);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->num_rows;;
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
  icon: 'error',
  title: 'Room Already Exist'
})


        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "add-rooms.php";
}, 2000);
            </script>';
    } else {
        $query = "INSERT into  rooms (building,seater,room_no,fees) values(?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('siii', $building, $seater, $roomno, $fees);
        $stmt->execute();
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
  title: 'New Room Added Successfully'
})
        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "add-rooms.php";
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Rooms</h4>
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

        <form method="POST">

            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bulding</h4>
                            <div class="form-group mb-4">
                                <select class="custom-select mr-sm-2" id="seater" name="building" required="required">
                                    <option value="">Select Building...</option>
                                    <option value="New Girls Hostel">New Girls Hostel</option>
                                    <option value="New Boys Hostel">New Boys Hostel</option>
                                    <option value="Old Girls Hostel">Old Girls Hostel</option>
                                    <option value="Mande Boys Hostel">Mande Boys Hostel</option>
                                    <option value="Old Boys Hostel">Old Boys Hostel</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Room Number</h4>
                            <div class="form-group">
                                <input type="text" name="rmno" placeholder="Enter Room Number" id="rmno" class="form-control" required>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Seater</h4>
                            <div class="form-group mb-4">
                                <select class="custom-select mr-sm-2" id="seater" name="seater" required="required">
                                    <option value="">Select Seater...</option>
                                    <option value="1">Single Seater</option>
                                    <option value="2">Two Seater</option>
                                    <option value="3">Three Seater</option>
                                    <option value="4">Four Seater</option>
                                    <option value="5">Five Seater</option>
                                    <option value="6">Six Seater</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Enter Room Fee (&#8358;)</h4>
                            <div class="form-group">
                                <input type="number" name="fee" id="fee" placeholder="Enter Total Fees" required="required" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>



            </div>


            <div class="form-actions">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success">Insert</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
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