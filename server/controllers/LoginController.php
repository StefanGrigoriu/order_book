<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\Company;
use \Exceptions;
use \OrderBook\Exceptions\HTTPException;
use \OrderBook\Models\Users;

class LoginController extends BaseController 
{
	// public function __construct()
	// {	
	// 	$this->dbManager = new Company();
	// }

	public static function returnObject($data = [], $status = null, $message = null)
	{
		return json_encode(['message' => $message
			,'data' => $data
			, 'status' => $status]);
	}

	public function login()
	{
		$data = $this->requestBody;
		// return $this->returnObject($data);
		$registry = $this->di->getRegistry();
		// return json_encode($registry['user']);
		
		$user = new Users();
		$user_found = $user->findFirst([
			'conditions' => 'email = :email: and password = :password: and id_company = :id_company:'
			, 'bind' => [
					'email' => $data['email']
					,'password' => sha1(($data['password']))
					, 'id_company' => $registry['user']['id_company']
			]
		]);
		// var_dump($user_found);

		if($user_found)
		{
			return $this->returnObject($user_found, 200, 'User logged in succesfully');
		}
		else
		{
			return $this->returnObject('User not found', 409);
		}
		
	}

	public function post()
	{
		// return 'im here';
		$data = $this->requestBody;
		$new_company = [
			'name' => null
			, 'config' => null
		];

		
		if(isset($data) && isset($data['name']))
		{
			$company = new Company();
			$new_company = array_merge((array)$new_company, (array)$data);
			// return $new_company['name'];
			$company->setName($new_company['name']);
			$company->setConfig($new_company['config']);
			// return $company->getName();
			// return json_encode($new_company);
			$resource = $company->create();
			if($resource !== false)
			{
				return $this->returnObject(null, 'ITS OK', 'Company has been created');
			}
			else
			{
				 $messages = $company->getMessages();
					$aux = '';
				    foreach ($messages as $message) {
     							   $aux .=' '.$message;
						}
				return $this->returnObject(null, 'ITS OK', $aux);
			}
		}
		return $this->returnObject(null, 'ITS OK', 'Company has not been created, data is missing');

		// $q = 'INSERT INTO \OrderBook\Models\Users (name, email, password) VALUES ("'.$data['name'].'","'.$data['email'].'", "'.$data['password'].'")';
	 	
		// $query = $this->modelsManager->createQuery($q);
		// $result = $query->execute();

		// return json_encode($data);
	}

	public function put()
	{
		return 'put';
	}

	// public function delete()
	// {
	// 	return 'delete';
	// }
}