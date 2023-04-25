<?php
    include("_includes/functions.inc");

    // Loads autoloader for the Faker library
    require_once '/Users/maartenvanderbeeken/vendor/autoload.php';

    // Creates new instance of the Faker library
    $faker = Faker\Factory::create();

    // Connects to the database
    $db = new mysqli("localhost", "root", "", "cw2_students");
    
    // Deletes all records from the student table
    $db->query("DELETE FROM student");

    // Inserts a predefined record for a student with id 20000000
    $db->query("INSERT INTO student (studentid, password, dob, firstname, 
                lastname, house, town, county, country, postcode) 
                VALUES ('20000000', '$2y$10$.LJBOl64nZWEVVE/v5mgNuzR01zx1zoyXuGJUa/zp2U.MQxkps3LS', 
                '1974-11-10', 'Jon', 'Smith', '23 Victoria Road', 'High Wycombe', 
                'Bucks', 'UK', 'HP11 1RT');");

    // Resets the auto-increment value
    $db->query("ALTER TABLE student AUTO_INCREMENT = 1");

    // Loops through a range of student
    foreach(range(1,20) as $x) 
    {
        $student_id = $x;

        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $date = mysqli_real_escape_string($db, $faker->date());
        $firstname = mysqli_real_escape_string($db, $faker->firstName());
        $lastname = mysqli_real_escape_string($db, $faker->lastname());
        $house = mysqli_real_escape_string($db, $faker->word());
        $town = mysqli_real_escape_string($db, $faker->city());
        $county = mysqli_real_escape_string($db, $faker->city());
        $country = mysqli_real_escape_string($db, $faker->country());
        $postcode = mysqli_real_escape_string($db, $faker->postcode());

        $sql = "
        INSERT INTO student (studentid, password, dob, firstname, 
        lastname, house, town, county, country, postcode)
        VALUES ('$student_id', '$hashed_password', 
        '{$date}', '{$firstname}', '{$lastname}', '{$house}', 
        '{$town}', '{$county}', '{$country}', '{$postcode}')";

        echo $sql . "<br />";

        // Inserts a new record into the student table using Faker generated data
        $db->query($sql);

        echo $student_id . "<br />";
    }
?>