<?php namespace App\Controllers;
use App\Models\LogModel;
use CodeIgniter\Controller;


class Logs extends BaseController {

	public function admin_index() {
		$user_id = session()->get('_id');
		$LogModel = new LogModel();
		$data['logs'] = $LogModel->AdmingetLogList();
		return view('admin/log/admin_list', $data);
	}
}
