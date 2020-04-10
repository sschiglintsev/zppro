<?php
session_start();

mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$delid_avans= $_POST['delava'];
$con->query("DELETE FROM avans WHERE id='$delid_avans'");