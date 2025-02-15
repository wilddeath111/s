<?php namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model {
	protected $table = 'logs';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'item_id', 'item', 'admin_id', 'log_text', 'log_date', 'client_ip'];


	////////////////////////
	/////	ADMIN //////////
	////////////////////////

	public function LastLog() {
		return $this->orderBy('_id', 'DESC')->findAll(10);
	}

	public function AdmingetLogList() {
		return $this->orderBy('_id', 'DESC')->findAll();
	}	

	public function CommentLog($_id) {
		return $this->where(['item_id' => $_id, 'item' => 'comment'])->orderBy('_id', 'DESC')->findAll(20);
	}

	public function AuthorLog($_id) {
		return $this->where(['item_id' => $_id, 'item' => 'author'])->orderBy('_id', 'DESC')->findAll(20);
	}

	public function BlogLog($_id) {
		return $this->where(['item_id' => $_id, 'item' => 'blog'])->orderBy('_id', 'DESC')->findAll(20);
	}



	public function PageLog($_id) {
		return $this->where(['item_id' => $_id, 'item' => 'page'])->orderBy('_id', 'DESC')->findAll(20);
	}
	
	
}
