<?php
namespace OrderBook\Controllers;

class BaseController extends \Phalcon\DI\Injectable
{
		public $dbManager = null;

	public function __construct(){
		$di = \Phalcon\DI::getDefault();
		$this->setDI($di);
	}

	public function get()
	{

		$registry = $this->di->getRegistry();
		$q = $this->request->get('q');
		if($q)
			$q = json_decode($q);

		$condition = 'id_company = :id_company:';
		// return json_encode($condition);
		$bind = [
			'id_company' => $registry['user']['id_company']
		];
		
		if(isset($q) && $q)
			foreach ($q as $key => $value)
			{
				# code...
				$condition .= ' AND '.$value->key .' '.$value->op.' :key'.$key.':';
				$bind['key'.$key] = $value->op == 'LIKE' ? '%'.$value->value.'%' : $value->value;
			}
			// return json_encode(['bind' => $bind, 'condition' => $condition]);
		$data = $this->dbManager->find(
			[
			'conditions' => $condition
			, 'bind' => $bind
			])->toArray();
	
	return $this->returnObject($data, 'ITS OK', 'All users list that have been requested');
		
	}

	public function getOne($id)
	{
		$data = $this->dbManager->findFirst($id);
		if($data !== false)
		{
			$data = $data->toArray();	
			return $this->returnObject($data, 'ITS OK', 'One user information given');
		}
		else
		{
			return $this->returnObject(null, 'ITS OK', 'Resource could not be found');
		}
		// return 'getone' . $id_user;
	}

		public function delete($id)
	{
		$data = $this->dbManager->findFirst($id);	
		if($data !== false)
		{
			if($data->delete() !== false)
			{
				//entry was deleted from database 
				return $this->returnObject(null, 'ITS OK', 'The entry was deleted.');
			}
			else
			{
						// entry couldnt be deleted
				return $this->returnObject(null, 'ITS OK', 'The entry could not be deleted.');
			}
		}
		else
		{
			//entry (row) was not found in database
			return $this->returnObject(null, 'ITS OK', 'The entry (the given id) was not found in database.');
		}

		return true;
	}
}