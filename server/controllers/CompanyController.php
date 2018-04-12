<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\Company;
use \Exceptions;

class CompanyController extends BaseController 
{
	public function __construct()
	{	
		$this->dbManager = new Company();
	}

	public static function returnObject($data = [], $status = null, $message = null)
	{
		return json_encode(['message' => $message
			,'data' => $data
			, 'status' => $status]);
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