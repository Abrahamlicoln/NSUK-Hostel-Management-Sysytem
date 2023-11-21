<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
$title = "Room Details | NSUK-HMS";
include 'header-main.php';
$select = "SELECT payment_status FROM payment_history WHERE payment_status = 'Success'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$status = $row['payment_status'];
$regno = $_SESSION['regno'];
$select = "SELECT * FROM registration WHERE regno = '$regno'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$invoice_number = $row['invoice_number'];
$fee = $row['fee'];
$building = $row['building'];
$room = $row['roomno'];
$seater = $row['seater'];
?>

<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <h3 style="margin-top:-70px;">My Room Details</h3>
        <div class="student-profile py-4">
            <div class="card rounded p-4">

                <div id="receipt">
                    <?php
                    $aid = $_SESSION['id'];
                    $ret = "select * from userregistration where id=?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $aid);
                    $stmt->execute();
                    $res = $stmt->get_result();

                    while ($row = $res->fetch_object()) {
                        $passport = base64_encode($row->passport); // assuming the passport field contains the binary data of the image
                        $gender = $row->gender;
                        $phone_number = $row->phone_number;
                        $email_address = $row->email;
                        $firstname = $row->firstName;
                        $lastname = $row->lastName;

                    ?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="card shadow-sm">
                                    <div class="card-header bg-transparent border-0">
                                        <h3 class="mb-0"><i class="far fa-building pr-1"></i>Room Details</h3>
                                    </div>
                                    <div class="card-body pt-0">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%">Building</th>
                                                <td width="2%">:</td>
                                                <td><?php echo $building; ?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Room Number </th>
                                                <td width="2%">:</td>
                                                <td><?php echo $room; ?></td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Bunk No</th>
                                                <td width="2%">:</td>
                                                <td><?php echo $seater; ?></td>
                                            </tr>
                                        <?php

                                    }
                                        ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <h4 class="card-title">My Room mate</h4>

                                        </div>
                                        <div class="table-responsive">
                                            <table class="table no-wrap v-middle mb-0">
                                                <thead>
                                                    <tr class="border-0">
                                                        <th class="border-0 font-14 font-weight-medium text-muted">Name/Email
                                                        </th>
                                                        <th class="border-0 font-14 font-weight-medium text-muted px-2">Phone Number
                                                        </th>
                                                        <th class="border-0 font-14 font-weight-medium text-muted">State of Origin</th>

                                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                            Actions
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $select = "SELECT r.*, u.* FROM registration r
           INNER JOIN userregistration u ON r.regno = u.regNo
           WHERE r.building = '$building' AND r.roomno = '$room' AND r.regno <> '$regno'";
                                                    $query = mysqli_query($mysqli, $select);

                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            $passport = base64_encode($row['passport']); // assuming the passport field contains the binary data of the image
                                                            $phone_number = $row['phone_number'];
                                                            $email_addess = $row['email'];
                                                            $state = $row['state'];
                                                            $firstname = $row['firstName'];
                                                            $lastname = $row['lastName'];
                                                    ?>

                                                            <tr>
                                                                <td class="border-top-0 px-2 py-4">
                                                                    <div class="d-flex no-block align-items-center">
                                                                        <div class="mr-3"><img src="data:image/jpeg;base64,<?php echo $passport; ?>" alt="user" class="rounded-circle" width="45" height="45" /></div>
                                                                        <div class="">
                                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium"><?php echo ucfirst(strtolower($lastname)) . " " . ucfirst(strtolower($firstname)); ?></h5>
                                                                            <span class="text-muted font-14"><?php echo $email_addess; ?></span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="border-top-0 text-muted px-2 py-4 font-14"><?php echo $phone_number; ?></td>
                                                                <td class="border-top-0 text-muted px-2 py-4 font-14"><?php echo ucfirst(strtolower($state)); ?></td>


                                                                <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">

                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <a href="tel:<?php echo $phone_number; ?>" class="btn btn-success mb-2 px-2"><i class="fas fa-phone "></i></a>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <a href="https://wa.me/+234<?php echo $phone_number; ?>" target="_blank" class="btn btn-success px-2"><i class="fab fa-whatsapp "></i></a>
                                                                        </div>
                                                                    </div>



                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <style>
            .student-profile .card h3 {
                font-size: 20px;
                font-weight: 700;
            }

            .student-profile .card p {
                font-size: 16px;
                color: #000;
            }

            .student-profile .table th,
            .student-profile .table td {
                font-size: 14px;
                padding: 5px 10px;
                color: #000;
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
<script>
    function printReceipt() {
        var receiptContent = document.getElementById("receipt").innerHTML;
        window.print(receiptContent);
    }
</script>
</body>

<!-- Custom Ft. Script Lines -->






</html>