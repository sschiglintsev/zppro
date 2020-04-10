<?php
session_start();
mb_internal_encoding("UTF-8");

require_once "../db_workers.php";

$avans = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=avans.id_worker) AS surname,
(SELECT name FROM  workers WHERE id=avans.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=avans.id_worker) AS m_name, (SELECT name FROM  objects WHERE id=avans.id_object) AS object FROM avans ORDER BY id ASC");
while ($row = $avans->fetch_assoc())
{echo "<tr> 
                <td>{$row['surname']}</td>
                <td>{$row['name']}</td>
                <td>{$row['m_name']}</td>
                <td>{$row['object']}</td>
                <td>{$row['date']}</td>
                <td>{$row['sum']}</td>
                <td><a onclick='show_edit_card({$row['id']});showpoverka_avans_edit()'>Редактировать</a></td>
                <td><a onclick='dellete_avans({$row['id']});show_avans();'>Удалить</a></td>
             </tr>";}