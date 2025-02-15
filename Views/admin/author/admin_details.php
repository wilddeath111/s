<?php echo view('admin/common/header'); ?>
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-8">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-account-box zmdi-hc-lg"></i> <strong><?=lang('Global.authors.editform_text'); ?></strong></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/author/details/<?=hash_encode($author['_id'])?>" enctype="multipart/form-data">
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
												<input type="text" name="author_name" value="<?=$author['author_name']?>" required class="form-control" placeholder="<?=lang('Global.authors.authorname_text'); ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="text-danger"><strong><?=lang('Global.authors.author_expertise_text'); ?> *</strong></label>
												<input type="text" name="author_expertise" value="<?=$author['author_expertise']?>" required class="form-control" placeholder="<?=lang('Global.authors.author_expertise_text'); ?>">
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
													<option <?php if ($author['status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_active_text'); ?></option>
													<option <?php if ($author['status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_passive_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.authors.author_bio_text'); ?></label>
												<textarea class="form-control valid" name="author_bio" id="author_bio" rows="1" style="min-height:170px !important;" aria-invalid="false"><?=$author['author_bio']?></textarea>
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
