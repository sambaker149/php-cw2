<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

   // Check if logged in
    if (isset($_SESSION['id'])) 
    {

        if(isset($_POST['confirm_delete']) && !empty($_POST['students'])) 
        {

            // Loop over students and delete entries  
            foreach($_POST['students'] as $student_id) 
            {
                //Execute SQL statement to delete items  
                $sql = "DELETE FROM student WHERE studentid = '$student_id'";
                // Run query  
                $result = mysqli_query($conn,$sql);
            }
            // Redirect to students page
            header("Location: students.php");
        } 
        else 
        {
            // Display confirmation message
            $confirm_message = "<div><h1 class='text-center'>Are you sure you want to delete?</h1>";
            $confirm_message .= "<br><br>";
            $confirm_message .= "<form method='POST'>";
            if (!empty($_POST['students'])) 
            {
                foreach ($_POST['students'] as $student_id) 
                {
                    $confirm_message .= "<input type='hidden' name='students[]' value='$student_id'>";
                }
                $confirm_message .= "<input type='submit' class='btn btn-outline-danger' name='confirm_delete' value='Yes' style='margin-right: 10px;'>";
            }
            $confirm_message .= "<input type='button' class='btn btn-outline-danger' value='No' onclick='window.location.href=\"students.php\"'>";
            $confirm_message .= "</form></div>";

            echo $confirm_message;
        }

    } 
    else 
    {
      // Redirect to index page  
        header("Location: index.php");
    }
?>

<script>
    function showConfirm() 
    {
        confirm_message = "Are you sure you want to delete this Student?";
        if(confirm(confirm_message)) 
        {
            document.forms[0].submit();
        }
    }
</script>