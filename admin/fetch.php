<?php
include('../includes/dbconn.php');
$network = $_POST['network'];
if ($network) {
    $sql = "SELECT * FROM faculty_department WHERE faculty = '$network'";
    $query = mysqli_query($mysqli, $sql);
    if ($query) {
        $result = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row['department'];
        }
        $myJSON = json_encode($result);
        echo $myJSON;
    }
}
