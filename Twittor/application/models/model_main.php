<?php

	class Model_Main extends Model
	{

		protected $serverName = "TWILIGHT\SQLEXPRESS";
		protected $databaseName = "TheWault";

		public function get_data()
		{
			$user = new UserRepository($serverName, $databaseName);	
			$user->getByID($_COOKIE);
			$post = new PostRepository($serverName, $databaseName);
			$post->getByOwner($user);
		}
	}