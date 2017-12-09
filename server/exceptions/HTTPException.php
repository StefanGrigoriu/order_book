<?php
namespace OrderBook\Exceptions;

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
}