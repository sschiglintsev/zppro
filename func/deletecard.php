<?php
session_start();

mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$delid= $_POST['delwor'];
$con->query("DELETE FROM workers WHERE id='$delid'");