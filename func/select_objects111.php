<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$pole1=$_POST['id_object'];
$tmp_111='';
$select_object11=$con->query("SELECT id,name FROM objects");
if ($pole1==false)
{
    $tmp_111='<option disabled selected value="54">Объект №3</option>';
    while ($row = mysqli_fetch_array($select_object11))
    {
        $tmp_111.='<option value='.$row['id'].'>'.$row['name']. '</option>';
    }
    echo $tmp_111;
}
else
{
    while ($row = mysqli_fetch_array($select_object11))
    {
        if ($row['id']==$pole1) {
            $tmp_111.='<option value='.$row['id'].' selected>'.$row['name']. '</option>';
        }
        else {
            $tmp_111.='<option value='.$row['id'].'>'.$row['name']. '</option>';
        }
    }
    echo $tmp_111;
}
