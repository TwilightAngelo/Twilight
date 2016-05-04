<?php
class Model_Login extends Model
{
	public function get_data($login=NULL)
	{
		$serverName = "TWILIGHT\SQLEXPRESS";
		$dbName = "TheWault";

		$rep = new UserRepository($serverName,$dbName);
		$user = $rep->getByLogin($login);
		if ($user)
		{
			return $user;
		}
		else
		{
			return false;
		}
	}
}
?>