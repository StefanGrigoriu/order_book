<?php
namespace OrderBook\Models;
use Phalcon\Mvc\Model;

class Users extends Model
{
	public $id_user;

	public $id_company;

	public $id_user_type;

	public $name;

	public $email;
	
	public $password;

	public function setIdUser($id_user)
	{
		$this->id_user = $id_user;
	}

	public function getIdUser()
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
	public function setIdUserType($id_user_type)
	{
		$this->id_user_type = $id_user_type;
	}

	public function getIdUserType()
	{
		return $this->id_user_type;
	}

	public function setName($name)
	{
		$this->name= $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setEmail($email)
	{
		$this->email= $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}






    // public function validation()
    // {
    //     // // Type must be: droid, mechanical or virtual
    //     // $this->validate(
    //     //     new InclusionIn(
    //     //         [
    //     //             'field'  => 'type',
    //     //             'domain' => [
    //     //                 'droid',
    //     //                 'mechanical',
    //     //                 'virtual',
    //     //             ],
    //     //         ]
    //     //     )
    //     // );

    //     // // Robot name must be unique
    //     // $this->validate(
    //     //     new Uniqueness(
    //     //         [
    //     //             'field'   => 'name',
    //     //             'message' => 'The robot name must be unique',
    //     //         ]
    //     //     )
    //     // );

    //     // // Year cannot be less than zero
    //     // if ($this->year < 0) {
    //     //     $this->appendMessage(
    //     //         new Message('The year cannot be less than zero')
    //     //     );
    //     // }

    //     // // Check if any messages have been produced
    //     // if ($this->validationHasFailed() === true) {
    //     //     return false;
    //     // }
    // }
}