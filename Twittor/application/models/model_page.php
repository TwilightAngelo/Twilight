<?php

	class Model_Page extends Model
	{

		protected $serverName = "TWILIGHT\SQLEXPRESS";
		protected $databaseName = "TheWault";

		public function get_data($login = NULL)
		{
			$u_repository = new UserRepository($this->serverName, $this->databaseName);	
			$user = $u_repository->getByID($_COOKIE['user_id']);

			$p_repository = new PostRepository($this->serverName, $this->databaseName);
			$posts = $p_repository->getByOwner($_COOKIE['user_id']);
			$post = $posts->fetch(PDO::FETCH_LAZY);

			return array('user_data' => $user, 'post_data' => $post);
		}
	}
?>