<?php namespace App\Controllers;
use App\Models\UserModel;
use App\Models\LogModel;
use App\Models\SettingModel;
use App\Models\BlogModel;
use App\Models\CommentModel;

class Administrator extends BaseController {

	public function caches() {
		return view('admin/home/admin_caches');
	}

	public function cron_delete_cache($security_code) {
		echo '<meta name="robots" content="noindex,nofollow">';
		if ($security_code == siteSet('crontab_code')) {
			$LogModel = new LogModel();
			if (file_exists('writable/cache')){
				array_map('unlink', glob('writable/cache/*'));

	            // LOG Kaydı Tutuluyor
	            $log_data = ['item_id' => 1, 'item' => 'system', 'admin_id' => 3, 'log_text' => 'Cron ile site önbelleği temizlendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
	            $save = $LogModel->insert($log_data);
	            // LOG Kaydı Tutuldu
				echo 'cache temizlendi';
			}else{
				echo 'Klasör mevcut değil';
			} 
		}
	}

	public function delete_cache() {
		if (file_exists('writable/cache')){
			array_map('unlink', glob('writable/cache/*'));
			return view('admin/home/all_delete_cache');
		}else{
			echo 'Klasör mevcut değil';
		} 
	}
	
	public function dashboard() {
		$user_id = session()->get('_id');
		$UserModel = new UserModel();
		$LogModel = new LogModel();
		$BlogModel = new BlogModel();
		$CommentModel = new CommentModel();
		
		$data['user_data'] = $UserModel->where('_id', $user_id)->first();
		$data['dashboard']['total_blog'] = count($BlogModel->TotalBlog());
		$data['dashboard']['total_pending_blog'] = count($BlogModel->TotalPendingBlog());
		$data['dashboard']['todayBlogCount'] = $BlogModel->dateBlogList(date('Y-m-d'));
		
		$data['dashboard']['total_pending_comments'] = count($CommentModel->AdminPendingCommentList());
		$data['dashboard']['total_active_comments'] = count($CommentModel->AdminActiveCommentList());
		$data['dashboard']['today_active_comments'] = count($CommentModel->AdminTodayActiveCommentList());
		
		
		$data['logs'] = $LogModel->LastLog();

		return view('admin/home/admin_dashboard', $data);
	}

	public function profile($alert = NULL) {
		$data['alert'] = $alert;
		$LogModel = new LogModel();
		$UserModel = new UserModel();

		$user_id = session()->get('_id');
		$data['user'] = $UserModel->where('_id', $user_id)->first();

		if ($this->request->getMethod() == 'post') {
			/*$rules = [
				'profile_name' => 'required|min_length[3]',
				'gsm' => 'required|min_length[10]|max_length[11]',
				];

			if($this->request->getPost('password') != ''){
				$rules['password'] = 'required|min_length[6]';
			}

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{ */

				$newData = [
					'client_name' => $this->request->getPost('profile_name'),
					'gsm' => $this->request->getPost('gsm'),
					'email' => $this->request->getPost('email'),
					'update_date' => date('Y-m-d H:i:s')
				];
				if($this->request->getPost('password') != ''){
					$newData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
				}
				$UserModel->update($user_id, $newData);
		        // LOG Kaydı Tutuluyor
		        $log_data = ['item_id' => $user_id, 'item' => 'profile', 'admin_id' => session()->get('_id'), 'log_text' => 'Admin Profilini Güncelledi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
		        $save = $LogModel->insert($log_data);
		        // LOG Kaydı Tutuldu
				return redirect()->to('/admin/profile/BS01');

			//}
		}

		return view('/admin/home/admin_profile', $data);
	}

	public function GenerateCronTabCode() {
		$SettingModel = new SettingModel();
		$LogModel = new LogModel();
		$rand = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 25)) , 0, 25);

		$settingData = [
			'crontab_code' => $rand,		
			'update_date' => date('Y-m-d H:i:s')
		];
		$SettingModel->update(1, $settingData);
        // LOG Kaydı Tutuluyor
        $log_data = ['item_id' => 1, 'item' => 'settings', 'admin_id' => session()->get('_id'), 'log_text' => 'CronTab Code Güncelledi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
        $save = $LogModel->insert($log_data);
        // LOG Kaydı Tutuldu

        return redirect()->to('/admin/site-settings/BS05');
	}

