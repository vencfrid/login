<?php

	class LoginContr extends Login
	{
		private $uid;
		private $pwd;

		public function __construct($uid, $pwd)
		{
			$this->uid = $uid;
			$this->pwd = $pwd;

		}

		public function loginUser()
		{
			if($this->emptyinput() == false)
			{
				header("location: ../index.php?error=emptyinput");
				exit();
			}	
			
			$this->getUser($this->uid, $this->pwd);
		}

		public function emptyinput()
			{
				$result;
				if(empty($this->uid)||empty($this->pwd))
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