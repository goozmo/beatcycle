<?php
require_once "../../../wp-config.php";

function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}
global $translate;
$codingKey = $translate->getCodingKey();
$download_timeout = $translate->getDownloadTimetout(); 
if(isset($_GET['action']) && $_GET['action']=="email" && isset($_GET['time']) && (time()-decode($_GET['time'],$codingKey))<$download_timeout) {
	$file = decode($_GET['filename'],$codingKey);
	header("Content-type: application/x-file-to-save");
	header("Content-Disposition: attachment; filename=".basename($file));
	readfile($_SERVER['DOCUMENT_ROOT'].wp_make_link_relative($file));
} else {
	echo "Dieses Link ist nicht mehr gültig!";
}
?>