<?php
require_once 'sendEmailClass.php';

$from = array('email' => 'helpdesk50@bodwell.edu', 'name' => 'IT Helpdesk');
$cc = '';
$subject = 'test2';
$body = 'bodwell-hs';


$to = array(
    array('email' => 'chanho.lee@bodwell.edu', 'name' => "test"),    
array('email' => 'leo.jeong@bodwell.edu', 'name' => "test")
);
sendEmail($from, $to, $cc, $subject, $body, $altBody = '');
 ?>
