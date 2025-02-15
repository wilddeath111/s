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
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-collection-text zmdi-hc-lg"></i> <strong><?=lang('Global.menu.publish_blogs_text'); ?></strong></h4>
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
										<th class="text-left"><?=lang('Global.blogs.publish_date_text'); ?></th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
								<?php
								if (! empty($blogs) && is_array($blogs)) {
									foreach ($blogs as $blog) {
										$total_comment = totalComments($blog['_id']);
								?>							
									<tr>
										<td class="text-left">
											<?=$blog['title'];?>
											<span class="badge badge-dark"><?=$blog['views'].' '.lang('Global.blogs.views_text'); ?></span>
											<?php if ($total_comment>0) { echo '<span class="badge badge-primary">'.$total_comment.' '.lang('Global.blogs.comments_text').'</span>'; } ?>
											
											<?php if ($blog['status'] == 'active') { echo '<span class="badge badge-success">'.str_word_count($blog['content']).' '.lang('Global.blogs.words_text').'</span>'; } ?>
											<?php if (!empty($blog['youtube_id'])) { echo '<span style="cursor:pointer" class="YTVideo badge badge-danger" youtube-id="'.$blog['youtube_id'].'"><i class="fa fa-play"></i></span>'; } ?>
											<?php if (!empty($blog['content_images'])) { echo '<a href="'.getBlogContentImage($blog['content_images']).'" class="badge badge-primary" data-lightbox="gallery-2" data-title="'.$blog['title'].'"><i class="fa fa-image"></i></a>'; } ?>
											<?php if ($blog['title_same'] == 1) { echo '<span class="badge badge-pink">'.lang('Global.blogs.list_title_same_text').'</span>'; } ?>
										</td>

										<td class="text-center"><?=checkstatus($blog['status']);?></td>
										<td class="text-left"><?=trtarihsaat($blog['create_date']);?></td>
										<td class="text-left"><?=trtarihsaat($blog['publish_date']);?></td>
										<td class="text-right">
											<?php if ($blog['status'] == 'active') { echo '<a href="'.getblogSeoUrl($blog['seo_name'], $blog['_id']).'" target="_blank" class="btn btn-xs btn-dark"><i class="fa fa-edit"></i>&nbsp; '.lang('Global.crud.view_url_text').'</a>'; } ?>
											<a href="/admin/blog/details/<?=hash_encode($blog['_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>&nbsp; <?=lang('Global.crud.edit_text'); ?></a>
											<a href="/admin/blog/delete/<?=hash_encode($blog['_id']);?>" onclick="return confirm('<?=lang('Global.crud.deleteconfirm_text'); ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>&nbsp; <?=lang('Global.crud.delete_text'); ?></a>
										</td>
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

$('.YTVideo').click(function() {
  var videoId = $(this).attr('youtube-id');
  var iframe = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>';
  $('#myModal').modal().find('.modal-body').html(iframe);

});

</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
