<?php echo view('admin/common/header'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-code-setting zmdi-hc-lg"></i> <strong><?=lang('Global.profile.site_settings_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/site-settings" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-image" aria-controls="tab-image" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-picture-o" aria-hidden="true"></i> <?=lang('Global.settings.image.tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-social" aria-controls="tab-social" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-share-square-o" aria-hidden="true"></i> <?=lang('Global.settings.social_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-openai" class="text-purple" aria-controls="tab-openai" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-android" aria-hidden="true"></i> <?=lang('Global.settings.openai_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-seo" aria-controls="tab-seo" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-search" aria-hidden="true"></i> <?=lang('Global.settings.seo_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-code" aria-controls="tab-code" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i> <?=lang('Global.settings.code_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-limit" aria-controls="tab-limit" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-list-ol" aria-hidden="true"></i> <?=lang('Global.settings.limit_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-google_analytics" aria-controls="tab-google_analytics" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-google" aria-hidden="true"></i> <?=lang('Global.settings.google_analytics_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-comments" aria-controls="tab-comments" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-comments" aria-hidden="true"></i> <?=lang('Global.settings.comments_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-unsplash" aria-controls="tab-unsplash" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-picture-o" aria-hidden="true"></i> <?=lang('Global.settings.unsplash_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-recaptcha" aria-controls="tab-recaptcha" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-lock" aria-hidden="true"></i> <?=lang('Global.settings.recaptcha_tab_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-onesignal" aria-controls="tab-onesignal" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-bell" aria-hidden="true"></i> <?=lang('Global.settings.onesignal_tab_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.site_name_text'); ?> *</strong></label>
												<input type="text" name="site_name" required value="<?=$setting['site_name']?>" class="form-control" placeholder="<?=lang('Global.settings.site_name_text'); ?>">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.site_slogan_text'); ?> *</strong></label>
												<input type="text" name="site_slogan" required value="<?=$setting['site_slogan']?>" class="form-control" placeholder="<?=lang('Global.settings.site_slogan_text'); ?>">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.language.title_text'); ?></label>
												<select id="site_language" name="site_language" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['site_language'] == 'en') { echo 'selected'; } ?> value="en"><?=lang('Global.language.en_text'); ?></option>
													<option <?php if ($setting['site_language'] == 'tr') { echo 'selected'; } ?> value="tr"><?=lang('Global.language.tr_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.site_themes_text'); ?></label>
												<select id="site_themes" name="site_themes" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['site_themes'] == 'nicheone') { echo 'selected'; } ?> value="nicheone">nicheone</option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.site_mail_text'); ?> *</strong></label>
												<input type="text" name="site_mail" required value="<?=$setting['site_mail']?>" class="form-control" placeholder="<?=lang('Global.settings.site_mail_text'); ?>">
											</div>
										</div>

										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.settings.home_cta_text'); ?></label>
												<textarea class="form-control valid" name="home_cta_text" id="home_cta_text" rows="1" style="min-height:170px !important;" aria-invalid="false"><?=$setting['home_cta_text']?></textarea>
											</div>
										</div>

										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.settings.header_about_text'); ?></label>
												<input type="text" name="site_about" required value="<?=$setting['site_about']?>" class="form-control" placeholder="<?=lang('Global.settings.header_about_text'); ?>">
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-success"><?=lang('Global.settings.cron_publishing_text'); ?> <a href="<?=getenv('site.URL').'/CRON/cronPublishBlog/'.siteSet('crontab_code');?>" target="_blank"><i class="fa fa-external-link"></i></a></label>
												<input type="text" name="cron_publishing" readonly value="<?=getenv('app.baseURL').'/CRON/cronPublishBlog/'.siteSet('crontab_code');?>" class="form-control" aria-describedby="helpBlock2">
												<span id="helpBlock2" class="help-block text-danger"><?=lang('Global.settings.cron_publishing_info_text'); ?> <a class="badge badge-primary" href="/admin/GenerateCronTabCode" onclick="return confirm('<?=lang('Global.crud.GenerateCronTabCode_confirm_text'); ?>')"><?=lang('Global.settings.generate_crontab_text'); ?></a></span>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-success"><?=lang('Global.settings.cron_deletecache_text'); ?> <a href="<?=getenv('site.URL').'/CRON/delete-cache/'.siteSet('crontab_code');?>" target="_blank"><i class="fa fa-external-link"></i></a></label>
												<input type="text" name="cron_deletecache" readonly value="<?=getenv('app.baseURL').'/CRON/delete-cache/'.siteSet('crontab_code');?>" class="form-control" aria-describedby="helpBlock2">
												<span id="helpBlock2" class="help-block text-danger"><?=lang('Global.settings.cron_deletecache_info_text'); ?></span>
											</div>
										</div>

									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-google_analytics">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label><?=lang('Global.settings.gAnalytics_ViewId_text'); ?></label>
												<input type="text" name="gAnalytics_ViewId" value="<?=$setting['gAnalytics_ViewId']?>" class="form-control" placeholder="<?=lang('Global.settings.gAnalytics_ViewId_text'); ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="gAnalytics_jsonFile"><?=lang('Global.settings.gAnalytics_jsonFile_text'); ?></label>
												<input type="file" name="gAnalytics_jsonFile" id="gAnalytics_jsonFile" class="form-control">
											</div>
										</div>
									</div>	
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-image">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label for="site_logo"><?=lang('Global.settings.logo_text'); ?></label>
												<input type="file" name="site_logo" id="site_logo" class="form-control">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="site_favicon"><?=lang('Global.settings.favicon_text'); ?></label>
												<input type="file" name="site_favicon" id="site_favicon" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="alert alert-info text-center"><?=lang('Global.settings.image.alert_text'); ?></div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="android_icon"><?=lang('Global.settings.image.android_icon_text'); ?></label>
												<input type="file" name="android_icon" id="android_icon" class="form-control">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label for="apple_touch_icon"><?=lang('Global.settings.image.apple_touch_icon_text'); ?></label>
												<input type="file" name="apple_touch_icon" id="apple_touch_icon" class="form-control">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.image.content_images_text'); ?></label>
												<select id="content_images" name="content_images" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['content_images'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['content_images'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-12"><h4 class="m-b-lg">OG IMAGE</h4></div>
										<div class="col-lg-4">
											<div class="form-group">
												<label><?=lang('Global.settings.og.status_text'); ?></label>
												<select id="default_og_status" name="default_og_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['default_og_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_active_text'); ?></option>
													<option <?php if ($setting['default_og_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_passive_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.og.site_name_text'); ?> *</strong></label>
												<input type="text" name="default_og_sitename" required value="<?=$setting['default_og_sitename']?>" class="form-control" placeholder="<?=lang('Global.settings.og.site_name_text'); ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.og.default_og_color_text'); ?> *</strong></label>
												<input type="text" name="default_og_color" required value="<?=$setting['default_og_color']?>" class="form-control color_select" placeholder="<?=lang('Global.settings.og.default_og_color_text'); ?>">
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												<label for="default_og_image"><?=lang('Global.settings.og.default_og_image_text'); ?></label>
												<input type="file" name="default_og_image" id="default_og_image" class="form-control">
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												<label for="default_og_font"><?=lang('Global.settings.og.default_og_font_text'); ?></label>
												<input type="file" name="default_og_font" id="default_og_font" class="form-control">
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.og.default_og_text_primary_color_text'); ?> *</strong></label>
												<input type="text" name="default_og_text_primary_color" required value="<?=$setting['default_og_text_primary_color']?>" class="form-control color_select" placeholder="<?=lang('Global.settings.og.default_og_text_primary_color_text'); ?>">
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.og.default_og_title_color_text'); ?> *</strong></label>
												<input type="text" name="default_og_title_color" required value="<?=$setting['default_og_title_color']?>" class="form-control color_select" placeholder="<?=lang('Global.settings.og.default_og_title_color_text'); ?>">
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.og.default_og_desc_color_text'); ?> *</strong></label>
												<input type="text" name="default_og_desc_color" required value="<?=$setting['default_og_desc_color']?>" class="form-control color_select" placeholder="<?=lang('Global.settings.og.default_og_desc_color_text'); ?>">
											</div>
										</div>

									</div>
								</div>

								<div role="tabpanel" class="tab-pane fade in" id="tab-code">
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.settings.header_code_text'); ?></label>
												<textarea class="form-control valid" name="header_code" id="header_code" rows="1" style="min-height:170px !important;" aria-invalid="false"><?=$setting['header_code']?></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.settings.footer_code_text'); ?></label>
												<textarea class="form-control valid" name="footer_code" id="footer_code" rows="1" style="min-height:170px !important;" aria-invalid="false"><?=$setting['footer_code']?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-social">
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label><?=lang('Global.settings.social_facebook_text'); ?></label>
												<input type="text" name="social_fb" value="<?=$setting['social_fb']?>" class="form-control" placeholder="<?=lang('Global.settings.social_facebook_text'); ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="site_image"><?=lang('Global.settings.site_image_text'); ?></label>
												<input type="file" name="site_image" id="site_image" class="form-control">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label><?=lang('Global.settings.social_twitter_text'); ?></label>
												<input type="text" name="social_tw" value="<?=$setting['social_tw']?>" class="form-control" placeholder="<?=lang('Global.settings.social_twitter_text'); ?>">
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-seo">
									<div class="row fixgutter">
										<div class="col-lg-6">
											<div class="form-group">
												<label><?=lang('Global.settings.seo_indexingapi_status_text'); ?></label>
												<select id="seo_indexingapi_status" name="seo_indexingapi_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['seo_indexingapi_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['seo_indexingapi_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="seo_indexingapi_json"><?=lang('Global.settings.seo_indexingapi_json_text'); ?></label>
												<input type="file" name="seo_indexingapi_json" id="seo_indexingapi_json" class="form-control">
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												<label><?=lang('Global.settings.seo_noindex_text'); ?></label>
												<select id="seo_noindex" name="seo_noindex" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['seo_noindex'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['seo_noindex'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-8">
											<div class="form-group">
												<label class="text-success"><?=lang('Global.settings.sitemap_url_text'); ?> <a href="<?=getenv('site.URL').'/sitemaps.xml';?>" target="_blank"><i class="fa fa-external-link"></i></a></label>
												<input type="text" name="sitemap_url" readonly value="<?=getenv('app.baseURL').'/sitemaps.xml';?>" class="form-control" aria-describedby="helpBlock2">
												<span id="helpBlock2" class="help-block text-danger"><?=lang('Global.settings.sitemap_url_info_text'); ?></span>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.desc_text'); ?> *</strong></label>
												<input type="text" name="description" required value="<?=$setting['description']?>" maxlength="255" data-plugin="maxlength" data-options="{ alwaysShow: true, threshold: 10, warningClass: 'label label-success', limitReachedClass: 'label label-danger', placement: 'bottom', message: 'used %charsTyped% of %charsTotal% chars.' }" class="form-control" placeholder="<?=lang('Global.settings.desc_text'); ?>">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.keywords_text'); ?> *</strong></label>
												<input type="text" name="keywords" required value="<?=$setting['keywords']?>" class="form-control" placeholder="<?=lang('Global.settings.keywords_text'); ?>" data-plugin="tagsinput" data-role="tagsinput">
											</div>
										</div>

									</div>
								</div>

								<div role="tabpanel" class="tab-pane fade in" id="tab-limit">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.home_blog_count_text'); ?> *</strong></label>
												<input type="text" name="home_blog_count" required value="<?=$setting['home_blog_count']?>" class="form-control" placeholder="<?=lang('Global.settings.home_blog_count_text'); ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.settings.related_blog_count_text'); ?> *</strong></label>
												<input type="text" name="related_blog_count" required value="<?=$setting['related_blog_count']?>" class="form-control" placeholder="<?=lang('Global.settings.related_blog_count_text'); ?>">
											</div>
										</div>
									</div>
								</div>

								<div role="tabpanel" class="tab-pane fade in" id="tab-comments">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.blog_comments_text'); ?></label>
												<select id="blog_comments" name="blog_comments" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['blog_comments'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['blog_comments'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.blog_comment_userform_text'); ?></label>
												<select id="blog_comment_userform" name="blog_comment_userform" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['blog_comment_userform'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['blog_comment_userform'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.blog_comment_ai_creator_text'); ?></label>
												<select id="blog_comment_ai_creator" name="blog_comment_ai_creator" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['blog_comment_ai_creator'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['blog_comment_ai_creator'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.blog_comment_ai_model_text'); ?></label>
												<select id="blog_comment_ai_model" name="blog_comment_ai_model" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['blog_comment_ai_model'] == 'gpt-4') { echo 'selected'; } ?> value="gpt-44">GPT-4</option>
													<option <?php if ($setting['blog_comment_ai_model'] == 'gpt-3.5-turbo') { echo 'selected'; } ?> value="gpt-3.5-turbo">GPT-3.5 Turbo</option>
													<option <?php if ($setting['blog_comment_ai_model'] == 'gpt-3.5-turbo-0301') { echo 'selected'; } ?> value="gpt-3.5-turbo-0301">GPT-3.5 Turbo 0301</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.blog_comment_ai_count_text'); ?></label>
												<select id="blog_comment_ai_count" name="blog_comment_ai_count" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['blog_comment_ai_count'] == 1) { echo 'selected'; } ?> value="1">1</option>
													<option <?php if ($setting['blog_comment_ai_count'] == 2) { echo 'selected'; } ?> value="2">2</option>
													<option <?php if ($setting['blog_comment_ai_count'] == 3) { echo 'selected'; } ?> value="3">3</option>
													<option <?php if ($setting['blog_comment_ai_count'] == 4) { echo 'selected'; } ?> value="4">4</option>
													<option <?php if ($setting['blog_comment_ai_count'] == 5) { echo 'selected'; } ?> value="5">5</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-success"><?=lang('Global.settings.cron_aicomment_creator_text'); ?> <a href="<?=getenv('site.URL').'/CRON/comment-creator/'.siteSet('crontab_code');?>" target="_blank"><i class="fa fa-external-link"></i></a></label>
												<input type="text" name="cron_deletecache" readonly value="<?=getenv('app.baseURL').'/CRON/comment-creator/'.siteSet('crontab_code');?>" class="form-control" aria-describedby="helpBlock2">
												<span id="helpBlock2" class="help-block text-danger"><?=lang('Global.settings.cron_aicomment_creator_info_text'); ?></span>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="alert alert-info alert-custom">
												<h4 class="alert-title"><?=lang('Global.comments.settings.info_alert_text'); ?></h4>
												<?=lang('Global.comments.settings.info_alert_content_text'); ?>
											</div>
										</div>
									</div>
								</div>

								<div role="tabpanel" class="tab-pane fade in" id="tab-openai">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.openai.blog_cron_text'); ?></label>
												<select id="openai_blog_cron" name="openai_blog_cron" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['openai_blog_cron'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['openai_blog_cron'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.openai.blogmodel_text'); ?></label>
												<select id="openai_blogmodel" name="openai_blogmodel" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['openai_blogmodel'] == 'gpt-4') { echo 'selected'; } ?> value="gpt-44">GPT-4</option>
													<option <?php if ($setting['openai_blogmodel'] == 'gpt-3.5-turbo') { echo 'selected'; } ?> value="gpt-3.5-turbo">GPT-3.5 Turbo</option>
													<option <?php if ($setting['openai_blogmodel'] == 'gpt-3.5-turbo-0301') { echo 'selected'; } ?> value="gpt-3.5-turbo-0301">GPT-3.5 Turbo 0301</option>
												</select>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label><span><?=lang('Global.settings.openai.apikey_text'); ?></span> <span class="text-danger" id="access_key_text"><?=lang('Global.show_hide_button_text'); ?></span></label>
												<input type="password" id="openai_apikey" name="openai_apikey" value="<?=$setting['openai_apikey']?>" class="form-control" placeholder="<?=lang('Global.settings.openai.apikey_text'); ?>">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><strong><?=lang('Global.settings.openai.title_ai_count_text'); ?> *</strong></label>
												<input type="text" name="openai_ai_count" value="<?=$setting['openai_ai_count']?>" class="form-control" placeholder="<?=lang('Global.settings.openai.title_ai_count_text'); ?>">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="alert alert-warning text-center"><?=lang('Global.settings.openai.alert_text'); ?></div>
										</div>
									</div>
								</div>

								<div role="tabpanel" class="tab-pane fade in" id="tab-unsplash">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.unsplash.status_text'); ?></label>
												<select id="unsplash_status" name="unsplash_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['unsplash_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['unsplash_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label><span><?=lang('Global.settings.unsplash.accesskey_text'); ?></span> <span class="text-danger" id="unsplash_accesskey_text"><?=lang('Global.show_hide_button_text'); ?></span></label>
												<input type="password" id="unsplash_accesskey" name="unsplash_accesskey" value="<?=$setting['unsplash_accesskey']?>" class="form-control" placeholder="<?=lang('Global.settings.unsplash.accesskey_text'); ?>">
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-recaptcha">
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												<label><?=lang('Global.settings.recaptcha_site_key_text'); ?></label>
												<input type="text" name="recaptcha_site_key" value="<?=$setting['recaptcha_site_key']?>" class="form-control" placeholder="<?=lang('Global.settings.recaptcha_site_key_text'); ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label><?=lang('Global.settings.recaptcha_secret_key_text'); ?></label>
												<input type="text" name="recaptcha_secret_key" value="<?=$setting['recaptcha_secret_key']?>" class="form-control" placeholder="<?=lang('Global.settings.recaptcha_secret_key_text'); ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label><?=lang('Global.settings.recaptcha_status_text'); ?></label>
												<select id="recaptcha_status" name="recaptcha_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['recaptcha_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_active_text'); ?></option>
													<option <?php if ($setting['recaptcha_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_passive_text'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div role="tabpanel" class="tab-pane fade in" id="tab-onesignal">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.onesignal.status_text'); ?></label>
												<select id="onesignal_notify_status" name="onesignal_notify_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['onesignal_notify_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['onesignal_notify_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.onesignal.onesignal_publish_blog_status_text'); ?></label>
												<select id="onesignal_publish_blog_status" name="onesignal_publish_blog_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['onesignal_publish_blog_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['onesignal_publish_blog_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.onesignal.onesignal_blog_decr_status_text'); ?></label>
												<select id="onesignal_blog_decr_status" name="onesignal_blog_decr_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['onesignal_blog_decr_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['onesignal_blog_decr_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.settings.onesignal.onesignal_publish_comment_status_text'); ?></label>
												<select id="onesignal_publish_comment_status" name="onesignal_publish_comment_status" class="form-control" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($setting['onesignal_publish_comment_status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_yes_text'); ?></option>
													<option <?php if ($setting['onesignal_publish_comment_status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_no_text'); ?></option>
												</select>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												<label><span><?=lang('Global.settings.onesignal.onesignal_api_key_text'); ?></span> <span class="text-danger" id="onesignal_api_key_text"><?=lang('Global.show_hide_button_text'); ?></span></label>
												<input type="password" id="onesignal_api_key" name="onesignal_api_key" value="<?=$setting['onesignal_api_key']?>" class="form-control" placeholder="<?=lang('Global.settings.onesignal.onesignal_api_key_text'); ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label><span><?=lang('Global.settings.onesignal.onesignal_app_id_text'); ?></span></label>
												<input type="text" id="onesignal_app_id" name="onesignal_app_id" value="<?=$setting['onesignal_app_id']?>" class="form-control" placeholder="<?=lang('Global.settings.onesignal.onesignal_app_id_text'); ?>">
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-lg-12 text-right"><button type="submit" class="btn btn-success btn-md"><i class="fa fa-wrench" aria-hidden="true"></i> <?=lang('Global.crud.add_button_text'); ?></button></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
<script>
function showAlert(messageAlert, messageText) {
    var alertBox = '<div class="alert alert-' + messageAlert + ' alert-dismissable" id="showalert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="word-break">' + messageText + '</span></div>';
    $('.slug_message').html(alertBox);
    $("#showalert").fadeTo(5000, 500).slideUp(500, function () {
        $("#showalert").slideUp(500);
    });
};

$('#access_key_text').click(function() {
    var x = $('#openai_apikey');
    if (x.attr('type') === 'password') {
        x.attr('type', 'text');
    } else {
        x.attr('type', 'password');
    }
});

$('#unsplash_accesskey_text').click(function() {
    var x = $('#unsplash_accesskey');
    if (x.attr('type') === 'password') {
        x.attr('type', 'text');
    } else {
        x.attr('type', 'password');
    }
});

$('#onesignal_api_key_text').click(function() {
    var x = $('#onesignal_api_key');
    if (x.attr('type') === 'password') {
        x.attr('type', 'text');
    } else {
        x.attr('type', 'password');
    }
});


$(document).ready(function(){
  $('.color_select').colorpicker(); 
});

</script>
