<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/admin', 'Administrator::dashboard', ['filter' => 'admin']);
$routes->get('/admin/dashboard', 'Administrator::dashboard', ['filter' => 'admin']);
$routes->get('/admin/GenerateCronTabCode', 'Administrator::GenerateCronTabCode', ['filter' => 'admin']);

$routes->get('/logout', 'Users::logout');
$routes->match(['get','post'],'/login', 'Users::index');

$routes->get('/admin/delete-cache', 'Administrator::delete_cache', ['filter' => 'admin']);
$routes->get('/admin/caches', 'Administrator::caches', ['filter' => 'admin']);

// ADMIN PROFILE
$routes->get('/admin/site-settings/(:segment)', 'Administrator::site_settings/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/site-settings', 'Administrator::site_settings',['filter' => 'admin']);

// LOG PAGE
$routes->get('/admin/logs', 'Logs::admin_index', ['filter' => 'admin']);

// SITE SETTINGS
$routes->get('/admin/profile/(:segment)', 'Administrator::profile/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/profile', 'Administrator::profile',['filter' => 'admin']);


// PHOTOS POOL
$routes->get('/admin/photospool/list', 'Photospool::admin_index', ['filter' => 'admin']);
$routes->get('/admin/photospool/delete/(:segment)', 'Photospool::admin_delete/$1', ['filter' => 'admin']);
$routes->get('/admin/photospool/keyword-add/(:segment)/(:segment)', 'Photospool::keyword_add/$1/$2', ['filter' => 'admin']);
$routes->get('/admin/photospool/keyword-add/(:segment)', 'Photospool::keyword_add/$1', ['filter' => 'admin']);
$routes->post('/admin/photospool/keyword-add-result', 'Photospool::keyword_add_result', ['filter' => 'admin']);

$routes->match(['get','post'],'/admin/photospool/keyword-add', 'Photospool::keyword_add', ['filter' => 'admin']);


// ANALYTICS PAGES
$routes->get('/admin/analytics/index', 'Analytics::index', ['filter' => 'admin']);
$routes->match(['get','post'], '/admin/analytics/real_time', 'Analytics::real_time', ['filter' => 'admin']);
$routes->match(['get','post'], '/admin/analytics/total_visitor', 'Analytics::total_visitor', ['filter' => 'admin']);
$routes->match(['get','post'], '/admin/analytics/popular_pages', 'Analytics::popular_pages', ['filter' => 'admin']);

// BLOG PAGES
$routes->post('/admin/blog/AJAXYoutubeSearch', 'Blog::AJAXYoutubeSearch', ['filter' => 'admin']);
$routes->post('/admin/blog/blog-ai-title-get', 'Blog::blogdetails_aititles', ['filter' => 'admin']);


