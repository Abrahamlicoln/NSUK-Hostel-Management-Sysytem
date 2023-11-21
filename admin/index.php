<?php
$title = "Administrator Login | NSUK-HMS";
include 'header.php';
?>
<?php
session_start();
include('../includes/dbconn.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT id, username, email, password FROM admin WHERE (username = ? OR email = ?)");
    $stmt->bind_param('ss', $username, $username);
    $stmt->execute();
    $stmt->bind_result($id, $username, $email, $hashed_password);
    $rs = $stmt->fetch();

    if ($rs && password_verify($password, $hashed_password)) {
        $_SESSION['id'] = $id;
        $uip = $_SERVER['REMOTE_ADDR'];
        $ldate = date('d/m/Y h:i:s', time());
        header("location:dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username/Email or password');</script>";
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
                        <a href="index.php" class="app-brand-link gap-2 pt-1"> <img src="../assets/images/logo.png" alt="" height="40" width="40">
                            <p style="font-size:20px; color:#254929 !important; font-family: 'Poppins', sans-serif; font-weight:600;" class="app-brand-text demo text-body text-uppercase mt-1">NSUK | HMS</p>
                        </a>
                    </div>
                    <center>
                        <p class="mb-1 mt-0" style="font-size:18px;">Administrator Login.</p>
                    </center>
                    <form id="formAuthentication" class="mb-3" action="index.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" required name="username" placeholder="Please Enter Username" autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" required name="password" placeholder="Please Enter Password" autofocus />
                        </div>
                        <button type="submit" name="login" class="btn btn-primary d-grid w-100" style="background-color:#18A08B !important; border:none;">Login</button>
                    </form>


                    </a>
                    <div class="text-center mt-2">
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
