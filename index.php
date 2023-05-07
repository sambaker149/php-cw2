<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");
   include("seed.php");

   // Seed DB
   seedDatabase();

   echo template("templates/partials/header.php");

   if (isset($_GET['return'])) 
   {
      $msg = "";
      if ($_GET['return'] == "fail") {$msg = "<h3 class='fw-bold text-danger'>Login Failed. Please try again.</h3>";}
      $data['message'] = "<p>$msg</p>";
   }

   if (isset($_SESSION['id'])) 
   {
      $data['content'] = "<img src='uploads/bnu-logo.webp' width='500' height='350' class='mx-auto d-block'>";
      $data['content'] .= "<h1 class='text-center mt-5'>Welcome To The Student Dashboard<br/>";
      echo template("templates/partials/nav.php");
      echo template("templates/default.php", $data);
      echo template("templates/partials/navlist.php");
   } 
   else 
   {
      echo template("templates/login.php", $data);
   }

   echo template("templates/partials/footer.php");
?>