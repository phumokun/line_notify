<?php 
    include_once 'connectdb.php'; 

    if (isset($_POST['search'])) {
        $month = $_POST['month'];
        $year = $_POST['year'];

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit();

        $query = "SELECT *,COUNT(name_music) as num_nm FROM line_notify_music 
                    WHERE MONTH(create_date) = '" . $month . "' AND YEAR(create_date) = '" . $year . "'
                    GROUP BY name_music
                    ORDER BY create_date ASC";

        // echo $query;
        // exit();

    } else {
        echo "<script type='text/javascript'>window.location.href = 'chart.php';</script>";
    }

    
    // echo $query;
    // exit();

    // echo '<pre>';
    // print_r($row);
    // echo '</pre>';
    // exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <title>ค้นหา</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto col-md-offset-4">
                <form action="action_search_chart.php" method="post">
                    <select class="custom-select mt-4" name="month">
                        <option value="1">มกราคม</option>
                        <option value="2">กุมภาพันธ์</option>
                        <option value="3">มีนาคม</option>
                        <option value="4">เมษายน</option>
                        <option value="5">พฤษภาคม</option>
                        <option value="6">มิถุนายน</option>
                        <option value="7">กรกฎาคม</option>
                        <option value="8">สิงหาคม</option>
                        <option value="9">กันยายน</option>
                        <option value="10">ตุลาคม</option>
                        <option value="11">พฤศจิกายน</option>
                        <option value="12">ธันวาคม</option>
                    </select>
                    <select class="custom-select my-2" name="year">
                        <option value="2020">ปี 2563</option>
                        <option value="2021">ปี 2564</option>
                    </select>
                    <div class="text-center mb-4">
                        <button class="btn btn-primary" type="submit" name="back">หน้าแรก</button>
                        <button class="btn btn-primary" type="submit" name="search">ค้นหา</button>
                    </div>
                </form>
                <div class="table-responsive mt-2">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ชื่อเพลง</th>
                            <th>จำนวนครั้ง</th>
                            <th>ศิลปิน</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $result = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_array($result)){
                    ?>
                        <tr>
                            <td><?php echo $row['name_music']; ?></td>
                            <td><?php echo $row['num_nm']; ?></td>
                            <td><a href="artist.php?art=<?php echo $row['artist']; ?>"><?php echo $row['artist']; ?></td>
                        </tr>
                        <?php } ?>   
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>