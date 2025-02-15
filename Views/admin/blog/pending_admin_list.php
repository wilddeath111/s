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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-collection-bookmark zmdi-hc-lg"></i> <strong><?=lang('Global.menu.pending_bloglist_text'); ?></strong></h4>
						<a href="/admin/blog/add" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=lang('Global.menu.blog_add_text'); ?></a>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="text-left"><?=lang('Global.blogs.title_text'); ?></th>
										<th class="text-center"><?=lang('Global.general.status_text'); ?></th>
										<th class="text-left"><?=lang('Global.blogs.create_date_text'); ?></th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if (! empty($blogs) && is_array($blogs)) {
									foreach ($blogs as $blog) {
									
								?>							
									<tr>
										<td class="text-left">
											<?=$blog['title'].' '.checkPriority($blog['priority']);?>
											<?php if ($blog['title_same'] == 1) { echo '<span class="badge badge-pink">'.lang('Global.blogs.list_title_same_text').'</span>'; } ?>	
										</td>

										<td class="text-center"><?=checkstatus($blog['status']);?></td>
										<td class="text-left"><?=trtarihsaat($blog['create_date']);?></td>
										<td class="text-right">
											<span class="publishButton btn btn-xs btn-info" data-id="<?=hash_encode($blog['_id']);?>"><i class="fa fa-check"></i>&nbsp; <?=lang('Global.crud.publish_text'); ?></span>
											<a href="/admin/blog/details/<?=hash_encode($blog['_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp; <?=lang('Global.crud.edit_text'); ?></a>
											<a href="/admin/blog/delete/<?=hash_encode($blog['_id']);?>" onclick="return confirm('<?=lang('Global.crud.deleteconfirm_text'); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>&nbsp; <?=lang('Global.crud.delete_text'); ?></a>
										</td>
									</tr>
								<?php
									}
								} else { echo '<tr class="text-center"><td colspan="3">'.lang('Global.crud.nodata_text').'</td></tr>'; } 
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

$('.publishButton').click(function() {
    var id = $(this).data('id');
    var url = '<?=getenv('app.baseURL').'/CRON/cronPublishBlog/'.siteSet('crontab_code').'/';?>' + id;
    $(this).html('<i class="fa fa-spinner fa-spin"></i> <?=lang('Global.crud.loading_text'); ?>');
    $(this).removeClass('btn-info');
    $(this).addClass('btn-dark');
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            if (response == '<meta name="robots" content="noindex,nofollow">OK') {
                $('.publishButton[data-id="'+id+'"]').hide();

				$.toast({ 
				  heading : "<strong><?=lang('Global.general.info_text');?></strong>",
				  text : "<?=lang('Global.general.published_blog_title_text');?>", 
				  showHideTransition : "slide",  
				  bgColor : "#3c763d",              
				  textColor : "#eee",  
				  icon: "success",          
				  allowToastClose : true,       
				  hideAfter : 5000,              
				  stack : 5,
				  textAlign : "left",
				  position : "top-right",
				  loaderBg: "#fff"
				})

            }
        },
        error: function() {
            //alert('An error occurred.');
        }
    });
});

$(document).ready(function() {
	$('#default-datatable').DataTable({
		responsive: true,
		searching: true,
		ordering: false,
		pageLength: 25,
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
