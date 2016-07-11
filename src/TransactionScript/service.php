<?php
include '../../data/config.inc.php';
require_once('./Gateway.php');
require_once('./RecognitionService.php');
$o_gw = new Gateway($cnx);
$o_date = new DateTime();
$o_dateInterval = DateInterval::createFromDateString($o_date->format('Y-m-d H:i:s'));
$o_dateInterval->d = '0';
$o_date->add($o_dateInterval);
$asOf =  $o_date->format('Y-m-d H:i:s');				
$o_rs = new RecognitionService($o_gw);
$contractNumber = 2;
//$o_rs->calculateRevenueRecognitions($contractNumber);
$rr = $o_rs->recognizedRevenue($contractNumber, $asOf);
var_dump($rr);
$cnx = NULL;

$o_asOf = new DateTime('2016-07-06 00:00:00');
$tt1 = $o_asOf->getTimestamp(); 
$o_recognitionDate = new DateTime('2016-07-03 00:00:00');
$tt2 = $o_recognitionDate->getTimestamp();
print_r($tt1-$tt2);

