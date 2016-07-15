<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", TRUE);
define("SERVER_NAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "anktech@123");
define("DB_NAME", "cms_sourabh");

$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
if(!$conn)
{
	echo "Error:".mysqli_error($conn);
}

include("constants.php");
include("classess.php");
include("file_names.php");
include("general_functions.php");

?>
