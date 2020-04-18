<?php 
    $bao = $_GET['bao'];
    $chmuc = $_GET['chmuc'];
    $sobai = $_GET['bai'];
    $file = $_SERVER['DOCUMENT_ROOT'] . "/php/laytin/luutru/baiTuBao-$bao-chmuc-$chmuc-bai-$sobai.html";
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    header("Content-Type: text/html");
    readfile($file);
    unlink("baiTuBao-$bao-chmuc-$chmuc-bai-$sobai.html");
?>