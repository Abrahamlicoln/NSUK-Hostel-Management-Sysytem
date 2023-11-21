<?php
session_start();
if (!isset($_SESSION['user_info'])) {
    echo '<script>
    window.location.href = "index.php";
            </script>';
} else {
    $data = $_SESSION['user_info'];
    $firstname = $data['firstName'];
    $lastname = $data['lastName'];
    $registration = $data['regNo'];
}
$title = "Update " . $lastname . " " . $firstname . " | NSUK-HMS";
include 'header.php';
?>
<?php
include('includes/dbconn.php');
if (isset($_POST['validate'])) {
    $email_address = filter_var(mysqli_real_escape_string($mysqli, $_POST['email_address']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(mysqli_real_escape_string($mysqli, $_POST['password']), FILTER_SANITIZE_EMAIL);
    $c_password =  filter_var(mysqli_real_escape_string($mysqli, $_POST['c_password']), FILTER_SANITIZE_EMAIL);

    if ($password !== $c_password) {
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
  title: 'Password does not Match'
})


        </script>";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $update = "UPDATE userregistration SET email = '$email_address', password = '$password', status_login = '1' WHERE regNo = '$registration'";
        $query = mysqli_query($mysqli, $update);
        if ($query) {
            $_SESSION['valid'] = "Set";
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
  title: 'Please Download the Requirement for Biometric in the Next Page and Capture the Student'
})


        </script>";
            echo '<script>
            window.setTimeout(function() {
    window.location.href = "biometric/index.php";
}, 2000);
            </script>';
        }
    }
}
?>
<style>

</style>
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
                    <p class="mb-1 mt-0">Welcome Back <b><?php echo $lastname . " " . $firstname; ?></b>. Please Update your Email Address and Password</p>
                    <form id="formAuthentication" class="mb-3" action="validate.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" required name="email_address" placeholder="Please Enter Email Address" autofocus />
                        </div>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password1" placeholder="Enter Password" . aria-describedby=" basic-default-password2">
                                    <span id="toggle-password1" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="c_password" id="password2" placeholder="Confirm Password" aria-describedby="basic-default-password2">
                                    <span id="toggle-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button type="submit" name="validate" class="btn btn-primary d-grid w-100 mt-3" style="background-color:#18A08B !important; border:none;">Update Student </button>
                    </form>

                </div>
            </div>
        </div>
        <!-- /Forgot Password -->
    </div>
</div>
</div>
<script>
    const togglePassword = (passwordInputId, toggleBtnId) => {
        const passwordInput = document.getElementById(passwordInputId);
        const toggleBtn = document.getElementById(toggleBtnId);
        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').className = type === 'password' ? 'bx bx-hide' : 'bx bx-show';
        });
    };
    togglePassword('password1', 'toggle-password1');
    togglePassword('password2', 'toggle-password2');
</script>

<!-- Core JS -->
<?php
include 'footer.php';
