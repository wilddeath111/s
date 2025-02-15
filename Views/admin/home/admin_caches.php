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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-network zmdi-hc-lg"></i> <strong><?=lang('Global.menu.caches_text'); ?></strong></h4>
						<a href="/admin/delete-cache" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash" aria-hidden="true"></i> <?=lang('Global.all_delete_cache_text'); ?></a>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="text-left"><?=lang('Global.caches.file_name_text');?></th>
										<th class="text-center"><?=lang('Global.caches.create_date_text');?></th>
									</tr>
								</thead>
								<tbody>
								<?php
								$cache_files = glob('writable/cache/*');
								if (!empty($cache_files)) {
								foreach ($cache_files as $file) {
								?>							
									<tr>
										<td class="text-left"><?=$file.' <span class="label label-dark">'.formatBytes(filesize($file)).'</span>';?></td>
										<td class="text-center"><?=trtarihsaat(date("Y-m-d H:i:s",filectime($file)));?></td>
									</tr>
								<?php
								}
								} else { echo '<tr class="text-center"><td colspan="2">'.lang('Global.crud.nodata_text').'</td></tr>'; } 
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
