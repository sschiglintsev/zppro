<?php
session_start();

mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$delid_objects= $_POST['delobj'];
$con->query("DELETE FROM objects WHERE id='$delid_objects'");