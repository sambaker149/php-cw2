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
         echo "<img src='templates/getjpg.php' height='150'</td>";

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
   <form name="frmdetails" enctype="multipart/form-data" action="" method="post">
   <label for="txtfirstname" class="form-label mt-2">First Name</label>
   <input class="form-control mb-2" name="txtfirstname" type="text" value="{$row['firstname']}" disabled/>
   <label for="txtlastname" class="form-label mt-2">Surname</label>
   <input class="form-control mb-2" name="txtlastname" type="text"  value="{$row['lastname']}" disabled/>
   <label for="txthouse" class="form-label mt-2">House No. and Street</label>
   <input class="form-control mb-2" name="txthouse" type="text"  value="{$row['house']}" required/>
   <label for="txttown" class="form-label mt-2">Town</label>
   <input class="form-control mb-2" name="txttown" type="text"  value="{$row['town']}" required/>
   <label for="txtcounty" class="form-label mt-2">County</label>
   <input class="form-control mb-2" name="txtcounty" type="text"  value="{$row['county']}" required/>
   <label for="txtcountry" class="form-label mt-2">Country</label>
   <input class="form-control mb-2" name="txtcountry" type="text"  value="{$row['country']}" required/>
   <label for="txtpostcode" class="form-label mt-2">Postcode</label>
   <input class="form-control mb-2" name="txtpostcode" type="text"  value="{$row['postcode']}" required/>
   <label for="photo" class="form-label mt-2">Profile Picture</label>
   <input class="form-control mb-2" type="file" name="photo" accept="image/jpeg"/><br/>
   <div class="card-footer">  
   <input type="submit" value="Save Details" name="submit" class="btn btn-outline-primary mb-3 mt-3"/>
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