<?php 
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Pacific/Auckland");

$con = mysqli_connect("localhost", "root", "", "social"); //connection to mysql variable($variable_name) and 4 parameters ("hostname","username","pass","Database name")

if(mysqli_connect_errno())
{
 	echo "Failed to connect:" . mysqli_connect_errno();
}
//Variables to prevent errors. If there is an error program will echo(print) "Failed to connect" + the error
?>