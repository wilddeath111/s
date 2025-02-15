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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-edit zmdi-hc-lg"></i> <strong><?=lang('Global.comments.editform_text'); ?></strong></h4>
						<?php if ($blog['status'] == 'active') { echo '<a href="'.getblogSeoUrl($blog['seo_name'], $blog['_id']).'" target="_blank" class="btn btn-success btn-xs pull-right"><i class="fa fa-link" aria-hidden="true"></i> '.lang('Global.blogs.view_url_text').'</a>'; } ?>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/comments/details/<?=hash_encode($comment['_id'])?>" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-8">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.comments.nickname_text'); ?> *</label>
												<input type="text" name="nick_name" class="form-control" value="<?=$comment['nick_name']?>" placeholder="<?=lang('Global.comments.nickname_text'); ?>">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label><strong><?=lang('Global.general.status_text'); ?></strong></label>
												<select id="status" name="status" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($comment['status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_active_text'); ?></option>
													<option <?php if ($comment['status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_passive_text'); ?></option>
													<option <?php if ($comment['status'] == 'pending') { echo 'selected'; } ?> value="pending"><?=lang('Global.general.status_pending_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label><strong><?=lang('Global.comments.comment_type_text'); ?></strong></label>
												<select id="comment_type" name="comment_type" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($comment['comment_type'] == 'user') { echo 'selected'; } ?> value="user"><?=lang('Global.general.status_user_text'); ?></option>
													<option <?php if ($comment['comment_type'] == 'ai') { echo 'selected'; } ?> value="ai"><?=lang('Global.general.status_ai_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><strong><?=lang('Global.comments.content_text'); ?></strong></label>
												<textarea class="form-control" name="comment_text" id="comment_text" rows="1" style="min-height:170px !important;" aria-invalid="false"><?=$comment['comment_text']?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 mt-2 text-right"><button type="submit" class="btn btn-primary btn-md"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?=lang('Global.crud.update_button_text'); ?></button></div>
								</div>
							</div>
						</div>
						</form>	
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
			<div class="col-md-4">
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title text-info pull-left"><i class="fa fa-info" aria-hidden="true"></i> <?=lang('Global.dashboard.last_log_title'); ?></h4>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body"  style="height:350px;overflow-y: scroll;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?=lang('Global.logs.admin_text'); ?></th>
								<th style="width:45%"><?=lang('Global.logs.log_text'); ?></th>
								<th class="text-right"><?=lang('Global.logs.log_date_text'); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (! empty($logs) && is_array($logs)) {
							foreach ($logs as $log) {
								$user = getUserInfo($log['admin_id']);
						?>							
							<tr>
								<?php
								if(!empty($user)) {
									echo '<td><a href="/admin/client/details/'.hash_encode($user->_id).'">'.$user->client_name.'</a></td>';
								} else {
									echo '<td>'.$log['client_ip'].'</td>';
								}
								?>
								<td><?=$log['log_text'];?></td>
								<td class="text-right"><?=trtarihsaat($log['log_date']);?></td>
							</tr>
						<?php
							}
						} else { echo '<tr class="text-center"><td colspan="5">'.lang('Global.crud.nodata_text').'</td></tr>'; }
						?>
						</tbody>
				
				  	</table>
					</div>
				</div>
			</div>
		</div><!-- .row -->
	</section><!-- #dash-content -->
</div><!-- .wrap -->
</main>
<!--========== END app main -->
<?php echo view('admin/common/footer'); ?>
