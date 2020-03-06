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
                <form action="line-notify.php" method="post" onsubmit="return submitFrm()";>
                    <label style="margin-left: 15px; margin-top: 7px;">โต๊ะที่</label><br>
                    <input name="table_no" placeholder='หมายเลขโต๊ะ' type='text'>                
                    <label style="margin-left: 15px; margin-top: 7px;">ชื่อเพลง</label><br>
                    <input name="song" placeholder='ระบุชื่อเพลง' type='text'>                  
                    <label style="margin-left: 15px; margin-top: 7px;">ศิลปิน</label><br>
                    <input name="art" placeholder='ระบุชื่อศิลปิน' type='text'>            
                    <label style="margin-left: 15px; margin-top: 7px;">แคปชั่น</label><br>
                    <input name="caption" placeholder='' type='text'>
                    <input class="btn btn-primary" style="width:90%;" type="submit" name="submit" value="ตกลง">
                    <!-- <div class="text-center"> 
                        <button class="btn btn-primary" style="margin-left:14px;" type="submit" name="submit">ตกลง</button>
                    </div>   -->
                </form>
            </div>
        </div>
    </div>

<script>
    function submitFrm()
    {
        if(confirm('จะขอเพลงนี้จริงอะ !!!')==true)
        {
            document.form_submit.submit.disabled=true;
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
</body>
</html>