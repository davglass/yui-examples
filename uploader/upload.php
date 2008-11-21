<?php
include('JSON.php');
$json = new Services_JSON();
$error = false;
$url = str_replace('upload.php', 'tmp/', $_SERVER['PHP_SELF']);
//Server
$uploaddir = '/home/davglass/blog.davglass.com/files/yui/uploader/tmp/';
//Local
//$uploaddir = '/Users/davglass/Sites/yui/uploader/tmp/';
$field = $_FILES['loader1'];
if ($_FILES['loader2']) {
    $field = $_FILES['loader2'];
}
$filename = str_replace(' ', '_', basename($field['name']));
$uploadfile = $uploaddir . $filename;

$data = new stdclass();
$data->response = new stdclass();

if (is_uploaded_file($field['tmp_name'])) {
    $imgExt = trim(strtolower(substr($filename, (strrpos($filename, '.') + 1))));
    switch ($imgExt) {
        case 'jpg'  : $imgOK = true;  break;  
        case 'jpeg' : $imgOK = true;  $imgExt = 'jpg'; break;
        case 'gif'  : $imgOK = true;  break;  
        case 'png'  : $imgOK = true; break;
        default     : $imgOK = false; break;
    }
    if ($imgOK) {
        if (!copy($field['tmp_name'], $uploadfile)) {
            $error = 'Image Copy Failed';
        }
    } else {
        $error = 'Invalid Image Type';
    }
} else {
    $error = 'Upload Failed';
}

if ($error) {
    //Bail..
    $data->response->error = $error;
} else {
    $data->response->file = $filename;
    $data->response->url = 'http://'.$_SERVER['HTTP_HOST'].$url.$filename;
    $data->response->size = PrettySize(filesize($uploadfile));
}

echo($json->encode($data));


function PrettySize($size) {
    if ($size == 'na') { 
        $mysize = '<i>unknown</i>';
    } else {
        $gb = 1024*1024*1024;
        $mb = 1024*1024;
        if ($size > $gb) {
            $mysize = sprintf ("%01.2f",$size/$gb) . " GB";
        } elseif ($size > $mb) {
            $mysize = sprintf ("%01.2f",$size/$mb) . " MB";
        } elseif ( $size >= 1024 ) {
            $mysize = sprintf ("%01.2f",$size/1024) . " Kb";
        } else {
            $mysize = $size . " bytes";
        }       
    }
    return $mysize;
}
?>
