<?php 


    include_once 'connectdb.php'; 

    $header = "รีเควสเพลงจากลูกค้าจ้า";
    $table_no = $_POST['table_no'];
    $song = $_POST['song'];
    $art = $_POST['art'];
    $caption = $_POST['caption'];

    $head = "ขอเพลงจ้าาาาา";

    $message = $header.
                "\n". "โต๊ะที่ : " . $table_no .
                "\n". "ชื่อเพลง : " . $song .
                "\n". "ศิลปิน : " . $art .
                "\n". "แคปชั่น : " . $caption;

if (isset($_POST["submit"])) {

    // echo '<pre>';
    // print_r($table_no[0]);
    // echo '</pre>';
    // exit();



    $query = "INSERT INTO line_notify_music (table_no, name_music, artist, caption)
        VALUE('" . $table_no . "', '" . $song . "', '" . $art . "', '" . $caption . "')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // echo "<script>alert('วาฬขอเพลงให้ละ');</script>";
        // echo "<script type='text/javascript'>window.location.href = 'finish.php?name=submit';</script>";
    } else {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
    }
}
   
    
    if ( $table_no <> "" ||  $song <> "" ||  $art <> "" ||  $caption <> "" ) {
        sendlinemesg();
        
        $res = notify_message($message);
    }
    

function sendlinemesg() {
    // LINE LINE_API https://notify-api.line.me/api/notify
    // LINE TOKEN w0iSSfRKedrsRplVSIxfmlKLY1YJ7oCFVkTz6b2LaNs แนะนำให้ใช้ของตัวเองนะครับเพราะของผมยกเลิกแล้วไม่สามารถใช้ได้
    
    define('LINE_API',"https://notify-api.line.me/api/notify");
    define('LINE_TOKEN',"w0iSSfRKedrsRplVSIxfmlKLY1YJ7oCFVkTz6b2LaNs");

    function notify_message($message) {
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                            ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                            ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}


?>

<!DOCTYPE html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <title>ขอเพลงวาฬ</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto col-md-offset-4">
                <img src="image/whale.png" class="rounded mx-auto d-block" style="max-width:25%; margin-bottom: 15px; margin-top: 15px" alt="วาฬไม่ใช่ปลา">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto col-md-offset-4" style="margin-top: 5px"> 
                <form action="" method="post" onsubmit="return submitFrm()";>
                    <label style="margin-left: 15px; margin-top: 7px;">โต๊ะที่</label><br>
                    <input name="table_no" placeholder='หมายเลขโต๊ะ' type='text'>                
                    <label style="margin-left: 15px; margin-top: 7px;">ชื่อเพลง</label><br>
                    <input name="song" placeholder='ระบุชื่อเพลง' type='text'>                  
                    <label style="margin-left: 15px; margin-top: 7px;">ศิลปิน</label><br>
                    <input name="art" placeholder='ระบุชื่อศิลปิน' type='text'>            
                    <label style="margin-left: 15px; margin-top: 7px;">แคปชั่น</label><br>
                    <input name="caption" placeholder='' type='text'>
                    <input class="btn btn-primary" style="width:90%;" id="submit" type="submit" name="submit" value="ตกลง">
                    <!-- <div class="text-center"> 
                        <button class="btn btn-primary" style="margin-left:14px;" type="submit" name="submit">ตกลง</button>
                    </div>   -->
                </form>
            </div>
        </div>
    </div>


    <input id="useridprofilefield" type="hidden">
    <input id="displaynamefield" type="hidden">

    <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script> 
           
    <script type="text/javascript">

    

    window.onload = function (e) {
        // init で初期化。基本情報を取得。
        // https://developers.line.me/ja/reference/liff/#initialize-liff-app
        liff.init(function (data) {
            getProfile();
            initializeApp(data);
        });

        // LIFF アプリを閉じる
        // https://developers.line.me/ja/reference/liff/#liffclosewindow()
        document.getElementById("submit").addEventListener("click", function () {
            
            liff.sendMessages([{
                type: "text",
                text: "<?php echo $head; ?>"
            }, {
                type: 'sticker',
                packageId: '11537',
                stickerId: '52002748'
            }]).then(function () {
                window.alert("วาฬขอเพลงให้ละ");
            });
            liff.closeWindow();  
        });
    };

    function submitFrm() {
        if(confirm('วาฬขอเพลงให้แปร๊ป !!!')==true) {
            document.form_submit.submit.disabled=true;
            return true;
        } else {
            return false;
        }
    }

    // プロファイルの取得と表示
    function getProfile(){
        // https://developers.line.me/ja/reference/liff/#liffgetprofile()
        liff.getProfile().then(function (profile) {
            document.getElementById('useridprofilefield').val = profile.userId;
            document.getElementById('displaynamefield').textContent = profile.displayName;

        }).catch(function (error) {
            window.alert("Error getting profile: " + error);
        });
    }

    </script>
</body>
</html>