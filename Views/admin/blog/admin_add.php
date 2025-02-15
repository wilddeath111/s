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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-collection-plus zmdi-hc-lg"></i> <strong><?=lang('Global.menu.blog_add_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/blog/add" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.blogs.title_text'); ?> *</label>
												<input type="text" name="title" required class="form-control" placeholder="<?=lang('Global.blogs.title_text'); ?>">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label for="blog_image"><?=lang('Global.blogs.image_text'); ?></label>
												<input type="file" name="blog_image" id="blog_image" class="form-control">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label><?=lang('Global.blogs.priority.title_text'); ?></label>
												<select id="priority" name="priority" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option selected value="0"><?=lang('Global.blogs.priority.low_text'); ?></option>
													<option value="1"><?=lang('Global.blogs.priority.high_text'); ?></option>
													<option value="2"><?=lang('Global.blogs.priority.higher_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label><?=lang('Global.blogs.title_same.title_same_text'); ?></label>
												<select id="title_same" name="title_same" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option selected value="0"><?=lang('Global.blogs.title_same.no_text'); ?></option>
													<option value="1"><?=lang('Global.blogs.title_same.yes_text'); ?></option>
												</select>
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
