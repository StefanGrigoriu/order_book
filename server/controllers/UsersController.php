<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\Users;
use \Exceptions;

class UsersController extends BaseController 
{
	public function __construct()
	{
		$this->dbManager = new Users();
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
		$user = new Users();
		$resources = $user->findFirst([
			'email = :email:',
			'bind' => [
					'email' =>	$data['email']
					]
		]);
	
		if($resources === false)
		{
			// nu exista userul cu acel email
			$user->setName($data['name']);
			$user->setEmail($data['email']);
			$user->setPassword(sha1($data['password']));
			$user->setIdCompany($data['id_company']);
			$user->setIdUserType($data['id_user_type']);
			$resource = $user->save();
			if($resource)
			{
				return $this->returnObject(null, 'ITS OK', 'User has been created.');
			}
			else
			{ 
				$messages = $user->getMessages();
					$aux = '';
				    foreach ($messages as $message) {
     							   $aux .=' '.$message;
						}
				return $this->returnObject(null, 'ITS OK', $aux);
			}
		}
		else
		{
			return $this->returnObject(null, 'ITS OK', 'User could not be saved because there is another user with that email.');
		}
		return json_encode($resources);
		// $user->setName($data['name']);
		// $user->setEmail($data['email']);
		// $user->setPassword($data['password']);


		// $q = 'INSERT INTO \OrderBook\Models\Users (name, email, password) VALUES ("'.$data['name'].'","'.$data['email'].'", "'.$data['password'].'")';
	 	
		// $query = $this->modelsManager->createQuery($q);
		// $result = $query->execute();

		return json_encode($data);
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