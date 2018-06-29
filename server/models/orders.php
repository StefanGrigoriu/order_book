<?php
namespace OrderBook\Models;

use Phalcon\Mvc\Model;
// use BaseModel;

class Orders extends BaseModel
{
	public $id_order;

	public $id_company;

	public $id_user;

	public $client_name;

	public $client_email;

	public $description;

	public $destination_address;

	public $destination_lat;

	public $destination_lng;

	public $duration;

	public $distance;

	public $duration_text;

	public $distance_text;

	public $status;

	public $status_password;

	public $created_at;
	
	public $updated_at;

	
	public function setIdOrder($id_order)
	{
		$this->id_order = $id_order;
	}

	public function getIdOder()
	{
		return $this->id_user;
	}

	public function setIdCompany($id_company)
	{
		$this->id_company = $id_company;
	}

	public function getIdCompany()
	{
		return $this->id_company;
	}

	public function setIdUser($id_user)
	{
		$this->id_user = $id_user;
	}

	public function getIdUser()
	{
		return $this->id_user;
	}

	public function setClientName($client_name)
	{
		$this->client_name = $client_name;
	}

	public function getClientName()
	{
		return $this->client_name;
	}

	public function setClientEmail($client_email)
	{
		$this->client_email = $client_email;
	}

	public function getClientEmail()
	{
		return $this->client_email;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getDescription()
	{
		return $this->description;
	}
// 
	public function setDestinationAddress($destination_address)
	{
		$this->destination_address = $destination_address;
	}

	public function getDestinationAddress()
	{
		return $this->destination_address;
	}


	public function setDestinationLat($destination_lat)
	{
		$this->destination_lat = $destination_lat;
	}

	public function getDestinationLat()
	{
		return $this->destination_lat;
	}

	public function setDestinationLng($destination_lng)
	{
		$this->destination_lng = $destination_lng;
	}

	public function getDestinationLng()
	{
		return $this->destination_lng;
	}
//	 



	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatusPassword($status_password)
	{
		$this->status_password = $status_password;
	}

	public function getStatusPassword()
	{
		return $this->status_password;
	}

	public function setCreatedAt($created_at)
	{
		$this->created_at= $created_at;
	}

	public function getCreatedAt()
	{
		return $this->created_at;
	}

	public function setUpdatedAt($updated_at)
	{
		$this->updated_at = $updated_at;
	}

	public function getUpdatedAt()
	{
		return $this->updated_at;
	}

	public function setDuration($duration)
	{
		$this->duration = $duration;
		// return $this;
	}

	public function getDuration()
	{
		return $this->duration;
	}

	public function setDistance($distance)
	{
		$this->distance = $distance;
		// return $this;
	}

	public function getDistance()
	{
		return $this->distance;
	}

	public function setDurationText($duration_text)
	{
		$this->duration_text = $duration_text;
		// return $this;
	}

	public function getDurationText()
	{
		return $this->duration_text;
	}

	public function setDistanceText($distance_text)
	{
		$this->distance_text = $distance_text;
		// return $this;
	}

	public function getDistanceText()
	{
		return $this->distance_text;
	}


	
}