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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-cloud-upload zmdi-hc-lg"></i> <strong><?=lang('Global.menu.csv_import_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/blog/csv-import" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label for="csv_file"><?=lang('Global.blogs.image_text'); ?></label>
												<input type="file" name="csv_file" id="csv_file" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.blogs.priority.title_text'); ?></label>
												<select id="priority" name="priority" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option selected value="0"><?=lang('Global.blogs.priority.low_text'); ?></option>
													<option value="1"><?=lang('Global.blogs.priority.high_text'); ?></option>
													<option value="2"><?=lang('Global.blogs.priority.higher_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.blogs.ai_count_text'); ?> *</label>
												<input type="text" name="ai_count" id="ai_count" value="<?=siteSet('openai_ai_count');?>" required class="form-control" placeholder="<?=lang('Global.blogs.ai_count_text'); ?>">
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

			<?php if (!empty($keywords)) { ?>
				<input type="hidden" name="ai_count1" id="ai_count1" value="<?=$ai_count;?>">
				<input type="hidden" name="priority1" id="priority1" value="<?=$priority;?>">
				<input type="hidden" name="title_same1" id="title_same1" value="<?=$title_same;?>">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i> <strong>Sonuçlar</strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="row">
							<div class="col-lg-12">
								<table class="table table-bordered table-hover table-responsive">
									<tr>
										<th>Keyword</th>
										<th>Volume</th>
										<th>KD</th>
										<th>CPC</th>
										<th>Number of Results</th>
										<th>#</th>
									</tr>
								<?php
								$i_id=0;
								foreach ($keywords as $keyword) {

									if (!empty($keyword['Number of Results'])) { $result_icon = '<a href="https://www.google.com/search?q='.urlencode($keyword['Keyword']).'" target="_blank"><i class="fa fa-search" style="color:#666;" aria-hidden="true"></i></a>'; } else { $result_icon = '';}
									echo '<tr><td>'.$keyword['Keyword'].'</td><td>'.$keyword['Volume'].'</td><td>'.$keyword['Keyword Difficulty'].' <i class="'.add_class_based_on_value($keyword['Keyword Difficulty']).' fa fa-circle" style="font-size:12px;" aria-hidden="true"></i></td><td>'.$keyword['CPC'].'</td><td>'.index_format_number($keyword['Number of Results']).' '.$result_icon.'</td><td><span data-id="'.$i_id.'" id="selectItem_'.$i_id.'" data-keyword="'.$keyword['Keyword'].'" class="addAiKeyword btn btn-success btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Add</span></td></tr>';
								$i_id++;
								}
								?>
								</table>
							</div>	
						</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			<?php } ?>
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- #dash-content -->
</div><!-- .wrap -->
</main>
<!--========== END app main -->
<?php echo view('admin/common/footer'); ?>
<script>
$('.addAiKeyword').click(function() {
	var Keyword = $(this).attr('data-keyword');
	var selectItem = $(this).attr('data-id');
	var ai_count = $("#ai_count1").val();
	var priority = $("#priority1").val();
	var title_same = $("#title_same1").val();

	
	var data_form = {"keyword" : Keyword, "ai_count" : ai_count, "priority" : priority, "title_same" : title_same};

	$.ajax({
		type: "POST",
		async: true,
		url:"/admin/blog/csv-keyword-add",
		data:data_form, 
		dataType: 'text',
		cache: false,
		beforeSend: function() {
			$("#selectItem_"+selectItem).attr("disabled", true);
			$("#selectItem_"+selectItem).removeClass('btn-success');
			$("#selectItem_"+selectItem).addClass('btn-dark');
		},
		success: function (result) {
			$("#selectItem_"+selectItem).addClass('hide');
			$.toast({ 
			  heading : "<strong><?=lang('Global.general.info_text');?></strong>",
			  text : "<?=lang('Global.general.added_keyword_title_text');?>", 
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

		},
		error: function(xhr, status, error) {
			$("#selectItem_"+selectItem).attr("disabled", false);
			$("#selectItem_"+selectItem).removeClass('btn-dark');
			$("#selectItem_"+selectItem).addClass('btn-warning');
			if (status == "timeout") {

				$.toast({ 
				  heading : "<strong><?=lang('Global.general.info_text');?></strong>",
				  text : "The request timeout.", 
				  showHideTransition : "slide",  
				  bgColor : "#a94442",              
				  textColor : "#eee",  
				  icon: "error",          
				  allowToastClose : true,       
				  hideAfter : 5000,              
				  stack : 5,
				  textAlign : "left",
				  position : "bottom-right",
				  loaderBg: "#fff"
				})

			} else {

				$.toast({ 
				  heading : "<strong><?=lang('Global.general.info_text');?></strong>",
				  text : "An error occurred: " + status + " - " + error, 
				  showHideTransition : "slide",  
				  bgColor : "#a94442",              
				  textColor : "#eee",  
				  icon: "error",          
				  allowToastClose : true,       
				  hideAfter : 5000,              
				  stack : 5,
				  textAlign : "left",
				  position : "bottom-right",
				  loaderBg: "#fff"
				})
			}
		}
	});

});
</script>
