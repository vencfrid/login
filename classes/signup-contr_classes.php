<?php 

class SignupContr extends Signup
{
	private $uid;
	private $pwd;
	private $pwdRepeat;
	private $email;

	public function __construct($uid, $pwd, $pwdRepeat, $email)
	{
		$this->uid=$uid;
		$this->pwd=$pwd;
		$this->pwdRepeat=$pwdRepeat;
		$this->email=$email;
	}	

	public function signupUser()
	{
		if($this->emptyinput() == false)
		{
			header("location: ../index.php?error=emptyinput");
			exit();
		}	
		if($this->invalidUid() == false)
		{
			header("location: ../index.php?error=username");
			exit();
		}
		if($this->invalidEmail() == false)
		{
			header("location: ../index.php?error=email");
			exit();
		}
		if($this->pwdMatch() == false)
		{
			header("location: ../index.php?error=passwordmatch");
			exit();
		}
		if($this->uidTakenCheck() == false)
		{
			header("location: ../index.php?error=useroremailtaken");
			exit();
		}

		$this->setUser($this->uid, $this->pwd, $this->email);
	}

	public function emptyinput()
	{
		$result;
		if(empty($this->uid)||empty($this->pwd)||empty($this->pwdRepeat)||empty($this->email))
		{
			$result = false;
		}
		else
		{
			$result = true;
		}
		return $result;
	}

	public function invalidUid()			//checkuje jestli username má ok znaky a ne nějaké divné
	{
		$result;
		if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid))
		{
			$result = false;
		}
		else
		{
			$result = true;
		}
		return $result;
	}

	public function invalidEmail()			//checkne jestli je skutečný email (FILTED_VALIDATE_EMAIL)
	{
		$result;
		if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
		{
			$result = false;
		}
		else
		{
			$result = true;
		}
		return $result;
	}

	public function pwdMatch()			//checkne jestli je skutečný email
	{
		$result;
		if($this->pwd !== $this->pwdRepeat)
		{
			$result = false;
		}
		else
		{
			$result = true;
		}
		return $result;
	}

	public function uidTakenCheck()			//checkne jestli je skutečný email
	{
		$result;
		if(!$this->checkUser($this->uid, $this->email))
		{
			$result = false;
		}
		else
		{
			$result = true;
		}
		return $result;
	}

	
}