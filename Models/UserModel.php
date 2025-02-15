<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model {
	protected $table = 'users';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'client_name', 'email', 'gsm', 'password', 'login_date', 'login_ip', 'create_date', 'update_date', 'status', 'user_type'];
	//protected $beforeUpdate = ['beforeUpdate'];

	protected function beforeUpdate(array $data){
		$data = $this->passwordHash($data);
		$data['data']['update_date'] = date('Y-m-d H:i:s');
		return $data;
	}

	protected function passwordHash(array $data){
		if(isset($data['data']['password']))
  		$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

		return $data;
	}

	public function user_control($email, $gsm) {
		$query   = $this->query("SELECT count(*) AS total FROM users WHERE email = '$email' OR gsm = '$gsm' ");
		return $results = $query->getRow();
	}
	

}
