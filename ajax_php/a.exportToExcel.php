<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
		if ($mob != false) {
			echo json_encode($mob);
		} else {
			echo json_encode(array('result' => '0'));
		}
} else {
	echo 0;
	exit;
}
?>
