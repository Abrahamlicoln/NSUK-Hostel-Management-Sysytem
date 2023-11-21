<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');

$regno = $_SESSION['regno'];
$select = "SELECT * FROM userregistration WHERE regNo = '$regno'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
date_default_timezone_set("Africa/Lagos");
$email_address = $row['email'];
$phone_number = $row['phone_number'];
$firsname = $row['firstName'];
$lastname = $row['lastName'];
$select = "SELECT * FROM registration WHERE regno = '$regno'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$fee = $row['fee'];
$building = $row['building'];
$room = $row['roomno'];
$new_seater = $row['seater'];
$invoice = $row['invoice_number'];
$select = "SELECT payment_status FROM payment_history WHERE reg_no = '$regno'";
$query = mysqli_query($mysqli, $select);
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $status = $row['payment_status'];
        // Check if the start date is greater than the current time
        if ($status === "Success") {

            echo '<script>    
    window.location.href = "dashboard.php";
          </script>';
        }
    }
}
$select = "SELECT end_time FROM registration WHERE regno = '$regno'";
$query = mysqli_query($mysqli, $select);
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $end_time = $row['end_time'];
        $end_time = strtotime($end_time);
        // Check if the end date is greater than the current time
        if ($end_time <= time()) {
            $update = "UPDATE registration SET eligible = '0' WHERE regno = '$regno'";
            $main_query = mysqli_query($mysqli, $update);
            if ($main_query) {
                // Redirect to dashboard
                header('Location: dashboard.php');
                exit;
            }
        }
    }
}

check_login();
date_default_timezone_set("Africa/Lagos");
$title = "Book Confirmation | NSUK-HMS";
include 'header-main.php';
$select = "SELECT end_time FROM registration WHERE regno = '$regno'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$end_time = $row['end_time'];
$start_date = new DateTime('now', new DateTimeZone('Africa/Lagos'));
$end_date = new DateTime($end_time, new DateTimeZone('Africa/Lagos'));
$new_fee = $fee * 100;
$interval = $end_date->diff($start_date);
$hours_diff = $interval->h;
$minutes_diff = $interval->i;
$seconds_diff = $interval->s;

