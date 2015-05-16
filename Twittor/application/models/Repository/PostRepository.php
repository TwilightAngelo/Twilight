<?php
	require_once ('Repository.php');
	class PostRepository extends Repository
	{
		public function __construct($serverName,$databaseName)
		{
			Repository::__construct($serverName,$databaseName);
			$this->TableName = "posts";
		}
		public function getByID($id)
		{
			$arr = array('id' => $id);
			$statement = $this->select($arr);
			$row = $statement->fetch(PDO::FETCH_LAZY);
			return new Post($row);
		}
		public function save($post)
		{
			$array = $post->toArray();
			$this->insert($array);
		}
		public function getByDate($date,$user=null)
		{
			$arr = array('date' => $date );
			if($user)
			{
				$usrID = $user->getID();
				$arr['owner'] = $usrID;
			}
			$rows = $this->select($arr);
			return $rows;
		}
		public function getByOwner($user)
		{	
			$id = $user->getID();
			$arr = array('owner' => $id);
			$rows = $this->select($arr);
			return $rows;
		}
		protected function delete($value){}
	}
?>