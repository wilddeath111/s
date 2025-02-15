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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-view-list zmdi-hc-lg"></i> <strong><?=lang('Global.menu.keywords_blog_add_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
					<?php if ($title_count>0) { echo '<div class="text-danger text-center"><strong>'.lang('Global.blogs.title_count_text', [$title_count]).'</strong></div>'; } ?>
						<form method="POST" action="/admin/blog/keyword-blog-add" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.blogs.keyword_text'); ?> *</label>
												<input type="text" name="keyword" id="keyword" required class="form-control" placeholder="<?=lang('Global.blogs.keyword_text'); ?>">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.blogs.ai_count_text'); ?> *</label>
												<input type="text" name="ai_count" id="ai_count" value="<?=siteSet('openai_ai_count');?>" required class="form-control" placeholder="<?=lang('Global.blogs.ai_count_text'); ?>">
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
										<div class="col-lg-12">
											<div class="alert alert-info alert-custom">
												<h4 class="alert-title"><?=lang('Global.blogs.priority.info_alert_text'); ?></h4>
												<?=lang('Global.blogs.priority.info_alert_content_text'); ?>
											</div>
										</div>
										<div class="col-lg-12" id="preview_titles"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 text-right">
										<span id="preview_get" class="btn btn-dark btn-md">
										  <span id="preview_loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> <?=lang('Global.crud.loading_text'); ?></span>
										  <span id="preview_text"><i class="fa fa-check" aria-hidden="true"></i> <?=lang('Global.crud.preview_button_text'); ?></span>
										</span>
										<button type="submit" class="btn btn-success btn-md"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?=lang('Global.crud.add_button_text'); ?></button>
									</div>
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

$('#preview_get').click(function (e) {
	var keyword = $('#keyword').val();
	var ai_count = $('#ai_count').val();
	var priority = $('#priority').val();
	var data = {"keyword" : keyword, "ai_count" : ai_count, "priority" : priority, "preview" : 1};

	$('#preview_text').hide();
	$('#preview_loading').show();

	$.ajax({
		type: "POST",
		async: true,
		url:"/admin/blog/keyword-blog-add",
		data:data, 
		dataType: 'text',
		cache: false,
		beforeSend: function() {
			$("#keyword").attr("disabled", true);
			$("#ai_count").attr("disabled", true);
			$('#preview_get').removeClass('btn-dark');
			$('#preview_get').addClass('btn-warning');
			$("#preview_get").attr("disabled", true);

		},
		success: function (result) {
			$("#keyword").attr("disabled", false);
			$("#ai_count").attr("disabled", false);
			$("#preview_get").attr("disabled", false);
			$('#preview_get').removeClass('btn-warning');
			$('#preview_get').addClass('btn-dark');

			$('#preview_titles').html(result);

			$('#preview_loading').hide();
			$('#preview_text').show();

			$.toast({ 
			  heading : "<strong><?=lang('Global.general.info_text');?></strong>",
			  text : "<?=lang('Global.general.get_success_data_text');?>", 
			  showHideTransition : "slide",  
			  bgColor : "#3c763d",              
			  textColor : "#eee",  
			  icon: "success",          
			  allowToastClose : true,       
			  hideAfter : 5000,              
			  stack : 5,
			  textAlign : "left",
			  position : "top-right",
			  loaderBg: "#fff"
			})

		}
	});
});
</script>
