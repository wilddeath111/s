<?php namespace App\Controllers;
use App\Models\LogModel;
use App\Models\CommentModel;
use App\Models\BlogModel;
use CodeIgniter\Controller;

use ReCaptcha\ReCaptcha;

class Comment extends BaseController {

    function random_create_comments($security_code) {
        echo '<meta name="robots" content="noindex,nofollow">';
        $BlogModel = new BlogModel();
        $LogModel = new LogModel();
        $CommentModel = new CommentModel();

        if ($security_code == siteSet('crontab_code')) {

            if (siteSet('blog_comment_ai_creator') == 'passive') {
                echo 'CRON PASSIVE'; exit();

                // LOG Kaydı Tutuluyor
                $log_data = ['item_id' => $pending_blog->_id, 'item' => 'comments', 'admin_id' => 3, 'log_text' => 'HATA! Yorum Publish CRON : Openai Yorum Cron Pasif durumda ', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                $save = $LogModel->insert($log_data);
                // LOG Kaydı Tutuldu
            }

            if (empty(siteSet('openai_apikey'))) {
                echo 'OPENAI KEY EMPTY'; exit();
                // LOG Kaydı Tutuluyor
                $log_data = ['item_id' => $pending_blog->_id, 'item' => 'comments', 'admin_id' => 3, 'log_text' => 'HATA! Publish CRON : Openai Cron Key Boş ', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                $save = $LogModel->insert($log_data);
                // LOG Kaydı Tutuldu
            }

            $blog_data = $BlogModel->RandomCommentBlog();

            $api_key = siteSet('openai_apikey');
            $model_id = siteSet('blog_comment_ai_model');
            $comment_count = siteSet('blog_comment_ai_count');

           $post_fields = array(
                "model" => "$model_id",
                "messages" => array(
                    array(
                        "role" => "user",
                        "content" => $blog_data->title.' başlıklı blog yazım için '.$comment_count.' adet kullanıcı yorumu ve yorum başlığı yazar mısınız? Yorumların 40 ile 200 karakter arasında limitlerle oluşmasını istiyorum. Ayrıca bir nickname yazmalısın. İngilizce yaz ve json verisi dön. Json veri isimleri NickName,CommentTitle,CommentBody olsun. Bana hiç açıklama yapma.Sadece json verisini istiyorum. JSON verisi harici hiçbirşey olmasın.'
                    )
                ),
                "max_tokens" => 3800,
                "temperature" => 0.7
            );

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_fields),
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Authorization: Bearer '.$api_key
            ),
            ));

            $response = curl_exec($curl);
            $json_response = json_decode($response, true);
            $t = $json_response['choices'][0]['message']['content'];
            $reviews_data = json_decode($t);
            
