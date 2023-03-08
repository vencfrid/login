<?php
if(isset($_POST["signb"]))
{
	//grabing the data only if post was created
	$uid = $_POST['uid'];
	$pwd = $_POST['pwd'];
	$pwdRepeat = $_POST['pwdrepeat'];
	$email = $_POST['email'];

	//Instantiate singupContr class
	include "../classes/dbh_classes.php";
	include "../classes/signup_classes.php";		// ../ znamená jít o složku z5
	include "../classes/signup-contr_classes.php";

	$signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);


	//running error handlers and user signup
	$signup->signupUser();  // zalová funkci z controleru jestli je všechno ok a potom spustí query z signup classy která má připojení přes dbh classu
	//going back to front page
 	header("location: ../index.php?error=none");
}

