<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\Model\Query;
use \OrderBook\Models\Orders;
use \Exceptions;
use \Phalcon\Di;
// use \OrderBook\Libs\sendgrid-php-master\sendgrid-php.php;


class OrdersController extends BaseController 
{

	public function __construct()
	{
		$this->dbManager = new Orders();
	}

	public function sendEmail($to = NULL)
	{
		$registry = $this->di->getRegistry();
		
		$company_name = $registry['company']['name'];
	
		$email = new \SendGrid\Mail\Mail(); 
		$email->setFrom("contact@no-reply.com" ,$company_name);
		$email->setSubject("Comanda ".$company_name);
		$email->addTo($to, "Example User");
		$email->addContent(
		    "text/html", "<strong>Comanda a fost plasata. <br/>Va multumim pentru cerere, vom reveni cu un apel in cel mai scurt timp.</strong>"
		);
		$sendgrid = new \SendGrid('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');
		try {
		    $response = $sendgrid->send($email);
			return json_encode('Email was successfull sent');
		} catch (Exception $e) {
		    return json_encode($e->getMessages());
		}
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
		if(isset($data['Orders']['client_email']))
		{
			$order->setClientEmail($data['Orders']['client_email']);
			$this->sendEmail($data['Orders']['client_email']);	
		}
		if(isset($data['Orders']['destination_address']))	
		{

			$order->setDestinationAddress($data['Orders']['destination_address']);
			$order->setDestinationLat($data['Orders']['destination_lat']);

			$order->setDestinationLng($data['Orders']['destination_lng']);
		}
		if(isset($data['Orders']['duration']))
		{
			$order->setDuration($data['Orders']['duration']);
			$order->setDurationText($data['Orders']['duration_text']);
			$order->setDistance($data['Orders']['distance']);
			$order->setDistanceText($data['Orders']['distance_text']);
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

		if(isset($data['Orders']['duration']))
		{
			$order->setDuration($data['Orders']['duration']);
			$order->setDurationText($data['Orders']['duration_text']);
			$order->setDistance($data['Orders']['distance']);
			$order->setDistanceText($data['Orders']['distance_text']);
		}
		$response = $order->update();

		$messages = true;
		if($response == false)
		{
			$messages = $order->getMessages();
		}

		return json_encode(['response' => $order ? $order->toArray() : null, 'message' => $messages]);
	}

	public function getOrderByMonth()
	{
		$registry = $this->di->getRegistry();
		$id_company =  $registry['user']['id_company'];
		$result = ['chart1' => [], 'chart2'=> []];
		//SELECT pt chart 1
		$sql = 'SELECT COUNT(*) as "Total", created_at FROM `orders` WHERE id_company = '.$id_company.' GROUP BY YEAR(created_at), MONTH(created_at) ORDER BY created_at ASC';
		$result['chart1'] =  $this->rawSql($sql);
		//Select cele mai multe vanzari per user
		$sql2 = 'SELECT COUNT(*) as "TOTAL", USERS.name FROM ORDERS, USERS WHERE ORDERS.id_user = USERS.id_user AND ORDERS.id_company = '.$id_company.' GROUP BY ORDERS.id_user';

			$result['chart2'] =  $this->rawSql($sql2);

			return json_encode( $result);							


	}

	

}