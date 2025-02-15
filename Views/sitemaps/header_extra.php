<?php if (!empty(siteSet('apple_touch_icon'))) { ?>
<link rel="apple-touch-icon" sizes="57x57" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=getenv('site.cdnUrl');?>/public/upload/icon/<?=siteSet('apple_touch_icon');?>-180x180.png">
<?php } ?>
<meta name="author" content="<?=siteSet('site_name');?>">
<link rel="search" type="application/opensearchdescription+xml" title="<?=siteSet('site_name');?>" href="/opensearch.xml">
<link rel=manifest href="/manifest.json">
<meta property="og:site_name" content="<?=siteSet('site_name');?>" />
<meta property="og:url" content="<?=current_url(false);?>" />
<meta property="og:title" content="<?php if(!empty($seo['title'])) { echo $seo['title']; }?>" />
<meta property="og:description" content="<?php if(!empty($seo['description'])) { echo $seo['description']; }?>" />
<meta property="og:image" content="<?=$seo['og_image'];?>" />
<meta property="og:image:alt" content="<?php if(!empty($seo['description'])) { echo $seo['description']; }?>" />
<link rel="image_src" href="<?=$seo['og_image'];?>">
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@<?=siteSet('social_tw');?>" />
<meta name="twitter:title" content="<?php if(!empty($seo['title'])) { echo $seo['title']; }?>" />
<meta name="twitter:description" content="<?php if(!empty($seo['description'])) { echo $seo['description']; }?>" />
<meta name="twitter:image" content="<?=$seo['og_image'];?>" />
<meta name="twitter:image:alt" content="<?php if(!empty($seo['description'])) { echo $seo['description']; }?>" />
<meta name="twitter:url" content="<?=current_url(false);?>" />

<?php if (siteSet('seo_noindex') == 'passive') { echo '<meta name="robots" content="noindex">'; } ?>
<link rel="shortcut icon" href="<?=getenv('site.cdnUrl');?>/public/upload/favicon/<?=siteSet('site_favicon');?>">
<link rel="canonical" href="<?=current_url(false);?>" />
<link rel='alternate' type='application/rss+xml' title='<?=siteSet('site_name');?> in RSS' href='/<?=seflink(siteSet('site_name'));?>.rss'>
<?php echo siteSet('header_code'); ?>
<script type="application/ld+json">
{
   "@context": "http://schema.org",
   "@type": "WebSite",
   "maintainer": [{
       "@context": "http://schema.org",
       "@type": "Organization",
       "brand": {
           "@context": "http://schema.org",
           "@type": "Brand",
           "logo": "<?=getenv('site.cdnUrl').'/public/upload/logo/'.siteSet('site_logo');?>",
           "name": "<?=siteSet('site_name');?>",
           "slogan": "<?=siteSet('site_slogan');?>"
       },
       "image": "<?=getenv('site.cdnUrl').'/public/upload/logo/'.siteSet('site_logo');?>",
       "name": "<?=siteSet('site_name');?>",
       "sameAs": ["https://twitter.com/<?=siteSet('social_tw');?>"],
       "url": "<?=getenv('app.baseURL');?>"
   }],
   "potentialAction": [{
      "@type": "SearchAction",
      "target": "<?=getenv('app.baseURL');?>/search/{search_term_string}",
      "query-input": "required name=search_term_string"
   }],
   "url": "<?=getenv('app.baseURL');?>"
}
</script>
<script type="application/ld+json">
{
   "@context": "http://schema.org",
   "@type": "Organization",
   "brand": {
       "@context": "http://schema.org",
       "@type": "Brand",
      "logo": "<?=getenv('site.cdnUrl').'/public/upload/logo/'.siteSet('site_logo');?>",
           "name": "<?=siteSet('site_name');?>",
           "slogan": "<?=siteSet('site_slogan');?>"
   },
    "image": "<?=getenv('site.cdnUrl').'/public/upload/logo/'.siteSet('site_logo');?>",
    "name": "<?=siteSet('site_name');?>",
    "sameAs": ["https://twitter.com/<?=siteSet('social_tw');?>"],
    "url": "<?=getenv('app.baseURL');?>"
}
</script>

<script type="application/ld+json">{
   "@context": "https://schema.org",
   "@graph": [{
      "@context": "https://schema.org",
      "@type": "SiteNavigationElement",
      "id": "site-navigation",
      "name": "About",
      "url": "<?=getenv('site.about_page');?>"
   }, {
      "@context": "https://schema.org",
      "@type": "SiteNavigationElement",
      "id": "site-navigation",
      "name": "Privacy Policy",
      "url": "<?=getenv('site.privacy_policy_page');?>"
   }, {
      "@context": "https://schema.org",
      "@type": "SiteNavigationElement",
      "id": "site-navigation",
      "name": "Contact",
      "url": "<?=getenv('site.contact_page');?>"
   }]
}
</script>
