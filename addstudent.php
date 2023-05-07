<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";

// Check if logged in
if (isset($_SESSION['id'])) 
{
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Check if form has been submitted
    if (isset($_POST['submit'])) 
    {
        // Checks if form empty + displays return message
        if(empty($_POST['studentid']) || empty($_POST['password']) 
        || empty($_POST['dob']) || empty($_POST['firstname']) 
        || empty($_POST['lastname']) || empty($_POST['house']) 
        || empty($_POST['town']) || empty($_POST['county']) 
        || empty($_POST['country']) || empty($_POST['postcode'])) {

        $data['content'] = "<h3 class='fw-bold text-danger'>Please fill in ALL required fields to continue</h3>" .
        $data['content'] = "<input type='button' class='btn btn-outline-primary' value='Return to Form' 
                            onclick='window.location.href=\"addstudent.php\"'><br/>";
    } 
    else 
    {  
        // Encrypts user password data    
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $image = $_FILES['profile_picture']['tmp_name'];

        $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));
        $studentid = $_POST['studentid'];

        // SQL query inserting a new student record  
        $sql = "INSERT INTO student (studentid, password, dob, firstname, 
        lastname, house, town, county, country, postcode, profile_picture)
        VALUES ('{$_POST['studentid']}', '$hashed_password', 
                '{$_POST['dob']}', '{$_POST['firstname']}', 
                '{$_POST['lastname']}', '{$_POST['house']}', 
                '{$_POST['town']}', '{$_POST['county']}', 
                '{$_POST['country']}','{$_POST['postcode']}',
                '$imagedata')";

                // Execute query  
                $result = mysqli_query($conn,$sql);

                // Display message
                $data['content'] = "<h3 class='fw-bold text-primary'>Student record has been added! Press return to form to add another entry</p>" .
                $data['content'] = "<input type='button' class='btn btn-outline-primary' value='Return to Form' 
                                    onclick='window.location.href=\"addstudent.php\"'><br/>";
        }
    }
    else 
    {
      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
        $data['content'] = <<<EOD

    <!-- HTML FORM -->
    <div class="container">
    <div class="card">
    <div class="card-header">
    <h2>Add New Student</h2>
    </div>
    <div class="card-body">
    <form name="frmdetails" action="" method="post" enctype="multipart/form-data"">

    Student ID:
    <input name="studentid" type="text" value="" class="form-control mb-2" />
    Password:
    <input name="password" type="password" value="" class="form-control mb-2" />
    Date of Birth:
    <input name="dob" type="date" value="" class="form-control mb-2" />
    First Name:
    <input name="firstname" type="text" value="" class="form-control mb-2" />
    Surname:
    <input name="lastname" type="text"  value="" class="form-control mb-2" />
    Number and Street:
    <input name="house" type="text"  value="" class="form-control mb-2" />
    Town:
    <input name="town" type="text"  value="" class="form-control mb-2" />
    County:
    <input name="county" type="text"  value="" class="form-control mb-2" />
    Country:
    <input name="country" type="text"  value="" class="form-control mb-2" />
    Postcode:
    <input name="postcode" type="text"  value="" class="form-control mb-2" />
    Profile Picture:
    <input name="profile_picture" type="file" Value="" class="form-control mb-2" /><br/>
    <div class="card-footer">  
    <input type="submit" value="Save" name="submit" class="btn btn-outline-primary mb-3 mt-3"/>
    </div>
    </form>

    </div>
    </div>
    </div><br>

EOD;

    }

    // Render template
    echo template("templates/default.php", $data);
} 
else 
{
    // Redirect to home page
    header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>