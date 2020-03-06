<?php

    $conn = mysqli_connect("localhost","root","","line_notify");

    $conn->set_charset("utf8");

    if(!$conn) {
        die("Failed to connec to database" . mysqli_error($conn));
    }


    // $conn = mysqli_connect("localhost","id12823731_whalehatyai","Su7270112720.","id12823731_whalehatyai");

    // $conn->set_charset("utf8");

    // if(!$conn) {
    //     die("Failed to connec to database" . mysqli_error($conn));
    // }
?>