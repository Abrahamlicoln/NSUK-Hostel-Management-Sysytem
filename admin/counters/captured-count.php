<?php
include '../includes/dbconn.php';

$sql = "SELECT * FROM userregistration WHERE status='3'";
$query = $mysqli->query($sql);
echo "$query->num_rows";
