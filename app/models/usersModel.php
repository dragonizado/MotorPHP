<?php 
/**
 * Dragonizado 2018
 */
class usersModel
{
	private $id = null;
	private $name;
	private $email;
	private $password;
	private $role;
	private $create_date;
	function __construct($db)
	{
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit("ERROR AL CONECTAR CON LA BASE DE DATOS.".$e->getMessage());
		}
	}

	public function __set($attr,$data){
		$this->$attr = $data;
	}

	public function __get($attr){
		return $this->$attr;
	}

	public function getUser(){
		$sql = "SELECT * FROM tbl_users";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetch();
	}

	public function register(){
		$sql = "INSERT INTO tbl_users (id,name,email,password,role,create_date) VALUES (:id,:name,:email,:password,:role,NOW())";
		$query = $this->db->prepare($sql);
		$params = [
			"id"=>$this->id,
			"name"=>$this->name,
			"email"=>$this->email,
			"password"=>sha1($this->password),
			"role"=>$this->role,
		];
		return $query->execute($params);
	}

	public function login(){
		$sql = "SELECT * FROM tbl_users WHERE name = :name";
		$query = $this->db->prepare($sql);
		$params = [
			":name"=>$this->name
		];
		$query->execute($params);
		$response = $query->fetch();

		if($response){
			if(!$this->passwords($response->password)){
				return false;
			}
			$this->__set("id",$response->id);
			$this->__set("name",$response->name);
			$this->__set("email",$response->email);
			$this->__set("password",$response->password);
			$this->__set("role",$response->role);
			$this->__set("create_date",$response->create_date);
		}
		return $response;
	}

	private function passwords($password){
		if(sha1($this->password) === $password){
			return true;
		}else{
			return false;
		}
	}

}
 ?>