<?php

	class Model_HomePage extends Model
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

		public function insert_data($data)
		{
			$p_repository = new PostRepository($this->serverName, $this->databaseName);
			$p_repository->save($data);
		}

		public function update_data($data)
		{
			$u_repository = new UserRepository($this->serverName, $this->databaseName);
			//$u_repository->update_info($entity);
			//дописать!!!!!!!!!1111111один
		}
	}
?>