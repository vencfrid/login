<?php
if(isset($_POST["signb1"]))
{
	//grabing the data only if post was created
	$uid = $_POST['uid'];
	$pwd = $_POST['pwd'];

	//Instantiate singupContr class
	include "../classes/dbh_classes.php";
	include "../classes/login_classes.php";		// ../ znamená jít o složku z5
	include "../classes/login-contr_classes.php";

	$login = new LoginContr($uid, $pwd);


	//running error handlers and user signup
	$login->loginUser();  // zalová funkci z controleru jestli je všechno ok a potom spustí query z signup classy která má připojení přes dbh classu
	//going back to front page
 	header("location: ../index.php?error=none");
}