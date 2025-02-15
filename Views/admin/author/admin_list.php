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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-accounts-list zmdi-hc-lg"></i> <strong><?=lang('Global.menu.author_list_text'); ?></strong></h4>
						<a href="/admin/author/add" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=lang('Global.authors.add_text'); ?></a>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="text-left"><?=lang('Global.authors.authorname_text'); ?></th>
										<th class="text-left"><?=lang('Global.authors.author_expertise_text'); ?></th>
										<th class="text-center"><?=lang('Global.general.status_text'); ?></th>
										<th class="text-left"><?=lang('Global.authors.create_date_text'); ?></th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if (! empty($authors) && is_array($authors)) {
									foreach ($authors as $author) {
								?>							
									<tr>
										<td class="text-left"><?=$author['author_name'];?> </td>
										<td class="text-left"><?=$author['author_expertise'];?></td>
										<td class="text-center"><?=checkstatus($author['status']);?></td>
										<td class="text-left"><?=trtarihsaat($author['create_date']);?></td>
										<td class="text-right">
											<a href="/admin/author/details/<?=hash_encode($author['_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp; <?=lang('Global.crud.edit_text'); ?></a>
											<a href="/admin/author/delete/<?=hash_encode($author['_id']);?>" onclick="return confirm('<?=lang('Global.crud.deleteconfirm_text'); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>&nbsp; <?=lang('Global.crud.delete_text'); ?></a>
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
