<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");

    global $conn;

    if(isset($_POST['submit']))
    {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $house = mysqli_real_escape_string($conn, $_POST['house']);
        $town = mysqli_real_escape_string($conn, $_POST['town']);
        $county = mysqli_real_escape_string($conn, $_POST['county']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

        // Obtain file sent to server within response.
        $photo = $_FILES['photo']['tmp_name']; 

        // Get file binary data
        $imagedata = addslashes(fread(fopen($photo, "r"), filesize($photo)));
    
        $sql = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`, `photo`) 
        VALUES ('". $id . "', '" . password_hash($pwd, PASSWORD_DEFAULT) . "', '". $dob . "', '". $fname . "', '". $lname . "', '". $house . "', '". $town . "', '". $county . "', '". $country . "', '". $postcode . "', '". $imagedata . "');";
        mysqli_query($conn,$sql);
    }

    header("Location: index.php");
?>