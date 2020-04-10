<?php
session_start();mb_internal_encoding("UTF-8");

require_once "../db_workers.php";

$workers = $con->query("SELECT *,(SELECT `name` FROM  objects WHERE id=workers.object) AS objects, (SELECT `name` FROM  objects WHERE id=workers.object_2) AS object2, 
(SELECT `name` FROM  objects WHERE id=workers.object_3) AS object3, (SELECT `name` FROM  objects WHERE id=workers.object_4) AS object4 FROM workers ORDER BY id ASC");
while ($row = $workers->fetch_assoc())
{$year=0;
    $month=0;
    $ostatok=0;
    $zarplata = $con->query("SELECT ostatok, year, month FROM  zarplata WHERE id_worker={$row['id']}");
    while ($roww = $zarplata->fetch_assoc())
    {
        if ($roww['year']==$year AND $roww['month']==$month) {

            $ostatok=$ostatok+$roww['ostatok'];
        }
        if ($roww['year']>$year) {
            $year=$roww['year'];
            $month=$roww['month'];
            $ostatok=$roww['ostatok'];
        }
        if ($roww['year']==$year AND $roww['month']>$month) {
            $month=$roww['month'];
            $ostatok=$roww['ostatok'];
        }


    }
    echo "<tr> 
                <td>{$row['surname']}</td>
                <td>{$row['name']}</td>
                <td>{$row['m_name']}</td>
                <td>{$row['post']}</td>
                <td>{$row['tel']}</td>
                <td>{$row['objects']}</td>
                <td>{$row['object2']}</td>
                <td>{$row['object3']}</td>
                <td>{$row['object4']}</td>
                <td>{$row['salary_in_day']}</td>
                <td>{$row['salary_in_hour']}</td>
                <td>$ostatok</td>
                <td><a onclick='showpoverka_worker_edit();show_edit_worker({$row['id']});show_select_object_edit({$row['object']},{$row['object_2']},{$row['object_3']},{$row['object_4']})'>Редактировать</a></td>
                <td><a onclick='dellete_workers({$row['id']});show();'>Удалить</a></td>
             </tr>";}