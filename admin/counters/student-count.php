<?php
include '../includes/dbconn.php';

$sql = "SELECT * FROM userregistration WHERE level='300 Level' OR level='100 Level' OR level = '500 Level'";
$query = $mysqli->query($sql);
echo "$query->num_rows";
