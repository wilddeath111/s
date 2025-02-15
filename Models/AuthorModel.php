<?php namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model {
	protected $table = 'authors';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'avatar_image', 'author_name', 'author_expertise', 'author_bio', 'status', 'create_date', 'update_date'];


    public function getAuthor($author_id) {
        return $this->asArray()->where(['status' => 'active', '_id' => $author_id])->first();
    }

	////////////////////////
	/////	ADMIN //////////
	////////////////////////

    public function ActiveAuthorList() {
        return $this->where(['status' => 'active'])->orderBy('author_name', 'ASC')->findAll();
    }

    public function AdminAuthorList() {
        return $this->orderBy('_id', 'DESC')->findAll();
    }

    public function AdmingetAuthor($_id) {
        return $this->asArray()->where(['_id' => $_id])->first();
    }

    public function RandomgetAuthor() {
        $query   = $this->query("SELECT * FROM authors WHERE status = 'active' ORDER BY RAND() DESC LIMIT 0,1");
        return $results = $query->getRow();      
    }
}
