<?php
    include("../_includes/config.inc");
    include("../_includes/dbconnect.inc");

    header("Content-type: image/jpeg");

    global $conn;

    $sql = "SELECT photo FROM student WHERE studentid='" . $_GET['id'] . "';";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
  
    $jpg = $row["photo"];

    echo $jpg;
?>