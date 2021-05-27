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
$objPHPExcel->getActiveSheet()->setCellValue('A1','Row No');
$objPHPExcel->getActiveSheet()->setCellValue('B1','MANUFACTURER');
$objPHPExcel->getActiveSheet()->setCellValue('C1','MODEL');
$objPHPExcel->getActiveSheet()->setCellValue('D1','BHSD Gen Year');
$objPHPExcel->getActiveSheet()->setCellValue('E1','Ownership');
$objPHPExcel->getActiveSheet()->setCellValue('F1','"SERIAL NO.(LAPTOP)"');
$objPHPExcel->getActiveSheet()->setCellValue('G1','BHSD ID');
$objPHPExcel->getActiveSheet()->setCellValue('H1','Stock Status');
$objPHPExcel->getActiveSheet()->setCellValue('I1','Device Status');
$objPHPExcel->getActiveSheet()->setCellValue('J1','Asset Remark');
$objPHPExcel->getActiveSheet()->setCellValue('K1','user');
$objPHPExcel->getActiveSheet()->setCellValue('L1','User ID');
$objPHPExcel->getActiveSheet()->setCellValue('M1','Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('N1','User Remark');

$dsn = $settings['pdo']['dsn'];
$conn = new PDO($dsn);
$result = array();
$sql = "SELECT
CASE WHEN left(UserID, 1) like '[0-9]'
THEN
(SELECT CONCAT(CONCAT(FirstName, ' ', LastName), ' ', EnglishName) FROM tblBHSStudent WHERE UserID = StudentID)
WHEN UserID IS NULL
THEN ''
ELSE
(SELECT CONCAT(FirstName, ' ', LastName) FROM tblStaff WHERE UserID = StaffID)
END AS FullName
,*
FROM tblBHSAssetMaster ORDER BY BHSDID ASC";
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
		$AssetID = $result[$i]['AssetID'];
		$FullName = $result[$i]['FullName'];
		$Manufacturer = $result[$i]['Manufacturer'];
		$Model = $result[$i]['Model'];
		$BHSDYear = $result[$i]['BHSDYear'];
		$Ownership = $result[$i]['Ownership'];
		$SerialNo = $result[$i]['SerialNo'];
		$BHSDID = $result[$i]['BHSDID'];
		$StockStatus = $result[$i]['StockStatus'];
		$DeviceStatus = $result[$i]['DeviceStatus'];
		$AssetRemark = $result[$i]['AssetRemark'];
		$UserID = $result[$i]['UserID'];
    $Username = $result[$i]['Username'];
    $UserRemark = $result[$i]['UserRemark'];

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$j", $i+1)
                ->setCellValue("B$j", $Manufacturer)
								->setCellValue("C$j", $Model)
								->setCellValue("D$j", $BHSDYear)
								->setCellValue("E$j", $Ownership)
								->setCellValue("F$j", $SerialNo)
								->setCellValue("G$j", $BHSDID)
								->setCellValue("H$j", $StockStatus)
								->setCellValue("I$j", $DeviceStatus)
								->setCellValue("J$j", $AssetRemark)
								->setCellValue("K$j", $Username)
								->setCellValue("L$j", $UserID)
								->setCellValue("M$j", $FullName)
                ->setCellValue("N$j", $UserRemark);
		$j++;
}

$objPHPExcel->getActiveSheet()->setTitle('AssetMaster');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$date= date("Y-m-d");
$filename=$date."- AssetMaster";

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
