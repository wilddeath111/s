<?php echo view('admin/common/header'); ?>
<main id="app-main" class="app-main">
<div class="wrap">
	<section class="app-content">
		<div class="row fixgutter">
			<div class="col-md-12">
				<?php echo alertbox('delete_cache', lang('Global.alert.delete_cache'), 'fa-check'); ?>
			</div>
		</div>
	</section>
</div>
</main>
<?php echo view('admin/common/footer'); ?>
