<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
$title = "Payment Receipt | NSUK-HMS";
include 'anotherhead.php';
$select = "SELECT payment_status FROM payment_history WHERE payment_status = 'Success'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$status = $row['payment_status'];
if ($status == 'Success') {
} else {
    echo '<script>        
    window.location.href = "dashboard.php";
            </script>';
}

$regno = $_SESSION['regno'];
$select = "SELECT * FROM registration WHERE regno = '$regno'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$invoice_number = $row['invoice_number'];
$fee = $row['fee'];
$building = $row['building'];
$room = $row['roomno'];
$seater = $row['seater'];

$select = "SELECT date_paid FROM payment_history WHERE reg_no='$regno'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$date_paid = $row['date_paid'];
$date = date("l, F j, Y | <b>H:i:sA</b>", strtotime($date_paid));
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
        <div class="student-profile py-4">
            <div class="card rounded p-4">

                <div id="receipt">
                    <div class="container">
                        <div class="row px-4 py-2">
                            <div class="col-md-2">
                                <center>
                                    <img src="../assets/images/logo.png" alt="">
                                </center>
                            </div>
                            <div class="col-md-8">
                                <center>
                                    <h2 style="font-weight:bolder; color:#18391A;">NASARAWA STATE UNIVERSITY, KEFFI</h2><br>
                                </center>
                                <center>
                                    <h4 style="font-weight:bolder; color:#18391A; margin-top:-20px;">HOSTEL MANAGEMENT SYSTEM</h4>
                                </center>
                            </div>
                            <div class="col-md-2">
                                <img class="profile_img img-fluid" src="data:image/jpeg;base64,<?php echo $passport; ?>" alt="student dp" width="100px">
                            </div>
                        </div>
                        <div class="row mb-4">

                            <div class="col-md-12">
                                <center>
                                    <h3 style="font-weight:bolder; color:#18391A;">Student Payment RECEIPT</h3>
                                </center>
                            </div>

                        </div>
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
                                <div class="col-lg-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="fas fa-address-book pr-1"></i>Personal Details</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="30%">Student Name</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo ucfirst(strtolower($row->lastName)) . " " . ucfirst(strtolower($row->firstName)); ?></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                    <th width="30%">Reg No</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->regNo; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Level </th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->level; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Invoice Number</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $invoice_number; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Amount Paid</th>
                                                    <td width="2%">:</td>
                                                    <td>&#8358;<?php echo number_format($fee); ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Date Paid</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $date; ?></td>
                                                </tr>


                                            </table>
                                        </div>
                                    </div>
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


                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Other Details</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="30%">Faculty</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->faculty; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Department </th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->department; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Gender</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->gender; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Tribe</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->tribe; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Email Address</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->email; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Phone Number</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->phone_number; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Contact in Case of Emergency</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->econtact; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Guardian Name</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->gname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Guardian Phone Number</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->gcontact; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Guardian Relationship</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $row->grelation; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">State of Origin</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo ucfirst(strtolower($row->state)); ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">LGA of Origin</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo ucfirst(strtolower($row->lga)); ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Address</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo ucwords(strtolower($row->address)); ?></td>
                                                </tr>
                                            <?php
                                        }
                                            ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="height: 26px"></div>
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="far fa-paper-plane pr-1"></i>Information</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            <p>Please take this Receipt with you to the Hostel in order to be verified by the Hall Administrator. Failure to do this will attract disqualification</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .student-profile .card {
                border-radius: 10px;
            }

            .student-profile .card .card-header .profile_img {
                width: 150px;
                height: 150px;
                object-fit: cover;
                margin: 10px auto;
                border: 10px solid #ccc;
                border-radius: 50%;
            }

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
        <center>
            <a href="dashboard.php" class="btn btn-danger">Go Back to Dashboard</a>
            <button class="btn btn-success" onclick="window.print();">Print Receipt</button>
        </center>

        <style>
            @media print {
                body * {
                    visibility: hidden;
                }

                #receipt,
                #receipt * {
                    visibility: visible;
                }


                #receipt {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
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