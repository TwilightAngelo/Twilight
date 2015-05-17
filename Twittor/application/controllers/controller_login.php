<?php
session_start();
class Controller_Login extends Controller
{
	public function __construct()
	{
		Controller::__construct();
		$this->model = new Model_Login();
	}
	function action_index()
	{
		$data["login_status"] = "";

		if(isset($_POST['login']) && isset($_POST['password']))
		{

			$login = $_POST['login'];
			$password =$_POST['password'];
			$user = $this->model->get_data($login);
			$user_arr = $user->toArray();
			if (($login == $user_arr['login']) && ($password == $user_arr['password']))
			{
				setcookie('user_id',$user->getID());
				header('Location:/Main/');
			}
			else
			{
				$data["login_status"] = "access_denied";
			}
		}
		else
		{
			$data["login_status"] = "";
		}
		
		$this->view->generate('login_view.php', 'template_view.php', $data);
	}
	
}
