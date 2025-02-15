<?php namespace App\Controllers;
use App\Models\UserModel;
use App\Models\LogModel;

class Users extends BaseController {

	public function index() {

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',
			];
			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];
			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				
				
				$user_model = new UserModel();
				$user = $user_model->where('email', $this->request->getVar('email'))->first();

				$this->setUserSession($user);
				$login_data = ['login_date' => date('Y-m-d H:i:s'), 'login_ip' => $this->request->getIPAddress()];
				$user_model->update($user['_id'], $login_data);

				return redirect()->to('/'.$user['user_type'].'/dashboard');

			}
		}
		
		return view('admin/home/login');
	}

	private function setUserSession($user){
		$user_data = [
			'_id' => $user['_id'],
			'name' => $user['client_name'],
			'email' => $user['email'],
			'isLoggedIn' => true,
			'user_type' => $user['user_type']
		];

		session()->set($user_data);
		return true;
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}

}
