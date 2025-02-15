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
						<h4 class="widget-title pull-left text-danger"><i class="menu-icon zmdi zmdi-accounts-list-alt zmdi-hc-lg"></i> <strong><?=lang('Global.menu.logs_text'); ?></strong></h4>
					</header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="logdata" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><?=lang('Global.logs.admin_text'); ?></th>
										<th style="width:45%"><?=lang('Global.logs.log_text'); ?></th>
										<th><?=lang('Global.logs.data_text'); ?></th>
										<th><?=lang('Global.logs.log_date_text'); ?></th>
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
											echo '<td>*</a></td>';
										}
										?>
										<td><?=$log['log_text'];?></td>
										<td><?=$log['item'].' / '. $log['item_id'];?></td>
										<td><?=trtarihsaat($log['log_date']);?></td>
									</tr>
								<?php
									}
								} else { echo '<tr class="text-center"><td colspan="4">'.lang('Global.crud.nodata_text').'</td></tr>'; } 
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
<?php echo view('admin/common/footer'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.22/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/ju/dt-1.10.22/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#logdata').DataTable({
		responsive: true,
		pageLength : 20,
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
