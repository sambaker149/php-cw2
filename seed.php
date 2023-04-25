<?php

    //include("_includes/config.inc");
    //include("_includes/dbconnect.inc");
    include("_includes/functions.inc");
    require_once 'vendor/autoload.php';

    $faker = Faker\Factory::create();

    $db = new mysqli("localhost", "root", "", "cw2_students");

    $db->query("DELETE FROM student");
    
    $db->query("ALTER TABLE student AUTO_INCREMENT = 1");

    foreach(range(1,30) as $x) {
        $student_id = $x;

        $db->query("
            INSERT INTO student (studentid, password, dob, firstname, 
            lastname, house, town, county, country, postcode)
            VALUES ('$student_id', '{$faker->password}', 
            '{$faker->date}', '{$faker->firstName}', '{$faker->lastName}', '{$faker->word}', 
            '{$faker->city}', '{$faker->city}', '{$faker->country}', '{$faker->postcode}')
        ");
    }
?>