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
			return $this->returnObject(null, '409', 'User could not be saved because there is another user with that email.');
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

	public function put($id)
	{
		$data = $this->requestBody;

		$user = $this->dbManager->findFirst([
			'conditions' => 'id_user = :id:'
			, 'bind' => [
				'id' => $id
			]	
		]);
		if(isset($data['name']))
			$user->setName($data['name']);
		if(isset($data['email']))
			$user->setEmail($data['email']);
		if(isset($data['mobile_no']))
			$user->setMobileNo($data['mobile_no']);
		if(isset($data['new_password']) && isset($data['confirm_password']))
		{
			$user->setPassword(sha1($data['new_password']));
		}
		$user->save();

			return $this->returnObject($user->toArray(), '200', 'Profile has been updated');

	// return json_encode([$user, $data]);
	}

	// public function delete()
	// {
	// 	return 'delete';
	// }
}