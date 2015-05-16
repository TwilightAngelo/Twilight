<?php 
	require_once ('Repository.php');
	class UserRepository extends Repository
	{
		public function __construct($serverName,$databaseName)
		{
			Repository::__construct($serverName,$databaseName);
			$this->TableName = "users";
			
		}
		public function getByID($id)
		{
			$statement = $this->select(array('id' => $id));
			$row = $statement->fetch(PDO::FETCH_LAZY);
			if ($row)
			{
				return new User($row);
			}
			else 
			{
				return false;
			}
		}
		public function getByLogin($login)
		{
			$statement = $this->select(array('login' => $login));
			$row = $statement->fetch(PDO::FETCH_LAZY);
			if ($row)
			{
				return new User($row);
			}
			else
			{
				return false;
			}
		}
		public function save($entity)
		{	
			$arr = $entity->toArray();
			$user = $this->getByLogin($arr['login']);
			if ($user)
			{
				echo "This user already exist!!!";
			}
			else
			{
				$this->insert($arr);
			}
		}
		
		protected function delete($value){}
	}
?>