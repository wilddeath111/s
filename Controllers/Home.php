<?php
namespace App\Controllers;
use App\Models\BlogModel;

class Home extends BaseController {
    
    public function index() {
        $BlogModel = new BlogModel();
        $home_blog_count = siteSet('home_blog_count');
        $data['blogs'] = $BlogModel->homePageBlog($home_blog_count);

        // Page Cache Started //
        if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
        // Page Cache Finished //

        $data['seo']['title'] = siteSet('site_name').' - '.siteSet('site_slogan');
        $data['seo']['description'] = siteSet('description');
        $data['seo']['keywords'] = siteSet('keywords');
        $data['seo']['og_image'] = getenv('site.cdnUrl').'/public/upload/site/'.siteSet('site_image');

        return view(siteSet('site_themes').'/layouts/home/index', $data);
    }
}
?>
