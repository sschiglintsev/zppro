<?PHP
session_start();
//mb_internal_encoding("UTF-8");
// "../db_workers.php";
define('DB_USER', "zpproru_tts"); //логин админа БД
define('DB_PASSWORD', "Sockromant7"); // пароль админа БД
define('DB_DATABASE', "zpproru_tts"); // база данных
define('DB_SERVER', "localhost"); // сервер 'localhost'
$con = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
$con->set_charset('utf8');
// Подключаем класс для работы с excel
require_once('../classes/PHPExcel.php');

$pole1 = $_POST['select10'];
$pole2 = $_POST['select_year_zp_all'];
$pole3 = $_POST['select_month_zp_all'];
// Создаем объект класса PHPExcel
$xls = new PHPExcel();

// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Зарплата');

// устанавливаем бордер ячейкам
$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$m='';
//if ($pole3=='01' || $pole3=='02' || $pole3==03 || $pole3==04 || $pole3==05 || $pole3==06 || $pole3==07 || $pole3==08 || $pole3==09){}
switch ($pole3) {
    case '01': $m='январь'; break;
    case '02': $m='февраль'; break;
    case '03': $m='март'; break;
    case '04': $m='апрель'; break;
    case '05': $m='май'; break;
    case '06': $m='июнь'; break;
    case '07': $m='июль'; break;
    case '08': $m='август'; break;
    case '09': $m='сентябрь'; break;
    case 10: $m='октябрь'; break;
    case 11: $m='ноябрь'; break;
    case 12: $m='декабрь'; break;
}

// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", "Зарплата за $m $pole2 год");
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('FFFFFF');
// Выравнивание текста
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Объединяем ячейки
$sheet->mergeCells('A1:N1');
// Вставляем текст в ячейку
$sheet->setCellValue("A3", '№ ');
$sheet->getStyle('A3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("B3", 'ФИО');
$sheet->getStyle('B3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("C3", 'Объект');
$sheet->getStyle('C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("D3", 'Оклад в день');
$sheet->getStyle('D3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('D3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("E3", 'Оклад в час');
$sheet->getStyle('E3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('E3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("F3", 'Всего часов');
$sheet->getStyle('F3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('F3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("G3", 'Итого сумма');
$sheet->getStyle('G3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('G3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("H3", 'Штраф');
$sheet->getStyle('H3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('H3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("I3", 'Аванс');
$sheet->getStyle('I3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('I3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("J3", 'Остаток за прошлый месяц');
$sheet->getStyle('J3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('J3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("K3", 'К выплате');
$sheet->getStyle('K3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('K3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("L3", 'Выплачено');
$sheet->getStyle('L3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('L3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("M3", 'Остаток');
$sheet->getStyle('M3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('M3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("N3", 'Выдано');
$sheet->getStyle('N3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('N3')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->setCellValue("O3", 'Подпись');
$sheet->getStyle('O3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('O3')->getFill()->getStartColor()->setRGB('EEEEEE');


$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);
$sheet->getColumnDimension('K')->setAutoSize(true);
$sheet->getColumnDimension('L')->setAutoSize(true);
$sheet->getColumnDimension('M')->setAutoSize(true);
$sheet->getColumnDimension('N')->setAutoSize(true);
$sheet->getColumnDimension('O')->setAutoSize(true);
// Объединяем ячейки
//$sheet->mergeCells('A1:H1');

// Выравнивание текста
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD");
$maxC = count($cols);
$i=4;
$j=0;
$ii=1;
$hour_all=0;
$hour_all_sum=0;
$sum=0;
$sum_sum=0;
$fine=0;
$fine_sum=0;
$avans=0;
$avans_sum=0;
$ostatok_early=0;
$ostatok_early_sum=0;
$payment=0;
$payment_sum=0;
$money=0;
$money_sum=0;
$ostatok=0;
$ostatok_sum=0;


$zarplata = $con->query("SELECT *,(SELECT surname FROM  workers WHERE id=zarplata.id_worker) AS surname,
(SELECT `name` FROM  workers WHERE id=zarplata.id_worker) AS name,(SELECT m_name FROM  workers WHERE id=zarplata.id_worker) AS m_name,
(SELECT `name` FROM  objects WHERE id=zarplata.id_object) AS name_object FROM zarplata WHERE id_object = '$pole1' AND year = '$pole2' AND month = '$pole3' ORDER BY id ASC");
while ($row = $zarplata->fetch_assoc()) {

    $sheet->setCellValue("$cols[$j]$i",$ii);
    $j++;
    $ii++;
    $a=$row['surname'].' '.$row['name'].' '.$row['m_name'];
    $sheet->setCellValue("$cols[$j]$i", $a);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['name_object']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['salary_in_day']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['salary_in_hour']);
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['hour_all']);
    $hour_all=$row['hour_all'];
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['sum']);
    $sum=$row['sum'];
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['fine']);
    $fine=$row['fine'];
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['avans']);
    $avans=$row['avans'];
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['ostatok_early']);
    $ostatok_early=$row['ostatok_early'];
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['payment']);
    $payment=$row['payment'];
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['money']);
    $money= $row['money'];
    $j++;
    $sheet->setCellValue("$cols[$j]$i", $row['ostatok']);
    $ostatok=$row['ostatok'];
    $i++;
    $j=0;
    $hour_all_sum=$hour_all+$hour_all_sum;
    $sum_sum=$sum+$sum_sum;
    $fine_sum=$fine+$fine_sum;
    $avans_sum=$avans+$avans_sum;
    $ostatok_sum=$ostatok+$ostatok_sum;
    $payment_sum=$payment+$payment_sum;
    $money_sum=$money+$money_sum;
    $ostatok_early_sum=$ostatok_early+$ostatok_early_sum;
}
$sheet->setCellValue("A$i",'');
$sheet->setCellValue("B$i",'Итого');
$sheet->setCellValue("C$i",'');
$sheet->setCellValue("D$i",'');
$sheet->setCellValue("E$i",'');
$sheet->setCellValue("F$i",$hour_all_sum);
$sheet->setCellValue("G$i",$sum_sum);
$sheet->setCellValue("H$i",$fine_sum);
$sheet->setCellValue("I$i",$avans_sum);
$sheet->setCellValue("J$i",$ostatok_early_sum);
$sheet->setCellValue("K$i",$payment_sum);
$sheet->setCellValue("L$i",$money_sum);
$sheet->setCellValue("M$i",$ostatok_sum);
$sheet->setCellValue("N$i",'');
$sheet->setCellValue("O$i",'');
$sheet->getStyle("A$i:O$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle("A$i:O$i")->getFill()->getStartColor()->setRGB('EEEEEE');
//$i=$i-1;
$sheet->getStyle("A3:O$i")->applyFromArray($styleArray);


//$xls = new PHPExcel();
//$xls->getProperties()->setCreator("TS");
//    ->setLastModifiedBy("Maarten Balliauw")
//    ->setTitle("Office 2007 XLSX Test Document")
//    ->setSubject("Office 2007 XLSX Test Document")
//    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
//    ->setKeywords("office 2007 openxml php")
//    ->setCategory("Test result file");

header('Content-Disposition: attachment;filename="zarplata.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('php://output');

