<?php 
    define('isSet',1); // giup truy cap file
    require_once('simple_crawler.php'); // gan file crawler vao
    $chmuc = $_GET['chmuc'];
    $bao = $_GET['bao'];
    echo '<option selected disabled>Chọn bài</option>'; // in
    function macdinh($uri) {
        $xmlDoc = new DOMDocument(); // goi obj domdocument
        $xmlDoc->load($uri); // tai xml
        $link = $xmlDoc->getElementsByTagName('link'); // lay cac phan tu co tag la link
        $i = 1;
        while ($i <= count($link)) { // vong lap in tung gia tri (option)
            echo "<option value='$i'>$i</option>";
            $i++;
        }
    }
    if ($bao == 'nhandan') { // neu la bao nhan dan
        $url = 'https://nhandan.com.vn/rss/'; 
        $uri = $url.$chmuc.'.html'; // tra ve url hoan chi cua chuyen muc
        macdinh($uri);
    } else if ($bao == 'vtv') { // neu la bao vtv

    }
?>