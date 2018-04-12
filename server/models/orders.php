<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;
// use BaseModel;

class Orders extends BaseModel
{
	public $id_order;

	public $id_company;

	public $id_user;

	public $client_name;

	public $description;

	public $created_at;
	
	public $updated_at;

	
	public function setIdOrder($id_order)
	{
		$this->id_order = $id_order;
	}

	public function getIdOder()
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

	public function setIdUser($id_user)
	{
		$this->id_user = $id_user;
	}

	public function getIdUser()
	{
		return $this->id_user;
	}

	public function setClientName($client_name)
	{
		$this->client_name = $client_name;
	}

	public function getClientName()
	{
		return $this->client_name;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setCreatedAt($created_at)
	{
		$this->created_at= $created_at;
	}

	public function getCreatedAt()
	{
		return $this->created_at;
	}

	public function setUpdatedAt($updated_at)
	{
		$this->updated_at = $updated_at;
	}

	public function getUpdatedAt()
	{
		return $this->updated_at;
	}

	
}