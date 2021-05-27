<?php
require_once 'PHPExcel/Classes/PHPExcel.php';
include 'db_connect.php';

$result = array();
$sql = "SELECT * FROM excel_data_new";
$result_sql = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_assoc($result_sql))
{
 $result[] = $rows;
}

//echo "<pre>";
//print_r($result);

$objPHPExcel = new PHPExcel();

// Set the active Excel worksheet to sheet 0

$objPHPExcel->setActiveSheetIndex(0);

// Merge Columns for showing 'Student's Data' start---------------
$objPHPExcel->setActiveSheetIndex(0)
 ->mergeCells('A1:E1');

$objPHPExcel->getActiveSheet()
 ->getCell('A1')
 ->setValue("Student's Data");

$objPHPExcel->getActiveSheet()
 ->getStyle('A1')
 ->getAlignment()
 ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()
 ->getStyle('A1:E1')
 ->getFill()
 ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
 ->getStartColor()
 ->setARGB('FF3399'); //FF3399 33F0FF F28A8C

// Merge Columns for showing 'Student's Data' close--------------->

// Initialise the Excel row number

$rowCount1 = 2;
$column1 = 'A';
$sql1 = "SHOW COLUMNS FROM excel_data_new";
$result1 = mysqli_query($conn,$sql1);
while($row1 = mysqli_fetch_array($result1))
{
 //echo $row1['Field']."<br>";
 $objPHPExcel->getActiveSheet()->setCellValue($column1.$rowCount1, $row1['Field']);


 $styleArray = array(
 'font' => array(
 'bold' => true,
 'color' => array('rgb' => '3333FF'),
 'size' => 11,
 'name' => 'Verdana'
 ),
 'fill' => array(
 'type' => PHPExcel_Style_Fill::FILL_SOLID,
 'color' => array('rgb' => '33F0FF'))
 );

$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray($styleArray);

 $column1++;
}
//end of adding column names
//start foreach loop to get data

$rowCount = 3;
foreach($result as $key => $values)
{
 //start of printing column names as names of MySQL fields
 $column = 'A';
 foreach($values as $value)
 {
 //echo $value.'<br>';
 //echo $column.$rowCount.'<br>';

 $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
 $column++;
 }
 $rowCount++;
}

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="results.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>
