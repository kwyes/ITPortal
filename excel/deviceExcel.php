<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

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
$objPHPExcel->getActiveSheet()->setCellValue('E1','Student Status');
$objPHPExcel->getActiveSheet()->setCellValue('F1','Enrollment Date');
$objPHPExcel->getActiveSheet()->setCellValue('G1','DeviceID');
$objPHPExcel->getActiveSheet()->setCellValue('H1','Category');
$objPHPExcel->getActiveSheet()->setCellValue('I1','BHSD No.');
$objPHPExcel->getActiveSheet()->setCellValue('J1','Type');
$objPHPExcel->getActiveSheet()->setCellValue('K1','MAC Address');
$objPHPExcel->getActiveSheet()->setCellValue('L1','Network Status');
$objPHPExcel->getActiveSheet()->setCellValue('M1','Device Status');

$dsn = $settings['pdo']['dsn'];
$conn = new PDO($dsn);
$result = array();
$sql = "SELECT
										d.StudentID,
										s.FirstName,
									  s.LastName,
										s.EnglishName,
										s.CurrentStudent,
										CONVERT(char(10), s.EnrolmentDate, 126) AS EnrolmentDate,
										d.DeviceID,
										d.DeviceCategory,
										d.BHSDNo,
										d.DeviceType,
										d.MACAddress,
										d.Network,
										d.NetworkRegStatus,
										d.DeviceStatus
									FROM
									tblBHSStudentEndDevice d
									LEFT JOIN
									tblBHSStudent s
									ON
										d.StudentID = s.StudentID
									ORDER BY
										s.StudentID ASC, d.DeviceID ASC";
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
		$CurrentStudent = $result[$i]['CurrentStudent'];
		$EnrollmentDate = $result[$i]['EnrolmentDate'];
		$DeviceID = $result[$i]['DeviceID'];
		$DeviceCategory = $result[$i]['DeviceCategory'];
		$BHSDNo = $result[$i]['BHSDNo'];
		$DeviceType = $result[$i]['DeviceType'];
		$MACAddress = $result[$i]['MACAddress'];
		$Network = $result[$i]['Network'];
		$NetworkRegStatus = $result[$i]['NetworkRegStatus'];
		$DeviceStatus = $result[$i]['DeviceStatus'];

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$j", $StudentID)
                ->setCellValue("B$j", $FirstName)
								->setCellValue("C$j", $LastName)
								->setCellValue("D$j", $EnglishName)
								->setCellValue("E$j", $CurrentStudent)
								->setCellValue("F$j", $EnrollmentDate)
								->setCellValue("G$j", $DeviceID)
								->setCellValue("H$j", $DeviceCategory)
								->setCellValue("I$j", $BHSDNo)
								->setCellValue("J$j", $DeviceType)
								->setCellValue("K$j", $MACAddress)
								->setCellValue("L$j", $NetworkRegStatus)
								->setCellValue("M$j", $DeviceStatus);
		$j++;
}

$objPHPExcel->getActiveSheet()->setTitle('Device');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$date= date("Y-m-d");
$filename=$date."- Device List";

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
