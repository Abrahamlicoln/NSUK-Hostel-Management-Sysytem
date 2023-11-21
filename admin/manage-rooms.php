<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "DELETE from rooms where id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Record has been deleted');</script>";
}
?>

<?php
$title = "Manage Room | NSUK-HMS";
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Rooms Management</h4>
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
                                        <th>Bulding</th>
                                        <th>Room No.</th>
                                        <th>Seater</th>
                                        <th>Hostel Fee</th>
                                        <th>Published On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $aid = $_SESSION['id'];
                                    $ret = "SELECT * from rooms";
                                    $stmt = $mysqli->prepare($ret);
                                    //$stmt->bind_param('i',$aid);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    $cnt = 1;
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt;; ?></td>
                                            <td><?php echo $row->building; ?></td>
                                            <td><?php echo $row->room_no; ?></td>
                                            <td><?php echo $row->seater; ?></td>
                                            <td>&#8358;<?php echo number_format($row->fees); ?></td>
                                            <td><?php echo $row->posting_date; ?></td>
                                            <td><a href="edit-room.php?id=<?php echo $row->id; ?>" title="Edit"><i class="icon-note"></i></a>&nbsp;&nbsp;
                                                <a href="manage-rooms.php?del=<?php echo $row->id; ?>" title="Delete" onclick="return confirm(" Do you want to delete");"><i class="icon-close" style="color:red;"></i></a>
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