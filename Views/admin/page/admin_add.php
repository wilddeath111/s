<?php echo view('admin/common/header'); ?>
<!-- APP MAIN ==========-->
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-8">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-collection-plus zmdi-hc-lg"></i> <strong><?=lang('Global.pages.add_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/page/add" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-seo" aria-controls="tab-seo" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-search" aria-hidden="true"></i> <?=lang('Global.pages.seo_tab_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-8">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.pages.title_text'); ?> *</label>
												<input type="text" name="title" required class="form-control" placeholder="<?=lang('Global.pages.title_text'); ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="page_image"><?=lang('Global.pages.image_text'); ?></label>
												<input type="file" name="page_image" id="page_image" class="form-control">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label><strong><?=lang('Global.general.status_text'); ?></strong></label>
												<select id="status" name="status" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option selected value="active"><?=lang('Global.general.status_active_text'); ?></option>
													<option value="passive"><?=lang('Global.general.status_passive_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label><strong><?=lang('Global.pages.footer_text'); ?></strong></label>
												<select id="footer" name="footer" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option value="1"><?=lang('Global.general.status_active_text'); ?></option>
													<option selected value="0"><?=lang('Global.general.status_passive_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><strong><?=lang('Global.pages.content_text'); ?></strong></label>
												<textarea class="form-control valid" name="content" id="content" rows="1" style="min-height:170px !important;" aria-invalid="false"></textarea>
												<script> CKEDITOR.replace('content', { width: '100%', height: 250 }); </script>
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-seo">
									<div class="row fixgutter">
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.pages.seo_title_text'); ?></label>
												<input type="text" name="seo_title" class="form-control" placeholder="<?=lang('Global.pages.seo_title_text'); ?>">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.pages.desc_text'); ?></label>
												<input type="text" name="description" class="form-control" placeholder="<?=lang('Global.pages.desc_text'); ?>" maxlength="160" data-plugin="maxlength" data-options="{ alwaysShow: true, threshold: 10, warningClass: 'label label-success', limitReachedClass: 'label label-danger', placement: 'left' }">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.pages.keywords_text'); ?></label>
												<input type="text" name="keywords" class="form-control" placeholder="<?=lang('Global.pages.keywords_text'); ?>" data-plugin="tagsinput" data-role="tagsinput">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 text-right"><button type="submit" class="btn btn-success btn-md"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?=lang('Global.crud.add_button_text'); ?></button></div>
								</div>
							</div>
						</div>
						</form>	
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
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
</script>
