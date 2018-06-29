<?php
namespace OrderBook\Controllers;
use \Phalcon\Di;

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

		if($registry['user']['id_user_type'] != '1')
		{
			$condition = 'id_company = :id_company:';
			$bind = [
				'id_company' => $registry['user']['id_company']
			];
		}
		
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
					'conditions' => isset($condition) ? $condition : null
					, 'bind' => isset($bind) ? $bind : null
					, 'order' => 'created_at DESC'
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

		public function rawSql($sql)
	{
		$di = Di::getDefault();
		$connection  = $di->getDb();
		$data       = $connection->query($sql);
		$data->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
		$results    = $data->fetchAll();
		return $results;
	}
	}