            if (isset($reviews_data)) {
                foreach ($reviews_data as $review) {

                    if((isset($review->NickName)) AND (isset($review->CommentBody)) ) {
                        $comment_data = [
                            'blog_id' => $blog_data->_id,
                            'nick_name' => $review->NickName,
                            'comment_text' => $review->CommentBody,
                            'create_date' => date('Y-m-d H:i:s'),
                            'status' => 'active',
                            'comment_type' => 'ai'
                        ];
                        $comment_id = $CommentModel->insert($comment_data);

                        if ($comment_id) {
                            // LOG Kaydı Tutuluyor
                            $log_data = ['item_id' => $comment_id, 'item' => 'comments', 'admin_id' => 3, 'log_text' => 'AI Yorum eklendi!', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                            $save = $LogModel->insert($log_data);
                            // LOG Kaydı Tutuldu

                            if (siteSet('onesignal_publish_comment_status') == 'active') {
                                $BlogOnesignal = New Blog();
                                $o_return = $BlogOnesignal->oneSignalSend(lang('Global.admin_notification.comment.title'), lang('Global.admin_notification.comment.content'));
                            }
                        }
                    }

                }
            }

        }
    }

    public function submit_comment() {
        $CommentModel = new CommentModel();

        $recaptcha_response = $this->request->getVar('recaptcha');
        $name = $this->request->getVar('name');
        $blog_id = $this->request->getVar('blog_id');
        $email = $this->request->getVar('email');
        $comment = $this->request->getVar('comment');

        // Google reCAPTCHA doğrulama anahtarını kontrol edin
        $recaptcha = new \ReCaptcha\ReCaptcha(siteSet('recaptcha_secret_key'));
        $response = $recaptcha->verify($recaptcha_response, $_SERVER['REMOTE_ADDR'], 'submit_comment');

        // Doğrulama başarısız olduysa hata mesajı gösterin
        if (!$response->isSuccess()) {
            echo json_encode(['status' => 'error', 'message' => lang('Site.reCAPTCHA_novalidate_text')]);
            return;
        }

        $comment_data = [
            'blog_id' => $blog_id,
            'nick_name' => $name,
            'comment_text' => $comment,
            'create_date' => date('Y-m-d H:i:s'),
            'comment_type' => 'user'
        ];
        $comment_id = $CommentModel->insert($comment_data);

        echo json_encode(['status' => 'success', 'message' => lang('Site.comment_success_text')]);
    }

	public function admin_list() {
		$user_id = session()->get('_id');
		$CommentModel = new CommentModel();
		$data['comments'] = $CommentModel->AdminCommentList();
		return view('admin/comment/admin_list', $data);
	}

    public function pending_admin_list() {
        $CommentModel = new CommentModel();
        $data['comments'] = $CommentModel->AdminPendingCommentList();
        return view('admin/comment/pending_admin_list', $data);
    }

    public function admin_delete($id) {
        $CommentModel = new CommentModel();
        $LogModel = new LogModel();
        $user_id = session()->get('_id');
        $_id = hash_decode($id)[0];

        $data['comment'] = $CommentModel->AdmingetComment($_id);

        if (empty($data['comment'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        } else {
            // LOG Kaydı Tutuluyor
            $log_data = ['item_id' => $_id, 'item' => 'comments', 'admin_id' => session()->get('_id'), 'log_text' => 'Yorum Silindi!', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
            $save = $LogModel->insert($log_data);
            // LOG Kaydı Tutuldu
            $data['comment'] = $CommentModel->where('_id', $_id)->delete();
            $data['toast']['toast_title'] = 'BS04';
            session()->set($data['toast']);
            return redirect()->to('/admin/comments/list');
        }
    }

    public function admin_details($id, $alert = NULL) {
        helper(['form', 'url']);
        $LogModel = new LogModel();

        $_id = hash_decode($id)[0];
        $user_id = session()->get('_id');

        $CommentModel = new CommentModel();
        $data['comment'] = $CommentModel->AdmingetComment($_id);
        $data['alert'] = $alert;
        
        $BlogModel = new BlogModel();
        $data['blog'] = $BlogModel->AdmingetBlog($data['comment']['blog_id']);
        
        if (empty($data['blog'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        }       

        if (empty($data['comment'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        }

        $data['logs'] = $LogModel->CommentLog($_id);

        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nick_name' => 'required',

            ];
            $validate = $this->validate($rules);
            if ($validate) {

                $data = [
                    'nick_name' => $this->request->getVar('nick_name'),
                    'comment_text'  => $this->request->getVar('comment_text'),
                    'status'  => $this->request->getVar('status'),
                    'update_date'   => date('Y-m-d H:i:s')
                ];
                $save = $CommentModel->update($_id, $data);
                if ($save) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $_id, 'item' => 'comments', 'admin_id' => session()->get('_id'), 'log_text' => 'Yorum Güncellendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    return redirect()->to('/admin/comments/details/'.$id.'/BS01');
                } else { return redirect()->to('/admin/comments/details/'.$id.'/BS00'); }
            } else { return redirect()->to('/admin/comments/details/'.$id.'/BS02'); }
        }

        echo view('admin/comment/admin_details', $data);
    }

}
