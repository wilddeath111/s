<?php namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model {
	protected $table = 'blogs';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'title', 'title_same', 'seo_name', 'keywords', 'description', 'content', 'content_images', 'create_date', 'update_date', 'publish_date', 'status', 'views', 'image', 'questions', 'youtube_id', 'priority', 'author_id', 'YoutubeTitle', 'YoutubeDuration'];


    public function getRelatedBlog($limit) {
        $query   = $this->query("SELECT * FROM blogs WHERE status = 'active' ORDER BY RAND() DESC LIMIT 0,$limit");
        return $results = $query->getResult();      
    }

    public function sitemapBlogs() {
        return $this->where(['status' => 'active'])->orderBy('update_date', 'DESC')->findAll();
    }

    public function RssBlogs() {
        $today = date('Y-m-d H:i:s');
        return $this->where(['status' => 'active'])->orderBy('update_date', 'DESC')->findAll(30);
    }

    public function getBlog($seo_name, $_id) {
        return $this->asArray()->where(['status' => 'active', '_id' => $_id, 'seo_name' => $seo_name])->first();
    }

    public function homePageBlog($limit) {
        return $this->where(['status' => 'active'])->orderBy('update_date', 'DESC')->findAll($limit);
    }

    public function BlogList() {
        return $this->where(['status' => 'active'])->orderBy('update_date', 'DESC')->findAll();
    }

    public function TotalBlog() {
        return $this->where(['status' => 'active'])->orderBy('_id', 'DESC')->findAll();
    }

    public function TotalPendingBlog() {
        return $this->where(['status' => 'pending'])->orderBy('_id', 'DESC')->findAll();
    }
    

    ////////////////////////
    /////   ADMIN //////////
    ////////////////////////

    public function dateBlogList($date) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT count(*) as total_publish_blog FROM blogs WHERE status = 'active' AND publish_date LIKE '%$date%' ");
        $results = $query->getRow();
        return $results;
    }
    
    public function AdminBlogList() {
        return $this->orderBy('_id', 'DESC')->findAll();
    }

    public function AdminPendingBlogList() {
        return $this->where(['status' => 'pending'])->orderBy('_id', 'DESC')->findAll();   
    } 

    public function AdminPublishBlogList() {
        return $this->where(['status' => 'active'])->orderBy('publish_date', 'DESC')->findAll();
    } 

    public function AdminPublishDayBlogList($day) {
        return $this->like('publish_date', $day, 'both')->where(['status' => 'active'])->orderBy('publish_date', 'DESC')->findAll();
    }

    public function AdmingetBlog($_id) {
        return $this->asArray()->where(['_id' => $_id])->first();
    }

    
    public function IdPendingBlog($blog_id) {
        $query   = $this->query("SELECT * FROM blogs WHERE _id = $blog_id AND status = 'pending' ");
        return $results = $query->getRow();
    }

    public function RandomCommentBlog() {
        $query   = $this->query("SELECT * FROM blogs WHERE status = 'active' ORDER BY RAND() DESC LIMIT 0,1");
        return $results = $query->getRow();      
    }

    public function RandomPendingBlog() {
        //$query   = $this->query("SELECT * FROM blogs WHERE status = 'pending' ORDER BY RAND() DESC LIMIT 0,1");
        $query   = $this->query("SELECT * FROM (SELECT * FROM blogs WHERE status = 'pending' ORDER BY RAND() ) AS temp_table ORDER BY priority DESC LIMIT 0,1");
        //$query   = $this->query("SELECT * FROM blogs WHERE _id = 790");
        return $results = $query->getRow();      
    }

}
