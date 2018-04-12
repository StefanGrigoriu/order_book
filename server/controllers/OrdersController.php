<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\Orders;
use \Exceptions;

class OrdersController extends BaseController 
{

	public function __construct()
	{
		$this->dbManager = new Orders();
	}

	// public function get()
	// {
	// 	$registry = $this->di->getRegistry();
	// 	$q = $this->request->get('q');
	// 	if($q)
	// 		$q = json_decode($q);

	// 	$condition = 'id_company = :id_company:';
	// 	// return json_encode($condition);
	// 	$bind = [
	// 		'id_company' => $registry['user']['id_company']
	// 	];
		
	// 	if(isset($q) && $q)
	// 		foreach ($q as $key => $value)
	// 		{
	// 			# code...
	// 			$condition .= ' AND '.$value->key .' '.$value->op.' :key'.$key.':';
	// 			$bind['key'.$key] = $value->op == 'LIKE' ? '%'.$value->value.'%' : $value->value;
	// 		}
	// 		return json_encode(['bind' => $bind, 'condition' => $condition]);
	// 	$data = $this->dbManager->find(
	// 		[
	// 		'conditions' => $condition
	// 		, 'bind' => $bind
	// 		])->toArray();
	
	// return $this->returnObject($data, 'ITS OK', 'All users list that have been requested');
	// }

	public static function returnObject($data = [], $status = null, $message = null)
	{
		return json_encode(['message' => $message
			,'data' => $data
			, 'status' => $status]);
	}

	public function post()
	{
		$registry = $this->di->getRegistry();
	
		$data = $this->requestBody;
		$order = new Orders();
		$order->setDescription($data['Orders']['description']);
		$order->setIdUser($registry['user']['id_user']);
		$order->setClientName($data['Orders']['client_name']);
	
		$response = $order->create();
	
		$messages = true;
		if($response == false)
		{
			$messages = $order->getMessages();
		}

		return json_encode(['response' => $order->toArray(), 'message' => $messages]);
	}

	public function put($id)
	{
		$data = $this->requestBody;
		$order_search = new Orders();
		$order = $order_search::findFirst(
			[
				'conditions' => 'id_order = :id_order:'
				, 'bind' => [
					'id_order' => $id
				]
			]);
		$order->setDescription($data['Orders']['description']);
		// $order->setIdUser($registry['user']['id_user']);
		$order->setClientName($data['Orders']['client_name']);
		$response = $order->update();
	
		$messages = true;
		if($response == false)
		{
			$messages = $order->getMessages();
		}

		return json_encode(['response' => $order ? $order->toArray() : null, 'message' => $messages]);
	}


}