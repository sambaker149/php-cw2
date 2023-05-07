<?php
  include("_includes/config.inc");
  include("_includes/dbconnect.inc");
  include("_includes/functions.inc");

  // Check if logged in
  if (isset($_SESSION['id'])) 
  {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // SQL statement that selects student's modules
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn,$sql);

    // Create form
    echo "<form action='studentdelete.php' method='POST' id='deleteForm'>";

    // Prepare page content
    echo "<table class='table table-bordered border-dark'>";

    // Display table headings  
    echo "<tr><th class='bg-dark text-light' colspan='6' align='center'><h2>Students</h2></th></tr>";
    echo "<tr class='bg-dark text-light'><th>Name</th><th>Student ID</th><th>DOB</th><th>Address</th><th>Student Photo</th><th>X</th></tr>";

    // Display students within the HTML table
    while($row = mysqli_fetch_assoc($result))
    {
      $student = createStudent($row);
      if($row['profile_picture'] != null)
      {
        echo "<tbody><tr></td><td>" . $student->name ."</td><td>" . $student->id . "</td><td>" 
        . $student->dob . "</td><td>" . $student->address . "</td><td><img src='templates/getimage.php?id=" . $student->id . "' height='100'</td>
        <td><input type='checkbox' value='" . $student->id . "' name='students[]'></td></tr></tbody>";
      }
      else
      {
        echo "<tbody><tr></td><td>" . $student->name ."</td><td>" . $student->id . "</td><td>" 
        . $student->dob . "</td><td>" . $student->address . "</td><td>Photo not Available</td>
        <td><input type='checkbox' value='" . $student->id . "' name='students[]'></td></tr></tbody>";
      }
    }

    // Delete button  
    echo "</table><input input type='submit' class='btn btn-outline-danger' onclick='confirmDelete()' 
          type='button' name='deletebtn' value='Delete Selected' />";

    // Close form  
    echo "</form></div>";
  }

  // Render template
  echo template("templates/partials/footer.php");
?>