	public function site_settings($alert = NULL) {
		helper(['form', 'url']); 
		$data['alert'] = $alert;
		$LogModel = new LogModel();
		$SettingModel = new SettingModel();
		$data['setting'] = $SettingModel->where('_id', 1)->first();

		if ($this->request->getMethod() == 'post') {

			//let's do the validation here
			$rules = [
				'site_name' => 'required',
				];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{

				$settingData = [
					'site_name' => trim($this->request->getPost('site_name')),
					'site_themes' => $this->request->getPost('site_themes'),
					'site_about' => $this->request->getPost('site_about'),
					'default_og_status' => $this->request->getPost('default_og_status'),
					'default_og_sitename' => $this->request->getPost('default_og_sitename'),
					'default_og_color' => $this->request->getPost('default_og_color'),
					
					'default_og_text_primary_color' => $this->request->getPost('default_og_text_primary_color'),
					'default_og_title_color' => $this->request->getPost('default_og_title_color'),
					'default_og_desc_color' => $this->request->getPost('default_og_desc_color'),
					
					'site_mail' => trim($this->request->getPost('site_mail')),
					'home_cta_text' => $this->request->getPost('home_cta_text'),
					'site_language' => $this->request->getPost('site_language'),
					'site_slogan' => trim($this->request->getPost('site_slogan')),
					'header_code' => $this->request->getPost('header_code'),
					'footer_code' => $this->request->getPost('footer_code'),
					'social_fb' => trim($this->request->getPost('social_fb')),
					'social_tw' => trim($this->request->getPost('social_tw')),
					'description' => trim($this->request->getPost('description')),
					'keywords' => $this->request->getPost('keywords'),
					'content_images' => $this->request->getPost('content_images'),
					'home_blog_count' => $this->request->getPost('home_blog_count'),
					'related_blog_count' => $this->request->getPost('related_blog_count'),
					'seo_noindex' => $this->request->getPost('seo_noindex'),
					'seo_indexingapi_status' => $this->request->getPost('seo_indexingapi_status'),
					'gAnalytics_ViewId' => $this->request->getPost('gAnalytics_ViewId'),
					'blog_comments' => $this->request->getPost('blog_comments'),
					'blog_comment_userform' => $this->request->getPost('blog_comment_userform'),
					'blog_comment_ai_creator' => $this->request->getPost('blog_comment_ai_creator'),
					'blog_comment_ai_model' => $this->request->getPost('blog_comment_ai_model'),
					'blog_comment_ai_count' => $this->request->getPost('blog_comment_ai_count'),
					'openai_apikey' => trim($this->request->getPost('openai_apikey')),
					'openai_blogmodel' => $this->request->getPost('openai_blogmodel'),
					'openai_ai_count' => $this->request->getPost('openai_ai_count'),
					'openai_blog_cron' => $this->request->getPost('openai_blog_cron'),
					'unsplash_status' => $this->request->getPost('unsplash_status'),
					'unsplash_accesskey' => trim($this->request->getPost('unsplash_accesskey')),
					'recaptcha_status' => $this->request->getPost('recaptcha_status'),
					'recaptcha_site_key' => trim($this->request->getPost('recaptcha_site_key')),
					'recaptcha_secret_key' => trim($this->request->getPost('recaptcha_secret_key')),

					'onesignal_api_key' => trim($this->request->getPost('onesignal_api_key')),
					'onesignal_app_id' => trim($this->request->getPost('onesignal_app_id')),
					'onesignal_publish_blog_status' => $this->request->getPost('onesignal_publish_blog_status'),
					'onesignal_blog_decr_status' => $this->request->getPost('onesignal_blog_decr_status'),
					'onesignal_publish_comment_status' => $this->request->getPost('onesignal_publish_comment_status'),
					'onesignal_notify_status' => $this->request->getPost('onesignal_notify_status'),

					'update_date' => date('Y-m-d H:i:s')
				];
				$SettingModel->update(1, $settingData);
		        // LOG Kaydı Tutuluyor
		        $log_data = ['item_id' => 1, 'item' => 'settings', 'admin_id' => session()->get('_id'), 'log_text' => 'Site Ayarları Güncelledi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
		        $save = $LogModel->insert($log_data);
		        // LOG Kaydı Tutuldu

			   	$seo_indexingapi_json = $this->request->getFile('seo_indexingapi_json');
			    if ($seo_indexingapi_json->isValid() && ! $seo_indexingapi_json->hasMoved()) {
			           $newName = $seo_indexingapi_json->getRandomName();
			           $seo_indexingapi_json->move('public/upload', $newName);

			           // Image DB Update
			           $indexingapi_data = ['seo_indexingapi_json'	=> $newName];
			           $save = $SettingModel->update(1, $indexingapi_data);
			    }

			   	$gAnalytics_jsonFile = $this->request->getFile('gAnalytics_jsonFile');
			    if ($gAnalytics_jsonFile->isValid() && ! $gAnalytics_jsonFile->hasMoved()) {
			           $newName = $gAnalytics_jsonFile->getRandomName();
			           $gAnalytics_jsonFile->move('public/upload', $newName);

			           // Image DB Update
			           $gAnalytics_jsonFile_data = ['gAnalytics_jsonFile'	=> $newName];
			           $save = $SettingModel->update(1, $gAnalytics_jsonFile_data);
			    }

			   	$img = $this->request->getFile('site_logo');
			    if ($img->isValid() && ! $img->hasMoved()) {
			           $newName = $img->getRandomName();
			           $img->move('public/upload/logo', $newName);

			           // Image DB Update
			           $image_data = ['site_logo'	=> $newName];
			           $save = $SettingModel->update(1, $image_data);
			    }

			   	$site_img = $this->request->getFile('site_image');
			    if ($site_img->isValid() && ! $site_img->hasMoved()) {
			           $newName = $site_img->getRandomName();
			           $site_img->move('public/upload/logo', $newName);

			           // Image DB Update
			           $image_data3 = ['site_image'	=> $newName];
			           $save = $SettingModel->update(1, $image_data3);
			    }

			   	$site_favicon = $this->request->getFile('site_favicon');
			    if ($site_favicon->isValid() && ! $site_favicon->hasMoved()) {
			           $newFavName = $site_favicon->getRandomName();
			           $site_favicon->move('public/upload/favicon', $newFavName);

			           // Image DB Update
			           $image_data2 = ['site_favicon'	=> $newFavName];
			           $save = $SettingModel->update(1, $image_data2);
			    }
			    
			   	$default_og_image = $this->request->getFile('default_og_image');
			    if ($default_og_image->isValid() && ! $default_og_image->hasMoved()) {
			           $newName = $default_og_image->getRandomName();
			           $default_og_image->move('public/upload/og', $newName);

			           // Image DB Update
			           $image_data4 = ['default_og_image'	=> $newName];
			           $save = $SettingModel->update(1, $image_data4);
			    }

			   	$default_og_font = $this->request->getFile('default_og_font');
			    if ($default_og_font->isValid() && ! $default_og_font->hasMoved()) {
			           $newName = $default_og_font->getRandomName();
			           $default_og_font->move('public/upload/og', $newName);

			           // Image DB Update
			           $image_data5 = ['default_og_font'	=> $newName];
			           $save = $SettingModel->update(1, $image_data5);
			    }

			   	$android_icon = $this->request->getFile('android_icon');
			    if ($android_icon->isValid() && ! $android_icon->hasMoved()) {
						$newName = $android_icon->getRandomName();
						$android_icon->move('public/upload/icon', $newName);
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(36, 36, true, 'height')->save('public/upload/icon/'.$newName.'-36x36.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(48, 48, true, 'height')->save('public/upload/icon/'.$newName.'-48x48.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(72, 72, true, 'height')->save('public/upload/icon/'.$newName.'-72x72.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(96, 96, true, 'height')->save('public/upload/icon/'.$newName.'-96x96.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(144, 144, true, 'height')->save('public/upload/icon/'.$newName.'-144x144.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(192, 192, true, 'height')->save('public/upload/icon/'.$newName.'-192x192.png');

						// Image DB Update
						$android_icon_data = ['android_icon'	=> $newName];
						$save = $SettingModel->update(1, $android_icon_data);
			    }

			   	$apple_touch_icon = $this->request->getFile('apple_touch_icon');
			    if ($apple_touch_icon->isValid() && ! $apple_touch_icon->hasMoved()) {
						$newName = $apple_touch_icon->getRandomName();
						$apple_touch_icon->move('public/upload/icon', $newName);
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(57, 57, true, 'height')->save('public/upload/icon/'.$newName.'-57x57.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(60, 60, true, 'height')->save('public/upload/icon/'.$newName.'-60x60.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(72, 72, true, 'height')->save('public/upload/icon/'.$newName.'-72x72.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(76, 76, true, 'height')->save('public/upload/icon/'.$newName.'-76x76.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(114, 114, true, 'height')->save('public/upload/icon/'.$newName.'-114x114.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(120, 120, true, 'height')->save('public/upload/icon/'.$newName.'-120x120.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(144, 144, true, 'height')->save('public/upload/icon/'.$newName.'-144x144.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(152, 152, true, 'height')->save('public/upload/icon/'.$newName.'-152x152.png');
						$image = \Config\Services::image()->withFile('public/upload/icon/'.$newName)->resize(180, 180, true, 'height')->save('public/upload/icon/'.$newName.'-180x180.png');

						// Image DB Update
						$apple_touch_icon_data = ['apple_touch_icon'	=> $newName];
						$save = $SettingModel->update(1, $apple_touch_icon_data);
			    }

				return redirect()->to('/admin/site-settings/BS01');

			}
		}

		return view('/admin/home/site_setting', $data);
	}

}
