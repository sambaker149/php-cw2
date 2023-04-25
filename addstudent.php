<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";

// check logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

   if(empty($_POST['studentid']) || empty($_POST['password']) 
        || empty($_POST['dob']) || empty($_POST['firstname']) 
        || empty($_POST['lastname']) || empty($_POST['house']) 
        || empty($_POST['town']) || empty($_POST['county']) 
        || empty($_POST['country']) || empty($_POST['postcode'])) {

        $data['content'] = "<p>Please fill in all the required feilds to continue!</p><br>" .
        $data['content'] = "<input type='button' value='Return' onclick='window.location.href=\"addstudent.php\"'>";
   } 
   else 
   {
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

     // SQL query inserting a new student record  
        $sql = "INSERT INTO student (studentid, password, dob, firstname, 
        lastname, house, town, county, country, postcode)
        VALUES ('{$_POST['studentid']}', '$hashed_password', 
                '{$_POST['dob']}', '{$_POST['firstname']}', 
                '{$_POST['lastname']}', '{$_POST['house']}', 
                '{$_POST['town']}', '{$_POST['county']}', 
                '{$_POST['country']}','{$_POST['postcode']}')";

            // Execute query  
            $result = mysqli_query($conn,$sql);

            // Display message
            $data['content'] = "<p>Student record has been added! Press return to add another entry</p>" .
                              "<br>" . 
                              "<input type='button' value='Return' onclick='window.location.href=\"addstudent.php\"'>";
        }
   }
   else 
   {
      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD
   <h2>Add New Student</h2>
   <form name="frmdetails" action="" method="post">
   Student ID :
   <input name="studentid" type="text" value=""  /><br/>
   Password :
   <input name="password" type="password" value=""  /><br/>
   Date of Birth :
   <input name="dob" type="date" value=""  /><br/>
   First Name :
   <input name="firstname" type="text" value=""  /><br/>
   Surname :
   <input name="lastname" type="text"  value=""  /><br/>
   Number and Street :
   <input name="house" type="text"  value=""  /><br/>
   Town :
   <input name="town" type="text"  value=""  /><br/>
   County :
   <input name="county" type="text"  value=""  /><br/>
   Country :
   <input name="country" type="text"  value=""  /><br/>
   Postcode :
   <input name="postcode" type="text"  value=""  /><br/>
   <input type="submit" value="Save" name="submit"/>
   </form>
EOD;

    }

   // render the template
    echo template("templates/default.php", $data);
} 
else 
{
    header("Location: index.php");
}
echo template("templates/partials/footer.php");
?>