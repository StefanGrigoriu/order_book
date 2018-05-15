<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;
// use OrderBook\Models\MyBehavior;
use OrderBook\Models\MyBehavior;

class BaseModel extends Model 
{

	public function initialize()
	{
		$this->keepSnapshots(true);
		  $this->addBehavior(new MyBehavior());
	}

	public function beforeCreate()
	{
		$registry = $this->di->getRegistry();
		$this->id_company = !$this->id_company ? $registry['user']['id_company'] : $this->id_company;
		$this->created_at = date("Y-m-d H:i:s");
	}
}