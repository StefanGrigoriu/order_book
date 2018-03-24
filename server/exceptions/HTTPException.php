<?php
namespace OrderBook\Exceptions;
	use Phalcon\Http\Response;

class HTTPException extends \Exception 
{
	private $devMessage = '';

	public function __construct($message, $code, $devMessage = '')
	{
		$this->message = $message;
		$this->code = $code;
		$this->devMessage = $devMessage;
	}

	public function getDevMessage()
	{
		return $this->devMessage;
	}

	public function send()
	{
		// Getting a response instance
		$response = new Response();

		if($this->getCode() != 200)
		{
					// Set status code
		$response->setStatusCode($this->getCode());

		// Set the content of the response
		$response->setContent(json_encode(['message' => $this->getMessage()]));

		// Send response to the client
		$response->send();
		}
		else {
			$response->setStatusCode(200);
			$response->send();
		}
	}
}