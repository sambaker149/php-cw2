<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if logged in
if (isset($_SESSION['id'])) 
{
   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Check if module has been selected
   if (isset($_POST['selmodule'])) 
   {
      $sql = "insert into studentmodules values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
      $result = mysqli_query($conn, $sql);
      $data['content'] .= "<h3 class='fw-bold text-primary'>The module " . $_POST['selmodule'] . " has been assigned to you</p>";
   }
   else  // If module has not been selected
   {
     // SQL statement that selects all modules
     $sql = "select * from module";
     $result = mysqli_query($conn, $sql);

     $data['content'] .= "<form class='form-control' name='frmassignmodule' action='' method='post' >";
     $data['content'] .= "<h2>Select Module To Assign</h2><br/>";
     $data['content'] .= "<select name='selmodule'>";
     // Display module names in drop down selection box
     while($row = mysqli_fetch_array($result)) 
     {
        $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
     }
     $data['content'] .= "</select><br><br/>";
     $data['content'] .= "<input type='submit' name='confirm' class='btn btn-outline-primary mb-3 mt-3' value='Assign Module' />";
     $data['content'] .= "</form>";
   }

   // Render template
   echo template("templates/default.php", $data);
} 
else 
{
   header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>