<?php
$title = "Login | NSUK-HMS";
include 'header.php';
?>
<?php
session_start();
include('includes/dbconn.php');
$select = "SELECT date_end FROM date_amendment WHERE id = '1'";
$query = mysqli_query($mysqli, $select);
$row = mysqli_fetch_assoc($query);
$end_date = $row['date_end'];
// Compare the current time with the start date

if (isset($_POST['login'])) {
    $email = filter_var(mysqli_real_escape_string($mysqli, $_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(mysqli_real_escape_string($mysqli, $_POST['password']), FILTER_SANITIZE_STRING);
    $stmt = $mysqli->prepare("SELECT id, email, password, regNo,gender FROM userregistration WHERE email=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($id, $email, $hashed_password, $regNo, $gender);
    $rs = $stmt->fetch();
    $stmt->close();
    if ($rs) {
        if (password_verify($password, $hashed_password)) {
            if (strtotime($end_date) <= time()) {
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
                title: 'I am So Sorry, But Hostel Booking is Closed'
                })


                        </script>";
                echo '<script>
                            window.setTimeout(function() {
                    window.location.href = "login.php";
                }, 1500);
                            </script>';
            }
            $select = "SELECT * FROM new_enrollment WHERE identification = '$regNo'";
            $query = mysqli_query($mysqli, $select);
            if ($numRow = mysqli_num_rows($query) > 0) {
                $_SESSION['id'] = $id;
                $_SESSION['login'] = $email;
                $_SESSION['regno'] = $regNo;
                $_SESSION['gender'] = $gender;
                $uid = $_SESSION['id'];
                $uemail = $_SESSION['login'];

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
                title: 'You have Login Successfully'
                })


                        </script>";
                echo '<script>
                            window.setTimeout(function() {
                    window.location.href = "student/dashboard.php";
                }, 2000);
                            </script>';
            } else {
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
            title: 'You have not been Enrolled Yet'
            })


                    </script>";
                echo '<script>
                        window.setTimeout(function() {
                window.location.href = "login.php";
            }, 2000);
                        </script>';
            }
        } else {
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
            title: 'Invalid Username or Password'
            })


                    </script>";
            echo '<script>
                        window.setTimeout(function() {
                window.location.href = "login.php";
            }, 2000);
                        </script>';
        }
    }
}

?>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-2">
            <!-- Forgot Password -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-2">
                        <a href="index.php" class="app-brand-link gap-2 pt-1"> <img src="assets/images/logo.png" alt="" height="40" width="40">
                            <p style="font-size:20px; color:#254929 !important; font-family: 'Poppins', sans-serif; font-weight:600;" class="app-brand-text demo text-body text-uppercase mt-1">NSUK | HMS</p>
                        </a>
                    </div>
                    <p class="mb-1 mt-0">Please Login to your Dashboard.</p>
                    <form id="formAuthentication" class="mb-3" action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" required name="email" placeholder="Please Enter Email Address" autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" required name="password" placeholder="Please Enter Password" autofocus />
                        </div>
                        <button type="submit" name="login" class="btn btn-primary d-grid w-100" style="background-color:#18A08B !important; border:none;">Login</button>
                    </form>
                    Forget Password?<a href="forgetpassword.php" class="">

                        <span style="color:#18A08B !important;">Click Here</span>
                    </a>
                    <div class="text-center mt-2">


                        <a href="index.php" class="d-flex align-items-center justify-content-center">
                            <i style="color:#18A08B !important;" class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                            <span style="color:#18A08B !important;">Back to Validate Page</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>
<!-- Core JS -->
<?php
include 'footer.php';
