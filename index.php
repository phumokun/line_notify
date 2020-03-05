<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        input {
            border:1px solid #ccc;
            width:200px;
            padding:10px;
            margin:5px 15px;
            border-radius:5px;
        }
        .send {
            width:220px;
        }
    </style>
</head>
<body>

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
        <button type="submit" name="submit">ตกลง</button>
    </form>
    
</body>
</html>