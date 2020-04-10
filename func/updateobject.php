<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];
$pole4 = $_POST['pole4'];
$con->query("UPDATE objects SET name='$pole1', short_name ='$pole2', address='$pole3' WHERE id=$pole4");
