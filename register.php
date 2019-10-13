<?php 
require 'config\config.php';
require 'includes\form_handlers\register_handler.php';
require 'includes\form_handlers\login_handler.php';
?>


<html>
<head>
	<title>Welcome to Walid's World</title>
</head>
<body>

	<form action="register.php" method ="POST">
		<input type="email" name="log_email" placeholder="Email Address" value= "<?php
		if(isset($_SESSION['log_email'])) {
			echo $_SESSION['log_email'];
		}
		?>" required>
		<br>
		<input type="password" name="log_password" placeholder="Password">
		<br>
		<input type="submit" name="login_button" value="Login">
		<br>

		<?php if(in_array("Email or Password was incorrect<br>",$error_array)) echo "Email or Password was incorrect<br>"; ?>

	</form>
	<form action="register.php" method="POST"> <!-- action means send inputs to register.php script , Method "POST" means pressing button and sending input-->

		<input type="text" name="reg_fname" placeholder="First name" value= "<?php
		if(isset($_SESSION['reg_fname'])) {
			echo $_SESSION['reg_fname'];
		}
		?>" required> <!--FirstName Box,input text, Name reference phpscript, this box compulsary -->
		<br> <!-- <br> Tag breaks each boxes-->
		<?php if(in_array("Your first Name must be between 1 and 25 characters<br>", $error_array)) echo "Your first Name must be between 1 and 25 characters<br>"; ?>

		<input type="text" name="reg_lname" placeholder="Last name" value= "<?php
		if(isset($_SESSION['reg_lname'])) {
			echo $_SESSION['reg_lname'];
		}
		?>" required> <!--LastName Box,input text, Name reference phpscript, this box compulsary -->
		<br>
		<?php if(in_array("Your Last Name must be between 1 and 25 characters<br>", $error_array)) echo "Your Last Name must be between 1 and 25 characters<br>"; ?>
		<input type="email" name="reg_email" placeholder="Email" value= "<?php
		if(isset($_SESSION['reg_email'])) {
			echo $_SESSION['reg_email'];
		}
		?>" required> <!--Email Box,input type email, Name reference phpscript, this box compulsary -->
		<br>
		<input type="email" name="reg_email2" placeholder="Confirm Email" value= "<?php
		if(isset($_SESSION['reg_email2'])) {
			echo $_SESSION['reg_email2'];
		}
		?>" required>
		<br>
		<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
		else if(in_array("Invalid Email Format<br>", $error_array)) echo "Invalid Email Format<br>"; 
		else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>";?>

		<input type="password" name="reg_password" placeholder="Password" required> <!--Password Box,input type password(****) -->
		<br>
		<input type="password" name="reg_password2" placeholder="Confirm Password" required>
		<br>
		<?php if(in_array("Your Password do not match<br>", $error_array)) echo "Your Password do not match<br>";
		else if(in_array("Your password can be only contain english characters or numbers<br>", $error_array)) echo "Your password can be only contain english characters or numbers<br>"; 
		else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>";?>

		<input type="submit" name="register_button" value="Register"> <!--Submit button Box,input type submit, -->
		<br>
		<?php if(in_array("<span style='color: Blue;'> Register Done! Login NOW </span><br>", $error_array)) echo "<span style='color: Blue;'> Register Done! Login NOW </span><br>"; ?>

	</form>


</body>

</html>