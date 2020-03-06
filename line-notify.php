 <?php 

    include_once 'connectdb.php'; 

    $header = "รีเควสเพลงจากลูกค้าจ้า";
    $table_no = $_POST['table_no'];
    $song = $_POST['song'];
    $art = $_POST['art'];
    $caption = $_POST['caption'];

    $message = $header.
                "\n". "โต๊ะที่ : " . $table_no .
                "\n". "ชื่อเพลง : " . $song .
                "\n". "ศิลปิน : " . $art .
                "\n". "แคปชั่น : " . $caption;

    if (isset($_POST["submit"])) {
        $query = "INSERT INTO line_notify_music (table_no, name_music, artist, caption)
            VALUE('" . $table_no . "', '" . $song . "', '" . $art . "', '" . $caption . "')";
        $result = mysqli_query($conn, $query);

            echo "<script>alert('วาฬขอเพลงให้ละ');</script>";
            echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
            echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        }
    
        
        if ( $table_no <> "" ||  $song <> "" ||  $art <> "" ||  $caption <> "" ) {
            sendlinemesg();
            
            $res = notify_message($message);
        }
        

    function sendlinemesg() {
		// LINE LINE_API https://notify-api.line.me/api/notify
		// LINE TOKEN f1LE62anzQOY3kYMfNsHaw4fhcqJUpohTyOMCA0TAgG แนะนำให้ใช้ของตัวเองนะครับเพราะของผมยกเลิกแล้วไม่สามารถใช้ได้
        define('LINE_API',"https://notify-api.line.me/api/notify");
        define('LINE_TOKEN',"f1LE62anzQOY3kYMfNsHaw4fhcqJUpohTyOMCA0TAgG");

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