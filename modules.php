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
      $sql = "select * from studentmodules sm, module m where m.modulecode = 
               sm.modulecode and sm.studentid = '" . $_SESSION['id'] ."';";
      $result = mysqli_query($conn,$sql);

      // Prepare page content
      $data['content'] .= "<table class='table table-bordered border-dark'>";
      $data['content'] .= "<tr><th class='bg-dark text-light' colspan='3' align='center'><h2>Modules</h2></th></tr>";
      $data['content'] .= "<tr class='bg-dark text-light'><th>Module Code</th>
                           <th>Module Name</th>
                           <th>Module Level</th></tr>";

      // Display modules within HTML table
      while($row = mysqli_fetch_array($result)) 
      {
         $data['content'] .= "<tr><td> $row[modulecode] </td><td> $row[name] </td>";
         $data['content'] .= "<td> $row[level] </td>";
         $data['content'] .= "</tr>";
      }
      if(mysqli_num_rows($result) == 0)
      {
         $data['content'] .= "<h3 class='fw-bold text-danger'>No Modules Assigned</h3>";
      }

      // Close form  
      $data['content'] .= "</table>";

      // Render template
      echo template("templates/default.php", $data);
      echo template("templates/partials/footer.php");

   } 
   else 
   {
      header("Location: index.php");
   }

   echo "</div></div></div></div></div></div></div></div>";

   
?>