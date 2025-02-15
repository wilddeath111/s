<?php namespace App\Controllers;

use App\Models\LogModel;
use App\Models\PageModel;

class Pages extends BaseController {

    public function detail($page_seoname, $_id) {

        $PageModel = new PageModel();
        $data['page'] = $PageModel->getPage($_id, $page_seoname);

        if (empty($data['page'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        }

        $page_view = ['view' =>  ($data['page']['view']+1)];
        $save = $PageModel->update($_id, $page_view);
    
        // Page Cache Started //
        if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
        // Page Cache Finished //

        $data['seo']['title'] = $data['page']['seo_title'].' - '.siteSet('site_name');
        $data['seo']['description'] = $data['page']['description'];
        $data['seo']['keywords'] = $data['page']['keywords'];
        $data['seo']['og_image'] = getenv('site.cdnUrl').'/public/upload/logo/'.siteSet('site_image');

        return view(siteSet('site_themes').'/layouts/pages/details', $data);
    }


    public function admin_list() {
        $PageModel = new PageModel();
        $data['pages'] = $PageModel->AdminPageList();
        return view('admin/page/admin_list', $data);
    }

    public function admin_delete($id) {
        $PageModel = new PageModel();
        $LogModel = new LogModel();
        $user_id = session()->get('_id');
        $_id = hash_decode($id)[0];

        $data['page'] = $PageModel->AdmingetPage($_id);

        if (empty($data['page'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        } else {
            // LOG Kaydı Tutuluyor
            $log_data = ['item_id' => $_id, 'item' => 'page', 'admin_id' => session()->get('_id'), 'log_text' => 'Sabit Sayfa Silindi! Sayfa Adı: '.$data['page']['name'], 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
            $save = $LogModel->insert($log_data);
            // LOG Kaydı Tutuldu
            $data['page'] = $PageModel->where('_id', $_id)->delete();
            $data['toast']['toast_title'] = 'BS04';
            session()->set($data['toast']);
            return redirect()->to('/admin/page/index');
        }
    }

    public function admin_add($alert = NULL) {
        $LogModel = new LogModel();
        $PageModel = new PageModel();
        $data['alert'] = $alert;
        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'title' => 'required',
                'status' => 'required',
            ];
            $validate = $this->validate($rules);
            if ($validate) {

                if (empty($this->request->getVar('seo_title'))) { $seo_title = $this->request->getVar('title'); } else { $seo_title = $this->request->getVar('seo_title'); }
                
                $page_data = [
                    'name' => $this->request->getVar('title'),
                    'seo_name' => seflink($this->request->getVar('title')),
                    'seo_title' => $seo_title,
                    'content'  => $this->request->getVar('content'),
                    'keywords'  => $this->request->getVar('keywords'),
                    'description'  => $this->request->getVar('description'),
                    'footer'  => $this->request->getVar('footer'),
                    'status'  => $this->request->getVar('status'),
                    'create_date'   => date('Y-m-d H:i:s')
                ];
                $page_id = $PageModel->insert($page_data);
                if ($page_id) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $page_id, 'item' => 'page', 'admin_id' => session()->get('_id'), 'log_text' => 'Sabit Sayfa Eklendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    $img = $this->request->getFile('page_image');
                    if ($img->isValid() && ! $img->hasMoved()) {
                           $newName = $img->getRandomName();
                           $img->move('public/upload/pages', $newName);

                           // Image DB Update
                           $image_data = ['image'   => $newName];
                           $save = $PageModel->update($page_id, $image_data);
                    }

                    return redirect()->to('/admin/page/details/'.hash_encode($page_id).'/BS03');
                } else { return redirect()->to('/admin/page/add/BS00'); }
                return redirect()->to('/admin/page/index');

            } else { return redirect()->to('/admin/page/add/BS02'); }
        }

        echo view('admin/page/admin_add', $data);
    }

    public function admin_details($id, $alert = NULL) {
        helper(['form', 'url']);
        $LogModel = new LogModel();

        $_id = hash_decode($id)[0];
        $user_id = session()->get('_id');
        
        $PageModel = new PageModel();
        $data['page'] = $PageModel->AdmingetPage($_id);
        $data['alert'] = $alert;

        if (empty($data['page'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        }

        $data['logs'] = $LogModel->PageLog($_id);

        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'title' => 'required',
                'status' => 'required',

            ];
            $validate = $this->validate($rules);
            if ($validate) {
                
                if (empty($this->request->getVar('seo_title'))) { $seo_title = $this->request->getVar('title'); } else { $seo_title = $this->request->getVar('seo_title'); }

                $data = [
                    'name' => $this->request->getVar('title'),
                    'seo_name' => seflink($this->request->getVar('title')),
                    'seo_title' => $seo_title,
                    'keywords'  => $this->request->getVar('keywords'),
                    'description'  => $this->request->getVar('description'),
                    'footer'  => $this->request->getVar('footer'),
                    'content'  => $this->request->getVar('content'),
                    'status'  => $this->request->getVar('status'),
                    'update_date'   => date('Y-m-d H:i:s')
                ];
                $save = $PageModel->update($_id, $data);
                if ($save) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $_id, 'item' => 'page', 'admin_id' => session()->get('_id'), 'log_text' => 'Sabit Sayfa Güncellendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    $img = $this->request->getFile('page_image');
                    if ($img->isValid() && ! $img->hasMoved()) {
                           $newName = $img->getRandomName();
                           $img->move('public/upload/pages', $newName);

                           // Image DB Update
                           $image_data = ['image'   => $newName];
                           $save = $PageModel->update($_id, $image_data);
                    }

                    return redirect()->to('/admin/page/details/'.$id.'/BS01');
                } else { return redirect()->to('/admin/page/details/'.$id.'/BS00'); }
            } else { return redirect()->to('/admin/page/details/'.$id.'/BS02'); }
        }

        echo view('admin/page/admin_details', $data);
    }

}
