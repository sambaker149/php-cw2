<?php
include "_includes/functions.inc";

// Call this script with password URL parameter to generate hash

if ($_GET["password"]) 
{
   $pass = $_GET["password"];
   echo password_hash($pass, PASSWORD_DEFAULT);
}
?>