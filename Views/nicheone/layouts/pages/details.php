<?php echo view('nicheone/layouts/common/header'); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "<?=siteSet('site_name');?>",
    "item": "<?=getenv('app.baseURL');?>"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "<?=$page['name'];?>",
    "item": "<?=current_url(false);?>"
  }]
}
</script>
<script type="application/ld+json">
[{
   "@context": "https://schema.org",
   "@type": "ImageObject",
   "contentUrl": "<?=getBlogImage($page['image']);?>",
   "license": "<?=getenv('app.baseURL');?>",
   "acquireLicensePage": "<?=getenv('app.baseURL');?>"
}]
</script>

<script type="application/ld+json">
{
   "@context": "https://schema.org",
   "@type": "BlogPosting",
   "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "<?=current_url(false);?>"
   },
   "headline": "<?=$page['name'];?>",
   "image": {
      "@type": "ImageObject",
      "url": "<?=getBlogImage($page['image']);?>"
   },
   "datePublished": "2023-04-06T23:04:56+0000",
   "dateModified": "2023-04-06T23:11:08+0000",
   "author": {
      "@type": "Person",
      "name": "admin",
      "url": "<?=getenv('app.baseURL');?>"
   },
   "publisher": {
      "@type": "Organization",
      "name": "<?=siteSet('site_name');?>",
      "logo": {
         "@type": "ImageObject",
         "url": "<?=getenv('site.cdnUrl').'/public/upload/logo/'.siteSet('site_logo');?>"
      }
   },
   "description": "<?=$page['description'];?>"
}
</script>

<section class="album py-5 bg-light">
  <div class="container">
    <div class="row" itemscope itemtype="http://schema.org/Blog">
      <div class="col-md-8 mx-auto">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <h2 class="card-title" itemprop="headline"><?=$page['name'];?></h2>
            <p class="card-text"><?=$page['description'];?></p>
            <div class="d-flex justify-content-between align-items-center"><small class="text-muted"><?=trtarih($page['create_date']);?></small></div>
            <?=$page['content']?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo view('nicheone/layouts/common/footer'); ?>
