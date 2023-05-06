<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");

    global $conn;

    $delete_array = $_POST['students'];
    if(!empty($delete_array))
    {
        for ($i = 0; $i < count($delete_array); $i++)
        {
            $deleteSQL = "DELETE from student WHERE studentid='" . $delete_array[$i] . "';";
            mysqli_query($conn,$deleteSQL);
        }
    }

    header("Location: students.php");
?>