<?php 
    define('isSet',1);
    require_once('simple_crawler.php');
    require_once('vnmesewoaccents.php');
    $bao = $_GET['bao'];
    $chmuc = $_GET['chmuc'];
    $sobai = $_GET['bai'];
    $tenChuyenMuc = $_GET['tchmuc'];
    if ($bao == 'nhandan') { // neu chon bao nhan dan
        $ten = 'Báo Nhân Dân';
        $web = 'https://nhandan.com.vn'; // trang chu
        $url = 'https://nhandan.com.vn/rss/'; // trang rss
        $uri = $url.$chmuc.'.html'; // tra ve trang chuyen muc rss
        $xmlDoc = new DOMDocument(); // goi obj tu domdocument
        $xmlDoc->load($uri); // tai xml
        $link = convert_name($xmlDoc->getElementsByTagName('link')->item($sobai)->nodeValue);// lay lien ket tu rss qua so bai
        $postContent = file_get_html($link); // lay gia tri html
        $img = $web.$postContent->find('img.mr-3.img-responsive',0)->src; // lay anh tu bai viet
        $desc = $postContent->find('.sapo',0)->children(0)->plaintext;
        $desc = str_replace('NDĐT – ', '', $desc);
        $desc = str_replace('NDĐT-', '', $desc);
        $desc = str_replace('NDĐT- ', '', $desc);
        $desc = str_replace('NDĐT - ', '', $desc);
        if ($desc == '') {
            $desc = $postContent->find('.item-content',0)->children(0)->plaintext; 
        }
        // if ($desc == '' || str_word_count($desc) < 30) {
        //     $desc = $postContent->find('.item-content',0)->children(0)->plaintext;            
        // } elseif (str_word_count($desc) > 100) {
        //     $desc = $postContent->find('.item-content',0)->plaintext;
        // }
        $title = $postContent->find('.item-container>h3', 0)->plaintext;
        echo $dl = "<img src='$img' style='width: 100%;'/> 
        <h3 style='padding: 10px; font-family: Arial, sans-serif'>$title</h3>
        <p style='padding: 0 10px; font-family: Arial, sans-serif'>$desc</p>
        <p style='text-align: right; padding: 0 10px; font-family: Arial, sans-serif'>$ten - $tenChuyenMuc</p>";
        $html_content = 
"
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<style>* {margin: 0; padding: 0}</style>
</head>
<body>$dl</body>
</html>
";
    } else if ($bao == 'vtv') { // neu chon bao vtv

    }
    $fileE = fopen($_SERVER['DOCUMENT_ROOT'] . "/php/laytin/luutru/baiTuBao-$bao-chmuc-$chmuc-bai-$sobai.html","w") or die("Unable to open file!");;
    fwrite($fileE, $html_content);
    fclose($fileE);
?>