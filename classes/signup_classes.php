<?php 

class Signup extends Dbh
{
	
protected function setUser($uid, $pwd, $email)
	{
		$stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);');

		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);  // hashování hesla pro bezpečnost

		if(!$stmt->execute(array($uid, $hashedPwd, $email)))
		{
			$stmt = null;
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		$stmt = null; // vynulování stmt pro bezpečnost injekce
	}

	protected function checkUser($uid, $email)
	{
		$stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

		if(!$stmt->execute(array($uid, $email)))
		{
			$stmt = null;
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		$resultCheck;
		if($stmt->rowCount()>0)
		{
			$resultCheck = false; 				// pokud uid nebo email už existuje result je neplatný -> nemůžeš vytvořit 2 účty pod 1 mail či usernamem
		}
		else
		{
			$resultCheck = true;
		}

		return $resultCheck;
	}
}