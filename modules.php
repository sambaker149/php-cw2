<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // Check if logged in
   if (isset($_SESSION['id'])) 
   {
      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student's modules
      $sql = "select * from studentmodules sm, module m where m.modulecode = sm.modulecode and sm.studentid = '" . 
      $_SESSION['id'] ."';";

      $result = mysqli_query($conn,$sql);

      // Prepare page content
      $data['content'] .= "<table class='table table-bordered border-dark'>";
      $data['content'] .= "<tr><th colspan='5' align='center'><h2>Modules</h2></th></tr>";
      $data['content'] .= "<tr><th>Module Code</th>
                           <th>Module Name</th>
                           <th>Module Level</th>
                           <th>X</th></tr>";
                           
      // Display modules within HTML table
      while($row = mysqli_fetch_array($result)) 
      {
         $data['content'] .= "<tr><td> $row[modulecode] </td><td> $row[name] </td>";
         $data['content'] .= "<td> $row[level] </td>";
         $data['content'] .= "<td> <input type='checkbox' name='modules[]' value='$row[modulecode]' ></td>";
         $data['content'] .= "</tr>";
      }
      $data['content'] .= "</table><br/>";

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