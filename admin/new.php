<?php
$password = "123456";

$password = password_hash($password, PASSWORD_DEFAULT);
var_dump($password);
