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

		//phalcon method to get * orders from order
		// $order = new Orders();
		$registry = $this->di->getRegistry();
		$data = $this->dbManager->find(
			[
			'conditions' => 'id_company =:id_company:'
			, 'bind' => [
				'id_company' => $registry['user']['id_company']
				]	
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