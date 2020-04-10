<?php
session_start();mb_internal_encoding("UTF-8");

require_once "../db_workers.php";

$objects = $con->query("SELECT * FROM objects WHERE id<>54 ORDER BY id DESC ");
while ($row = $objects->fetch_assoc())
{echo "<tr> 
                <td>{$row['name']}</td>
                <td>{$row['short_name']}</td>
                <td>{$row['address']}</td>
                <td><a onclick='show_edit_object({$row['id']});showpoverka_object_edit();'>Редактировать</a></td>
                <td><a onclick='dellete_objects({$row['id']});show_objects();'>Удалить</a></td>
             </tr>";}