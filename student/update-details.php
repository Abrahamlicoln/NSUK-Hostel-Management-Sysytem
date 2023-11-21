<?php
session_start();


include('../includes/dbconn.php');

$select = "SELECT status_update FROM userregistration WHERE id = '" . $_SESSION['id'] . "'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
if ($row['status_update'] == '1') {
    echo '<script>    
    window.location.href = "dashboard.php";
            </script>';
}
include('../includes/check-login.php');
$title = "Update Student Info | NSUK-HMS";
include 'header-main.php';
check_login();
if (isset($_POST['submit'])) {
    $registration = filter_var(mysqli_real_escape_string($mysqli, $_POST['regno']), FILTER_SANITIZE_STRING);
    $gender = filter_var(mysqli_real_escape_string($mysqli, $_POST['gender']), FILTER_SANITIZE_STRING);
    $contact = filter_var(mysqli_real_escape_string($mysqli, $_POST['contact']), FILTER_SANITIZE_STRING);
    $econtact = filter_var(mysqli_real_escape_string($mysqli, $_POST['econtact']), FILTER_SANITIZE_STRING);
    $tribe = filter_var(mysqli_real_escape_string($mysqli, $_POST['tribe']), FILTER_SANITIZE_STRING);
    $gname = filter_var(mysqli_real_escape_string($mysqli, $_POST['gname']), FILTER_SANITIZE_STRING);
    $grelation = filter_var(mysqli_real_escape_string($mysqli, $_POST['grelation']), FILTER_SANITIZE_STRING);
    $gcontact = filter_var(mysqli_real_escape_string($mysqli, $_POST['gcontact']), FILTER_SANITIZE_STRING);
    $state = filter_var(mysqli_real_escape_string($mysqli, $_POST['state']), FILTER_SANITIZE_STRING);
    $lga = filter_var(mysqli_real_escape_string($mysqli, $_POST['lga']), FILTER_SANITIZE_STRING);
    $address = filter_var(mysqli_real_escape_string($mysqli, $_POST['address']), FILTER_SANITIZE_STRING);
    $p_address = filter_var(mysqli_real_escape_string($mysqli, $_POST['p_address']), FILTER_SANITIZE_STRING);

    $update = "UPDATE userregistration SET gender = '$gender', phone_number ='$contact', econtact='$econtact', tribe = '$tribe', gname = '$gname', grelation='$grelation', gcontact = '$gcontact', state = '$state', lga = '$lga', address = '$address', p_address = '$p_address', status_update = '1' WHERE regNo = '$registration'";
    $query = mysqli_query($mysqli, $update);
    if ($query) {

        echo '<script>
    window.location.href = "dashboard.php";
            </script>';
    }
}
?>
<?php
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://locus.fkkas.com/api/states",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);
$state = json_decode($response, true);


$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
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

        <form method="POST">

            <h4 class="card-title mt-5">Student's Personal Information</h4>
            <div class="py-3">
                <p class="text-muted">Please make SURE you crosscheck all your Information before Submiting. Biodata can only be Updated Onces</p>
            </div>
            <div class="row">

                <?php
                $aid = $_SESSION['id'];
                $ret = "select * from userregistration where id=?";
                $stmt = $mysqli->prepare($ret);
                $stmt->bind_param('i', $aid);
                $stmt->execute();
                $res = $stmt->get_result();
                while ($row = $res->fetch_object()) {
                ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Registration Number</h4>
                                <div class="form-group">
                                    <input type="text" name="regno" id="regno" value="<?php echo $row->regNo; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">First Name</h4>
                                <div class="form-group">
                                    <input type="text" name="fname" id="fname" value="<?php echo $row->firstName; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Middle Name</h4>
                                <div class="form-group">
                                    <input type="text" name="mname" id="mname" value="<?php echo $row->middleName; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Last Name</h4>
                                <div class="form-group">
                                    <input type="text" name="lname" id="lname" value="<?php echo $row->lastName; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Email</h4>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" value="<?php echo $row->email; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Gender</h4>
                                <div class="form-group">
                                    <select name="gender" required id="" class="form-control">
                                        <option value="">---Select Gender-----</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Phone Number</h4>
                                <div class="form-group">
                                    <input type="number" required name="contact" id="contact" placeholder="Format: 07012345678" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Emergency Contact Number</h4>
                            <div class="form-group">
                                <input type="number" name="econtact" id="econtact" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tribe</h4>
                            <div class="form-group">
                                <input type="text" name="tribe" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <h4 class="card-title mt-5">Guardian's Information</h4>

            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Guardian Name</h4>
                            <div class="form-group">
                                <input type="text" name="gname" id="gname" class="form-control" placeholder="Enter Guardian's Name" required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Relationship</h4>
                            <div class="form-group">
                                <input type="text" name="grelation" id="grelation" required class="form-control" placeholder="Student's Relation with Guardian">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Gurdian Phone Number</h4>
                            <div class="form-group">
                                <input type="text" name="gcontact" id="gcontact" required class="form-control" placeholder="Enter Guardian's Contact No.">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <h4 class="card-title mt-5">Current Address Information</h4>

            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">State of Origin</h4>
                            <div class="form-group">
                                <select name="state" required class="form-control " id="state">
                                    <option value="">---Select State----</option>
                                    <?php
                                    foreach ($state['data'] as $s) { ?>
                                        <option value="<?php echo $s['alias']; ?>"><?php echo $s['name']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">LGA of Origin</h4>
                            <div class="form-group">
                                <select name="lga" required class="form-control " id="lga">
                                    <option value="">---Select LGA----</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Home Address</h4>
                            <div class="form-group">
                                <input type="text" name="address" class="form-control" placeholder="Enter Address" required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Permanent Address</h4>
                            <div class="form-group">
                                <input type="text" name="p_address" class="form-control" placeholder="Enter Permanent Address" required>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="form-actions">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-dark">Reset</button>
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

<!-- Custom Ft. Script Lines -->



<script>
    $(document).ready(function() {
        // Handle change event on state dropdown list
        $('#state').on('change', function() {
            var stateName = $(this).val(); // Get selected state name
            $.ajax({
                url: 'newpage.php', // URL to send AJAX request
                type: 'POST',
                data: {
                    state: stateName
                }, // Data to send with the request
                success: function(response) {
                    // Update LGAs dropdown list with new options
                    $('#lga').html(response);
                },
                error: function() {
                    alert('Error occurred while fetching data!');
                }
            });
        });
    });
</script>

</html>