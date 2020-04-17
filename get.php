<?php 
    define('isSet',1);
    require_once('simple_crawler.php');
    $bao = $_GET['bao'];
    $chmuc = $_GET['chmuc'];
    $sobai = $_GET['bai'];
    $tenChuyenMuc = $_GET['tchmuc'];
    function macdinh($ten, $uri, $sobai, $web, $tenChuyenMuc, $img_html, $desc_html, $desc_alt_html, $title_html) {
        $xmlDoc = new DOMDocument(); // goi obj tu domdocument
        $xmlDoc->load($uri); // tai xml
        $link = $xmlDoc->getElementsByTagName('link')->item($sobai)->nodeValue;// lay lien ket tu rss qua so bai
        $postContent = file_get_html($link); // lay gia tri html
        $img = $web.$postContent->find($img_html,0)->src; // lay anh tu bai viet
        $desc = $postContent->find($desc_html,0)->children(0)->plaintext;
        $desc = str_replace('NDĐT – ', '', $desc);
        $desc = str_replace('NDĐT-', '', $desc);
        $desc = str_replace('NDĐT- ', '', $desc);
        $desc = str_replace('NDĐT - ', '', $desc);
        // if ($desc == '' || str_word_count($desc) < 30) {
        //     $desc = $postContent->find($desc_alt_html,0)->children(0)->plaintext;            
        // } elseif (str_word_count($desc) > 100) {
        //     $desc = $postContent->find($desc_alt_html,0)->plaintext;
        // }
        $title = $postContent->find($title_html, 0)->plaintext;
        echo "<img src='$img' style='width: 100%'/>"; // in
        echo "<h3 style='padding: 10px'>$title</h3>";
        echo "<p>$desc</p>";
        echo "<p class='text-right' style='padding: 0 10px'>$ten - $tenChuyenMuc</p>";
    }
    if ($bao == 'nhandan') { // neu chon bao nhan dan
        $ten = 'Nhân Dân';
        $web = 'https://nhandan.com.vn'; // trang chu
        $url = 'https://nhandan.com.vn/rss/'; // trang rss
        $uri = $url.$chmuc.'.html'; // tra ve trang chuyen muc rss
        macdinh($ten, $uri, $sobai, $web, $tenChuyenMuc, 'img.mr-3.img-responsive', '.sapo', '.item-content', '.item-container>h3');
    } else if ($bao == 'vtv') { // neu chon bao vtv

    }
?>