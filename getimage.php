<?php 
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

header("Content-type: image/jpeg");

$sql = "SELECT profile_picture FROM student WHERE studentid='" . $_GET['studentid'] . "';";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$imagedata = $row['profile_picture'];

$data['content'] .= "<td> <img src='data:image/jpeg;base64," . base64_encode($imagedata) . 
"' alt='Profile Picture' height='80' width='80'> </td>";

$jpg = $row["profile_image"];

echo $jpg;
?>