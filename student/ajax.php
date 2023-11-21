<?php
// your code here
$regno = $_POST['regno'];
$select = "SELECT end_time FROM registration WHERE regno = '$regno'";
$query = mysqli_query($mysqli, $select);

$response = array(); // initialize empty array for JSON response

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $end_time = $row['end_time'];
        $end_time = strtotime($end_time);
        // Check if the start date is greater than the current time
        if ($end_time <= time()) {
            $update = "UPDATE registration SET eligible = '0' WHERE regno = '$regno'";
            $main_query = mysqli_query($mysqli, $update);
            if ($main_query) {
                // query successful, update response with new eligibility status
                $response['success'] = true;
                $response['eligible'] = 0;
            } else {
                // query failed, update response with error message
                $response['success'] = false;
                $response['error'] = "Failed to update eligibility status";
            }
            break; // exit loop after first match
        }
    }
}

echo json_encode($response); // return JSON response
