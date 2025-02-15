<?php
echo view('admin/common/header');
$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime($filter_date . ' +1 day'));
$og_status = 1;

?>
<main id="app-main" class="app-main">
   <div class="wrap">
      <section class="app-content">
				<div class="row">
					<div class="col-md-12">
						<div class="mail-toolbar m-b-lg">
							<div class="btn-group" role="group"><a href="#" class="btn btn-default"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?=$filter_date;?></a></div>
							<div class="btn-group" role="group">
								<a href="#" class="btn btn-default"><i class="fa fa-trash"></i></a>
								<a href="#" class="btn btn-default"><i class="fa fa-exclamation-circle"></i></a>
							</div>
							<div class="btn-group pull-right" role="group">
								<a href="/admin/blog/publish-day-list/<?=date('Y-m-d', strtotime($filter_date . ' -1 day'));?>" class="btn btn-default"><i class="fa fa-chevron-left"></i></a>
								<?php
								if ($tomorrow <= $today) {
								    echo '<a href="/admin/blog/publish-day-list/'.$tomorrow.'" class="btn btn-default"><i class="fa fa-chevron-right"></i></a>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
						if ((empty(siteSet('default_og_sitename'))) OR (empty(siteSet('default_og_color'))) OR (empty(siteSet('default_og_image'))) OR (empty(siteSet('default_og_font'))) OR (empty(siteSet('default_og_text_primary_color'))) OR (empty(siteSet('default_og_title_color'))) OR (empty(siteSet('default_og_desc_color')))) {
							$og_status = 0;
    					echo '<div class="alert alert-danger text-center"><strong>'.lang('Global.blogs.undefined_og_image_var_alert_text').'</strong></div>';
						}?>
					</div>
				</div>
				<div class="gallery row">
					<?php
					if (! empty($blogs) && is_array($blogs)) {
					foreach ($blogs as $blog) {
					?>	
						<div class="col-xs-6 col-sm-4 col-md-3" style="height:420px; overflow: hidden;">
							<div class="gallery-item" id="gallery-item-<?=$blog['_id'];?>">
								<div class="thumb" style="height: 285px; width: 100%;overflow: hidden;">
									<a href="<?=getBlogImage($blog['image']);?>" data-lightbox="gallery-2" data-title="<?=$blog['title'];?>">
										<img class="img-responsive" src="<?=getBlogImage($blog['image']);?>" alt="">
									</a>
								</div>
								<div class="caption">
									<a href="<?=getblogSeoUrl($blog['seo_name'], $blog['_id']);?>" target="_blank"><?=$blog['title'];?></a>
									<div style="clear: both;"></div>
									<?php if ($og_status == 1) { echo '<span class="btn btn-xs btn-primary replace-og-image" data-id="'.$blog['_id'].'"><i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;'.lang('Global.blogs.og_image_replace_button_text').'</span>'; } ?>
									</div>
							</div>
						</div>
					<?php } } ?>
				</div>
      </section>
   </div>
</main>

<?php echo view('admin/common/footer'); ?>
<style>
.loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
}

.loading::before {
    content: '';
    display: block;
    width: 0;
    height: 0;
    margin: 6px;
    border-radius: 50%;
    border: 5px solid #fff;
    border-color: #fff transparent #fff transparent;
    animation: loading 1.2s linear infinite;
}

@keyframes loading {
    0% {
        transform: rotate(0);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>

<script>
$(document).ready(function() {
    $('.replace-og-image').click(function() {
        var span = $(this);
        var id = $(this).data('id');
        var image = $('#gallery-item-' + id).find('img');
        
        $.ajax({
            type: 'POST',
            url: '/admin/blog/og-image-replace',
            data: {id: id},
            dataType: 'json',
            beforeSend: function() {
                image.parent().append('<div class="loading"></div>');
                image.css('opacity', 0.4);
            },
            success: function(data) {
                if (data.image_url) {
                    image.attr('src', data.image_url);
                    span.hide();
                }
            },
			error: function() {
                span.removeClass('btn-primary').addClass('btn-danger').html('<?=lang('Global.crud.error_text'); ?>');
            },
            complete: function() {
                image.parent().find('.loading').remove();
                image.css('opacity', 1);
            }
        });
    });
});
</script>
