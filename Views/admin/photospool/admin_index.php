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
						<h4 class="widget-title pull-left text-danger"><i class="menu-icon zmdi zmdi-collection-image zmdi-hc-lg"></i> <strong><?=lang('Global.menu.photopoollist_text'); ?></strong></h4>
					</header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="logdata" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th><?=lang('Global.photospool.keyword_text'); ?></th>
										<th><?=lang('Global.photospool.source_text'); ?></th>
										<th><?=lang('Global.photospool.create_date_text'); ?></th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if (! empty($photos) && is_array($photos)) {
									foreach ($photos as $photo) {
								?>
									<tr>
										<td><a href="<?=$photo['photo_url'];?>" data-lightbox="gallery-2" data-title="<?=$photo['photo_keyword'];?>"><img src="<?=$photo['photo_url'];?>" style="width: auto; height: 32px; border-radius:7px;"></a></td>
										<td><?=$photo['photo_keyword'];?> <span class="badge badge-danger"><?=$photo['used'];?></span></td>
										<td><?=$photo['source'];?></td>
										<td><?=trtarihsaat($photo['create_date']);?></td>
										<td class="text-right">
											<a href="/admin/photospool/delete/<?=hash_encode($photo['_id']);?>" onclick="return confirm('<?=lang('Global.crud.deleteconfirm_text'); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>&nbsp; <?=lang('Global.crud.delete_text'); ?></a>
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
