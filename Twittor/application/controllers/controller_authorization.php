<?php
	class Controller_authorization extends Controller
	{

		protected $serverName = "TWILIGHT\SQLEXPRESS";
		protected $databaseName = "TheWault";	

		function action_index()
		{
			$sName = $this->serverName;
			$dbName =$this->databaseName;

			if (isset($_POST['login']) && isset($_POST['password']))
			{
				$auth = new Application($sName, $dbName);
				$auth->authorization();
				$auth->check();
			}
			$this->view->generate('authorization_view.php', 'template_view.php', $data = NULL);
		}
	}
?>