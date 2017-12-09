<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\Users;
use \Exceptions;

class UsersController extends BaseController 
{
	
	public function get()
	{
		// return 'what';
		// return 'error';
		$q = 'SELECT * FROM OrderBook\Models\Users';
		$query = $this->modelsManager->createQuery($q);
		$result = $query->execute();	
		return json_encode(['get' => 'get'
		,'result' => $result]);
	}

	public function getOne()
	{

		return 'getone';
	}

	public function post()
	{
		$data = $this->requestBody;
		$q = 'INSERT INTO \OrderBook\Models\Users (name, email, password) VALUES ("'.$data['name'].'","'.$data['email'].'", "'.$data['password'].'")';
	 	
		$query = $this->modelsManager->createQuery($q);
		$result = $query->execute();

		return json_encode($data);
	}

	public function put()
	{
		return 'put';
	}

	public function delete()
	{
		return 'delete';
	}
}