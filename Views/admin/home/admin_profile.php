<?php echo view('admin/common/header'); ?>
<main id="app-main" class="app-main">
<div class="wrap">
<form action="/admin/profile" method="post" id="ProfileForm">
	<section class="app-content">
		<div class="row fixgutter">
			<div class="col-md-6">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-account-box zmdi-hc-lg"></i> <?=lang('Global.profile.my_profile_text'); ?></h4>
					</header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="row fixgutter">
							<?php if (!empty($alert)) { echo '<div class="col-lg-12">'.alertbox($alert, lang('Global.alert.'.$alert), 'fa-info').'</div>';} ?>
							<div class="col-lg-12">
								<div class="row fixgutter">
									<div class="col-lg-6">
										<div class="form-group">
											<label><?=lang('Global.profile.name_text'); ?></label>
											<input class="form-control" value="<?=$user['client_name']?>" autocomplete="off" placeholder="<?=lang('Global.profile.name_text'); ?>" name="profile_name" type="text" id="profile_name" required minlength="2">
										</div>			
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label><?=lang('Global.profile.mail_text'); ?></label>
											<input class="form-control" value="<?=$user['email']?>" autocomplete="off" placeholder="<?=lang('Global.profile.mail_text'); ?>" name="email" type="text" id="email" required readonly minlength="2">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label><?=lang('Global.profile.gsm_text'); ?></label>
											<input class="form-control" value="<?=$user['gsm']?>" autocomplete="off" placeholder="<?=lang('Global.profile.gsm_text'); ?>" name="gsm" type="text" id="gsm" required minlength="2">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label><?=lang('Global.profile.password_text'); ?></label>
											<input class="form-control" autocomplete="off" placeholder="<?=lang('Global.profile.password_text'); ?>" name="password" type="password" id="password">
										</div>
									</div>
									<div class="col-lg-12 text-right"><button type="submit" class="btn btn-dark btn-md"><i class="fa fa-user-o"></i> <?=lang('Global.profile.save_button_text'); ?></button></div>				
								</div>										
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</section>
</form>
</div>
</main>
<?php echo view('admin/common/footer'); ?>
