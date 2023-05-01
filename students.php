<?php

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");


   // Check if logged in
    if (isset($_SESSION['id'])) 
    {
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");

      // SQL statment that selects student's modules
        $sql = "SELECT * FROM student";

        $result = mysqli_query($conn,$sql);

      // Create form
        $data['content'] .= "<form action='deletestudents.php' method='POST'>";

      // Prepare page content
        $data['content'] .= "<table class='table table-bordered border-dark'>";

      // Display table headings  
        $data['content'] .= "<tr><th colspan='5' align='center'>Students</th></tr>";
        $data['content'] .= "<tr><th>Student ID</th><th>First Name</th>
                            <th>Last Name</th><th>DOB</th>
                            <th>House</th><th>Town</th>
                            <th>County</th><th>Country</th>
                            <th>Postcode</th><th>Profile Image</th>
                            <th>X</th></tr>";

      // Display students within the HTML table
        while($row = mysqli_fetch_array($result)) 
        {
        $data['content'] .= "<tr>";
            $data['content'] .= "<td> {$row["studentid"]} </td>";
            $data['content'] .= "<td> {$row["firstname"]} </td>";
            $data['content'] .= "<td> {$row["lastname"]} </td>";
            $data['content'] .= "<td> {$row["dob"]} </td>";
            $data['content'] .= "<td> {$row["house"]} </td>";
            $data['content'] .= "<td> {$row["town"]} </td>";
            $data['content'] .= "<td> {$row["county"]} </td>";
            $data['content'] .= "<td> {$row["country"]} </td>";
            $data['content'] .= "<td> {$row["postcode"]} </td>";
            $data['content'] .= "<td> {$row["profile_picture"]} </td>";
            $data['content'] .= "<td> <input type='checkbox' name='students[]' value='$row[studentid]' ></td>";
            $data['content'] .= "</tr>";
        }
        $data['content'] .= "</table><br>";

      // Delete button  
        $data['content'] .= "<input type='submit' class='btn btn-outline-danger' name='deletebtn' value='Delete'/>";

      // Close form  
        $data['content'] .= "</form>";

      // Render template
        echo template("templates/default.php", $data);
    } 
    else 
    {
        header("Location: index.php");
    }

    echo template("templates/partials/footer.php");
?>