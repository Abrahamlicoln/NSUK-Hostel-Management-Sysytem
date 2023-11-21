<?php
include('../includes/dbconn.php');
$building = $_POST['building'];
if ($building) {
    $sql = "SELECT * FROM rooms WHERE building = '$building'";
    $query = mysqli_query($mysqli, $sql);
    if ($query) {
        $result = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row['room_no'];
        }
        $myJSON = json_encode($result);
        echo $myJSON;
    }
}
