<?php namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model {
	protected $table = 'comments';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'blog_id', 'nick_name', 'comment_text', 'create_date', 'update_date', 'status', 'comment_type'];

    public function getBlogCommentList($_id) {
        return $this->asArray()->where(['status' => 'active'])->where(['blog_id' => $_id])->orderBy('update_date', 'DESC')->findAll();
    }


	////////////////////////
	/////	ADMIN //////////
	////////////////////////


    public function AdmingetBlogCommentList($_id) {
        return $this->asArray()->where(['blog_id' => $_id])->findAll();
    }

    public function AdminCommentList() {
        return $this->orderBy('_id', 'DESC')->findAll();
    }

    public function AdminPendingCommentList() {
        return $this->where(['status' => 'pending'])->orderBy('_id', 'ASC')->findAll();   
    }

    public function AdminActiveCommentList() {
        return $this->where(['status' => 'active'])->orderBy('_id', 'ASC')->findAll();   
    }

    public function AdminTodayActiveCommentList() {
        $date = date('Y-m-d');
        return $this->like('create_date', $date, 'both')->where(['status' => 'active'])->orderBy('_id', 'ASC')->findAll();   
    }

    public function AdmingetComment($_id) {
        return $this->asArray()->where(['_id' => $_id])->first();
    }
}
