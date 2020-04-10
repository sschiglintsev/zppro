<?php
session_start();mb_internal_encoding("UTF-8");

require_once "../db_workers.php";
$pole1 = $_POST['pole1'];
$pole2 = $_POST['pole2'];
$pole3 = $_POST['pole3'];


$zarplata = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=zarplata.id_worker) AS surname,
(SELECT `name` FROM  workers WHERE id=zarplata.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=zarplata.id_worker) AS m_name,
(SELECT `name` FROM  objects WHERE id=zarplata.id_object) AS name_object FROM zarplata WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3' ORDER BY id ASC");
//$users=array();
//$id=array();
$i=0;
while ($row = $zarplata->fetch_assoc()) {
    $i++;
    echo "
            <div class='stroka_zp'>
                <span class='zp_name'><i class='fa fa-user-circle-o'></i> <small> $i</small>. ".$row['surname'].' '.$row['name'].' '.$row['m_name']." 
                <a onclick='dellete_zarplata({$row['id_worker']},$pole1,$pole2,$pole3);show_zarplata0();'> Удалить расчет ЗП</a> </span>
                <span class='zp_stroka'>Оклад в день:<br><input class=\"alldays_input_zp inputdesc_zp\" 
                onkeyup=\"$('#s_in_h{$row['id']}').val(this.value/8);
                $('#sum{$row['id']}').val((this.value/8)*parseInt($('#hour_all{$row['id']}').val()));
                $('#payment{$row['id']}').val(((this.value/8)*parseInt($('#hour_all{$row['id']}').val()))-parseInt($('#avans{$row['id']}').val())-parseInt($('#fine{$row['id']}').val())+parseFloat($('#ostatok_early{$row['id']}').val()));
                $('#ostatok{$row['id']}').val(((this.value/8)*parseInt($('#hour_all{$row['id']}').val()))-parseInt($('#avans{$row['id']}').val())-parseInt($('#fine{$row['id']}').val())+parseFloat($('#ostatok_early{$row['id']}').val())-$('#money".$row['id']."').val())\"
                 id='s_in_d{$row['id']}' data-type=".$row['id']." type=\"text\" value=".$row['salary_in_day']."></span>
                <span class='zp_stroka'>Оклад в час:<br><input class=\"alldays_input_zp inputdesc_zp\" id='s_in_h{$row['id']}' data-type=".$row['id']." type=\"text\" value=".$row['salary_in_hour']." readonly></span>
                <span class='zp_stroka'>Штраф:<br><input  class=\"alldays_input_zp\" id='fine{$row['id']}' value=".$row['fine']." readonly></span>
                <span class='zp_stroka'>Аванс:<br><input  class=\"alldays_input_zp\" id='avans{$row['id']}' value=".$row['avans']." readonly></span>
                <span class='zp_stroka'>Всего часов:<br><input  class=\"alldays_input_zp\" id='hour_all{$row['id']}' value=".$row['hour_all']." readonly></span>
                <span class='zp_stroka'>Итого сумма:<br><input class=\"alldays_input_zp inputdesc_zp\" id='sum{$row['id']}' data-type=".$row['id']." type=\"text\" value=".$row['sum']." readonly></span>
                <span class='zp_stroka'>Остаток за прошлый месяц:<br><input class=\"alldays_input_zp inputdesc_zp\" 
                onkeyup=\"$('#payment{$row['id']}').val((parseInt($('#hour_all{$row['id']}').val())*parseFloat($('#s_in_h{$row['id']}').val()))-parseInt($('#avans{$row['id']}').val())-parseInt($('#fine{$row['id']}').val())+ parseFloat($('#ostatok_early{$row['id']}').val())); 
                $('#ostatok{$row['id']}').val((parseInt($('#hour_all{$row['id']}').val())*parseFloat($('#s_in_h{$row['id']}').val()))-parseInt($('#avans{$row['id']}').val())-parseInt($('#fine{$row['id']}').val())+ parseFloat($('#ostatok_early{$row['id']}').val())-parseInt($('#money{$row['id']}').val()));\" 
                id='ostatok_early{$row['id']}' data-type=".$row['id']." value=".$row['ostatok_early']."></span>
                <span class='zp_stroka'>К выплате:<br><input class=\"alldays_input_zp inputdesc_zp\" id='payment{$row['id']}' data-type=".$row['id']." value=".$row['payment']." readonly></span>
                <span class='zp_stroka'>Выплачено:<br><input onkeyup=\"$('#ostatok{$row['id']}').val($('#payment{$row['id']}').val()-this.value)\" class=\"alldays_input_zp inputdesc_zp\" id='money{$row['id']}' data-type=".$row['id']." type='text' value=".$row['money']."></span>
                <span class='zp_stroka' id='span_ostatok'>Остаток:<br><input class=\"alldays_input_zp inputdesc_zp\" id='ostatok{$row['id']}' data-type=".$row['id']." value=".$row['ostatok']." readonly></span>

             </div>
    <script>
        function save_zp(id) {
            var numid=$(id).val();
        }
    </script> ";
    }
echo "</div>";

echo " <script>
                    function save_zp() {
                        var pole1 = $('#sel4').val();
                        var pole2 = $('#sel_year_zp').val();
                        var pole3 = $('#sel_month_zp').val();
                        console.log('ok')
                        var desc_zp = $('.inputdesc_zp');
                        var desc_array_zp=[];
                        $.each(desc_zp,function (i,item) {
                            desc_array_zp.push({
                                num_zp: $(item).attr('id'),
                                type: $(item).attr('data-type'),
                                value_zp: $(item).val()
                            })
                        })
                        
                                        console.log(desc_array_zp)
                        $.ajax({
                                    method: 'POST',
                                    url: '../func/save_zp.php',
                                    data: {
                                        'descval_zp': JSON.stringify(desc_array_zp)
                                    },
                                    success: function(responce) {
                                        show_zarplata(pole1, pole2, pole3);
                                        console.log(responce)
                                    }
                                });}
                </script>";
