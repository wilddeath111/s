<?php namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model {
	protected $table = 'pages';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'name', 'seo_name', 'seo_title', 'keywords', 'description', 'footer', 'status', 'create_date', 'content', 'image', 'view'];

    public function sitemapPages() {
        return $this->where(['status' => 'active'])->orderBy('create_date', 'DESC')->findAll();
    }
    
    public function getPage($_id, $seo_name) {
        return $this->asArray()->where(['status' => 'active', '_id' => $_id, 'seo_name' => $seo_name])->first();
    }

    ////////////////////////
    /////   ADMIN //////////
    ////////////////////////

    public function AdminTotalPageList() {
        return $this->where(['status' => 'active'])->orderBy('create_date', 'DESC')->findAll();
    }

    public function AdminPageList() {
        return $this->orderBy('_id', 'DESC')->findAll();
    }

    public function AdmingetPage($_id) {
        return $this->asArray()->where(['_id' => $_id])->first();
    }
    
}
