<?php echo view('nicheone/layouts/common/header'); ?>
<section class="py-5 text-center container">
  <div class="row py-lg-5"><?=siteSet('home_cta_text');?></div>
</section>
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
    <?php foreach ($blogs as $blog) { ?>
      <div class="col">
        <div class="card shadow-sm">
          <a href="<?=getblogSeoUrl($blog['seo_name'], $blog['_id']);?>" title="<?=$blog['title']?>"><img itemprop="image" class="card-img-top lazy" src="<?=getBlogImage();?>" data-original="<?=getBlogImage($blog['image']);?>" alt="<?=$blog['title']?>" title="<?=$blog['title'];?>"></a>
          <div class="card-body">
            <div class="card-title fw-bold" itemprop="headline"><a href="<?=getblogSeoUrl($blog['seo_name'], $blog['_id']);?>" title="<?=$blog['title']?>"><?=$blog['title']?></a></div>
            <p class="card-text" itemprop="text"><?=$blog['description'];?></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="views float-start text-success d-block small"><?=$blog['views'].' '.lang('Site.blog.views_text');?></div>
                <div class="float-end text-muted d-block small"><?=calculate_reading_time($blog['content']).' '.lang('Site.blog.min_read_text');?></div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>
<?php echo view('nicheone/layouts/common/footer'); ?>
