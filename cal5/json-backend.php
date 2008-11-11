<?php
include('JSON.php');
$json = new Services_JSON();


$getMonth = (($_GET['getMonth']) ? $_GET['getMonth'] : date('n'));
if (($getMonth < 1) || ($getMonth > 12)) {
    $getMonth = date('n');
}
$getYear = (($_GET['getYear']) ? $_GET['getYear'] : date('Y'));


$months[1] = array(3,8,11,19,26);
$months[2] = array(2,7,14,17,25);
$months[3] = array(1,6,13,18,27);
$months[4] = array(3,8,11,19,26);
$months[5] = array(2,7,14,17,25);
$months[6] = array(1,6,13,18,27);
$months[7] = array(3,8,11,19,26);
$months[8] = array(2,7,14,17,25);
$months[9] = array(1,6,13,18,27);
$months[10] = array(3,8,11,19,26);
$months[11] = array(2,7,14,17,25);
$months[12] = array(1,6,13,18,27);

$dates = array();

$monthStamp = mktime(0,0,0,($getMonth),1,$getYear);
$curMonth = date('m', $monthStamp);
while (list($k, $day) = each($months[$getMonth])) {
    $thisStamp = mktime(0,0,0,$curMonth,$day,$getYear);
    $thisDate = date("n/j/Y", $thisStamp);
    $dates[$thisDate] = date('M jS', $thisStamp).' - This is a test. This is a test. This is a test. This is a test. This is a test.';
}

echo($json->encode($dates));
?>
