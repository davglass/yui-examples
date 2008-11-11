#!/usr/bin/php
<?php
$str = file_get_contents('raw.json');

$data = json_decode($str);

$out = Array('YAHOO' => true, 'util' => true, 'widget' =>true, 'example' => true);
$outP = Array();


foreach ($data->classmap as $name => $value) {
    $len = strrpos($name, '.');
    if ($len > 0) {
        $name = substr($name, ($len + 1));
    }
    $out[$name] = true;
    $methods = Array();
    if ($value->methods) {
        foreach ($value->methods as $m => $v) {
                $len = strrpos($m, '.');
                if ($len > 0) {
                    $m = substr($m, ($len + 1));
                }
                if ($m != 'contains') {
                    if (!array_key_exists('private', $v) && !array_key_exists('protected', $v)) {
                        $out[$m] = true;
                    } else {
                        $outP[$m] = true;
                    }
                }
        }
    }
}

//print_r($out);

$startStr = 'syn keyword javaScriptYUI'."    ";
$str = $startStr.'';
$outStr = Array();
foreach($out as $k => $v) {
    $str .= $k.' ';
    if (strlen($str) > 800) {
        $outStr[] = $str .= "\n";
        $str = $startStr.'';
    }
}
$str .= "\n";
$outStr[] = $str;

$startStr = 'syn keyword javaScriptYUIPrivate'."    ";
$str = $startStr.'';
foreach($outP as $k => $v) {
    $str .= $k.' ';
    if (strlen($str) > 800) {
        $outStr[] = $str .= "\n";
        $str = $startStr.'';
    }
}
$str .= "\n";
$outStr[] = $str;

$str = '';
foreach ($outStr as $k => $v) {
    $str .= $v;
}

$str1 = file_get_contents('js1.vim');
$str2 = file_get_contents('js2.vim');

$str = '"Starting YUI methods'."\n".$str1.$str.$str2;

$handle = fopen('javascript.vim', 'w');
fwrite($handle, $str);
fclose($handle);
?>
