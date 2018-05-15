<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;

class Audit extends Model
{
	public $id;

	public $id_company;

	public $user;

	public $email;

	public $role;
	
	public $primary_key;

	public $table;

	public $action;

	public $create_at;

	public $details;

	public $new_value;

	public $old_value;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setIdCompany($id_company)
	{
		$this->id_company = $id_company;
	}

	public function getIdCompany()
	{
		return $this->id_company;
	}

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setRole($role)
	{
		$this->role = $role;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setPrimaryKey($primary_key)
	{
		$this->primary_key = $primary_key;
	}

	public function getPrimaryKey()
	{
		return $this->primary_key;
	}

	public function setTable($table)
	{
		$this->table = $table;
	}

	public function getTable()
	{
		return $this->table;
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function setCreateAt($create_at)
	{
		$this->create_at = $create_at;
	}

	public function getCreateAt()
	{
		return $this->create_at;
	}


	public function setDetails($details)
	{
		$this->details = $details;
	}

	public function getDetails()
	{
		return $this->details;
	}

public function setNewValue($new_value)
	{
		$this->new_value = $new_value;
	}

	public function getNewValue()
	{
		return $this->new_value;
	}

	public function setOldValue($old_value)
	{
		$this->old_value = $old_value;
	}

	public function getOldValue()
	{
		return $this->old_value;
	}
}