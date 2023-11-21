<?php
include '../includes/dbconn.php';

$sql = "SELECT * FROM registration WHERE eligible = '1'";
$query = $mysqli->query($sql);
echo "$query->num_rows";
