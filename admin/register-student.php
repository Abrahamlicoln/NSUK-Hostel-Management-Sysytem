<?php
session_start();
include('../includes/dbconn.php');
$title = "Student Registration | NSUK-HMS";
include 'includes/general.php';

if (isset($_POST['submit'])) {
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $session = $_POST['session'];
    $sql = "SELECT * FROM userregistration where regNo=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('s', $regno);
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
  title: 'This Student Already Exist'
})
        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "view-students-acc.php";
}, 2000);
            </script>';
    } else {
        $query = "INSERT into userRegistration(regNo,firstName,middleName,lastName,gender,faculty,department,level,session) values(?,?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssssssss', $regno, $fname, $mname, $lname, $gender, $faculty, $department, $level, $session);
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
  title: 'You have Register a Student Successfully'
})
        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "view-students-acc.php";
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
        <form action="bulk.php" method="post" enctype="multipart/form-data">
            <label for="">Upload Student in Bulk</label><br>
            <input type="file" name="upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="" class="mb-3" /><br>
            <button type="submit" name="bulk" class="btn btn-success mb-4">Upload</button>
        </form>
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Student Registration Form</h4>
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

        <form action="register-student.php" method="POST">

            <div class="row">



                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Registration Number</h4>
                            <div class="form-group">
                                <input type="text" name="regno" placeholder="Enter Registration Number" id="regno" class="form-control" required>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">First Name</h4>
                            <div class="form-group">
                                <input type="text" name="fname" id="fname" placeholder="Enter First Name" required class="form-control">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Middle Name</h4>
                            <div class="form-group">
                                <input type="text" name="mname" id="mname" placeholder="Enter Middle Name" required class="form-control">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Last Name</h4>
                            <div class="form-group">
                                <input type="text" name="lname" id="lname" placeholder="Enter Middle Name" required class="form-control">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Gender</h4>
                            <div class="form-group mb-4">
                                <select class="custom-select mr-sm-2" id="gender" name="gender" required="required">
                                    <option selected>Choose...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Faculty</h4>
                            <div class="form-group mb-4">
                                <select class="custom-select mr-sm-2" id="faculty" onchange="GetDetail(this.value)" name="faculty" required="required">
                                    <option selected>Choose Faculty...</option>
                                    <option value="Faculty of Natural and Applied Sciences">Faculty of Natural and Applied Sciences</option>
                                    <option value="Faculty of Administration">Faculty of Administration</option>
                                    <option value="Faculty of Arts">Faculty of Arts</option>
                                    <option value="Faculty of Law">Faculty of Law</option>
                                    <option value="Faculty of Social Sciences">Faculty of Social Sciences</option>
                                    <option value="Faculty of Education">Faculty of Education</option>
                                    <option value="Faculty of Environmental Sciences">Faculty of Environmental Sciences</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Department</h4>
                            <div class="form-group mb-4">
                                <select class="custom-select mr-sm-2" id="department" name="department" required="required">
                                    <option selected></option>


                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Level</h4>
                            <div class="form-group mb-4">
                                <select class="custom-select mr-sm-2" id="" name="level" required="required">
                                    <option value="" selected>---Select Level----</option>
                                    <option value="100 Level">100 Level</option>
                                    <option value="200 level">200 Level</option>
                                    <option value="300 Level">300 Level</option>
                                    <option value="400 Level">400 Level</option>
                                    <option value="500 Level">500 Level</option>


                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Academic Session</h4>
                            <div class="form-group mb-4">
                                <select class="custom-select mr-sm-2" id="" name="session" required="required">
                                    <option value="" selected>---Select Session----</option>
                                    <?php
                                    for ($i = 2020; $i <= 2080; $i++) {
                                        $main = $i + 1;
                                        $academic_session = $i . "/" . $main . " Academic Session";
                                    ?>

                                        <option value="<?php echo $academic_session; ?>"><?php echo $academic_session; ?></option>

                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>





            </div>


            <div class=" form-actions">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success">Register</button>
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
<script>
    // Send AJAX request to fetch.php
    function GetDetail(str) {
        var department = $("#department");
        department.prop('disabled', true); // disable the second select box
        department.html('<option value="">Select Department...</option>'); // show loading message
        $.ajax({
            url: "fetch.php",
            type: "POST",
            data: {
                network: str

            },
            success: function(response) {
                var myObj = JSON.parse(response);
                // Update the second select box
                department.prop('disabled', false);
                for (var i = 0; i < myObj.length; i++) {
                    var option = $('<option></option>').text(myObj[i]);
                    department.append(option);
                }
            }
        });
    }
</script>
<!-- customs -->

</body>

</html>