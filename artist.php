<?php 
    include_once 'connectdb.php'; 
    if (isset($_GET['art'])) {
        $artist = $_GET['art'];
        $query = "SELECT *, COUNT(name_music) as num_nm FROM line_notify_music
                    WHERE artist = '" . $artist . "'
                    GROUP BY name_music
                    ORDER BY create_date ASC";
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
    <title>List เพลงร้านวาฬ</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto col-md-offset-4">
                <div class="table-responsive mt-4">
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
                            <td><?php echo $row['artist']; ?></td>
                        </tr>
                    <?php } ?>   
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="chart.php"><button class="btn btn-primary" type="submit" name="submit">ย้อนกลับ</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>