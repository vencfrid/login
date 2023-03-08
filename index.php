<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>test login</title>
	<link rel="stylesheet" href="testpage.css">
	<meta http-equiv="refresh" content="99999">
</head>
<body>
	<div id="div1">
		<h1>Testovací koutek na hraní</h1>
 			<p>Tohle je prototyp login systému</p>
  			<p>Přes signup se vytvoří účet s hashovaným heslem -> dodělat změnu hesla, ověření emailem </p>
	</div>
	<div id="div2">
		<?php
			if(isset($_SESSION["userid"]))
			{
				echo'<a href="#">'.$_SESSION["useruid"].'</a>';
				echo'<br>';
				echo'<a href="includes/logout_inc.php"> LOGOUT </a>';
			}
			else
			{
				echo'<a href="#">SIGN UP</a>';
				echo'<br>';
				echo'<a href="#">LOGIN</a>';
			}
		?>
	</div>
	<div id="div3">
		<table id="table1">
			<tr>
				<td id="div1Table1">			
					Sign up
					<form name="sign" id="sign" action="includes/signup_inc.php" method="POST">
						<ul style="list-style-type:none;">
						  	<li><input type="text" name="uid" id="uid" placeholder="uid"></li>
						  	<li><input type="password" name="pwd" id="pwd" placeholder="password"></li>
						  	<li><input type="password" name="pwdrepeat" id="pwdrepeat" placeholder="repeat password"></li>
						  	<li><input type="text" name="email" id="email" placeholder="E-mail"></li>
						  	<li><button type="submit" name="signb" id="signb">SIGN UP</button></li>
						</ul>
					</form>
				</td>
				<td id="div1Table2">			
					login
					<form name="login" id="login" action="includes/login_inc.php" method="POST">
						<ul style="list-style-type:none;">
						  	<li><input type="text" name="uid" id="uid" placeholder="username"></li>
						  	<li><input type="password" name="pwd" id="pwd" placeholder="password"></li>
						  	
						  	<li><button type="submit" name="signb1" id="signb1">LOGIN</button></li>
						</ul>
					</form>
				</td>
			</tr>
			
		</table>
	</div>
</body>
</html>


