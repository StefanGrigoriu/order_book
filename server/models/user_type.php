<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;

class UserType extends BaseModel
{
	public $id_user_type;

	public $name;

	public $config;

	
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
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setConfig($config)
	{
		$this->config = $config;
	}

	public function getConfig()
	{
		return $this->config;
	}

	// public function beforeCreate()
	// {
	// 	$this->id_company = !$this->id_company ? 1 : $this->id_company;
	// 	$this->created_at = date("Y-m-d H:i:s");
	// }
}