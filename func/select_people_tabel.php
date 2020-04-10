<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";

    $select_people_tabel=$con->query("SELECT id,surname,name,m_name,object,object_2,object_3,object_4 FROM workers ORDER BY surname");
    $tmp_people_tabel='<option>Сотрудник</option>';
    while ($row = mysqli_fetch_array($select_people_tabel))
    {
        $select_object_tabel=$con->query("SELECT name FROM objects WHERE id=".$row['object']." ");
        while ($roww = mysqli_fetch_array($select_object_tabel)) {
            if ($row['object']!=='54') {
                $name = $roww['name'];
                $tmp_people_tabel .= '<option value=' . $row['id'] . ' for=' . $row['object'] . '>' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['m_name'] . ' (' . $roww['name'] . ')</option>';
            }
        }
        $select_object_tabel=$con->query("SELECT name FROM objects WHERE id=".$row['object_2']." ");
        while ($roww = mysqli_fetch_array($select_object_tabel)) {
            if ($row['object_2']!=='54') {
                $name = $roww['name'];
                $tmp_people_tabel .= '<option value=' . $row['id'] . ' for=' . $row['object_2'] . '>' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['m_name'] . ' (' . $roww['name'] . ')</option>';
            }
        }
        $select_object_tabel=$con->query("SELECT name FROM objects WHERE id=".$row['object_3']." ");
        while ($roww = mysqli_fetch_array($select_object_tabel)) {
            if ($row['object_3']!=='54') {
                $name = $roww['name'];
                $tmp_people_tabel .= '<option value=' . $row['id'] . ' for=' . $row['object_3'] . '>' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['m_name'] . ' (' . $roww['name'] . ')</option>';
            }
        }
        $select_object_tabel=$con->query("SELECT name FROM objects WHERE id=".$row['object_4']." ");
        while ($roww = mysqli_fetch_array($select_object_tabel)) {
            if ($row['object_4']!=='54') {
                $name = $roww['name'];
                $tmp_people_tabel .= '<option value=' . $row['id'] . ' for=' . $row['object_4'] . '>' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['m_name'] . ' (' . $roww['name'] . ')</option>';
            }
        }
    }
echo $tmp_people_tabel;
