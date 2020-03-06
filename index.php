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
            <div class="col-md-4 mx-auto col-md-offset-4" style="margin-top: 15px"> 
                <form action="line-notify.php" method="post">
                    <label style="margin-left:14px;">โต๊ะที่</label>
                    <br>
                    <input style="margin-bottom: 15px;" name="table_no" placeholder='หมายเลขโต๊ะ' type='text'>
                    <br>
                    <label style="margin-left:14px;">ชื่อเพลง</label><br>
                    <input style="margin-bottom: 15px;" name="song" placeholder='ระบุชื่อเพลง' type='text'>
                    <br>
                    <label style="margin-left:14px;">ศิลปิน</label><br>
                    <input style="margin-bottom: 15px;" name="art" placeholder='ระบุชื่อศิลปิน' type='text'>
                    <br>
                    <label style="margin-left:14px;">แคปชั่น</label><br>
                    <input style="margin-bottom: 15px;" name="caption" placeholder='' type='text'>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-primary" style="margin-left:14px;" type="submit" name="submit">ตกลง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>