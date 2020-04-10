<?php
session_start();
mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];

$res = "SELECT EXISTS (SELECT * FROM tabel WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3')";
