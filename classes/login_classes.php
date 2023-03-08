<?php

	class Login extends Dbh
	{
		protected function getUser($uid, $pwd)
		{
			$stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;');
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);  // hashování hesla pro bezpečnost

			if(!$stmt->execute(array($uid, $Pwd)))
			{
				$stmt = null;
				header("location: ../index.php?error=stmtfailed");
				exit();
			}

			if($stmt->rowCount()==0)
			{
				$stmt = null;
				header("location: ../index.php?error=usernotfound");
				exit();				
			}
			
			$pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);
			
			if($checkPwd==false)
			{
				$stmt = null;
				header("location: ../index.php?error=wrongpwd");
				exit();				
			}
			elseif($checkPwd == true)
			{
				$stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;');
			
				if(!$stmt->execute(array($uid, $uid, $Pwd)))
				{
					$stmt = null;
					header("location: ../index.php?error=stmtfailed");
					exit();
				}

				if($stmt->rowCount()==0)
				{
					$stmt = null;
					header("location: ../index.php?error=usernotfound");
					exit();				
				}

				$user = $stmt->fetchAll(PDO::FETCH_ASSOC);			// vezme všechna data o userovi
				session_start();
				$_SESSION['userid'] = $user[0]["users_id"];
				$_SESSION['useruid'] = $user[0]["users_uid"];
			}
			
			$stmt = null; // vynulování stmt pro bezpečnost injekce
		

		}

		

		/*private function getUser($uid, $pwd)
		{
			$stmt= $this->connect()->prepare('SELECT users_uid, users_pwd FROM users WHERE users_uid = ? AND users_pwd = ?;')
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

			if(!$stmt->execute(array($uid, $hashedPwd)))
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
	


		}*/
	}