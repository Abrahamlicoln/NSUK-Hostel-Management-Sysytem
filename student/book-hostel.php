<?php
session_start();
$regNo = $_SESSION['regno'];
$gender = $_SESSION['gender'];
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
date_default_timezone_set("Africa/Lagos");
$select = "SELECT date_start FROM date_amendment WHERE id = '1'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$start = $row['date_start'];

// Check if the start date is greater than the current time
if (strtotime($start) > time()) {

    echo '<script>    
    window.location.href = "dashboard.php";
          </script>';
}

$title = "Book Hostel | NSUK-HMS";
include 'header-main.php';
?>
<?php

$select = "SELECT * FROM payment_history WHERE reg_no = '$regNo'";
$query = mysqli_query($mysqli, $select);
if ($num = mysqli_num_rows($query) > 0) {
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
  title: 'You have Booked Hostel Already'
})


        </script>";
    echo '<script>    
    window.location.href = "dashboard.php";
          </script>';
}
if (isset($_POST['booked'])) {
    $building = filter_var(mysqli_real_escape_string($mysqli, $_POST['building']), FILTER_SANITIZE_STRING);
    $room = filter_var(mysqli_real_escape_string($mysqli, $_POST['room']), FILTER_SANITIZE_STRING);
    $_SESSION['building'] = $building;
    $_SESSION['room'] = $room;
    $select = "SELECT * FROM rooms WHERE building = '$building' AND room_no = '$room'";
    $query = mysqli_query($mysqli, $select);
    $row = mysqli_fetch_assoc($query);
    $room_full = $row['room_full'];
    $fee = $row['fees'];
    $_SESSION['fee'] = $fee;
    $_SESSION['building'] = $building;
    $_SESSION['room'] = $room;
    $new_room = $row['room_full'] + 1;
    $seater = $row['seater'];
    if ($room_full >= $seater) {
        echo "
        <script>
        Swal.fire(
        'Oops',
         'This Room is already fill up. Please Try Another Room',
        'error'
        )
        </script> 
        ";
    } else {
        $select = "SELECT * FROM registration WHERE building = '$building' AND roomno = '$room' ORDER BY id DESC LIMIT 1";
        $query = mysqli_query($mysqli, $select);
        $row = mysqli_fetch_assoc($query);
        $seaters = $row['seater'];
        date_default_timezone_set("Africa/Lagos");

        $current_date = new DateTime('now', new DateTimeZone('Africa/Lagos'));
        $one_hour_interval = new DateInterval('PT2H');
        $end_date = $current_date->add($one_hour_interval);
        $end_date =  $end_date->format('Y-m-d H:i:s');
        $invoice = rand(0000000000, 9999999999);
        $new_seater = $seaters + 1;
        $_SESSION['seater'] = $new_seater;
        $insert = "INSERT INTO registration(building,roomno,seater,regno,fee,invoice_number,have_booked,end_time,eligible) VALUES('$building','$room','$new_seater','$regNo',$fee,'$invoice','1','$end_date','1')";
        $query = mysqli_query($mysqli, $insert);
        if ($query) {
            $update = "UPDATE rooms SET room_full = '$new_room' WHERE building='$building' AND room_no = '$room'";
            $query = mysqli_query($mysqli, $update);
            if ($query) {
                $insert = "INSERT INTO switches(reg_no,no_book_again,show_booked,view_confirm) VALUES('$regNo','1','1','1')";
                $query = mysqli_query($mysqli, $insert);
                if ($query) {

                    echo "
        <script>
        Swal.fire(
        'Congratulation!!!',
         'This Room is Available. You will be Redirected to Confirmation Page Shortly.',
        'success'
        )
        </script> 
        ";
                    echo '<script>
            window.setTimeout(function() {
    window.location.href = "book-confirmation.php";
}, 2000);
            </script>';
                }
            }
        }
    }
}
if (isset($_POST['confirmation'])) {
    echo '<script>
    window.location.href = "book-confirmation.php";
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
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <form action="book-hostel.php" method="POST">

            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-3">Hostel Booking</h4>
            </div>
            <?php
            $select = "SELECT * FROM registration WHERE regno = '$regNo' AND eligible = '0'";
            $another_query = mysqli_query($mysqli, $select);
            if (mysqli_num_rows($another_query) > 0) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h3 style="color:red"> Sorry, You will not be able to Apply for Hostel this Session Again, Try Again in another Session</h3>
                        </center>
                    </div>
                </div>
                <?php

            } else {

                $select = "SELECT * FROM switches WHERE reg_no =  '$regNo' AND no_book_again = '1' AND show_booked = '1' AND view_confirm = '1' ";
                $query = mysqli_query($mysqli, $select);
                if (mysqli_num_rows($query) > 0) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <button type="submit" name="confirmation" class="btn btn-success">View Confirmation Page</button>
                            </center>
                        </div>
                    </div>


                <?php
                } else { ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Select Building</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" onchange="GetDetail(this.value)" name="building" required="required">
                                            <option value="">Select Building...</option>
                                            <?php
                                            if ($gender == "Male") { ?>
                                                <option value="New Boys Hostel">New Boys Hostel</option>
                                                <option value="Mande Boys Hostel">Mande Boys Hostel</option>
                                                <option value="Old Boys Hostel">Old Boys Hostel</option>

                                            <?php
                                            } elseif ($gender == "Female") { ?>

                                                <option value="New Girls Hostel">New Girls Hostel</option>

                                                <option value="Old Girls Hostel">Old Girls Hostel</option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Select Room</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="room" name="room" required="required">
                                            <option value="">Select Room...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <button type="submit" name="booked" class="btn btn-success">Check Availability</button>
                            </center>
                        </div>
                    </div>



            <?php
                }
            }
            ?>




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

<!-- Custom Ft. Script Lines -->

<script>
    // Send AJAX request to fetch.php
    function GetDetail(str) {
        var room = $("#room");
        room.prop('disabled', true); // disable the second select box
        room.html('<option value="">Select Room...</option>'); // show loading message
        $.ajax({
            url: "getroom.php",
            type: "POST",
            data: {
                building: str

            },
            success: function(response) {
                var myObj = JSON.parse(response);
                // Update the second select box
                room.prop('disabled', false);
                for (var i = 0; i < myObj.length; i++) {
                    var option = $('<option></option>').text(myObj[i]);
                    room.append(option);
                }
            }
        });
    }
</script>

</html>