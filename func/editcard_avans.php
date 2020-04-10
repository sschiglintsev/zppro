<?php
session_start();mb_internal_encoding("UTF-8");
require_once "../db_workers.php";
$delid_avans= $_POST['edava'];
echo'
<div class="b-popup" id="spisok_avans" style="display: none;">
        <div class="b-popup-content" style="width: 600px; height: 180px;text-align: center;">
            <form style="width: 100%">
                <div class=\"control-group\">
                    <select id="sel3" name="select3" style="width: 500px; height: 27px">
                    </select>
                </div>
                <p></p>
                <input  name="pole2" id="pole2_avans" type="date" style="width: 500px; height: 27px" placeholder="Дата">
                <p></p>
                <input  name="pole3" id="pole3_avans" type="text" placeholder="Сумма">
                <p></p>
                <ul id="spisocheksimochek_avans" class="listok bbb" style="display: none; width: 100%"></ul>
                <a class="btn" onclick="poverka_avans();" id="dalee_avans" name="hello_avans">Сохранить</a>
            </form>
        </div>
    </div>
            ';

