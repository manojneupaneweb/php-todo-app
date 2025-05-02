<?php

include('db.php');

$token = isset(($_COOKIE['assessToken']));
if ($token) {
    header("Location: login.php");
    exit;
}

include('login.php')
?>



