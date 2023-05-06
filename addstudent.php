<?php
  include("_includes/config.inc");
  include("_includes/dbconnect.inc");
  include("_includes/functions.inc");

  echo template("templates/partials/nav.php");
  echo template("templates/partials/header.php");
  echo template("templates/register.php");
  echo template("templates/partials/footer.php");
?>