<?php
	$conn = mysqli_connect("localhost", "root", "", "cw2_students");

	mysqli_set_charset($conn, "utf8mb4");

	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
?>