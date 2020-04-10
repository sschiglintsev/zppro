<?php
session_start();mb_internal_encoding("UTF-8");

require_once "../db_workers.php";
$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];


$tabel = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=tabel.id_worker limit 1) AS surname,
(SELECT `name` FROM  workers WHERE id=tabel.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=tabel.id_worker) AS m_name,
(SELECT `name` FROM  objects WHERE id=tabel.id_object) AS name_object FROM tabel WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3' ORDER BY id ASC");
//$users=array();
$id='';
$i=0;
while ($row = $tabel->fetch_assoc()) {

    $i++;
    echo "";
    if ($id!=$row['id_worker']) {
        if ($id!='') {echo "</div>";}
        $id=$row['id_worker'];
        echo "      <div style='border:1px;margin-bottom: 0px;display: inline-block'>      
                <div class='fio'>
                    <span></span>
                    <span >{$row['surname']} {$row['surname']} {$row['m_name']}</span>
                    <a onclick='dellete_tabel({$row['id_worker']},$pole1,$pole2,$pole3);'> Удалить табель</a>
               </div> ";
    }
    echo    "<span  class=\"alldays\">".$row['day']."
                     <br><input class=\"alldays_input inputdesc_t\" id='f{$row['id']}' data-type='{$row['id']}' type='text' value=".$row['hour'].">
                     <br><input class=\"alldays_input inputdesc_t\" id='s{$row['id']}' data-type='{$row['id']}' value=".$row['fine']."><br>
             </span>";
    //  if ($id!=$row['id_worker']) {
    //      echo "</div>";
    // }
    echo "    <script>
        function saveusers(id) {
            var numid=$(id).val();
        }
    </script> ";
}
echo "</div>";

echo " <script>
                    function saveusers() {
                        var pole1 = $('#sel4').val();
                        var pole2 = $('#sel_year_zp').val();
                        var pole3 = $('#sel_month_zp').val();
                        console.log('ok')
                        var desc_zp = $('.inputdesc_t');
                        var desc_array_zp=[];
                        $.each(desc_zp,function (i,item) {
                            desc_array_zp.push({
                                n: $(item).attr('id'),
                                t: $(item).attr('data-type'),
                                v: $(item).val()
                            })
                        })
                        
                                        console.log(desc_array_zp)
                        $.ajax({
                                    method: 'POST',
                                    url: '../func/save_tabel.php',
                                    data: {
                                        'descval_t': JSON.stringify(desc_array_zp)
                                    },
                                    success: function(responce) {
                                        show_zarplata(pole1, pole2, pole3);
                                        console.log(responce)
                                    }
                                });}
                </script>";
