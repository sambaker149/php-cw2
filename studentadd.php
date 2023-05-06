<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");

    global $conn;

    if(isset($_POST['submit']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $id = $_POST['id'];
        $dob = $_POST['dob'];
        $house = $_POST['house'];
        $town = $_POST['town'];
        $county = $_POST['county'];
        $country = $_POST['country'];
        $postcode = $_POST['postcode'];
        $pwd = $_POST['pwd'];

        // Obtain file sent to server within response.
        $photo = $_FILES['photo']['tmp_name']; 

        // Get file binary data
        $imagedata = addslashes(fread(fopen($photo, "r"), filesize($photo)));

        $sql = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, 
        `country`, `postcode`, `photo`) 
        VALUES ('". $id . "', '" . password_hash($pwd, PASSWORD_DEFAULT) . "', '". $dob . "', '". $fname . "', '". $lname . "', 
        '". $house . "', '". $town . "', '". $county . "', '". $country . "', '". $postcode . "', '". $imagedata . "');";
        mysqli_query($conn,$sql);
    }

    header("Location: index.php");
?>