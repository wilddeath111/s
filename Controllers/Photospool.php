<?php namespace App\Controllers;
use App\Models\LogModel;
use App\Models\PhotosPoolModel;
use CodeIgniter\Controller;


class Photospool extends BaseController {

	public function admin_index() {
		$user_id = session()->get('_id');
		$PhotosPoolModel = new PhotosPoolModel();
		$data['photos'] = $PhotosPoolModel->AdmingetPhotosList();
		return view('admin/photospool/admin_index', $data);
	}

	public function keyword_add($alert = NULL, $count = NULL) {
		$data['alert'] = $alert;
		$data['photo_count'] = $count;
		if ($this->request->getMethod() === 'post') {
            $rules = [
                'keyword' => 'required',
            ];
            $validate = $this->validate($rules);
            if ($validate) {
				$data['keyword'] = trim($this->request->getVar('keyword'));
				$data['source'] = $this->request->getVar('source'); 

				if ($data['source'] == 'unsplash') {
					$photo_data = $this->getUnsplashPhoto($data['keyword']);
					$data['photo_data'] = $photo_data['results'];
				} else {
					$data[] = '';
				}

			} else { return redirect()->to('/admin/photospool/keyword-add/BS02'); }

			return view('admin/photospool/keyword_add', $data);
		} else {
			$data[] = '';
			return view('admin/photospool/keyword_add', $data);	
		}
		
	}

	public function keyword_add_result() {
		$PhotosPoolModel = new PhotosPoolModel();

		$selected_photos = $this->request->getVar('imageCheckbox');
		$source = $this->request->getVar('source');
		$keyword = $this->request->getVar('keyword');

		if (!empty($selected_photos)) {
			$photo_count = 0;
			foreach ($selected_photos as $photo) {
				$photo_d = explode("|||", $photo);
				$photo_control = $PhotosPoolModel->where('photo_id', trim($photo_d[1]))->first();
				if (empty($photo_control)) {
			        $photo_data = [
			        	'photo_id' => trim($photo_d[1]),
			            'photo_url' => trim($photo_d[0]),
			            'photo_keyword' => trim($keyword),
			            'source' => trim($source),
			            'create_date'   => date('Y-m-d H:i:s')
			        ];
			        $photo_id = $PhotosPoolModel->insert($photo_data);
			        $photo_count++;
			    }
			}
			return redirect()->to('/admin/photospool/keyword-add/BS03/'.$photo_count);
		} else {
			return redirect()->to('/admin/photospool/keyword-add/BS02');
		}
	}

	public function getUnsplashPhoto($keywords) {
	    $access_key = siteSet('unsplash_accesskey');
	    $per_page = 50;
	    $page = 1;
	    $orientation = 'landscape';

	    $url = 'https://api.unsplash.com/search/photos?query='.urlencode($keywords).'&per_page='.$per_page.'&page='.$page.'&orientation='.$orientation.'&client_id='.$access_key;

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($ch);
	    curl_close($ch);

	    $data = json_decode($response, true);
	    return $data;
	}

    public function admin_delete($id) {
        $PhotosPoolModel = new PhotosPoolModel();
        $LogModel = new LogModel();
        $user_id = session()->get('_id');
        $_id = hash_decode($id)[0];

        $data['photo'] = $PhotosPoolModel->AdmingetPhoto($_id);

        if (empty($data['photo'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        } else {
            // LOG Kaydı Tutuluyor
            $log_data = ['item_id' => $_id, 'item' => 'photospool', 'admin_id' => session()->get('_id'), 'log_text' => 'Fotoğraf Silindi!', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
            $save = $LogModel->insert($log_data);
            // LOG Kaydı Tutuldu
            $data['blog'] = $PhotosPoolModel->where('_id', $_id)->delete();
            $data['toast']['toast_title'] = 'BS04';
            session()->set($data['toast']);
            return redirect()->to('/admin/photospool/list');
        }
    }

}
