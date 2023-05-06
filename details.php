<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// Check if logged in
if (isset($_SESSION['id'])) 
{

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Check if form has been submitted
   if (isset($_POST['submit'])) 
   {
      // SQL statement to update student details
      $sql = "update student set firstname ='" . mysqli_real_escape_string($conn, $_POST['txtfirstname']) . "',";
      $sql .= "lastname ='" . mysqli_real_escape_string($conn, $_POST['txtlastname'])  . "',";
      $sql .= "house ='" . mysqli_real_escape_string($conn, $_POST['txthouse'])  . "',";
      $sql .= "town ='" . mysqli_real_escape_string($conn, $_POST['txttown'])  . "',";
      $sql .= "county ='" . mysqli_real_escape_string($conn, $_POST['txtcounty'])  . "',";
      $sql .= "country ='" . mysqli_real_escape_string($conn, $_POST['txtcountry'])  . "',";
      $sql .= "postcode ='" . mysqli_real_escape_string($conn, $_POST['txtpostcode'])  . "',";
      $sql .= "photo = NULL ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      if(!empty($_FILES['photo']['tmp_name']))
      {
         $photo = $_FILES["photo"]["tmp_name"]; 
         $imagedata = addslashes(fread(fopen($photo, "r"), filesize($photo)));
         $sql1 = "update student set photo = '" . $imagedata ."' where studentid = '" . $_SESSION['id'] . "';";
         $result = mysqli_query($conn,$sql1);
      }

      $data['content'] = "<h3 class='fw-bold text-primary'>Your details have been updated</h3>";
   }
   else 
   {
      // SQL statment to return student record with ID that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      if(!empty($row['photo']))
         echo "<img src='templates/getimage.php?id=" . $_SESSION['id'] . "' height='150'</td>";

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
   <input name="txtfirstname" type="text" class="form-control" value="{$row['firstname']}" />
   Surname:
   <input name="txtlastname" type="text" class="form-control" value="{$row['lastname']}" />
   Number and Street:
   <input name="txthouse" type="text" class="form-control" value="{$row['house']}" />
   Town:
   <input name="txttown" type="text" class="form-control" value="{$row['town']}" />
   County:
   <input name="txtcounty" type="text" class="form-control" value="{$row['county']}" />
   Country:
   <input name="txtcountry" type="text" class="form-control" value="{$row['country']}" />
   Postcode:
   <input name="txtpostcode" type="text" class="form-control" value="{$row['postcode']}" />
   Profile Picture :
   <input name="profile_picture" type="file" Value="" class="form-control mb-2" /><br/>
   <div class="card-footer">  
   <input type="submit" value="Save" name="submit" class="btn btn-outline-primary mb-3 mt-3"/>
   </div>
   </form>
   </div>
   </div>
EOD;

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