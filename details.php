<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// Check if logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If form has been submitted
   if (isset($_POST['submit'])) {

      // SQL statement to update the student details
      $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<h3 class='fw-bold text-primary'>Your details have been updated</h3>";
      $data['content'] .= "<input type='button' value='View Students' class='btn btn-outline-primary' 
                           onclick='window.location.href=\"students.php\"'><br/>";

   }
   else 
   {
      // SQL statement to return the student record with ID that matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <div class="container">
   <div class="card">
   <div class="card-header">
   <h2>My Details</h2>
   </div>
   <div class="card-body">
   <form name="frmdetails" action="" method="post">
   First Name:
   <input name="txtfirstname" type="text" class="form-control mb-2" value="{$row['firstname']}" />
   Surname:
   <input name="txtlastname" type="text" class="form-control mb-2" value="{$row['lastname']}" />
   Number and Street:
   <input name="txthouse" type="text" class="form-control mb-2" value="{$row['house']}" />
   Town:
   <input name="txttown" type="text" class="form-control mb-2" value="{$row['town']}" />
   County:
   <input name="txtcounty" type="text" class="form-control mb-2" value="{$row['county']}" />
   Country:
   <input name="txtcountry" type="text" class="form-control mb-2" value="{$row['country']}" />
   Postcode:
   <input name="txtpostcode" type="text" class="form-control mb-2" value="{$row['postcode']}" />
   </div>
   <div class="card-footer">
   <input type="submit" value="Save" class="btn btn-outline-primary mb-3 mt-3" name="submit"/>
   </div>
   </form>
   </div>
   </div>
EOD;
   }

   // Render template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>