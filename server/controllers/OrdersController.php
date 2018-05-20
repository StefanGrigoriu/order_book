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
		if(isset($data['Orders']['destination_address']))
		{

			$order->setDestinationAddress($data['Orders']['destination_address']);
						$order->setDestinationLat($data['Orders']['destination_lat']);

			$order->setDestinationLng($data['Orders']['destination_lng']);

		}
		$response = $order->save();

		$messages = true;

		if($response == false)
		{
			$messages = $order->getMessages();
		}

		return json_encode(['response' => $order->toArray(), 'message' => $messages]);
	}

	public function verifyOrder($status_password)
	{
		// return json_encode($status_password);
		$order_search = new Orders();
		$order = $order_search::findFirst(
			[
				'conditions' => 'status_password = :sts:'
				, 'bind' => [
					'sts' => $status_password
				]
			]);

		if($order !== false)
		{
			$order = $order->toArray();	
			return $this->returnObject($order, 'ITS OK', 'One user information given');
		}
		else
		{
			return $this->returnObject(null, 'ITS OK', 'Resource could not be found');
		}
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

		if(isset($data['Orders']['status']))
		{
			$order->setStatus($data['Orders']['status']);
		}

		if(isset($data['Orders']['status_password']))
		{
			$order->setStatusPassword($data['Orders']['status_password']);
		}

if(isset($data['Orders']['destination_address']))
		{

			$order->setDestinationAddress($data['Orders']['destination_address']);
						$order->setDestinationLat($data['Orders']['destination_lat']);

			$order->setDestinationLng($data['Orders']['destination_lng']);

		}
		$response = $order->update();

		$messages = true;
		if($response == false)
		{
			$messages = $order->getMessages();
		}

		return json_encode(['response' => $order ? $order->toArray() : null, 'message' => $messages]);
	}


}