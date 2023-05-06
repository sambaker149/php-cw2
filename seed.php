<?php
    include("_includes/dbconnect.inc");

    function seedDatabase()
    {
        global $conn;
        $sql = "select * from student;";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);

        $student1 = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`) 
        VALUES ('20000001', '" . password_hash("test", PASSWORD_DEFAULT) . "', '2005-09-25', 'Harry', 'Jefferson', '53 Corporation Street', 'High Wycombe', 'Bucks', 'UK', 'HP13 6TQ');";
        
        $student2 = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`) 
        VALUES ('20000002', '" . password_hash("test", PASSWORD_DEFAULT) . "', '2003-05-31', 'Cameron', 'West', '201 High Street', 'Langley', 'Berks', 'UK', 'SL3 8LP');";

        $student3 = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`) 
        VALUES ('20000003', '" . password_hash("test", PASSWORD_DEFAULT) . "', '2002-12-27', 'Justin', 'Peacock', '26 Luker Avenue', 'Henley-on-Thames', 'Oxon', 'UK', 'RG9 2EU');";

        $student4 = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`) 
        VALUES ('20000004', '" . password_hash("test", PASSWORD_DEFAULT) . "', '2003-09-08', 'Elliot', 'Gates', '36 Ajax Road', 'Rochester', 'Kent', 'UK', 'ME1 2UY');";

        $student5 = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`) 
        VALUES ('20000005', '" . password_hash("test", PASSWORD_DEFAULT) . "', '2006-05-03', 'Lucas', 'Cooling', '128 Wulfstan Street', 'East Acton', 'London', 'UK', 'W12 0AD');";
                

        // Check if query only has initial student configured
        if(mysqli_num_rows($result) <= 1)
        {
            mysqli_query($conn,$student1);
            mysqli_query($conn,$student2);
            mysqli_query($conn,$student3);
            mysqli_query($conn,$student4);
            mysqli_query($conn,$student5);
        }
    }
?>