<?php

	class Controller_page extends Controller
	{

		function __construct()
		{
			include 'application/models/model_homepage.php';
			$this->pmodel = new Model_Page();
			$this->hmodel = new Model_HomePage();
			$this->view = new View();
		}

		function action_index($action_param = NULL)
		{
			/*
			проверка на батьку страницs и если нулевая страница => редирект на свою
			*/
			if (isset($_COOKIE['user_id']))
			{
				if ($action_param == $_COOKIE['user_id'])
				{
					$data = $this->pmodel->get_data();
					$this->view->generate('homepage_view.php', 'template_view.php', $data);
				}
				else
				{
					$data = $this->pmodel->get_data();
					$this->view->generate('page_view.php', 'template_view.php', $data);
				}
			}
			else
			{
				print("Cookies is empty");
			}
		}
	}
?>