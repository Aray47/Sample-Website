<?php

if (isset($_POST['submit'])) {		//if button is clicked

	include_once 'dbh.inc.php';   // we are already in the  'includes' folder no need to type /include/ etc..

	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$vPwd = $_POST['vPwd'];  //no need to escape string as it isn't being posted to the DB

	//error handling:
	//Check if empty fields:
	if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
		header("Location: ../signup.php?signup=emptyValues");   //will tell user what kind of error message inside URL
		exit();
	} else {
		//Check if input characters are valid:
		if (!preg_match("/^[a-zA-Z]*$/", $first, $last))  {   //if there are non-existent characters other than specified then...
			header("Location: ../signup.php?signup=invalidCharacters");  
		exit();
		} else {
			//Check if email is valid: 
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../signup.php?signup=invalidEmail");  
				exit();
			} else {
				//is UID the same as another UID?
				$sql = "SELECT * FROM users WHERE user_uid ='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);  //checking row for results

				//if the query brings back another user with the same user ID then:
				if ($resultCheck > 0) {
					header("Location: ../signup.php?signup=userTaken");  
				exit();
			   } 
			   if ($_POST['pwd'] != $_POST['vPwd']) {
			   	header("Location: ../signup.php?passwordError");
			   	exit();
			   } else {
			   	//Hashing the password:
			   	$hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);

			   	//insert the user into the database -- side note: you can rename variables underneath if the above variable with same name is not needed
			   	$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '".$_POST['last']."', '$email', '$uid', '$hashedPWD');";
			   	mysqli_query($conn, $sql);
			   	header("Location: ../index.php?signup=Success!");  
				exit();
			   }

			}
		}
	}

} else {			//if user does not click button and simply types in the URL (/includes/signup.inc.php) they will be taken to signup.php immediately:
	header("Location: ../signup.php");	
	exit(); //closes script from running
}