// Embed the time difference in a JavaScript variable
echo "<script>var time_diff = " . ($hours_diff * 3600 + $minutes_diff * 60 + $seconds_diff) . ";</script>";

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


        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-3">Booking Hostel Confirmation</h4>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="p-1">
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


                            ?>
                                <center>
                                    <img src="data:image/jpeg;base64,<?php echo $passport; ?>" alt="user" class="rounded-circle" height="150" width="150">

                                    <div class="mt-3">
                                        <p style="font-weight:bolder; font-size:18px;"><?php echo ucfirst(strtolower($row->lastName)) . " " . ucfirst(strtolower($row->firstName)); ?></p>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-truncate"><?php echo ucwords(strtolower($row->department)); ?></p>
                                    </div>
                                    <div class="mt-3">
                                        <p class=""><?php echo ucfirst(strtolower($row->level)); ?></p>
                                    </div>

                                    <div class="mt-3">
                                        <a href="#" class="btn btn-success">Verify Payment</a>
                                    </div>

                                </center>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <p>You are very lucky to get this Room. If you are unable to pay before the countdown (time) finish you will not be able to apply for Hostel again. Thank you</p>
                                    <tr>
                                        <td><b>Email Address</b></td>
                                        <td><?php echo $email_address; ?></td>


                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number</b></td>
                                        <td><?php echo $phone_number; ?></td>

                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><b>Building</b></td>
                                        <td><?php echo $building; ?></td>

                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Room Number</b></td>
                                        <td><?php echo $room; ?></td>

                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Assigned Bunk</b></td>
                                        <td><?php echo $new_seater; ?></td>

                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Amount to Pay</b></td>
                                        <td>&#8358;<?php echo number_format($fee); ?></td>

                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Invoice Number</b></td>
                                        <!-- HTML -->
                                        <td class="mt-1">
                                            <div id="invoice-number" style="display: inline;"><?php echo $invoice; ?></div>
                                            <button id="copy-button" class="btn btn-success btn-sm" style="display: inline; margin-left: 10px;">Copy</button>
                                        </td>


                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>You are to Make Payment in </b></td>
                                        <td>
                                            <center>
                                                <div id="clock-c" class=" count mb-0 py-1 px-1"></div>
                                            </center>
                                            <style>
                                                .count {
                                                    background-color: #22CA80;
                                                    color: white;
                                                    border-radius: 10px;

                                                }
                                            </style>
                                        </td>
                                        <td></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-12">
                <center>
                    <button type="button" onclick="payWithPaystack()" class="btn btn-success">Proceed Now</button>
                    <script src="https://js.paystack.co/v1/inline.js"></script>
                </center>
                <script>
                    function payWithPaystack() {
                        var handler = PaystackPop.setup({
                            key: 'pk_test_8576502f170eb999a5fb199dcd52503b766b9790',
                            email: '<?php echo $email_address; ?>',
                            amount: <?php echo $new_fee; ?>,
                            currency: "NGN",
                            ref: "<?php echo $invoice; ?>",
                            firstname: "<?php echo $firsname; ?>",
                            lastname: "<?php echo $lastname; ?>",
                            metadata: {
                                custom_fields: [{
                                    display_name: "<?php echo $lastname . " " . $firsname; ?>",
                                    variable_name: "<?php $phone_number; ?>",
                                    value: "<?php echo $phone_number; ?>"
                                }]

                            },
                            callback: function(response) {
                                const referenced = response.reference;
                                window.location.href = 'paymentreceipt.php?succesfullypaid=' + referenced;
                            },
                            onClose: function() {
                                alert('You are about to Cancelled this Payment.');
                            },

                        });
                        handler.openIframe();
                    }
                </script>


            </div>

        </div>


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

<!-- Custom Ft. Script Lines -->
<script>
    function updateCountdown() {
        if (time_diff > 0) {
            var time_diff_in_seconds = time_diff;
            var days = Math.floor(time_diff_in_seconds / (60 * 60 * 24));
            time_diff_in_seconds -= days * 60 * 60 * 24;
            var hours = Math.floor(time_diff_in_seconds / (60 * 60));
            time_diff_in_seconds -= hours * 60 * 60;
            var minutes = Math.floor(time_diff_in_seconds / 60);
            time_diff_in_seconds -= minutes * 60;
            var seconds = Math.floor(time_diff_in_seconds);

            // Update the innerHTML of the clock-c element with the countdown
            var countdownHtml = '';
            if (days > 0) {
                countdownHtml += '<span class="h3 mx-1 font-weight-bold">' + days + '</span>Day';
            }
            countdownHtml += '<span class="h3 mx-1 font-weight-bold">' + hours + '</span>Hour' +
                '<span class="h3 mx-1 font-weight-bold">' + minutes + '</span>Min' +
                '<span class="h3 mx-1 font-weight-bold">' + seconds + '</span>Sec';
            $('#clock-c').html(countdownHtml);

            // Decrement the time difference by 1 second
            time_diff--;

            // Schedule the next update in 1 second
            setTimeout(updateCountdown, 1000);
        } else {
            alert("Sorry, Time Up, Try Again Next Session");
            window.location.replace('dashboard.php');
        }
    }
    // Call the updateCountdown function to start the countdown timer
    updateCountdown();



    // JavaScript
    const invoiceNumber = document.getElementById("invoice-number");
    const copyButton = document.getElementById("copy-button");

    copyButton.addEventListener("click", function() {
        const tempInput = document.createElement("input");
        tempInput.value = invoiceNumber.innerText;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Invoice number copied to clipboard!");
    });
</script>






</html>