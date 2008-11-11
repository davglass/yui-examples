<?php
include('JSON.php');
$json = new Services_JSON();

$str = $_POST['check'];

$out = new stdclass();
$out->check = 'spelling';
$out->data = Array();
$out->data[0] = new stdclass();
$out->data[0]->word = 'Thsi';
$out->data[0]->suggestions = array("This","Thai","Th's");

$out->data[1] = new stdclass();
$out->data[1]->word = 'tset';
$out->data[1]->suggestions = array("test","stet","Set","Tet","set");


echo($json->encode($out));
?>
