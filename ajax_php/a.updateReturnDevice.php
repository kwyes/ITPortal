<?php
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
  @extract($_POST);
  if(isset($returnId)) {
    include_once '../config/dbconnect.php';
		require_once '../config/ITAdminClass.php';
		$c = new ITAdminClass();
    $mob = $c->updateReturnDevice($returnId, $ReturnStatus, $BHSDID, $ServiceTag, $rAssetLabels, $rTablet, $rKeyboard, $rPen, $rPower, $InspectionResult, $DeductCheck, $DeductionAmount,$InspectionDate, $OrgReturnStatus);

		if ($mob != false) {
			echo json_encode($mob);
		} else {
			echo json_encode(array('result' => '0'));
		}
  } else {
    echo json_encode(array('result' => '0'));
  }
} else {
	echo 0;
	exit;
}
