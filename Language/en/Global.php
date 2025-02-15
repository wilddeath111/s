<?php
/**
 * Files language strings.
 *
 * @package      CodeIgniter
 * @author       CodeIgniter Dev Team
 * @copyright    2014-2019 British Columbia Institute of Technology (https://bcit.ca/)
 * @license      https://opensource.org/licenses/MIT    MIT License
 * @link         https://codeigniter.com
 * @since        Version 3.0.0
 * @filesource
 * 
 * @codeCoverageIgnore
 */
return [
    'system_title'       => 'Control Panel',
    'login_text'         => '<i class="fa fa-sign-in" aria-hidden="true"></i> OTURUM AÇ',
    'home_text'      => 'Anasayfa',
    'logout_text'        => 'Oturumu Kapat!',
    'email_text'         => 'Mail Adresiniz',
    'password_text'         => 'Şifreniz',
    'general_text'      => 'GENEL',
    'content_text'      => 'İçerik',
    'profile_text'   => 'Profilim',
    'selected_text' => 'Seçiniz',
    'all_delete_cache_text' => 'Tüm Site Önbelleği Sil',
    'show_hide_button_text' => 'Göster/Gizle',

    'header_quick' => [
        'gosite_text' => 'Anasayfaya Git',
    ], 

    'admin_notification' => [
        'content_published' => [
            'title' => 'İçerik Yayınlandı',
            'content' => 'başlıklı içerik yayınlandı.',

        ],
        'comment' => [
            'title' => 'AI Yorum Eklendi',
            'content' => 'İçerik için AI Yorumu Eklendi',
        ],
    ],

    'dashboard' => [
        'today_publish_blog_text' => 'Bugün Yayınlanan',
        'analytics_realtime_info_text' => 'Bu veriler <span class="text-danger"><strong>Google Analytics</strong></span> tarafından sağlanmaktadır.',
        'total_blog_text' => 'Yayınlanan İçerik',
        'total_pending_blog_text' => 'Bekleyen Tanımlı Başlık',
        'last_log_title' => 'Son İşlemler',
        'realtime_visitor_text' => 'Anlık Kullanıcılar',
        'analytics' => [
            'page_title_text' => 'Sayfa Başlığı',
            'page_url_text' => 'Sayfa Urlsi',
            'location_text' => 'Lokasyon',
            'visitor_count_text' => 'Kaç Kişi',
            'visitor_total_text' => 'Ziyaret',
            'active_visitor_text' => 'Kişi Online',
            'device_details_text' => 'Cihaz',
            'visitor_text' => 'Ziyaretçi',
            'total_visitor_text' => 'Toplam Ziyaretçi',
            'last7_visitor_text' => 'Son 7 Gün Ziyaretçi',
            'today_visitor_text' => 'Bugün Ziyaretçi',
            'yesterday_visitor_text' => 'Dün Ziyaretçi',
            'popular_pages_text' => 'Popüler Sayfalar',
            'popular_pages_info_text' => 'Son 30 günlük verilere göre hesaplandı.',
        ]
    ],

    'blogs' => [

        'undefined_og_image_var_alert_text' => 'OG Image için Site Ayarlarında yapılması gerekenler yapılmamış. Bu yüzden görseller OG ile değiştirilemez. Öncelikle OG Image ayarlarını tamamlayın',
        'og_image_replace_button_text' => 'OG Olarak Değiştir',
        'list_title_same_text' => 'Başlık Aynı',
        'title_same' => [
            'title_same_text' => 'Başlık Aynı Kalsın',
            'yes_text' => 'Evet',
            'no_text' => 'Hayır',

        ],
        'title_count_text' => '{0, number} adet başlık eklendi.',
        'priority' => [
            'info_alert_text' => 'BİLGİLENDİRME!',
            'info_alert_content_text' => '* OPENAI alt yapısını kullanır. <strong>.env</strong> ayarları yapılmış ve OPENAI key tanımlanmalıdır.<br> * İçerik sayısı belirterek OPENAI ile başlık sayısını belirtebilirsiniz.<br> * Öncelik kısmını öncelikli içeriklerinizin girişi için kullanabilirsiniz. <br> * Önizleme yaparak başlık önerilerini görebilirsiniz, <strong>önizlemedeki başlıklar sadece öneridir, direk girilmez.</strong>',
            'title_text' => 'Öncelik',
            'low_text' => 'Low',
            'high_text' => 'High',
            'higher_text' => 'Higher',
        ],
        'ai_related_text' => 'Aİ Önerilen Başlıklar',
        'ai_related_title_text' => 'Başlık',
        'ai_related_button_text' => 'Başlıkları Getir',
        'words_text' => 'kelime',
        'ai_count_text' => 'İçerik Sayısı',
        'faq_tab_text' => 'SSS',
        'faq_content_text' => 'Sorular-Cevaplar',
        'youtube_id_text' => 'Youtube Video Id',
        'selectedvideo_button_text' => 'Seçildi',
        'selectvideo_button_text' => 'Video Seç',
        'title_text' => 'Başlık',
        'editform_text' => 'İçeriği Düzenle',
        'view_url_text' => 'İçeriğe Git',
        'content_text' => 'İçerik',
        'desc_text' => 'Açıklama',
        'keywords_text' => 'Anahtar Kelimeler',
        'seo_tab_text' => 'SEO',
        'create_date_text' => 'Oluşturulma',
        'publish_date_text' => 'Yayınlanma',
        'views_text' => 'görüntülenme',
        'image_text' => 'Görsel',
        'keyword_text' => 'Anahtar Kelime/Fikir',
        'youtube_tab_text' => 'YouTube',
        'comments_text' => 'yorum',
    ],

    'photospool' => [
        'used_text' => 'Kullanılma',
        'url_text' => 'URL',
        'source_text' => 'Kaynak',
        'keyword_text' => 'Anahtar Kelimeler',
        'create_date_text' => 'Oluşturulma Zamanı',
        'selected_photos_text' => 'Seçilenleri Ekle',
        'all_selected_photos_text' => 'Select All',
        'all_deselected_photos_text' => 'Deselect All',
        'photo_count_text' => '{0, number} adet fotoğraf eklendi.',
    ],

    'comments' => [
        'settings' => [
            'info_alert_text' => 'YORUM MODÜLÜNÜ KULLANMAK İÇİN',
            'info_alert_content_text' => '* Kullanıcı yorum formu aktif edildiğinde Google Recaptcha\'da aktif edilmelidir. (Yorum kontrolleri için zorunlu) <br> * AI Otomatik yorum girişi aktif ediliğinde aşağıdaki CRON URL hosting panelinize tanımlanmalıdır. <br> * AI Otomatik yorum modülü için OPENAI Key ayarları yapılmış olmalıdır. <br> * <strong>AI Yorum Sayısı</strong> bir içeriğe kaç adet yorum girileceğini belirtir.',
        ],

        'all_comments_text' => 'Toplam onaylanan',
        'pending_comments_text' => 'Onay bekleyen',
        'today_comments_text' => 'Bugün yorum',
        'editform_text' => 'Yorum Düzenle',
        'nickname_text' => 'Nick name',
        'content_text' => 'Yorum',
        'create_date_text' => 'Oluşturulma',
        'comment_type_text' => 'Yorum Tipi'
        
    ], 

    'authors' => [
        'editform_text' => 'Yazar Düzenle',
        'authorname_text' => 'Yazar Adı',
        'author_expertise_text' => 'Uzmanlık Alanı',
        'author_bio_text' => 'Biyografi',
        'add_text' => 'Yazar Ekle',
        'create_date_text' => 'Oluşturulma',
        'avatar_image_text' => 'Avatar',
    ],

    'menu' => [
        'publish_blogs_day_text' => 'Günlük İçerikler',

        'csv_import_text' => 'CSV Yükle',
        'author_list_text' => 'Yazarlar',
        'comments_text' => 'Yorumlar',
        'commentslist_text' => 'Yorum Listesi',
        'comments_pendinglist_text' => 'Onay Bekleyenler',
        'photos_pool_text' => 'Fotoğraf Havuzu',
        'photopoollist_text' => 'Fotoğraf Listesi',
        'photopool_add_text' => 'Fotoğraf Ekle',
        'blogs_text' => 'İçerikler',
        'bloglist_text' => 'İçerik Listesi',
        'pending_bloglist_text' => 'Bekleyen İçerikler',
        'publish_blogs_text' => 'Yayınlanan İçerikler',
        'blog_add_text' => 'İçerik Tanımla',
        'keywords_blog_add_text' => 'Keywords İçerik',
        'caches_text' => 'Site Önbelleği',
        'dashboard_text' => 'Dashboard',
        'logs_text' => 'İşlem Kayıtları',
        'report_text' => 'Raporlar',
        'analytics_text' => 'Google Analytics',
        'pages_text' => 'Sabit Sayfalar',
        'pagelist_text' => 'Sayfa Listesi',
        'page_add_text' => 'Sayfa Oluştur', 
    ],

    'caches' => [
        'file_name_text' => 'Dosya Adı',
        'create_date_text' => 'Oluşturulma Zamanı',
    ],

    'pages' => [
        'image_text' => 'Yazı Resmi',
        'add_text' => 'Sabit Sayfa Ekle',
        'editform_text' => 'Sabit Sayfalar Düzenleme',
        'title_text' => 'Sayfa Adı',
        'views_text' => 'Görüntülenme',
        'view_url_text' => 'Sitede Göster',
        'log_text' => 'Sayfa Geçmişi',
        'content_text' => 'Sayfa İçeriği',
        'create_text' => 'Yeni Sayfa Ekle',
        'create_date_text' => 'Oluşturulma Zamanı',
        'seo_tab_text' => 'SEO',
        'seo_title_text' => 'SEO Başlığı',
        'desc_text' => 'SEO Açıklama',
        'keywords_text' => 'SEO Anahtar Kelimeleri',
        'footer_text' => 'Site Altında Göster',
        'views_text' => 'görüntülenme',
    ],


    'alert' => [
        'BS00' => 'Hata Oluştu!',
        'BS01' => 'Veriler Başarıyla Güncellendi',
        'BS02' => 'Zorunlu Alanları Doldurun!',
        'BS03' => 'Veriler Başarıyla Eklendi!',
        'BS04' => 'Veriler Başarıyla Silindi!',
        'BS05' => 'Güvenlik Amaçlı Cron Tab Kodu Güncellendi!',
        'no_data' => 'Veri Bulunamadı!',
        'delete_cache' => '<strong>BİLGİLENDİRME!</strong> Sitenin tüm önbelleği silindi. ',
        'openai_apikey' => 'Otomatik içerik girişi için OPENAI KEY tanımlanmamış. Hemen Ayarlar->OPENAI sekmesinden <a href="/admin/site-settings">tanımlayabilirsiniz.</a>',
        'openai_blog_cron' => 'Otomatik içerik girişi aktif edilmemiş, CRON ile içerik girişi çalışmayacaktır. Hemen Ayarlar->OPENAI sekmesinden <a href="/admin/site-settings">aktif edebilirsiniz.</a>',

        'unsplash_accesskey' => 'Unsplash için Access KEY tanımlanmamış. Hemen Ayarlar->UNSPLASH sekmesinden <a href="/admin/site-settings">tanımlayabilirsiniz.</a>',
        'unsplash_status' => 'Blog içeriklerinde fotoğraf kullanımı için Unsplash aktif edilmemiş, içeriklerinizde fotoğraf olmayacaktır. Hemen Ayarlar->UNSPLASH sekmesinden <a href="/admin/site-settings">aktif edebilirsiniz.</a>',
        'unsplash_status_pool' => 'Fotoğraf havuzu için Unsplash kullanamazsınız. Unsplash aktif edilmesi gerekmektedir. Hemen Ayarlar->UNSPLASH sekmesinden <a href="/admin/site-settings">aktif edebilirsiniz.</a>',
    ],

    'profile' => [
        'my_profile_text' => 'Profilim',
        'name_text' => 'İsim Soyisim',
        'mail_text' => 'Mail Adresi',
        'gsm_text' => 'Telefon Numarası',
        'password_text' => 'Şifreniz',
        'save_button_text' => 'Profilimi Güncelle',
        'admin_profile_text' => 'Profil ve Ayarlar',
        'site_settings_text' => 'Site Ayarları',
    
    ],

    'logs' => [
        'log_text' => 'İşlem Açıklaması',
        'log_date_text' => 'İşlem Zamanı',
        'admin_text' => 'Yönetici',
        'data_text' => 'Veri / Veri ID',
        'client_ip_text' => 'Kullanıcı IP',
        'log_type_text' => 'İşlem Tipi'
    ],

    'crud' => [
        'error_text' => 'HATA',
        'publish_text' => 'Yayınla',
        'preview_button_text' => 'Önizleme',
        'edit_text' => 'Düzenle',
        'delete_text' => 'Sil',
        'deleteconfirm_text' => 'Veri Silinecek! Emin misiniz?',
        'add_text' => 'Ekle',
        'nodata_text' => 'Veri Bulunamadı!',
        'update_button_text' => 'Güncelle',
        'add_button_text'   => 'Kaydet',
        'update_setting_text'   => 'Ayarları Kaydet',
        'view_url_text' => 'Sayfaya Git',
        'view_text' => 'Görüntüle',
        'loading_text' => 'Yükleniyor...',
        'get_text' => 'Getir',
        'GenerateCronTabCode_confirm_text' => 'CronTab Kodu Tekrar Oluşturulacak? Tüm Cron tanımlamalarınızı tekrar yapmalısınız.',

    ],

    'general' => [
        'all_show_text' => 'Tümünü göster',
        'status_no_text' => 'Hayır',
        'select_text' => 'Seçiniz',
        'status_yes_text' => 'Evet',
        'status_ai_text' => 'AI',
        'status_user_text' => 'Kullanıcı',
        'status_text'       => 'Durum',
        'createdate_text' => 'Eklenme Zamanı',
        'updatedate_text' => 'Güncellenme Zamanı',
        'status_active_text'    => 'Aktif',
        'status_passive_text'    => 'Pasif',
        'status_draft_text' => 'Taslak',
        'status_pending_text'    => 'Beklemede',
        'info_text' => '<strong>BİLGİLENDİRME!</strong>',
        'added_title_text' => 'İçerik Başlığı Eklendi',
        'added_keyword_title_text' => 'Anahtar Kelime için AI Başlıklar Eklendi',
        'get_success_data_text' => 'Veriler Başarıyla Alındı',
        'published_blog_title_text' => 'İçerik Başarıyla Yayınlandı',
    ],

    'settings' => [
        'onesignal_tab_text' => 'ONESIGNAL',
        'onesignal' => [
            'status_text' => 'Bildirim Durumu',
            'onesignal_publish_blog_status_text' => 'Yazı Yayınlandığında Gönder',
            'onesignal_blog_decr_status_text' => 'Blog Yazısı 5 Kaldığında Gönder',
            'onesignal_publish_comment_status_text' => 'AI Yorum Yayınlandığında Gönder',
            'onesignal_api_key_text' => 'API KEY',
            'onesignal_app_id_text' => 'APP ID',

        ],
        'og' => [
            'default_og_text_primary_color_text' => 'Birincil Metin Rengi',
            'default_og_title_color_text' => 'Başlık Metin Rengi',
            'default_og_desc_color_text' => 'Açıklama Metin Rengi',
            'status_text' => 'Durum',
            'site_name_text' => 'OG Site Adı',
            'default_og_color_text' => 'OG Arka Plan Rengi',
            'default_og_image_text' => 'Varsayılan Görsel, <small>PNG Olmalıdır </small>',
            'default_og_font_text' => 'Varsayılan OG Fontu',
        ],
        
        'recaptcha_status_text' => 'Recaptcha Durumu',
        'recaptcha_site_key_text' => 'Recaptcha Site Key',
        'recaptcha_secret_key_text' => 'Recaptcha Secret Key',
        'recaptcha_tab_text' => 'GOOGLE RECAPTCHA',
        
        'unsplash_tab_text' => 'UNSPLASH',
        'unsplash' => [
            'status_text' => 'Durum',
            'accesskey_text' => 'Access Key',
        ],
        'openai_tab_text' => 'OPENAI',
        'openai' => [
            'alert_text' => '<span class="text-danger"><strong>Başlık Öneri Varsayılan sayısının yüksek olması</strong></span>, içerik düzenlemeye çalıştığınızda sisteminizi yavaşlatacaktır.',
            'blog_cron_text' => 'AI Oto İçerik Girişi',
            'blogmodel_text' => 'Blog OpenAI Modeli',
            'apikey_text' => 'OPENAI Api Key',
            'title_ai_count_text' => 'Başlık Öneri Varsayılan',
        ],
        'comments_tab_text' => 'YORUMLAR',
        'blog_comments_text' => 'Site Yorum Modülü',
        'blog_comment_userform_text' => 'Kullanıcı Yorum Formu',
        'blog_comment_ai_creator_text' => 'AI Otomatik Yorum',
        'blog_comment_ai_model_text' => 'AI Model',
        'blog_comment_ai_count_text' => 'AI Yorum Sayısı',
        'generate_crontab_text' => 'CronTab Kodu Tekrar Oluştur',
        'header_about_text' => 'Site Hakkında Kısa Metin',
        'cron_aicomment_creator_text' => 'CRON Otomatik Yorum',
        'cron_aicomment_creator_info_text' => 'Belirtilen adresi CRON olarak hosting panelinize tanımlayın.',
        'cron_publishing_text' => 'CRON Otomatik İçerik Yükleme',
        'cron_publishing_info_text' => 'Belirtilen adresi CRON olarak hosting panelinize tanımlayın.',
        'cron_deletecache_text' => 'CRON Otomatik Site Belleği Temizle',
        'cron_deletecache_info_text' => 'Belirtilen adresi CRON olarak hosting panelinize tanımlayın.',
        'home_cta_text' => 'Anasayfa ÜST CTA',
        
        'home_blog_count_text' => 'Anasayfa Yazı Limiti',
        'related_blog_count_text' => 'Detay Benzer Yazı Limiti',
        'social_facebook_text' => 'Facebook Sayfa Adresi',
        'social_twitter_text' => 'Twitter Kullanıcı Adı',
        'site_name_text' => 'Site Adı',
        'site_themes_text' => 'Tema',
        'site_mail_text' => 'Site Mail Adresi',
        'site_slogan_text' => 'Site Sloganı',
        'google_analytics_tab_text' => 'GA',
        'gAnalytics_ViewId_text' => 'Google Analytics View Id',
        'gAnalytics_jsonFile_text' => 'Google Analytics Json Dosyası',
        'seo_tab_text' => 'SEO',
        'social_tab_text' => 'SOSYAL',
        'code_tab_text' => 'TANIMLAMALAR',
        'limit_tab_text' => 'LİMİTLER',
        'header_code_text' => 'Header Kısmı Kod',
        'footer_code_text' => 'Footer Kısmı Kod',
        'image' => [
            'alert_text' => 'Icon uzantıları mutlaka .PNG olmalıdır. Aksi durumda Apple Touch ve Android Icon çalışmaz',
            'tab_text' => 'LOGO VE GÖRSEL',
            'android_icon_text' => 'Android Icon',
            'apple_touch_icon_text' => 'Apple Icon',
            'content_images_text' => 'İçerik içinde Otomatik Resim',
        ],
        'logo_text' => 'Site Logo',
        'site_image_text' => 'Sosyal Medya Görseli',
        'favicon_text' => 'Site Favicon',
        'seo_indexingapi_status_text' => 'Indexing Api?',
        'seo_indexingapi_json_text' => 'Index Api Key File',
        'seo_noindex_text' => 'Arama Motorları Indexlesin mi?',
        'sitemap_url_text' => 'Sitemap Adresi',
        'sitemap_url_info_text' => 'Sitemaps.xml Adresini Google Search Console üzerinden bildirmelisiniz.',
        'desc_text' => 'Site Açıklaması',
        'keywords_text' => 'Site Anahtar Kelimeleri',
    ],

    'language' => [
        'title_text' => 'Site Dili',
        'en_text' => 'İngilizce',
        'tr_text' => 'Türkçe',
    ],

];
