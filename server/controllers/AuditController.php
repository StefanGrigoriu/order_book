<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\Audit;
use \Exceptions;

class AuditController extends BaseController 
{

	public function __construct()
	{
		$this->dbManager = new Audit();
	}


	public static function returnObject($data = [], $status = null, $message = null)
	{
		return json_encode(['message' => $message
			,'data' => $data
			, 'status' => $status]);
	}

	public function get()
	{
		$registry = $this->di->getRegistry();
		if($registry['user']['id_user_type'] != '1')
		{
			$condition = 'id_company = :id_company:';
			$bind = [
				'id_company' => $registry['user']['id_company']
			];
		}
		$q = $this->request->get('q');
		if($q)
			$q = json_decode($q);

		$data = $this->dbManager->find(
			[
				'conditions' => isset($condition) ? $condition : null
				, 'bind' => isset($bind) ? $bind : null
				, 'order' => 'create_at DESC'
			])->toArray();

		return $this->returnObject($data, 'ITS OK', 'All users list that have been requested');

	}

}