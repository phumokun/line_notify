<?php

    include_once 'connectdb.php'; 

    if (isset($_POST["submit"])) {

        // echo '<pre>';
        // print_r($table_no[0]);
        // echo '</pre>';
        // exit();

        $header = "จองโต๊ะวันนี้";
        $date = date("d-m-Y");
        $name = $_POST['name'];
        $num = $_POST['num'];
        $phone = $_POST['phone'];
        $area = $_POST['area'];
    
        $message = $header.
                    "\n". "จองโต๊ะวันที่ : " . $date .
                    "\n". "ชื่อผู้จอง : " . $name .
                    "\n". "จำนวนคน : " . $num .
                    "\n". "เบอร์โทร : " . $phone .
                    "\n". "บริเวณ : " . $area;

        $query = "INSERT INTO booking (name_user, num, phone, area)
            VALUE('" . $name . "', '" . $num . "', '" . $phone . "', '" . $area . "')";

        $result = mysqli_query($conn, $query);

        if ( $date <> "" ||  $name <> "" ||  $num <> "" ||  $phone <> "" ||  $area <> "" ) {
            sendlinemesg();
            
            $res = notify_message($message);
        }

        if ($result) {
            // echo "<script>alert('วาฬขอเพลงให้ละ');</script>";
            echo "<script type='text/javascript'>window.location.href = 'finish.php?name=submit';</script>";
        } else {
            echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
            echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        }
    }


    


    function sendlinemesg() {
    // LINE LINE_API https://notify-api.line.me/api/notify
    // LINE TOKEN X4xkLBf9boLOGLmMcMy2yKP6KHh6nWXB45Uqlavhq5b แนะนำให้ใช้ของตัวเองนะครับเพราะของผมยกเลิกแล้วไม่สามารถใช้ได้

    define('LINE_API',"https://notify-api.line.me/api/notify");
    define('LINE_TOKEN',"hda9y72UT6XKbU5KBQjWkWNAVHYK0kk0slROcEyllVo");

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

    $accessToken = "bgxuOq0uh7cIc/8/6AMjevvDou2NQ0oPoKtC9Gk4uGv26Jcg9EkYrp5zQPVnUY4KW2fGLDLdiZYqAzEfz5sk/xkMD9Zd4CZsoWFQ1vzpP4MxfWWXaooG/h/8b02+kXHOjsNzcCxotEaxSa8R0dvQOQdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];

    //รับ id ของผู้ใช้
    $id = $arrayJson['events'][0]['source']['userId'];
   
    #ตัวอย่าง Message Type "Text + Sticker"
    if($message == "จองโต๊ะ"){
        $arrayPostData['to'] = $id;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "วาฬได้รับข้อมูลการจองแล้วน้าา\nคอนเฟิร์มการจองโต๊ะเรียบร้อยแล้วนะคะ รับโต๊ะก่อน 21:00 น. นะคะ";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "2";
        $arrayPostData['messages'][1]['stickerId'] = "34";
        pushMsg($arrayHeader,$arrayPostData);
    }
    
    function pushMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/push";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>จองโต๊ะวาฬรายวัน</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap 4.3.1 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
   <style>
       #MainDiv button {
           margin:3px;
       }
   </style>
    <script>
        //你的liff app ID, 例如 --> 0000000000-spPeRmAn
        var YourLiffAppId = '1653949480-JNr2oX95';
 
        function initializeLiff(myLiffId) {
            liff
                .init({
                    liffId: myLiffId
                })
                .then(() => {
                    //取得QueryString
                    let urlParams = new URLSearchParams(window.location.search);
                    //顯示QueryString
                    $('#QueryString').val(urlParams.toString());
                    //顯示UserId
                    liff.getProfile().then(function (e) {
                        $('#field_info').val(e.userId);
                    });
                })
                .catch((err) => {
                    alert(JSON.stringify(err));
                });
        }

        $(document).ready(function () {
            //init LIFF
            initializeLiff(YourLiffAppId);

            //ButtonSendMsg
            $('#ButtonSendMsg').click(function () {
                liff.sendMessages([
                    {
                        type: 'text',
                        text: $('#msg').val()
                    }
                ]).then(() => {
                    alert('วาฬจองโต๊ะให้ละอิอิ');
                }) 
            });
        });
    </script>
</head>
<body>
    <div class="row">
        <div class="col-md-4 mx-auto col-md-offset-4">
            <img src="image/whale.png" class="rounded mx-auto d-block" style="max-width:25%; margin-bottom: 15px; margin-top: 15px" alt="วาฬไม่ใช่ปลา">
        </div>
    </div>
    <div class="row">
        <div id="MainDiv" class="col-md-6" style="margin:5px">
            <form method="post" onsubmit="return submitFrm()";>
                <input class="form-control" type="hidden" id="QueryString">
                
                <label style="margin-left: 15px; margin-top: 7px;">ชื่อผู้จอง</label><br>
                <input name="name" placeholder='กรุณากรอกชื่อผู้ต้องการจอง' type='text' require>                
                <label style="margin-left: 15px; margin-top: 7px;">จำนวนคน</label><br>
                <input name="num" placeholder='ระบุจำนวนคน **กรอกเฉพาะตัวเลขเท่านั้น' type='number' require>                  
                <label style="margin-left: 15px; margin-top: 7px;">เบอร์โทรติดต่อ</label><br>
                <input name="phone" placeholder='เบอร์โทรติดต่อ' type='tel' require>            
                <label style="margin-left: 15px; margin-top: 7px;">บริเวณที่ต้องการ</label><br>
                <input name="area" placeholder='ระบุบริเวณที่ต้องการ' type='text'>
                <input class="form-control" type="hidden" id="msg" value="จองโต๊ะ" />
                <input class="btn btn-primary" style="width:90%;" id="ButtonSendMsg" type="submit" name="submit" value="จองโต๊ะ">
                <!-- <div class="text-center"> 
                    <button class="btn btn-primary" style="margin-left:14px;" type="submit" name="submit">ตกลง</button>
                </div>   -->
            </form>
        </div>
    </div>

    <script>
    function submitFrm() {
        if(confirm('วาฬขอเพลงให้แปร๊ป !!!')==true) {
            document.form_submit.submit.disabled=true;
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>
</html>
