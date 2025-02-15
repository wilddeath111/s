<?php echo view('admin/common/header'); ?>
<!-- APP MAIN ==========-->
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-6">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-collection-plus zmdi-hc-lg"></i> <strong><?=lang('Global.menu.photopool_add_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (siteSet('unsplash_status') == 'passive') { echo '<div class="col-md-12">'.alertbox('unsplash_status', lang('Global.alert.unsplash_status_pool'), 'fa-info').'</div>'; } ?>
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
					<?php if ($photo_count>0) { echo '<div class="text-danger text-center"><strong>'.lang('Global.photospool.photo_count_text', [$photo_count]).'</strong></div>'; } ?>
						<form method="POST" action="/admin/photospool/keyword-add" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-8">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.photospool.keyword_text'); ?> *</label>
												<input type="text" name="keyword" id="keyword" required class="form-control" placeholder="<?=lang('Global.photospool.keyword_text'); ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label><strong><?=lang('Global.photospool.source_text'); ?></strong></label>
												<select id="source" name="source" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<?php if (siteSet('unsplash_status') == 'active') { echo '<option value="unsplash">Unsplash</option>'; } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 text-right">
										<button type="submit" class="btn btn-success btn-md"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?=lang('Global.crud.get_text'); ?></button>
									</div>
								</div>
							</div>
						</div>
						</form>	
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
	<?php if (!empty($photo_data)) { ?>
		<form method="post" action="/admin/photospool/keyword-add-result">
		<input type="hidden" name="keyword" value="<?=$keyword?>">
		<input type="hidden" name="source" value="<?=$source?>">
		<div class="row">
			<div class="col-md-12">
				<div class=" m-b-lg">
					<button type="submit" class="btn btn-default"><i class="fa fa-check" aria-hidden="true"></i> <?=lang('Global.photospool.selected_photos_text');?></button>
					<span id="select-all-photos" class="btn btn-primary"> <?=lang('Global.photospool.all_selected_photos_text');?></span>
					<span id="deselect-all-photos" class="btn btn-danger" style="display:none;"> <?=lang('Global.photospool.all_deselected_photos_text');?></span>
				</div>
			</div>
		</div>
		<div class="row">
		<?php foreach ($photo_data as $photo) { ?>
			<div class="col-xs-6 col-sm-4 col-md-3" style="height:340px; overflow: hidden;">
				<div class="gallery-item">
					<div class="thumb" style="height: 285px; width: 100%;overflow: hidden;">
						<a href="<?=$photo['urls']['regular'];?>" data-lightbox="gallery-2" data-title="<?=$photo['alt_description'];?>"><img class="img-responsive" src="<?=$photo['urls']['regular'];?>" style="max-height: 290px;"></a>
					</div>
					<div class="checkbox checkbox-primary" style="margin:5px;"><input name="imageCheckbox[]" value="<?=$photo['urls']['regular'].'|||'.$photo['id'];?>" type="checkbox" id="checkbox-<?=$photo['id']?>"><label for="checkbox-<?=$photo['id']?>"> <?=$photo['alt_description'];?></label></div>
				</div>

			</div>
		<?php } ?>
		</div>
		</form>
	<?php } ?>
	</section><!-- #dash-content -->
</div><!-- .wrap -->
</main>
<!--========== END app main -->
<?php echo view('admin/common/footer'); ?>
<script>
function showAlert(messageAlert, messageText) {
    var alertBox = '<div class="alert alert-' + messageAlert + ' alert-dismissable" id="showalert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="word-break">' + messageText + '</span></div>';
    $('.slug_message').html(alertBox);
    $("#showalert").fadeTo(5000, 500).slideUp(500, function () {
        $("#showalert").slideUp(500);
    });
};

    $("#select-all-photos").click(function() {
        $("input[type='checkbox']").prop("checked", true);
        $(this).hide();
        $("#deselect-all-photos").show();
    });

    $("#deselect-all-photos").click(function() {
        $("input[type='checkbox']").prop("checked", false);
        $(this).hide();
        $("#select-all-photos").show();
    });

</script>
