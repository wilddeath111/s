<?php
namespace App\Controllers;
use App\Models\BlogModel;
use App\Models\LogModel;
use App\Models\PhotosPoolModel;
use App\Models\CommentModel;
use App\Models\AuthorModel;

use Google;
use Google_Service_Indexing;
use Google_Service_Indexing_UrlNotification;

use DOMDocument;
use DOMXPath;

class Blog extends BaseController {

    public function og_image_replace() {
        $BlogModel = new BlogModel();
        $LogModel = new LogModel();

        if ($this->request->getMethod() === 'post') {
            $blog_id = $this->request->getVar('id');
            $blog_data = $BlogModel->AdmingetBlog($blog_id);
            $Images = new Images();
            $og_image = $Images->watermark($blog_data['_id'], $blog_data['title'], $blog_data['description']);
            $og_image_data = ['image'    => $og_image, 'update_date'   => date('Y-m-d H:i:s')];
            $og_save = $BlogModel->update($blog_data['_id'], $og_image_data);
            if ($og_save) {
                // LOG Kaydı Tutuluyor
                $log_data = ['item_id' => $blog_data['_id'], 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'CRON: Blog Görseli OG ile  Değiştirildi.', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                $save = $LogModel->insert($log_data);
                // LOG Kaydı Tutuldu
                
                $data['status'] = 'SUCCESS';
                $data['image_url'] = getBlogImage($og_image);
            } else {
                $data['status'] = 'ERROR';
            }

            print_r(json_encode($data));
        }
    }

    public function publish_admin_day_list($day) {
        $data['filter_date'] = $day;
        $BlogModel = new BlogModel();
        $data['blogs'] = $BlogModel->AdminPublishDayBlogList($day);
        return view('admin/blog/admin_day_list', $data);
    }

    public function oneSignalSend($n_title, $n_content) {
        $onesignal_api_key = siteSet('onesignal_api_key');
        $onesignal_app_id = siteSet('onesignal_app_id');

        if (siteSet('onesignal_notify_status') == 'passive') { exit(); }

        if ((!empty($onesignal_api_key)) AND (!empty($onesignal_api_key))) {

            $content = array( 'en' => $n_content);

            $fields = array(
                'app_id' => $onesignal_app_id,
                'included_segments' => array('All'),
                'contents' => $content,
                'headings' => array('en' => $n_title),
                'url' => getenv('app.baseURL').'/admin/dashboard',
                'chrome_web_image' => getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon').'-192x192.png',
                'chrome_web_icon' => getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon').'-192x192.png'
            );

            $headers = array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic ' . $onesignal_api_key);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            echo $response;
        }

    }

    public function csv_keyword_add() {
        $BlogModel = new BlogModel();
        $LogModel = new LogModel();

        if ($this->request->getMethod() === 'post') {
            $ai_count = trim($this->request->getVar('ai_count'));
            $priority = trim($this->request->getVar('priority'));
            $keyword = trim($this->request->getVar('keyword'));
            $title_same = trim($this->request->getVar('title_same'));

            if (empty(siteSet('openai_apikey'))) {
                echo 'OPENAI KEY EMPTY'; 
                // LOG Kaydı Tutuluyor
                $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'HATA! Blog Publish CRON : Openai Blog Cron Key Boş ', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                $save = $LogModel->insert($log_data);
                // LOG Kaydı Tutuldu
                exit();
            }

            if (($title_same == 1) AND ($ai_count == 1)) {

                $blog_data = [
                    'title' => trim($keyword),
                    'title_same' => $title_same,
                    'status'  => 'pending',
                    'priority' => $priority,
                    'create_date'   => date('Y-m-d H:i:s')
                ];
                $blog_id = $BlogModel->insert($blog_data);
                if ($blog_id) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $blog_id, 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'Keyword İçerik Tanımlandı', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu
                }

            } else {

                $json_meta = $this->getBlogContent('Kendini uzman bir makale yazarı ve Google SEO uzmanı gibi düşün ve aşağıda verdiğim anahtar kelimeden bana '.$ai_count.' adet Düşük rekabet içeren makale başlığı oluştur. Bunları json verisi olarak bana ver. Bana hiçbir şekilde açıklama yapma. Bunları json verisi olarak bu formatta {
                        "title": ".."
                        } Keywords : ', $keyword);

                $meta = json_decode('['.$json_meta.']', true);

                $title_count = 0;
                foreach ($meta as $item) {
                    if (isset($item['title'])) {

                        $blog_data = [
                            'title' => trim($item['title']),
                            'title_same' => $title_same,
                            'status'  => 'pending',
                            'priority' => $priority,
                            'create_date'   => date('Y-m-d H:i:s')
                        ];
                        $blog_id = $BlogModel->insert($blog_data);
                        if ($blog_id) {
                            // LOG Kaydı Tutuluyor
                            $log_data = ['item_id' => $blog_id, 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'Keyword İçerik Tanımlandı', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                            $save = $LogModel->insert($log_data);
                            // LOG Kaydı Tutuldu
                            $title_count++;
                        }
                    }
                }
            }

        }
    }

    public function csv_import() {
        $BlogModel = new BlogModel();
        $LogModel = new LogModel();

        if ($this->request->getMethod() === 'post') {
            $data['ai_count'] = trim($this->request->getVar('ai_count'));
            $data['priority'] = trim($this->request->getVar('priority'));
            $data['title_same'] = trim($this->request->getVar('title_same'));
        
            $csv_file = $this->request->getFile('csv_file');
            if ($csv_file->isValid() && ! $csv_file->hasMoved()) {
                   $newName = $csv_file->getRandomName();
                   $csv_file->move('public/upload/csv', $newName);

            } else {
                return redirect()->to('/admin/blog/csv-import');
            }

            if (($handle = fopen("public/upload/csv/$newName", "r")) !== FALSE) {
                $headers = fgetcsv($handle, 1000, ",");
                
                while (($k_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    //$row[] = array_combine($headers, $k_data);

                    $row[] = array(
                        $headers[0] => $k_data[0],
                        $headers[1] => $k_data[1],
                        $headers[2] => $k_data[2],
                        'CPC' => $k_data[3], 
                        $headers[4] => $k_data[4],
                        $headers[5] => $k_data[5],
                        $headers[6] => $k_data[6],
                        $headers[7] => $k_data[7],
                        $headers[8] => $k_data[8]
                    );

                }

                fclose($handle);
            }
            
            $data['keywords'] = $row;

        } else {
            $data[] = '';
        }

        return view('admin/blog/csv_import', $data);

    }

    function AJAXYoutubeSearch() {
        $q = $this->request->getVar('q');

        $t = $this->getYouTubeSearchResults($q);
        print_r(json_encode($t));
    }

    function getYouTubeSearchResults($searchQuery) {
        $url = 'https://www.youtube.com/results?q='.urlencode($searchQuery);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $results = curl_exec($ch);
        curl_close($ch);

        /*preg_match_all('/ytInitialData\s*=\s*({.+?})\s*;/s', $results, $matches);
    $json_data = json_decode($matches[1][0], true);

        print_r($json_data);
        exit(); */
        if (!empty($results)) {
            preg_match_all('/ytInitialData\s*=\s*({.+?})\s*;/s', $results, $matches);
            if (isset($matches[1][0])) {
                $json_data = json_decode($matches[1][0], true);
            }
            //print_r('<pre>');
            //die(print_r($json_data));
            if (isset($json_data['contents']['twoColumnSearchResultsRenderer']['primaryContents']['sectionListRenderer']['contents']) && is_array($json_data['contents']['twoColumnSearchResultsRenderer']['primaryContents']['sectionListRenderer']['contents'])) {
                foreach ($json_data['contents']['twoColumnSearchResultsRenderer']['primaryContents']['sectionListRenderer']['contents'] as $konten) {
                    if (isset($konten['itemSectionRenderer']['contents']) && is_array($konten['itemSectionRenderer']['contents'])) {
                        $videoku['items'] = array();
                        foreach ($konten['itemSectionRenderer']['contents'] as $item_jadi) {
                            if (isset($item_jadi['videoRenderer'])) {
                                $item_jadi  = $item_jadi['videoRenderer'];
                                $video_id = (isset($item_jadi['videoId'])) ? $item_jadi['videoId'] : '';
                                if (empty($video_id)) continue;
                                $videoku['items'][] = array(
                                    'id' => array(
                                        'videoId' => $video_id
                                    ),
                                    'url' => $video_id,
                                    'title' => ((isset($item_jadi['title']['runs'][0]['text'])) ? $item_jadi['title']['runs'][0]['text'] : ''),
                                    'thumbHigh' => ((isset($item_jadi['thumbnail']['thumbnails']['0']['url'])) ? $item_jadi['thumbnail']['thumbnails']['0']['url'] : ''),
                                    'channelTitle' => ((isset($item_jadi['ownerText']['runs']['0']['text'])) ? $item_jadi['ownerText']['runs']['0']['text'] : ''),
                                    'channelId' => ((isset($item_jadi['ownerText']['runs']['0']['navigationEndpoint']['browseEndpoint']['browseId'])) ? $item_jadi['ownerText']['runs']['0']['navigationEndpoint']['browseEndpoint']['browseId'] : ''),
                                    'channelUrl' => ((isset($item_jadi['ownerText']['runs']['0']['navigationEndpoint']['browseEndpoint']['browseId'])) ? "https://www.youtube.com/channel/" . $item_jadi['ownerText']['runs']['0']['navigationEndpoint']['browseEndpoint']['browseId'] : ''),
                                    'publishedAt' => ((isset($item_jadi['publishedTimeText']['simpleText'])) ? $item_jadi['publishedTimeText']['simpleText'] : ''),
                                    'duration' => ((isset($item_jadi['lengthText']['simpleText'])) ? $item_jadi['lengthText']['simpleText'] : ''),
                                    'viewCount' => ((isset($item_jadi['viewCountText']['simpleText'])) ? preg_replace('/(,)|(\s*views?)$/i', "", $item_jadi['viewCountText']['simpleText']) : '')
                                );
                            }
                        }
                        if (!empty($videoku['items'])) break;
                    }
                }
            }

            return $videoku;

        }
    }

    public function keywordsBlogTitles($alert = NULL, $count = NULL) {

        $LogModel = new LogModel();
        $BlogModel = new BlogModel();
        $data['alert'] = $alert;
        $data['title_count'] = $count;
        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'keyword' => 'required',
                'ai_count' => 'required'
            ];
            $validate = $this->validate($rules);
            if ($validate) {

                if (empty(siteSet('openai_apikey'))) {
                    echo 'OPENAI KEY EMPTY';
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'HATA! Blog Publish CRON : Openai Blog Cron Key Boş ', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu
                    exit();
                }

                $keyword = trim($this->request->getVar('keyword'));
                $ai_count = trim($this->request->getVar('ai_count'));
                $priority = trim($this->request->getVar('priority'));
                $title_same = trim($this->request->getVar('title_same'));
                $preview = $this->request->getVar('preview');
                if ($preview == 1 ) {
                    $json_meta = $this->getBlogContent('Kendini uzman bir makale yazarı ve Google SEO uzmanı gibi düşün ve aşağıda verdiğim anahtar kelimeden bana '.$ai_count.' adet Düşük rekabet içeren makale başlığı oluştur. Bunları json verisi olarak bana ver. Bana hiçbir şekilde açıklama yapma. Bunları json verisi olarak bu formatta {
                            "title": ".."
                            } Keywords : ', $keyword);
                    $meta = json_decode('['.$json_meta.']', true);

                    foreach ($meta as $item) {
                        if (isset($item['title'])) {
                            echo $item['title'].'<br>';
                        }
                    }

                } else {
                    $json_meta = $this->getBlogContent('Kendini uzman bir makale yazarı ve Google SEO uzmanı gibi düşün ve aşağıda verdiğim anahtar kelimeden bana '.$ai_count.' adet Düşük rekabet içeren makale başlığı oluştur. Bunları json verisi olarak bana ver. Bana hiçbir şekilde açıklama yapma. Bunları json verisi olarak bu formatta {
                            "title": ".."
                            } Keywords : ', $keyword);

                    $meta = json_decode('['.$json_meta.']', true);

                    $title_count = 0;
                    if (! empty($meta) && is_array($meta)) {         
                        foreach ($meta as $item) {
                            if (isset($item['title'])) {

                                $blog_data = [
                                    'title' => trim($item['title']),
                                    'title_same' => $title_same,
                                    'status'  => 'pending',
                                    'priority' => $priority,
                                    'create_date'   => date('Y-m-d H:i:s')
                                ];
                                $blog_id = $BlogModel->insert($blog_data);
                                if ($blog_id) {
                                    // LOG Kaydı Tutuluyor
                                    $log_data = ['item_id' => $blog_id, 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'Keyword İçerik Tanımlandı', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                                    $save = $LogModel->insert($log_data);
                                    // LOG Kaydı Tutuldu
                                    $title_count++;
                                }
                            }
                        }
                    }
                    return redirect()->to('/admin/blog/keyword-blog-add/BS03/'.$title_count);                   
                }


            } else { return redirect()->to('/admin/blog/keyword-blog-add/BS02'); }
        } else { return view('admin/blog/keyword_blog_add', $data); }
    }

    public function BlogTitleAdd() {
        $BlogModel = new BlogModel();
        $LogModel = new LogModel();

        if ($this->request->getMethod() === 'post') {
            $title = trim($this->request->getVar('title'));
            $blog_data = [
                'title' => $title,
                'status'  => 'pending',
                'priority' => 0,
                'create_date'   => date('Y-m-d H:i:s')
            ];
            $blog_id = $BlogModel->insert($blog_data);
            if ($blog_id) {
                // LOG Kaydı Tutuluyor
                $log_data = ['item_id' => $blog_id, 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'Keyword İçerik Tanımlandı', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                $save = $LogModel->insert($log_data);
                // LOG Kaydı Tutuldu
                echo 'OK';
            } else {
                echo 'ERROR';
            }
        }
    }

    public function cronPublishBlog($security_code, $blog_id = NULL ) {
        echo '<meta name="robots" content="noindex,nofollow">';

        $PhotosPoolModel = new PhotosPoolModel();
        $BlogModel = new BlogModel();
        $LogModel = new LogModel();
        $AuthorModel = new AuthorModel();

        if ($security_code == siteSet('crontab_code')) {
            
            $author_data = $AuthorModel->RandomgetAuthor();
            $author_id = $author_data->_id;

            if (siteSet('openai_blog_cron') == 'passive') {
                echo 'CRON PASSIVE';
                // LOG Kaydı Tutuluyor
                $log_data = ['item_id' => 99999, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'HATA! Blog Publish CRON : Openai Blog Cron Pasif durumda ', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                $save = $LogModel->insert($log_data);
                // LOG Kaydı Tutuldu
                exit();
            }

            if (empty(siteSet('openai_apikey'))) {
                echo 'OPENAI KEY EMPTY';
                // LOG Kaydı Tutuluyor
                $log_data = ['item_id' => 99999, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'HATA! Blog Publish CRON : Openai Blog Cron Key Boş ', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                $save = $LogModel->insert($log_data);
                // LOG Kaydı Tutuldu
                exit();
            }
            
            if (!empty($blog_id)) {
                $_id = hash_decode($blog_id)[0];
                $pending_blog = $BlogModel->IdPendingBlog($_id);
            } else {
                $pending_blog = $BlogModel->RandomPendingBlog();
                $total_pending_blog = count($BlogModel->TotalPendingBlog());

                if ($total_pending_blog == 5) {
                    if (siteSet('onesignal_blog_decr_status') == 'active') {
                        $o_return = $this->oneSignalSend(lang('Global.admin_notification.content_published.title'), lang('Global.admin_notification.content_published.content'));
                    }
                }
            }
            
            if (empty($pending_blog)) { exit(); }
            $meta = $this->getBlogContent('Bana aşağıdaki anahtar kelimelerle alakalı 1 blog makalesi başlığı verin. Bu başlık, aşağıdaki anahtar kelimeleri makaleye dahil etmeme izin vermelidir. Başlıklar bilgilendirici veya ticari amaçlı olmalıdır. ayrıca başlığa göre çekici ve göz alıcı 165 karakterlik meta açıklama ekleyin. Oluşturduğun makale başlığı için 4 adet anahtar kelime, 4 adet uzun kuyruklu anahtar kelime (çok uzun olmasın) oluştur. Keywordsleri virgül ile ayır.Sadece İngilizce yaz. Put this message in the following structure. "title"="..", "description"="..", "keywords"="..", "longtailkeywords"=".." .Bana hiç açıklama yapma.Sadece veri istiyorum. Başlık ', $pending_blog->title);
            
            $pattern = '/"title"="([^"]+)",\s*"description"="([^"]+)",\s*"keywords"="([^"]+)",\s*"longtailkeywords"="([^"]+)"/';

            preg_match($pattern, $meta, $matches);

            if (array_key_exists(1, $matches) && array_key_exists(2, $matches) && array_key_exists(3, $matches) && array_key_exists(4, $matches)) {
                if ($pending_blog->title_same == 0) {
                    $title = $matches[1];
                } else {
                    $title = $pending_blog->title;
                }

                $description = $matches[2];
                $keywords = $matches[3];
                $longtail_keywords = $matches[4];
                if (empty($title) OR empty($description) OR empty($keywords) ) {
                    exit();
                }

                $blog_data = [
                    'title' => $title,
                    'seo_name' => seflink($title),
                    'keywords'  => $keywords.', '.$longtail_keywords,
                    'description'  => $description,
                    'author_id' => $author_id,
                    'update_date'   => date('Y-m-d H:i:s')
                ];
                $save = $BlogModel->update($pending_blog->_id, $blog_data);
                if ($save) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'CRON: Blog SEO Meta ve Başlığı Güncellendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    $content = $this->getBlogContent('Kendini uzman bir makale yazarı ve Google SEO uzmanı gibi düşün ve aşağıda verdiğim makale başlığından bana en az 500 kelimeden oluşan ingilizce bir makale oluştur. İçerikte ara başlıklar kullanmaya çalış ve ara başlıkları <p><strong></strong></p> ile işaretle. Diğer paragrafları da <p></p> ile işaretle.Content kısmı HTML formatında olsun.', $pending_blog->title);
                    if (!empty($content)) {
                        $blog_content = [
                            'content'  => $content,
                            'status' => 'active',
                            'update_date'   => date('Y-m-d H:i:s'),
                            'publish_date'   => date('Y-m-d H:i:s')
                        ];
                        $save = $BlogModel->update($pending_blog->_id, $blog_content);   
                        if ($save) {

                            if (siteSet('unsplash_status') == 'active') {
                                $image_url = $this->getUnsplashPhoto($title);
                                if (!empty($image_url)) {
                                    $blog_image_data = [
                                        'image'  => $image_url,
                                        'update_date'   => date('Y-m-d H:i:s')
                                    ];
                                    $image_save = $BlogModel->update($pending_blog->_id, $blog_image_data); 
                                    
                                    if ($image_save) {
                                        // LOG Kaydı Tutuluyor
                                        $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'CRON: Blog İçeriğine Ana Resim Eklendi.', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                                        $save = $LogModel->insert($log_data);
                                        // LOG Kaydı Tutuldu
                                    }
                                }
                            }

                            if (siteSet('default_og_status') == 'active') {
                                $Images = new Images();
                                $og_image = $Images->watermark($pending_blog->_id, $title, $description);
                                $og_image_data = ['image'    => $og_image, 'update_date'   => date('Y-m-d H:i:s')];
                                $og_save = $BlogModel->update($pending_blog->_id, $og_image_data);
                                if ($og_save) {
                                    // LOG Kaydı Tutuluyor
                                    $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'CRON: Blog İçeriğine OG Otomatik Resim Eklendi.', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                                    $save = $LogModel->insert($log_data);
                                    // LOG Kaydı Tutuldu
                                }
                            }

                            $faq_content = $this->getBlogContent('Kendini uzman bir makale yazarı ve Google SEO uzmanı gibi düşün ve aşağıda verdiğim makale başlığı ile ilgili 5 itemden oluşan ingilizce sık Sorulan sorular kısmı oluştur. Soru cevap şeklinde ama cevaplar çok uzun olmasın. Bunları json verisi olarak bu formatta {
                            "question": "..",
                            "answer": ".."
                            }, dön. Bana hiçbir şekilde açıklama yapma.  Başlık', $title);
                            $faq_content = str_replace('[','',$faq_content);
                            $faq_content = str_replace(']','',$faq_content);
                            if (!empty($faq_content)) {
                                $blog_faq_data = [
                                    'questions'  => '['.$faq_content.']',
                                    'update_date'   => date('Y-m-d H:i:s')
                                ];
                                $faq_save = $BlogModel->update($pending_blog->_id, $blog_faq_data); 
                                
                                if ($faq_save) {
                                    // LOG Kaydı Tutuluyor
                                    $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'CRON: Blog İçeriğine FAQ Eklendi.', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                                    $save = $LogModel->insert($log_data);
                                    // LOG Kaydı Tutuldu
                                }
                            }

                            if (siteSet('content_images') == 'active') {
                                $keywords2 = explode(', ', $keywords);
                                $regexKeywords = implode('|', $keywords2);
                                $content_images = $PhotosPoolModel->randomContentImage($regexKeywords);
                                if (!empty($content_images)) {
                                
                                    $content_image_filename = 'content-'.uniqid().'-'.uniqid().'.jpg';
                                    file_put_contents('public/upload/blog/'.$content_image_filename, file_get_contents($content_images->photo_url));

                                    $content_image_data = [
                                        'content_images'  => $content_image_filename,
                                        'update_date'   => date('Y-m-d H:i:s')
                                    ];
                                    $content_i_save = $BlogModel->update($pending_blog->_id, $content_image_data); 
                                    
                                    if ($content_i_save) {
                                        // LOG Kaydı Tutuluyor
                                        $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'CRON: Blog İçeriğine Content Image Eklendi.', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                                        $save = $LogModel->insert($log_data);
                                        // LOG Kaydı Tutuldu
                                    }
                                } else {
                                    // LOG Kaydı Tutuluyor
                                    $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'CRON: Blog İçeriğine uygun Content Image Bulunamadı.', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                                    $save = $LogModel->insert($log_data);
                                    // LOG Kaydı Tutuldu
                                }
                            }

                            // LOG Kaydı Tutuluyor
                            $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'CRON: Blog İçeriği Güncellendi, İçerik Yayınlandı.', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                            $save = $LogModel->insert($log_data);
                            // LOG Kaydı Tutuldu

                            if (siteSet('onesignal_publish_blog_status') == 'active') {
                                $o_return = $this->oneSignalSend(lang('Global.admin_notification.content_published.title'), $title.' '.lang('Global.admin_notification.content_published.content'));
                            }

                            echo 'OK';
                            if (siteSet('seo_indexingapi_status') == 'active') {
                                $blog_url = getblogSeoUrl(seflink($title), $pending_blog->_id);
                                $indexing_status = $this->IndexingApiPost($blog_url, 'URL_UPDATED');
                                if(!empty($indexing_status)) {  $notify_time = $indexing_status->urlNotificationMetadata->latestUpdate["notifyTime"]; } 
                                if (!empty($notify_time)) {
                                    // LOG Kaydı Tutuluyor
                                    $log_data = ['item_id' => $pending_blog->_id, 'item' => 'blog', 'admin_id' => 3, 'log_text' => 'İçerik Indexing Api ile Google\'a Bildirildi. Zaman:'.$notify_time, 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                                    $save = $LogModel->insert($log_data);
                                    // LOG Kaydı Tutuldu
                                }
                            }
                        }        
                    }

                }

            } else {
                echo 'Olmadı.: : '.$meta;
            }
        }
    }

    public function getUnsplashPhoto($keywords) {
        $access_key = siteSet('unsplash_accesskey');
        $per_page = 20;
        $page = 1;
        $orientation = 'landscape';

        $url = 'https://api.unsplash.com/search/photos?query='.urlencode($keywords).'&per_page='.$per_page.'&page='.$page.'&orientation='.$orientation.'&client_id='.$access_key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        $random_index = rand(0, $per_page - 1);
        $photo = $data['results'][$random_index];
        $url = $photo['urls']['regular'];
        $filename = uniqid().'-'.uniqid().'.jpg';
        file_put_contents('public/upload/blog/'.$filename, file_get_contents($url));
        return $filename;
    }

    public function getBlogContent($task, $title) {
        $task_description = $task.' * '.$title;
        $openai_apikey = siteSet('openai_apikey');
        $openai_model = siteSet('openai_blogmodel');
        $post_fields = array(
            "model" => $openai_model,
            "messages" => array(
                array(
                    "role" => "user",
                    "content" => $task_description
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
          'Authorization: Bearer '.$openai_apikey
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $t = json_decode($response);
        $return = trim($t->choices[0]->message->content);
        //$return['desc_title_character_count'] = '('.strlen($return['description']).')';

        return $return;
    }

    public function IndexingApiPost($url, $type) {
        if ((siteSet('seo_indexingapi_status') == 'active') AND (!empty(siteSet('seo_indexingapi_json')))) {
            try {

                $googleClient = new Google\Client();
                $googleClient->setAuthConfig('public/upload/'.siteSet('seo_indexingapi_json'));
                $googleClient->setScopes(Google_Service_Indexing::INDEXING);
                $service = new Google_Service_Indexing($googleClient);

                if (!empty($url)) {
                    $postBody = new Google_Service_Indexing_UrlNotification(['url' => $url, 'type' => $type]);
                    $result = $service->urlNotifications->publish($postBody);
                    return $result;
                    //echo "Notification time: " . $result->urlNotificationMetadata->latestUpdate["notifyTime"]; //
                    //echo "Notification type: " . $result->urlNotificationMetadata->latestUpdate["type"]; // Notification type.
                    //echo "Url that you submitted: " . $result->urlNotificationMetadata->latestUpdate["url"]; // Url that you submitted.

                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function pending_admin_list() {
        $BlogModel = new BlogModel();
        $data['blogs'] = $BlogModel->AdminPendingBlogList();
        return view('admin/blog/pending_admin_list', $data);
    }

    public function admin_list() {
        $BlogModel = new BlogModel();
        $data['blogs'] = $BlogModel->AdminBlogList();
        return view('admin/blog/admin_list', $data);
    }

    public function publish_admin_list() {
        $BlogModel = new BlogModel();
        $data['blogs'] = $BlogModel->AdminPublishBlogList();
        return view('admin/blog/publish_admin_list', $data);
    }

    public function admin_delete($id) {
        $BlogModel = new BlogModel();
        $LogModel = new LogModel();
        $user_id = session()->get('_id');
        $_id = hash_decode($id)[0];

        $data['blog'] = $BlogModel->AdmingetBlog($_id);

        if (empty($data['blog'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        } else {
            // LOG Kaydı Tutuluyor
            $log_data = ['item_id' => $_id, 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'İçerik Silindi! İçerik Adı: '.$data['blog']['title'], 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
            $save = $LogModel->insert($log_data);
            // LOG Kaydı Tutuldu
            $data['blog'] = $BlogModel->where('_id', $_id)->delete();
            $data['toast']['toast_title'] = 'BS04';
            session()->set($data['toast']);
            return redirect()->to('/admin/blog/list');
        }
    }

    public function admin_add($alert = NULL) {
        $LogModel = new LogModel();
        $BlogModel = new BlogModel();
        $data['alert'] = $alert;
        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'title' => 'required',
            ];
            $validate = $this->validate($rules);
            if ($validate) {
                
                $blog_data = [
                    'title' => trim($this->request->getVar('title')),
                    'title_same' => $this->request->getVar('title_same'),
                    'seo_name' => seflink($this->request->getVar('title')),
                    'priority' => $this->request->getVar('priority'),
                    'status'  => 'pending',
                    'create_date'   => date('Y-m-d H:i:s')
                ];
                $blog_id = $BlogModel->insert($blog_data);
                if ($blog_id) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $blog_id, 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'İçerik Tanımlandı', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    $img = $this->request->getFile('blog_image');
                    if ($img->isValid() && ! $img->hasMoved()) {
                           $newName = $img->getRandomName();
                           $img->move('public/upload/blog', $newName);

                           // Image DB Update
                           $image_data = ['image'   => $newName];
                           $save = $PageModel->update($blog_id, $image_data);
                    }

                    //return redirect()->to('/admin/blog/details/'.hash_encode($blog_id).'/BS03');
                    return redirect()->to('/admin/blog/add/BS03');
                } else { return redirect()->to('/admin/blog/add/BS00'); }
                return redirect()->to('/admin/blog/list');

            } else { return redirect()->to('/admin/blog/add/BS02'); }
        }

        echo view('admin/blog/admin_add', $data);
    }

    public function admin_details($id, $alert = NULL) {
        helper(['form', 'url']);
        $LogModel = new LogModel();
        $CommentModel = new CommentModel();
        $AuthorModel = new AuthorModel();

        $_id = hash_decode($id)[0];
        $user_id = session()->get('_id');
        
        $BlogModel = new BlogModel();
        $data['blog'] = $BlogModel->AdmingetBlog($_id);
        $data['alert'] = $alert;

        if (empty($data['blog'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        }
        $youtube_keyword = getRandomKeyword($data['blog']['keywords']);
        $data['youtube_data'] = $this->getYouTubeSearchResults($youtube_keyword);

        $data['comments'] = $CommentModel->AdmingetBlogCommentList($_id);

        $data['logs'] = $LogModel->BlogLog($_id);

        $data['authors'] = $AuthorModel->ActiveAuthorList();

        // Veriler Post Edildiğinde kaydet
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'title' => 'required',
                'status' => 'required',

            ];
            $validate = $this->validate($rules);
            if ($validate) {

                $data = [
                    'title' => trim($this->request->getVar('title')),
                    'title_same'  => $this->request->getVar('title_same'),
                    'seo_name' => seflink($this->request->getVar('title')),
                    'keywords'  => $this->request->getVar('keywords'),
                    'description'  => $this->request->getVar('description'),
                    'content'  => $this->request->getVar('content'),
                    'questions'  => $this->request->getVar('questions'),
                    'status'  => $this->request->getVar('status'),
                    'youtube_id'  => $this->request->getVar('youtube_id'),
                    'YoutubeTitle' => $this->request->getVar('YoutubeTitle'),
                    'YoutubeDuration' => $this->request->getVar('YoutubeDuration'),
                    'author_id' => $this->request->getVar('author_id'),
                    'update_date'   => date('Y-m-d H:i:s')
                ];
                $save = $BlogModel->update($_id, $data);
                if ($save) {
                    // LOG Kaydı Tutuluyor
                    $log_data = ['item_id' => $_id, 'item' => 'blog', 'admin_id' => session()->get('_id'), 'log_text' => 'İçerik Güncellendi', 'log_date' => date('Y-m-d H:i:s'), 'client_ip' => $this->request->getIPAddress() ];
                    $save = $LogModel->insert($log_data);
                    // LOG Kaydı Tutuldu

                    $blog_url = getblogSeoUrl(seflink($this->request->getVar('title')), $_id);
                    if($this->request->getVar('status') == 'active') { $indexing_status = $this->IndexingApiPost($blog_url, 'URL_UPDATED'); }

                    $img = $this->request->getFile('blog_image');
                    if ($img->isValid() && ! $img->hasMoved()) {
                           $newName = $img->getRandomName();
                           $img->move('public/upload/blog', $newName);

                           // Image DB Update
                           $image_data = ['image'   => $newName];
                           $save = $BlogModel->update($_id, $image_data);
                    }

                    return redirect()->to('/admin/blog/details/'.$id.'/BS01');
                } else { return redirect()->to('/admin/blog/details/'.$id.'/BS00'); }
            } else { return redirect()->to('/admin/blog/details/'.$id.'/BS02'); }
        }

        echo view('admin/blog/admin_details', $data);
    }

    public function blogdetails_aititles() {
        $blog_title = $this->request->getVar('v_title');
        if (!empty(siteSet('openai_apikey'))) {
            $json_meta = $this->getBlogContent('Kendini uzman bir makale yazarı ve Google SEO uzmanı gibi düşün ve aşağıda verdiğim anahtar kelimeden bana '.siteSet('openai_ai_count').' adet Düşük rekabet içeren makale başlığı oluştur. Bunları json verisi olarak bana ver. Bana hiçbir şekilde açıklama yapma. Bunları json verisi olarak bu formatta {
                    "title": ".."
                    } Keywords : ', $blog_title);
            $ai_titles = json_decode('['.$json_meta.']', true);
            print_r(json_encode($ai_titles));
        }
    }

    public function details($seo_name, $id) {
        $BlogModel = new BlogModel();
        $AuthorModel = new AuthorModel();
        $CommentModel = new CommentModel();
        $_id = hash_decode($id)[0];
        $data['blog'] = $BlogModel->getBlog($seo_name, $_id);

        if (empty($data['blog'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the item: '. $_id);
        } else {

            $data['comments'] = $CommentModel->getBlogCommentList($_id);

            $data['author'] = $AuthorModel->getAuthor($data['blog']['author_id']);
            if (empty($data['author'])) {
                $data['author']['author_name'] = siteSet('site_name');
                $data['author']['author_expertise'] = '';
                $data['author']['author_bio'] = siteSet('description');
                
            }

            $blog_view = ['views' =>  ($data['blog']['views']+1)];
            $save = $BlogModel->update($_id, $blog_view);
        
            // Page Cache Started //
            if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
            // Page Cache Finished //

            $related_blog_limit = siteSet('related_blog_count');
            $data['related_blogs'] = $BlogModel->getRelatedBlog($related_blog_limit);

            $data['seo']['title'] = $data['blog']['title'].' - '.siteSet('site_name');
            $data['seo']['description'] = $data['blog']['description'];
            $data['seo']['keywords'] = $data['blog']['keywords'];
            $data['seo']['og_image'] = getBlogImage($data['blog']['image']);
            return view(siteSet('site_themes').'/layouts/blog/details', $data);
        }

    }
}
