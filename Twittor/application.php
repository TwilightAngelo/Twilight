
<?php

/**
* 
*/
require('Database.php');
class Application
{
	protected $connection;
	protected $serverName = "TWILIGHT\SQLEXPRESS";
	protected $databaseName = "TheWault";	
	public function __construct($serverName = "TWILIGHT\SQLEXPRESS", $databaseName = "TheWault")
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
			$temp = $result->toArray();
			if ($temp['password'] == $_POST['password'])
			{
				echo "vse norm";
			}
			else
			{
				echo "pass wrong";
			}
		}
		else
		{
			echo "logina nety!!!";
		}
	}
	public function registration()
	{
		$errors = 0;
		if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login']))
		{
			$errors++;
			echo "Только буквы из инглиша и цифры";
		}

		if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
		{
			$errors++;
			echo "Логин должен быть больше 3 но меньше 30";
		}
		$statement = new UserRepository($this->serverName, $this->databaseName);
		$result = $statement->getByLogin($_POST['login']);
		if($result)
		{
			$errors++;
			echo "Такой логин уже занят!!111один";
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
		
	}

}
?>