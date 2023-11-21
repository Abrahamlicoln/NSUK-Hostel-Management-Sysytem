<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
$title = "Student Account | NSUK-HMS";
include 'includes/general.php';

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "DELETE from userregistration where id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
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
  title: 'Student Record Deleted Successfully'
})
        </script>";
    echo '<script>
            window.setTimeout(function() {
    window.location.href = "view-students-acc.php";
}, 2000);
            </script>';
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Student's Account</h4>
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

        <!-- Table Starts -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle">Displaying all the registered student's account.</h6>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                <thead class="thead-success text-white" style="background-color:#18A08B !important;">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Reg. No.</th>
                                        <th>Student's Name</th>
                                        <th>Gender</th>
                                        <th>Faculty</th>
                                        <th>Department</th>
                                        <th>Level</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $aid = $_SESSION['id'];
                                    $ret = "SELECT * from userregistration";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    $cnt = 1;
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt;; ?></td>
                                            <td><?php echo $row->regNo; ?></td>
                                            <td><?php echo $row->firstName; ?> <?php echo $row->middleName; ?> <?php echo $row->lastName; ?></td>
                                            <td><?php echo $row->gender; ?></td>
                                            <td><?php echo $row->faculty; ?></td>
                                            <td><?php echo $row->department; ?></td>
                                            <td><?php echo $row->level; ?></td>
                                            <td>
                                                <a href="view-students-acc.php?del=<?php echo $row->id; ?>" title="Delete Record" onclick="return confirm(" Do you want to delete");"><i class="icon-close" style="color:red;"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        $cnt = $cnt + 1;
                                    } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Ends -->

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
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

</body>

</html>