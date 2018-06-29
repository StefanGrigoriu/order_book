<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;

class Users extends BaseModel
{
	private $id_user;

	private $id_company;

	private $id_user_type;

	private $name;

	private $email;

	private $mobile_no;

	private $address;
	
	private $password;

	private $picture;

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

	public function setMobileNo($mobile_no)
	{
		$this->mobile_no = $mobile_no;
	}

	public function getMobileNo()
	{
		return $this->mobile_no;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setPicture($picture)
	{
		$this->picture = $picture;
	}

	public function getPicture()
	{
		return $this->picture;
	}

}