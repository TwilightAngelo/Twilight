<?php
	class User
	{
		private $id;
		public $login;
		public $password;
		private $firstName;
		private $lastName;
		private $email;

		public function toArray()
		{
			return (array('login' => $this->login, 'password' => $this->password, 'email' => $this->email ));
		}

		public function getID()
		{
			return $this->id;
		}

		public function getLogin()
		{
			return $this->login;
		}
			
		public function __construct($array)
		{
			$this->id = $array['id'];
			$this->login = $array['login'];
			$this->password = $array['password'];
			$this->email = $array ['email'];
		}
	}
?>