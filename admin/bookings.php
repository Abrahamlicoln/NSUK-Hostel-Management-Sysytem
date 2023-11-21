<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

?>

<?php
$title = "Student Hostel Booking | NSUK-HMS";
include 'includes/general.php';
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Student Hostel Booking</h4>
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

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                <thead class="thead-success text-white" style="background-color:#18A08B !important;">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Passport</th>
                                        <th>Names</th>
                                        <th>Reg. Number</th>
                                        <th>Building</th>
                                        <th>Room No.</th>
                                        <th>Bulk No</th>
                                        <th>Amount Paid</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select = "SELECT r.*, u.* FROM registration r
           INNER JOIN userregistration u ON r.regno = u.regNo";
                                    $query = mysqli_query($mysqli, $select);
                                    if (mysqli_num_rows($query) > 0) {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $i++;
                                            $passport = base64_encode($row['passport']); // assuming the passport field contains the binary data of the image
                                            $phone_number = $row['phone_number'];
                                            $email_addess = $row['email'];
                                            $state = $row['state'];
                                            $firstname = $row['firstName'];
                                            $building = $row['building'];
                                            $roomno = $row['roomno'];
                                            $seater = $row['seater'];
                                            $regno = $row['regNo'];
                                            $amount_paid = $row['fee'];
                                            $lastname = $row['lastName'];
                                    ?>
                                            <td><?php echo $i; ?></td>
                                            <td>

                                                <img src="data:image/jpeg;base64,<?php echo $passport; ?>" alt="user" class="rounded-circle" width="45" height="45" />
                                            </td>
                                            <td><?php echo ucfirst(strtolower($lastname)) . " " . ucfirst(strtolower($firstname)); ?></td>
                                            <td><?php echo $regno; ?></td>
                                            <td><?php echo $building; ?></td>
                                            <td><?php echo $roomno; ?></td>
                                            <td><?php echo $seater; ?></td>
                                            <td>&#8358;<?php echo number_format($amount_paid); ?></td>

                                            <td><a href="view_student.php?id=<?php echo $regno; ?>" class="btn btn-secondary">View</a>

                                            </td>
                                            </tr>
                                    <?php

                                        }
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