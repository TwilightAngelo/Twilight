<?php
	
require_once ('User.php');
abstract class Repository
{
	protected $serverName;
	protected $databaseName;
	protected $connection;
	protected $TableName;
	
	public function __construct($serverName,$databaseName)
	{	
		$this->serverName = $serverName;
		$this->databaseName = $databaseName;
		try 
		{
  		$this->connection = new PDO("sqlsrv:server=$serverName;Database=$databaseName", "", "");
  		$this->connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch (PDOException $e)
		{
			echo $e->getMessage() ;
    		die();
		}
	}

	public abstract function getByID($id);
	public abstract function save($entity);

	protected function select($values, $what = "*")
	{
		$query = "SELECT " . $what . " FROM " . $this->TableName;
		if (count($values))
		{
			$query.=" WHERE ";
		}
		$counter = 0;
		foreach ($values as $key => $value) 
		{
			$counter++;
			$query.="$key = :$key";
			if($counter<count($values))
			{
				$query.=" AND ";
			}
		}
		$statement = $this->connection->prepare($query);
		$statement->execute($values);
		return $statement;
	}
	protected function insert($values)
	{
		$columns = "";
		$set = "";
		$counter = 0;
		foreach ($values as $key => $value) 
		{
			$counter++;
			$columns.="$key";
			$set.= ":$key";
			if ($counter < count($values)) {
				$columns.=",";
				$set.=",";
			}
		}
		$query = "INSERT INTO " . $this->TableName . " (".$columns.") VALUES (".$set.")";
		$statement = $this->connection->prepare($query);
		$statement->execute($values);
	}
	protected abstract function delete($value);
	protected function update($value)
	{
		$values = $user->toArray();
		$field = '';
		$set = '';
		$counter = 0;
		foreach ($values as $key => $value) 
		{
			$counter++;
			$set .= "$key = :$key ";
			if ($counter < count($values)) $set.=",";
		}
		$values['id'] = $user->getID();
		$query = "UPDATE " . $this->TableName . " SET " . $set . " " . "WHERE id = :id";
		$statement = $this->connection->prepare($query);
		$statement->execute($values);
	}
};
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