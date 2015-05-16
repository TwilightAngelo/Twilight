
<?php
	require_once ('Database.php');
	class Application
	{
		protected $connection;
		protected $serverName = "TWILIGHT\SQLEXPRESS";
		protected $databaseName = "TheWault";	
	
	
		public function __construct($serverName, $databaseName)
		{
			$this->serverName = $serverName;
			$this->databaseName = $databaseName;
		}
	
	
		public function authorization()
		{
			$statement = new UserRepository($this->serverName, $this->databaseName);
			$result = $statement->getByLogin($_POST['login']);
			if ($result)
			{
				$res_arr = $result->toArray();
				if ($res_arr['password'] == $_POST['password'])
				{
					setcookie("user_id", $result->getID());
					var_dump($_COOKIE);
					print ("vse norm ");
				}
				else
				{
					setcookie("user_id", NULL);
					print ("pass wrong ");
				}
			}
			else
			{
				setcookie("user_id", NULL);
				print ("logina nety!!! ");
			}
		}
	
	
		public function registration()
		{
			$errors = 0;
			if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login']))
			{
				$errors++;
				print ("Только буквы из инглиша и цифры");
			}
	
			if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
			{
				$errors++;
				print ("Логин должен быть больше 3 но меньше 30");
			}
			$statement = new UserRepository($this->serverName, $this->databaseName);
			$result = $statement->getByLogin($_POST['login']);
			if($result)
			{
				$errors++;
				print ("Такой логин уже занят!!111один");
			}
			if(!$errors)
			{
				$info_arr = array('id' => NULL, 'login' => $_POST['login'],'password' => $_POST['password'],'email' => $_POST['email']);
				$user = new User($info_arr);
				$statement->save($user);
	
			}
		}
	
	
		public function check()
		{
			if (isset($_COOKIE['user_id']))
			{
				$statement = new UserRepository($this->serverName, $this->databaseName);
				$result = $statement->getByID($_COOKIE['user_id']);
				if ($result)
				{
					$res_arr = $result->toArray();
					print ("Привет! " . $res_arr['login']);
				}
				else
				{
					setcookie('user_id', NULL);
					print ("Что-то с бд пошло не так");
				}
			}
			else
			{
				setcookie('user_id', NULL);
				print ("Что-то с кукями пошло не так");
			}
		}
	}
?>