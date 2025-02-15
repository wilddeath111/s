<?php echo view('admin/common/header'); ?>
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-8">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-account-add zmdi-hc-lg"></i> <strong><?=lang('Global.authors.add_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/author/add" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.authors.authorname_text'); ?> *</strong></label>
												<input type="text" name="author_name" required class="form-control" placeholder="<?=lang('Global.authors.authorname_text'); ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.authors.author_expertise_text'); ?> *</strong></label>
												<input type="text" name="author_expertise" required class="form-control" placeholder="<?=lang('Global.authors.author_expertise_text'); ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="avatar_image" class="text-danger"><strong><?=lang('Global.authors.avatar_image_text'); ?> *</strong></label>
												<input type="file" name="avatar_image" id="avatar_image" class="form-control">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label><strong><?=lang('Global.general.status_text'); ?> *</strong></label>
												<select id="status" name="status" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option selected value="active"><?=lang('Global.general.status_active_text'); ?></option>
													<option value="passive"><?=lang('Global.general.status_passive_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.authors.author_bio_text'); ?></label>
												<textarea class="form-control valid" name="author_bio" id="author_bio" rows="1" style="min-height:170px !important;" aria-invalid="false"></textarea>
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
