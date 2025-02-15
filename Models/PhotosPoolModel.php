<?php namespace App\Models;

use CodeIgniter\Model;

class PhotosPoolModel extends Model {
	protected $table = 'photos_pool';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'photo_id', 'photo_url', 'photo_keyword', 'used', 'create_date', 'source'];

    public function AdmingetPhotosList() {
        return $this->orderBy('photo_keyword', 'DESC')->findAll();
    }

    public function AdmingetPhoto($_id) {
        return $this->asArray()->where(['_id' => $_id])->first();
    }

    public function randomContentImage($keywords) {
        $query   = $this->query("SELECT * FROM photos_pool WHERE photo_keyword REGEXP '$keywords' ORDER BY RAND() LIMIT 1");
        $results = $query->getRow();
        
        if (!empty($results)) {
            $data = ['used' => $results->used + 1];
            $this->db->table('photos_pool')->where('photo_id', $results->photo_id)->update($data);
        }

        return $results;

    }

}
