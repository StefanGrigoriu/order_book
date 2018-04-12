<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;

class Users extends BaseModel
{
	public $id_user;

	public $id_company;

	public $id_user_type;

	public $name;

	public $email;
	
	public $password;

	public function setIdUser($id_user)
	{
		$this->id_user = $id_user;
	}

	public function getIdUser()
	{
		return $this->id_user;
	}

	public function setIdCompany($id_company)
	{
		$this->id_company = $id_company;
	}

	public function getIdCompany()
	{
		return $this->id_company;
	}
	public function setIdUserType($id_user_type)
	{
		$this->id_user_type = $id_user_type;
	}

	public function getIdUserType()
	{
		return $this->id_user_type;
	}

	public function setName($name)
	{
		$this->name= $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setEmail($email)
	{
		$this->email= $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

}