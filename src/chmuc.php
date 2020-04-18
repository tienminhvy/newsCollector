<?php 
    define('isSet', 1);
    require_once('simple_crawler.php');
    require_once('vnmesewoaccents.php'); // nhap file chuyen chu tieng viet co dau sang khong dau
    $bao = $_GET['bao'];
    echo '<option selected disabled>Chọn mục</option>'; // mac dinh
    function macdinh($url,$items){
        // $url // muc rss cua bao
        // $items  // menu
        $html = file_get_html($url); // lay gia tri html cua trang rss
        $i = 1;
        $menu = $html->find($items,0)->children();
        while ($i <= count($menu)-1) { // lap tu 1 den so chuyen muc
            $item = $html->find($items,0)->children($i)->plaintext; // tra ve kq tu link sang van ban
            $value = strtolower(convert_name($item)); // chuyen tieng viet co dau sang ko dau va in thuong
            switch ($value) {
                case 'yte':
                    $value = 'y-te';
                    break;
                default:
                    break;
            }
            $content .= "<option value='".$value."'>$item</option>"; // them cac chuyen muc de lua chon
            $i++;
        }
    return $content; // tra ve noi dung, can dung echo de in ra
    }
    if ($bao == 'nhandan') { // neu chon bao nhan dan
        echo macdinh('https://nhandan.com.vn/rss', 'ul.nav.navbar-nav.navbar-menu-items.no-print'); // para2: menu
    } elseif ($bao == 'vtv') { // neu chon bao vtv
        echo macdinh('https://vtv.vn/rss.htm',$html->find('.menu_chinh ul',0)->children());
    }
?>