<!doctype html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['valid'])) {
  echo '<script>
    window.location.href = "../index.php";
            </script>';
}
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Biometric | NSUK - Hostel Management System</title>
</head>
<?php
$title = "Biometric Requirement | NSUK - Hostel Management System";
include '../header.php';

?>

<body>



  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('../assets/images/biometric.jpg');  
        "></div>
    <div class="contents order-2 order-md-1">

      <div class="container-fluid mt-5">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-11">
            <center>
              <img src="../assets/images/logo_main.png" alt="" width="70px">
              <h5 class="text-success" style="color:#254929 !important; font-weight:bolder;">NSUK - Hostel Management System</h5>
            </center>
            <h5 class="text-muted mt-3">Passport Photograph Specification</h5>
            <li>Ensure your face (eyes, nose, ears, mouth and jaw) is fully shown</li>
            <li>Ensure the picture fills the frame and centralised</li>
            <li>Ensure the Photo background is white or off-white</li>
            <li>Ensure the environment is well illuminated</li>
            <h5 class="text-muted mt-2">Biometric Requirement</h5>
            <p class="mb-0">This prerequisite below is required and should be installed seperately before clicking the Install button:</p>
            <li>Biometrics Prerequisite for either
              <a target="_blank" href="https://drive.google.com/file/d/0B5kf0kE1pZ9ZUU95THhoeXk3djg/view?resourcekey=0-bI0cwWBYU2B6_KkwZVHHdw">32 bit Installation</a>
              or
              <a target="_blank" href="https://drive.google.com/file/d/0B5kf0kE1pZ9ZMW9aY3UxNzE0dWc/view?resourcekey=0-aMjfISV-ySV2X2rMhNvPaQ">64 bit Installation</a>
            </li>
            <p class="mt-3 mb-0">The following prerequisites are required:</p>
            <li> Microsoft Windows Installer Latest Version</li>
            <li> Microsoft .NET Framework 4.7.2 (x86 and x64)
              <p class="mt-2">If these components are already installed, you can
                <a href="../publish/NSUK-HOSTEL MANAGEMENT SYSTEM.application"> launch </a>
                the application now. Otherwise, click the button below to install the prerequisites and run the application.
              </p>

              <center>
                <a onclick="window.location.href = InstallButton.href" id="InstallButton" href="../publish/setup.exe">
                  <button class="btn btn-success">Install Requirement</button>
                </a>
              </center>

          </div>
        </div>
      </div>


    </div>

    <script type="text/javascript">
      runtimeVersion = "4.7.2";
      checkClient = false;
      directLink = "../publish/NSUK-HOSTEL MANAGEMENT SYSTEM.application";

      function Initialize() {
        if (HasRuntimeVersion(runtimeVersion, false) || (checkClient && HasRuntimeVersion(runtimeVersion, checkClient))) {
          InstallButton.href = directLink;
          BootstrapperSection.style.display = "none";
        }
      }

      function HasRuntimeVersion(v, c) {
        var va = GetVersion(v);
        var i;
        var a = navigator.userAgent.match(/\.NET CLR [0-9.]+/g);
        if (va[0] == 4)
          a = navigator.userAgent.match(/\.NET[0-9.]+E/g);
        if (c) {
          a = navigator.userAgent.match(/\.NET Client [0-9.]+/g);
          if (va[0] == 4)
            a = navigator.userAgent.match(/\.NET[0-9.]+C/g);
        }
        if (a != null)
          for (i = 0; i < a.length; ++i)
            if (CompareVersions(va, GetVersion(a[i])) <= 0)
              return true;
        return false;
      }

      function GetVersion(v) {
        var a = v.match(/([0-9]+)\.([0-9]+)\.([0-9]+)/i);
        if (a == null)
          a = v.match(/([0-9]+)\.([0-9]+)/i);
        return a.slice(1);
      }

      function CompareVersions(v1, v2) {
        if (v1.length > v2.length) {
          v2[v2.length] = 0;
        } else if (v1.length < v2.length) {
          v1[v1.length] = 0;
        }

        for (i = 0; i < v1.length; ++i) {
          var n1 = new Number(v1[i]);
          var n2 = new Number(v2[i]);
          if (n1 < n2)
            return -1;
          if (n1 > n2)
            return 1;
        }
        return 0;
      }
    </script>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>