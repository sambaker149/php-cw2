<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

   // check logged in
    if (isset($_SESSION['id'])) 
    {

        if(isset($_POST['confirm_delete']) && !empty($_POST['students'])) 
        {

            // Loop over students and delete entries  
            foreach($_POST['students'] as $student_id) 
            {
                //Execute sql statement to delete items  
                $sql = "DELETE FROM student WHERE studentid = '$student_id'";
                // Run query  
                $result = mysqli_query($conn,$sql);
            }
            // Redirect to students page
            header("Location: students.php");
        } 
        else 
        {
            // Show the confirmation message
            $confirm_message = "Are you sure you want to delete?";
            $confirm_message .= "<br><br>";
            $confirm_message .= "<form method='POST'>";
            if (!empty($_POST['students'])) 
            {
                foreach ($_POST['students'] as $student_id) 
                {
                    $confirm_message .= "<input type='hidden' name='students[]' value='$student_id'>";
                }
                $confirm_message .= "<input type='button' value='Yes' onclick='showConfirm()' style='margin-right: 10px;'>";
            }
            $confirm_message .= "<input type='button' value='No' onclick='window.location.href=\"students.php\"'>";
            $confirm_message .= "</form>";

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
        if(confirm("Are you sure you want to delete?")) 
        {
            document.forms[0].submit();
        }
    }
</script>