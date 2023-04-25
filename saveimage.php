<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$image = $_FILES['profile_picture']['tmp_name'];

$imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));
$studentid = $_POST['studentid'];

$sql = "UPDATE student SET profile_picture='$imagedata' WHERE studentid='$studentid'";

mysqli_query($conn, $sql);

header("location: students.php");
exit();
?>