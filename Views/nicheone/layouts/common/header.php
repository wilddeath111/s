<!doctype html>
<html lang="<?=siteSet('site_language');?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(!empty($seo['title'])) { echo $seo['title']; }?></title>
    <meta name="description" content="<?php if(!empty($seo['description'])) { echo $seo['description']; }?>">
    <meta name="keywords" content="<?php if(!empty($seo['keywords'])) { echo $seo['keywords']; }?>">
    <meta name="author" content="<?=siteSet('site_name');?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

.card-title a {
  color: #666;
  text-decoration: none;
}

ul.list-unstyled li a {
  text-decoration: none;
}
.no-underline {
  text-decoration: none;
}
.card-text {
  font-size: 14px;
  line-height: 1;
}
h1 {font-size:20px !important;margin:0;padding:0;}
.footerPages a {color:#666;font-size:14px;}
    </style>
    <?php echo view('sitemaps/header_extra'); ?>
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white"><?=lang('Site.about_text');?></h4>
              <p class="text-muted"><?=siteSet('site_about');?></p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white"><?=lang('Site.contact_text');?></h4>
              <ul class="list-unstyled">
                <?php if (!empty(siteSet('social_tw'))) { echo '<li><a href="https://www.twitter.com/'.siteSet('social_tw').'" target="_blank" title="'.siteSet('site_name').' Twitter" class="text-white">'.lang('Site.follow_twitter_text').'</a></li>'; } ?>
                <?php if (!empty(siteSet('social_fb'))) { echo '<li><a href="'.siteSet('social_fb').'" target="_blank" title="'.siteSet('site_name').' Facebook" class="text-white">'.lang('Site.like_facebook_text').'</a></li>'; } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
          <a href="<?=getenv('app.baseURL');?>" title="<?=siteSet('site_name')?>" class="navbar-brand d-flex align-items-center"><h1><?=siteSet('site_name')?></h1></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
    <main>
