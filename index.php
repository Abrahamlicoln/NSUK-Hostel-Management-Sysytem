<?php
session_start();
$title = "Validate Student | NSUK-HMS";
include 'header.php';
include('includes/dbconn.php');
if (isset($_POST['submit'])) {
  $registraion_no = filter_var(mysqli_real_escape_string($mysqli, $_POST['text']), FILTER_SANITIZE_STRING);
  $select = "SELECT * FROM userregistration WHERE regNo = '$registraion_no' AND (level = '100 Level' OR level='400 Level' OR level = '500 Level')";
  $query = mysqli_query($mysqli, $select);

  if ($numRow = mysqli_num_rows($query)) {

    while ($row = mysqli_fetch_assoc($query)) {

      if ($row['status_login'] == '1') {
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
  title: 'This Student Have been Validated Already. You will be Redirected to Login'
})


        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "login.php";
}, 2000);
            </script>';
      } else {
        $_SESSION['user_info'] = $row;
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
  title: 'Student Validated Successfully'
})


        </script>";
        echo '<script>
            window.setTimeout(function() {
    window.location.href = "validate.php";
}, 2000);
            </script>';
      }
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
  title: 'Hostel is Only for 100 Level and Final Year Student'
})


        </script>";
    echo '<script>
            window.setTimeout(function() {
    window.location.href = "index.php";
}, 2000);
            </script>';
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
          <p class="mb-1 mt-0">Enter your Jamb Number/Matric No to Create account.</p>
          <form id="formAuthentication" class="mb-3" action="index.php" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Jamb No./Matric. No</label>
              <input type="text" class="form-control" required name="text" placeholder="Please Enter Jamb No/Matric No" autofocus />
            </div>
            <button type="submit " name="submit" class="btn btn-primary d-grid w-100" style="background-color:#18A08B !important; border:none;">Validate</button>
          </form>
          <div class="text-center">
            <a href="login.php" class="d-flex align-items-center justify-content-center">
              <i style="color:#18A08B !important;" class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              <span style="color:#18A08B !important;">Back to login</span>
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
