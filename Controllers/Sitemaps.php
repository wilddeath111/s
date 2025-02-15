<?php
namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\PageModel;
use CodeIgniter\HTTP\Response;


class Sitemaps extends BaseController{

	public function site_rss() {
		$response = service('response');
		$response->setHeader('Content-type', 'application/xml');
		
		// Page Cache Started //
		if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
		// Page Cache Finished //
		
		$BlogModel = new BlogModel();
		$data['blogs'] = $BlogModel->RssBlogs();

		echo view('sitemaps/rss_template', $data); 
	}

	public function manifest() {
		$response = service('response');
		$response->setHeader('Content-type', 'application/json');
		echo view('sitemaps/manifest'); 
	}

	public function opensearch() {
		$response = service('response');
		$response->setHeader('Content-type', 'application/xml');
		echo view('sitemaps/opensearch'); 
	}

	public function index() {
		$response = service('response');
		$response->setHeader('Content-type', 'text/xml');
		$response->send();

		// Page Cache Started //
		if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
		// Page Cache Finished //
		echo view('sitemaps/index');
	}

	public function news_sitemap() {
		$response = service('response');
		$response->setHeader('Content-type', 'text/xml');
		$response->send();
		
		// Page Cache Started //
		if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
		// Page Cache Finished //
		$BlogModel = new BlogModel();
		$data['blogs'] = $BlogModel->sitemapBlogs();
		echo view('sitemaps/news_sitemap', $data);
	}

	public function blogs() {
		$response = service('response');
		$response->setHeader('Content-type', 'text/xml');
		$response->send();
		
		// Page Cache Started //
		if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
		// Page Cache Finished //
		$BlogModel = new BlogModel();
		$data['blogs'] = $BlogModel->sitemapBlogs();
		echo view('sitemaps/blogs', $data);
	}

	public function pages() {
		$response = service('response');
		$response->setHeader('Content-type', 'text/xml');
		$response->send();
		
		// Page Cache Started //
		if (getenv('site.Cache') == 'true') { $this->cachePage(getenv('site.CachetimeOut')); } 
		// Page Cache Finished //
		$PageModel = new PageModel();
		$data['pages'] = $PageModel->sitemapPages();
		echo view('sitemaps/pages', $data);
	}

}

?>
