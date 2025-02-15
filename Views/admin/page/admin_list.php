<?php echo view('admin/common/header'); ?>
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<!-- DOM dataTable -->
			<div class="col-md-12">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-collection-item zmdi-hc-lg"></i> <strong><?=lang('Global.menu.pages_text'); ?></strong></h4>
						<a href="/admin/page/add" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=lang('Global.pages.add_text'); ?></a>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="text-left"><?=lang('Global.pages.title_text'); ?></th>
										<th class="text-left"><?=lang('Global.pages.seo_title_text'); ?></th>
										<th class="text-center"><?=lang('Global.general.status_text'); ?></th>
										<th class="text-left"><?=lang('Global.pages.create_date_text'); ?></th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if (! empty($pages) && is_array($pages)) {
									foreach ($pages as $page) {
								?>							
									<tr>
										<td class="text-left"><?=$page['name'];?> <span class="badge badge-dark"><?=$page['view'].' '.lang('Global.pages.views_text'); ?></span></td>
										<td class="text-left"><?=$page['seo_title'];?></td>
										<td class="text-center"><?=checkstatus($page['status']);?></td>
										<td class="text-left"><?=trtarihsaat($page['create_date']);?></td>
										<td class="text-right">
											<?php if ($page['status'] == 'active') { echo '<a href="'.getpageSeoUrl($page['seo_name'], $page['_id']).'" target="_blank" class="btn btn-xs btn-dark"><i class="fa fa-edit"></i>&nbsp; '.lang('Global.crud.view_url_text').'</a>'; } ?>
											<a href="/admin/page/details/<?=hash_encode($page['_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp; <?=lang('Global.crud.edit_text'); ?></a>
											<a href="/admin/page/delete/<?=hash_encode($page['_id']);?>" onclick="return confirm('<?=lang('Global.crud.deleteconfirm_text'); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>&nbsp; <?=lang('Global.crud.delete_text'); ?></a>
										</td>
									</tr>
								<?php
									}
								} else { echo '<tr class="text-center"><td colspan="5">'.lang('Global.crud.nodata_text').'</td></tr>'; } 
								?>
								</tbody>
							</table>
						</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- .app-content -->
</div><!-- .wrap -->
</main>
<!--========== END app main -->
<?php echo view('admin/common/footer'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.22/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/ju/dt-1.10.22/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#default-datatable').DataTable({
		responsive: true,
		searching: true,
		ordering: false,
		bLengthChange: false,
		bPaginate: true,
	 "language":{
			"sDecimal":        ",",
			"sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
			"sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar",
			"sInfoEmpty":      "Kayıt yok",
			"sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
			"sInfoPostFix":    "",
			"sInfoThousands":  ".",
			"sLengthMenu":     "Sayfada _MENU_ kayıt göster",
			"sLoadingRecords": "Yükleniyor...",
			"sProcessing":     "İşleniyor...",
			"sSearch":         "Ara:",
			"sZeroRecords":    "Eşleşen kayıt bulunamadı",
			"oPaginate": {
				"sFirst":    "İlk",
				"sLast":     "Son",
				"sNext":     "Sonraki",
				"sPrevious": "Önceki"
			},
			"oAria": {
				"sSortAscending":  ": artan sütun sıralamasını aktifleştir",
				"sSortDescending": ": azalan sütun soralamasını aktifleştir"
			}
		}		
	});
	
});
</script>
