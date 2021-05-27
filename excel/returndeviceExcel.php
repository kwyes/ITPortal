<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


function returnStatus($s){
  $txt = '';
  switch ($s) {
    case '0':
      $txt = 'Pending';
      break;
    case '1':
      $txt = 'Not Returned';
      break;
    case '2':
      $txt = 'Returned';
      break;
    default:
      $txt = 'Pending';
      break;
  }
  return $txt;
}

function deviceStatus($s){
  $txt = '';
  switch ($s) {
    case '1':
      $txt = 'Ok';
      break;
    case '2':
      $txt = 'Minor';
      break;
    case '3':
      $txt = 'Major';
      break;
    case '3':
      $txt = 'Missing';
      break;
    default:
      $txt = 'Not Returned';
      break;
  }
  return $txt;
}

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../PHPExcel/Classes/PHPExcel.php';
require_once '../settings.php';
global $settings;

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1','StudentID');
$objPHPExcel->getActiveSheet()->setCellValue('B1','FirstName');
$objPHPExcel->getActiveSheet()->setCellValue('C1','LastName');
$objPHPExcel->getActiveSheet()->setCellValue('D1','EnglishName');
$objPHPExcel->getActiveSheet()->setCellValue('E1','School Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1','Counsellor');
$objPHPExcel->getActiveSheet()->setCellValue('G1','Return Status');
$objPHPExcel->getActiveSheet()->setCellValue('H1','Service Tag');
$objPHPExcel->getActiveSheet()->setCellValue('I1','BHSD No.');
$objPHPExcel->getActiveSheet()->setCellValue('J1','Asset Label');
$objPHPExcel->getActiveSheet()->setCellValue('K1','Tablet');
$objPHPExcel->getActiveSheet()->setCellValue('L1','Keyboard');
$objPHPExcel->getActiveSheet()->setCellValue('M1','Pen');
$objPHPExcel->getActiveSheet()->setCellValue('N1','Charger');
$objPHPExcel->getActiveSheet()->setCellValue('O1','Deduct');
$objPHPExcel->getActiveSheet()->setCellValue('P1','Deduct Amount');
$objPHPExcel->getActiveSheet()->setCellValue('Q1','Inspection Date');
$objPHPExcel->getActiveSheet()->setCellValue('R1','Inspection Result');


$dsn = $settings['pdo']['dsn'];
$conn = new PDO($dsn);
$result = array();
$sql = "SELECT s.FirstName, s.LastName, s.EnglishName, s.SchoolEmail, s.Counselor, r.*
FROM tblBHSReturnDevices r
LEFT JOIN tblBHSStudent s on s.StudentID = r.StudentID
ORDER BY StudentID ASC";
$stmt = $conn->prepare($sql);

$stmt->execute();

while ($row = $stmt->fetch()) {
	$result[] = $row;
}
$rowCount = 2;
$j = 2;
for ($i=0; $i < sizeof($result); $i++)
{
    // Add some data
		$StudentID = $result[$i]['StudentID'];
		$FirstName = $result[$i]['FirstName'];
		$LastName = $result[$i]['LastName'];
		$EnglishName = $result[$i]['EnglishName'];
		$SchoolEmail = $result[$i]['SchoolEmail'];
		$Counselor = $result[$i]['Counselor'];
		$ReturnStatus = returnStatus($result[$i]['ReturnStatus']);
    $ServiceTag = $result[$i]['ServiceTag'];
		$BHSDID = $result[$i]['BHSDID'];
		$rAssetLabels = deviceStatus($result[$i]['rAssetLabels']);
		$rTablet = deviceStatus($result[$i]['rTablet']);
		$rKeyboard = deviceStatus($result[$i]['rKeyboard']);
    $rPen = deviceStatus($result[$i]['rPen']);
		$rPower = deviceStatus($result[$i]['rPower']);
    $DeductCheck = $result[$i]['DeductCheck'];
    $DeductionAmount = $result[$i]['DeductionAmount'];
    $InspectionDate = $result[$i]['InspectionDate'];
    $InspectionResult = $result[$i]['InspectionResult'];

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$j", $StudentID)
                ->setCellValue("B$j", $FirstName)
								->setCellValue("C$j", $LastName)
								->setCellValue("D$j", $EnglishName)
								->setCellValue("E$j", $SchoolEmail)
								->setCellValue("F$j", $Counselor)
								->setCellValue("G$j", $ReturnStatus)
								->setCellValue("H$j", $ServiceTag)
								->setCellValue("I$j", $BHSDID)
								->setCellValue("J$j", $rAssetLabels)
								->setCellValue("K$j", $rTablet)
								->setCellValue("L$j", $rKeyboard)
								->setCellValue("M$j", $rPen)
                ->setCellValue("N$j", $rPower)
                ->setCellValue("O$j", $DeductCheck)
                ->setCellValue("P$j", $DeductionAmount)
                ->setCellValue("Q$j", $InspectionDate)
                ->setCellValue("R$j", $InspectionResult);
		$j++;
}

$objPHPExcel->getActiveSheet()->setTitle('Return Device');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$date= date("Y-m-d");
$filename=$date."- Return Device List";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
