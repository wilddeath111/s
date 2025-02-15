<?php namespace App\Controllers;
use App\Models\LogModel;
use App\Models\AuthorModel;
use CodeIgniter\Controller;


class Author extends BaseController {

	public function admin_list() {
		$user_id = session()->get('_id');
		$AuthorModel = new AuthorModel();
		$data['authors'] = $AuthorModel->AdminAuthorList();
		return view('admin/author/admin_list', $data);
	}

    public function admin_delete($id) {
        $AuthorModel = new AuthorModel();
        $LogModel = new LogModel();
        $user_id = session()->get('_id');
        $_id = hash_decode($id)[0];

        $data['author'] = $AuthorModel->AdmingetAuthor($_id);

        if (empty($data['author'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        } else {
            // LOG Kaydı Tutuluyor
            $log_data = ['item_id' => $_id, 'item' => 'author', 'admin_id' => session()->get('_id'), 'log_text' => 'Yazar Silindi!', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
            $save = $LogModel->insert($log_data);
            // LOG Kaydı Tutuldu
            $data['author'] = $AuthorModel->where('_id', $_id)->delete();
            $data['toast']['toast_title'] = 'BS04';
            session()->set($data['toast']);
            return redirect()->to('/admin/author/list');
        }
    }

    public function admin_add($alert = NULL) {
        $LogModel = new LogModel();
        $AuthorModel = new AuthorModel();
        $data['alert'] = $alert;
        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'author_name' => 'required',
            ];
            $validate = $this->validate($rules);
            if ($validate) {
                
                $author_data = [
                    'author_name' => trim($this->request->getVar('author_name')),
                    'author_expertise'  => trim($this->request->getVar('author_expertise')),
                    'author_bio'  => trim($this->request->getVar('author_bio')),
                    'status'  => $this->request->getVar('status'),
                    'create_date'   => date('Y-m-d H:i:s')
                ];
                $author_id = $AuthorModel->insert($author_data);
                if ($author_id) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $author_id, 'item' => 'author', 'admin_id' => session()->get('_id'), 'log_text' => 'Yazar Eklendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    $img = $this->request->getFile('avatar_image');
                    if ($img->isValid() && ! $img->hasMoved()) {
                           $newName = $img->getRandomName();
                           $img->move('public/upload/authors', $newName);

                           // Image DB Update
                           $image_data = ['avatar_image'   => $newName];
                           $save = $AuthorModel->update($author_id, $image_data);
                    }

                    return redirect()->to('/admin/author/details/'.hash_encode($author_id).'/BS03');
                } else { return redirect()->to('/admin/author/add/BS00'); }
                return redirect()->to('/admin/author/index');

            } else { return redirect()->to('/admin/author/add/BS02'); }
        }

        echo view('admin/author/admin_add', $data);
    }

    public function admin_details($id, $alert = NULL) {
        helper(['form', 'url']);
        $LogModel = new LogModel();

        $_id = hash_decode($id)[0];
        $user_id = session()->get('_id');

        $AuthorModel = new AuthorModel();
        $data['author'] = $AuthorModel->AdmingetAuthor($_id);
        $data['alert'] = $alert;

        if (empty($data['author'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        }

        $data['logs'] = $LogModel->AuthorLog($_id);

        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'author_name' => 'required',

            ];
            $validate = $this->validate($rules);
            if ($validate) {

                $data = [
                    'author_name' => trim($this->request->getVar('author_name')),
                    'author_expertise'  => trim($this->request->getVar('author_expertise')),
                    'author_bio'  => trim($this->request->getVar('author_bio')),
                    'status'  => $this->request->getVar('status'),
                    'update_date'   => date('Y-m-d H:i:s')
                ];
                $save = $AuthorModel->update($_id, $data);
                if ($save) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $_id, 'item' => 'author', 'admin_id' => session()->get('_id'), 'log_text' => 'Yazar Güncellendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    $img = $this->request->getFile('avatar_image');
                    if ($img->isValid() && ! $img->hasMoved()) {
                           $newName = $img->getRandomName();
                           $img->move('public/upload/authors', $newName);

                           // Image DB Update
                           $image_data = ['avatar_image'   => $newName];
                           $save = $AuthorModel->update($_id, $image_data);
                    }

                    return redirect()->to('/admin/author/details/'.$id.'/BS01');
                } else { return redirect()->to('/admin/author/details/'.$id.'/BS00'); }
            } else { return redirect()->to('/admin/author/details/'.$id.'/BS02'); }
        }

        echo view('admin/author/admin_details', $data);
    }

}
