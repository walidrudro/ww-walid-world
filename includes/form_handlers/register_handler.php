<?php
//Declaring variables
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //Email
$em2 = ""; //Email 2
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date
$error_array = array(); //Holds error messages, if there is any error

if(isset($_POST['register_button'])){   //this line is if the register button from the form is clicked. 

 	//Registration form values. All input from Html form will store in variable below.$_POST['form input name']

 	//First name 
 	$fname = strip_tags($_POST['reg_fname']); // Removes any unwanted html tag input from user.  Security
 	$fname = str_replace(" ", '', $fname); // Removes Space, Replaces space" " with no space''
 	$fname = ucfirst(strtolower($fname)); // Uppercase first letter
 	$_SESSION['reg_fname'] = $fname; // Stores the first name into the current session 

 	//Last name 
 	$lname = strip_tags($_POST['reg_lname']); // Remove html tags
 	$lname = str_replace(" ", '', $lname); // Removes Space
 	$lname = ucfirst(strtolower($lname)); // Uppercase first letter
 	$_SESSION['reg_lname'] = $lname; // Stores the Last name into the current session 

 	//Email 
 	$em = strip_tags($_POST['reg_email']); // Remove html tags
 	$em = str_replace(" ", '', $em); // Removes Space
 	$em = ucfirst(strtolower($em)); // Uppercase first letter
 	$_SESSION['reg_email'] = $em; // Stores E-mail into the current session 

 	//Email 2 
 	$em2 = strip_tags($_POST['reg_email2']); // Remove html tags
 	$em2 = str_replace(" ", '', $em2); // Removes Space
 	$em2 = ucfirst(strtolower($em2)); // Uppercase first letter
 	$_SESSION['reg_email2'] = $em2; // Stores E-mail 2 into the current session

 	//password 
 	$password = strip_tags($_POST['reg_password']); // Remove html tags

 	//password 2
 	$password2 = strip_tags($_POST['reg_password2']); // Remove html tags

 	$date = date("y-m-d"); // Current date of Sign up

 	if ($em == $em2) {
 		//Checking Email in valid format (example@email.com)

 		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

 			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

 			// Check if the email already exists in database. 
 			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");

 			//Count the number of the query returned for $e_check 
 			$num_rows = mysqli_num_rows($e_check);

 			if ($num_rows > 0) {
 				array_push($error_array, "Email already in use<br>");
 			} // if query returns any result that means the email is already in the database. 


 		}
 		else {
 			array_push($error_array, "Invalid Email Format<br>");
 		}
 	
 	}
 	//if 2 email input ($em and $em2) doesn't match then echo Emails Dont match
 	else {

 		array_push($error_array, "Emails don't match<br>");
 	}

 	if(strlen($fname) > 25 || strlen($fname) < 1) {
 		array_push($error_array, "Your first Name must be between 1 and 25 characters<br>");
 		 }

 	if(strlen($lname) > 25 || strlen($lname) < 1) {
 		array_push($error_array, "Your Last Name must be between 1 and 25 characters<br>");
 		 }

 	if($password != $password2) {
 		array_push($error_array, "Your Password do not match<br>");
 	}
 	else {
 		if(preg_match('/[^A-Za-z0-9]/', $password)) {
 			array_push($error_array, "Your password can be only contain english characters or numbers<br>");
 		}
 	}

 	if(strlen($password > 30 || strlen($password) < 5)) {
 		array_push($error_array, "Your password must be between 5 and 30 characters<br>");
 	}

 	if(empty($error_array)) {
 		$password = md5($password); // Encrypting password before sending to the database

 		//Generate username by concatenating first name and last name 

 	$username = strtolower($fname . "_" . $lname);
 	$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

 	$i = 0;
 	//if username exists add number to username
 	while(mysqli_num_rows($check_username_query) != 0) {
 		$i++; //Add 1 to i ($i +1)
 		$username = $username . "_" . $i;
 		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username= '$username'");
 	}
 

 	//Profile picture assignment
 	$rand = rand(1, 4); //Random number betweek 1 and 4

 	if($rand == 1)
 	$profile_pic = "assets\images\profile_pics\defaults\Cartman.png";
 	else if($rand == 2)
 	$profile_pic = "assets\images\profile_pics\defaults\Cartman-Cop-head-icon.png";
 	else if($rand == 3)
 	$profile_pic = "assets\images\profile_pics\defaults\Cartman-Gandalf-head-icon.png";
 	else if($rand == 4)
 	$profile_pic = "assets\images\profile_pics\defaults\peter-griffin.png";


 	$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0' , '0', 'no', ',')");

 	array_push($error_array, "<span style='color: Blue;'> Register Done! Login NOW </span><br>");

 	//clear form input
 	$_SESSION['reg_fname'] = "";
 	$_SESSION['reg_lname'] = "";
 	$_SESSION['reg_email'] = "";
 	$_SESSION['reg_email2'] = "";

 }
}
?>