<?php
	class Route 
	{
		static function start()
		{
			$controller_name = 'Main';
			$action_name = 'index';

			$routes = explode('/', $_SERVER['REQUEST_URI']);

			if (!empty($routes[1]))
			{
				$routes[1] = strtolower($routes[1]);
				$controller_name = $routes[1];
			}

			if (!empty($routes[2]))
			{
				$action_name = $routes[2];
			}

			$sttmp = strpos($controller_name, 'page');
			var_dump($sttmp);

			$str = substr($routes[1], 0, 4);
			var_dump($str);

			if ($str === 'page')
			{
				$controller_name = 'page';
				$action_param = str_replace('page', '', $routes[1]);
			}

			$model_name = 'Model_' . $controller_name;
			$controller_name = 'Controller_' . $controller_name;
			$action_name = 'action_' . $action_name;

			$model_file = strtolower($model_name) . '.php';
			$model_path = "application/models/" . $model_file;
			if (file_exists($model_path))
			{
				include "application/models/" . $model_file;
			}

			$controller_file = strtolower($controller_name) . '.php';
			$controller_path = "application/controllers/" . $controller_file;
			if (file_exists($controller_path))
			{
				include "application/controllers/" . $controller_file;

			}
			else 
			{
				Route::ErrorPage404();
			}

			$controller = new $controller_name;
			$action = $action_name;

			if (method_exists($controller, $action))
			{
				$controller->$action($action_param);
			}
			else
			{
				Route::ErrorPage404();
			}
		}

		static function ErrorPage404()
		{
			$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
			header('HTTP/1.1 404 Not Found');
			header("Status: 404 Not Found");
			header('Location:' . $host . '404');
		}
	}
?>