$routes->get('/admin/blog/pending-list', 'Blog::pending_admin_list', ['filter' => 'admin']);
$routes->get('/admin/blog/publish-list', 'Blog::publish_admin_list', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/blog/publish-day-list/(:segment)', 'Blog::publish_admin_day_list/$1', ['filter' => 'admin']);
$routes->post('/admin/blog/og-image-replace', 'Blog::og_image_replace', ['filter' => 'admin']);

$routes->get('/admin/blog/list', 'Blog::admin_list', ['filter' => 'admin']);
$routes->get('/admin/blog/delete/(:segment)', 'Blog::admin_delete/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/blog/details/(:segment)', 'Blog::admin_details/$1', ['filter' => 'admin']);
$routes->get('/admin/blog/details/(:segment)/(:segment)', 'Blog::admin_details/$1/$2', ['filter' => 'admin']);
$routes->get('/admin/blog/add/(:segment)', 'Blog::admin_add/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/blog/add', 'Blog::admin_add', ['filter' => 'admin']);
$routes->post('/admin/blog/blog-title-add', 'Blog::BlogTitleAdd', ['filter' => 'admin']);

$routes->match(['get','post'], '/admin/blog/csv-import', 'Blog::csv_import', ['filter' => 'admin']);
$routes->post('/admin/blog/csv-keyword-add', 'Blog::csv_keyword_add', ['filter' => 'admin']);


$routes->get('/admin/blog/keyword-blog-add/(:segment)/(:segment)', 'Blog::keywordsBlogTitles/$1/$2', ['filter' => 'admin']);
$routes->get('/admin/blog/keyword-blog-add/(:segment)', 'Blog::keywordsBlogTitles/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/blog/keyword-blog-add', 'Blog::keywordsBlogTitles', ['filter' => 'admin']);

$routes->match(['get','post'],'/admin/blog/youtube-search/(:segment)', 'Blog::YoutubeSearch/$1');


// COMMENTS
$routes->get('/admin/comments/list', 'Comment::admin_list', ['filter' => 'admin']);
$routes->get('/admin/comments/pending-list', 'Comment::pending_admin_list', ['filter' => 'admin']);
$routes->get('/admin/comments/delete/(:segment)', 'Comment::admin_delete/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/comments/details/(:segment)', 'Comment::admin_details/$1', ['filter' => 'admin']);
$routes->get('/admin/comments/details/(:segment)/(:segment)', 'Comment::admin_details/$1/$2', ['filter' => 'admin']);

// FIXED PAGES
$routes->get('/admin/page/index', 'Pages::admin_list', ['filter' => 'admin']);
$routes->get('/admin/page/delete/(:segment)', 'Pages::admin_delete/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/page/details/(:segment)', 'Pages::admin_details/$1', ['filter' => 'admin']);
$routes->get('/admin/page/details/(:segment)/(:segment)', 'Pages::admin_details/$1/$2', ['filter' => 'admin']);
$routes->get('/admin/page/add/(:segment)', 'Pages::admin_add/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/page/add', 'Pages::admin_add', ['filter' => 'admin']);


// AUTHORS
$routes->get('/admin/author/list', 'Author::admin_list', ['filter' => 'admin']);
$routes->get('/admin/author/delete/(:segment)', 'Author::admin_delete/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/author/details/(:segment)', 'Author::admin_details/$1', ['filter' => 'admin']);
$routes->get('/admin/author/details/(:segment)/(:segment)', 'Author::admin_details/$1/$2', ['filter' => 'admin']);
$routes->get('/admin/author/add/(:segment)', 'Author::admin_add/$1', ['filter' => 'admin']);
$routes->match(['get','post'],'/admin/author/add', 'Author::admin_add', ['filter' => 'admin']);


// HOME
$routes->get('/', 'Home::index');
$routes->get('/(:segment)-(:segment).html', 'Blog::details/$1/$2');

$routes->post('/submit_comment', 'Comment::submit_comment');

//PAGES
$routes->get('/p/(:segment)-(:segment).html', 'Pages::detail/$1/$2');

// SITEMAP
$routes->get('/sitemaps.xml', 'Sitemaps::index');
$routes->get('/news-sitemap.xml', 'Sitemaps::news_sitemap');
$routes->get('/sitemap-blogs.xml', 'Sitemaps::blogs');
$routes->get('/sitemap-pages.xml', 'Sitemaps::pages');

// OTHER SITEMAPS
$routes->get('/opensearch.xml', 'Sitemaps::opensearch');
$routes->get('/(:segment).rss', 'Sitemaps::site_rss');
$routes->get('/manifest.json', 'Sitemaps::manifest');



//CRON JOBS
$routes->get('/CRON/delete-cache/(:segment)', 'Administrator::cron_delete_cache/$1');
$routes->get('/CRON/cronPublishBlog/(:segment)/(:segment)', 'Blog::cronPublishBlog/$1/$2');
$routes->get('/CRON/cronPublishBlog/(:segment)', 'Blog::cronPublishBlog/$1');
$routes->get('/CRON/comment-creator/(:segment)', 'Comment::random_create_comments/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
