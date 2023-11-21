<?php

date_default_timezone_set('America/Chicago');
//Here we define out main variables 
$welcome_string = "Welcome";
date_default_timezone_set("Africa/Lagos");
$numeric_date = date("H");

//Start conditionals based on military time 
if ($numeric_date >= 0 && $numeric_date < 12)
    $welcome_string = "Good Morning,";
else if ($numeric_date >= 12 && $numeric_date < 15)
    $welcome_string = "Good Afternoon,";
else if ($numeric_date >= 15 && $numeric_date <= 24)
    $welcome_string = "Good Evening,";


$aid = $_SESSION['id'];
$ret = "select * from userregistration where id=?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $aid);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_object()) {

    echo "<h3 class='page-title text-truncate text-dark font-weight-medium mb-1'>$welcome_string $row->firstName! </h3>";
}
