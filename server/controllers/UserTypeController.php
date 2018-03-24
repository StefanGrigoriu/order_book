<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\UserType;
use \Exceptions;

class UserTypeController extends BaseController 
{
	public function __construct()
	{
		$this->dbManager = new UserType();
	}

	public static function returnObject($data = [], $status = null, $message = null)
	{
		return json_encode(['message' => $message
			,'data' => $data
			, 'status' => $status]);
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

}