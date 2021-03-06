<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống lấy tin từ báo</title>
    <!-- Bootstrap 4.x CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
</head>
<body>
    <h1 class="text-center">Hệ thống lấy tin</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col">
                <div class="collect">
                    <select id="nguonbao" onchange="doiChuyenMuc(this.value)">
                        <option selected disabled>Chọn nguồn báo</option>
                        <option value="nhandan">Báo Nhân Dân</option>
                        <option value="vtv">Báo VTV</option>
                    </select>
                    <select id="chuyenmuc" onchange="soBaiViet()">
                        <option selected disabled>Chọn mục</option>
                    </select>
                    <select id="chonbai">
                        <option selected disabled>Chọn bài</option>
                    </select>
                    <button class="btn btn-info" onclick="layTin();dl()">Lấy tin</button>
                    <button class="btn btn-info"><a style="color: white" href="dl.php" id="dl">Nhấn vô đây sau khi get để tải file xuống</a></button>
                </div>
            </div>
            <div class="col-lg-8 col" id="display">
                
            </div>
        </div>
    </div>
    <!-- Bootstrap 4.x JS + Jquery 3.x-->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <script>
        function doiChuyenMuc(bao){ // Sau khi chon bao can lay
            if (bao == '') { // neu chuyen muc rong thi thoat ct
                $('#chuyenmuc').html(''); 
                return;
            } else {
                if (window.XMLHttpRequest) { // kiem tra browser co ho tro xmlhttprequest khong
                    xmlHttp = new XMLHttpRequest();
                } 
                xmlHttp.onreadystatechange = function (){ // ajax
                    if (this.readyState == 4 && this.status == 200) {
                        $('#chuyenmuc').html(this.responseText);
                    }
                }
                xmlHttp.open('GET', 'chmuc.php?bao='+bao, true);
                xmlHttp.send()
            }
        }
        function soBaiViet() { // sau khi chon chuyen muc
            bao = $('#nguonbao').val();
            chmuc = $('#chuyenmuc').val();
            if (chmuc == '') {
                return;
            } else {
                if (window.XMLHttpRequest) {
                    xmlHttp = new XMLHttpRequest;
                }
                xmlHttp.onreadystatechange = function (){
                    if (this.readyState == 4 && this.status == 200) {
                        $('#chonbai').html(this.responseText);
                    }
                }
                xmlHttp.open('GET', 'chonbai.php?chmuc='+chmuc+'&bao='+bao,true);
                xmlHttp.send();
            }
        }
        function layTin() { // nhan de lay tin
            bao = $('#nguonbao').val();
            chmuc = $('#chuyenmuc').val();
            sobai = $('#chonbai').val();
            tenchmucdu = $('#chuyenmuc option:selected').html();
            if (chmuc == '') {
                return;
            } else {
                if (window.XMLHttpRequest) {
                    xmlHttp = new XMLHttpRequest();
                }
                xmlHttp.onreadystatechange = function (){
                    if (this.readyState == 4 && this.status == 200){
                        $('#display').html(this.responseText);
                    }
                }
                xmlHttp.open('GET', 'get.php?chmuc='+chmuc+'&bao='+bao+'&bai='+sobai+'&tchmuc='+tenchmucdu,true);
                xmlHttp.send();
            }
        }
        function dl(){
            sobai = $('#chonbai').val();
            $('#dl').attr('href', 'dl.php?bao='+bao+'&chmuc='+chmuc+'&bai='+sobai);
        }
    </script>
</body>
</html>