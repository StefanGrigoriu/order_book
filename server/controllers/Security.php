<?php
namespace OrderBook\Controllers;

use Phalcon\Mvc\User\Component;
use \OrderBook\Exceptions\HTTPException;
use \OrderBook\Models\Users;

class Security extends Component 
{
	public $email;
	public $password;
    public $company_id = true;

	public function checkAccess($parameters)
	{
		    $aux = explode(':',$parameters['password']);
		    $this->email = $parameters['email'];
    		$this->password = $aux[0];
    		$this->company_id = $aux[1];
    		$registry = $this->di->getRegistry();
    		$user = new Users();
    		$user_found = $user->findFirst([
			'conditions' => 'email = :email: and password = :password: and id_company = :id_company:'
			, 'bind' => [
					'email' =>  $this->email
					,'password' => sha1($this->password)
					, 'id_company' => $this->company_id
			]
			]);

    		if($user_found)
    		{
    			$registry['user'] = $user_found->toArray();
    		}
    		else throw new HTTPException('Error user not found', 400);
	}
}