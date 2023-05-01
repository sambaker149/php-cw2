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
      $data['content'] .= "<tr><th colspan='5' align='center'>Modules</th></tr>";
      $data['content'] .= "<tr><th>Module Code</th>
                           <th>Module Name</th>
                           <th>Module Level</th></tr>";
      // Display modules within HTML table
      while($row = mysqli_fetch_array($result)) 
      {
         $data['content'] .= "<tr><td> $row[modulecode] </td><td> $row[name] </td>";
         $data['content'] .= "<td> $row[level] </td></tr>";
      }
      $data['content'] .= "</table>";

      // Render template
      echo template("templates/default.php", $data);
   } 
   else 
   {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");
?>