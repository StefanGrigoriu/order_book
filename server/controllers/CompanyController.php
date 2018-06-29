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
//de modificat, get-ul, voi scoate momentan la join id_Company = id_company celui ce face request
	// si de facut o alta functi de search speciala in care nu folosim id_company = ..

	public function get()
	{

		$registry = $this->di->getRegistry();
		$q = $this->request->get('q');
		// var_dump($q);
		if($q)
			$q = json_decode($q);

		$condition = '';
			// 'id_company' => $registry['user']['id_company']
		// return json_encode($condition);
		$bind = [

		];
		// return json_encode($q);
		if(isset($q) && $q)
		{
			foreach ($q as $key => $value)
			{
				# code...
				$condition .= $value->key .' '.$value->op.' :key'.$key.':';
				$bind['key'.$key] = $value->op == 'LIKE' ? '%'.$value->value.'%' : $value->value;
			}
		}

			// return json_encode(['bind' => $bind, 'condition' => $condition]);
		$data = $this->dbManager->find(
			[
				'conditions' => $condition
				, 'bind' => $bind
			])->toArray();

		return $this->returnObject($data, 'ITS OK', 'All users list that have been requested');

	}

	public function post()
	{
		$data = $this->requestBody;
		$company = new Company();
		$resources = $company->findFirst([
			'name = :name:',
			'bind' => [
				'name' =>	$data['name']
			]
		]);

		$company->setName($data['name']);
		$resource = $company->save();
		if($resource !== false)
		{
			return $this->returnObject(null, 'ITS OK', 'Company has been created');
		}

		return $this->returnObject(null, 'ITS OK', 'Company has not been created, data is missing');
	}

	public function put($id)
	{
		$data = $this->requestBody;
		$company = new Company();
		$resources = $company->findFirst([
			'id_company = :id:',
			'bind' => [
				'id' =>$id
			]
		]);
	
		if(isset($data['name']))
			$resources->setName($data['name']);
		if(isset($data['config']))
			$resources->setConfig($data['config']);
		$resource = $resources->save();

		if($resource !== false)
		{
			return $this->returnObject($resources->toArray(), 'ITS OK', 'Company has been updated');
		}

		return $this->returnObject(null, 'ITS OK', 'Company has not been created, data is missing');
	}

}