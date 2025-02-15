<?php namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model {
	protected $table = 'settings';
    protected $primaryKey = '_id';
    protected $allowedFields = ['_id', 'site_name', 'site_publication_name', 'site_slogan', 'site_language', 'keywords', 'description', 'home_blog_count', 'related_blog_count', 'social_tw', 'social_fb', 'footer_copyright', 'footer_code', 'header_code', 'site_about', 'home_cta_text', 'site_image', 'apple_touch_icon', 'android_icon', 'seo_noindex', 'site_favicon', 'site_logo', 'seo_indexingapi_status', 'seo_indexingapi_json', 'gAnalytics_ViewId', 'gAnalytics_jsonFile', 'site_mail', 'site_themes', 'content_images', 'crontab_code', 'blog_comments', 'blog_comment_userform', 'blog_comment_ai_creator', 'blog_comment_ai_model', 'openai_apikey', 'openai_ai_count', 'openai_blogmodel', 'openai_blog_cron', 'unsplash_status', 'unsplash_accesskey', 'recaptcha_status', 'recaptcha_site_key', 'recaptcha_secret_key', 'blog_comment_ai_count', 'default_og_status', 'default_og_sitename', 'default_og_color', 'default_og_image', 'default_og_font', 'default_og_text_primary_color', 'default_og_title_color', 'default_og_desc_color', 'onesignal_api_key', 'onesignal_app_id', 'onesignal_publish_blog_status', 'onesignal_blog_decr_status', 'onesignal_publish_comment_status', 'onesignal_notify_status'];

}
