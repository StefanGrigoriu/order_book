<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;

class Company extends BaseModel
{
	public $id_company;

	public $name;

	public $config;

	public function setIdCompany($id_company)
	{
		$this->id_company = $id_company;
		return $this;
	}

	public function getIdCompany()
	{
		return $this->id_company;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setConfig($config)
	{
		$this->config = $config;
		return $this;
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