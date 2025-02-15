<?php echo view('admin/common/header'); ?>
<!-- APP MAIN ==========-->
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<main id="app-main" class="app-main">
  <div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-8">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="menu-icon zmdi zmdi-edit zmdi-hc-lg"></i> <strong><?=lang('Global.blogs.editform_text'); ?></strong></h4>
						<a href="<?=getblogSeoUrl($blog['seo_name'], $blog['_id'])?>" target="_blank" class="btn btn-success btn-xs pull-right"><i class="fa fa-link" aria-hidden="true"></i> <?=lang('Global.blogs.view_url_text'); ?></a>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body">
					<?php if (!empty($alert)) { echo alertbox($alert, lang('Global.alert.'.$alert), 'fa-info');} ?>
						<form method="POST" action="/admin/blog/details/<?=hash_encode($blog['_id'])?>" enctype="multipart/form-data">
						<div class="m-b-lg nav-tabs-horizontal">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-folder" aria-hidden="true"></i> <?=lang('Global.general_text'); ?></a></li>
								<li role="presentation" class=""><a href="#tab-seo" aria-controls="tab-seo" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-search" aria-hidden="true"></i> <?=lang('Global.blogs.seo_tab_text'); ?></a></li>
								<li role="presentation" class=""><a class="text-danger" href="#tab-youtube" aria-controls="tab-youtube" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-youtube" aria-hidden="true"></i> <?=lang('Global.blogs.youtube_tab_text'); ?></a></li>
								<?php if ($blog['status'] == 'active') { echo '<li role="presentation" class=""><a href="#tab-faq" aria-controls="tab-faq" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-question-circle" aria-hidden="true"></i> '.lang('Global.blogs.faq_tab_text').'</a></li>'; } ?>
							</ul>
							<div class="tab-content p-h-md">
								<div role="tabpanel" class="tab-pane fade in active" id="tab-general">
									<div class="row">
										<div class="col-lg-8">
											<div class="form-group">
												<label class="text-danger"><?=lang('Global.blogs.title_text'); ?> *</label>
												<input type="text" name="title" class="form-control" value="<?=$blog['title']?>" placeholder="<?=lang('Global.blogs.title_text'); ?>">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label for="blog_image"><?=lang('Global.blogs.image_text'); ?></label>
												<input type="file" name="blog_image" id="blog_image" class="form-control">
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><strong><?=lang('Global.general.status_text'); ?></strong></label>
												<select id="status" name="status" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($blog['status'] == 'active') { echo 'selected'; } ?> value="active"><?=lang('Global.general.status_active_text'); ?></option>
													<option <?php if ($blog['status'] == 'passive') { echo 'selected'; } ?> value="passive"><?=lang('Global.general.status_passive_text'); ?></option>
													<option <?php if ($blog['status'] == 'pending') { echo 'selected'; } ?> value="pending"><?=lang('Global.general.status_pending_text'); ?></option>
													<option <?php if ($blog['status'] == 'draft') { echo 'selected'; } ?> value="draft"><?=lang('Global.general.status_draft_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.blogs.title_same.title_same_text'); ?></label>
												<select id="title_same" name="title_same" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
													<option <?php if ($blog['title_same'] == 0) { echo 'selected'; } ?> value="0"><?=lang('Global.blogs.title_same.no_text'); ?></option>
													<option <?php if ($blog['title_same'] == 1) { echo 'selected'; } ?> value="1"><?=lang('Global.blogs.title_same.yes_text'); ?></option>
												</select>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.blogs.youtube_id_text'); ?></label>
												<input type="text" name="youtube_id" class="BlogYoutubeId form-control" value="<?=$blog['youtube_id']?>" placeholder="<?=lang('Global.blogs.youtube_id_text'); ?>">
												<input type="hidden" name="YoutubeDuration" id="YoutubeDuration" value="<?=$blog['YoutubeDuration']?>">
												<input type="hidden" name="YoutubeTitle" id="YoutubeTitle" value="<?=$blog['YoutubeTitle']?>">
												
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												<label><?=lang('Global.authors.authorname_text'); ?></label>
												<select id="author_id" name="author_id" class="form-control" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
												<?php foreach ($authors as $author) { ?>
													<option <?php if ( $blog['author_id'] == $author['_id']) { echo 'selected'; } ?> value="<?=$author['_id'];?>"><?=$author['author_name'];?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><strong><?=lang('Global.blogs.content_text'); ?></strong></label>
												<textarea class="form-control valid" name="content" id="content" rows="1" style="min-height:70px !important;" aria-invalid="false"><?=$blog['content']?></textarea>
												<script> CKEDITOR.replace('content', { width: '100%', height: 250 }); </script>
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-seo">
									<div class="row fixgutter">
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.blogs.desc_text'); ?></label>
												<input type="text" name="description" class="form-control" value="<?=$blog['description']?>" placeholder="<?=lang('Global.blogs.desc_text'); ?>" maxlength="160" data-plugin="maxlength" data-options="{ alwaysShow: true, threshold: 10, warningClass: 'label label-success', limitReachedClass: 'label label-danger', placement: 'left' }">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.blogs.keywords_text'); ?></label>
												<input type="text" name="keywords" class="form-control" value="<?=$blog['keywords']?>" placeholder="<?=lang('Global.blogs.keywords_text'); ?>" data-plugin="tagsinput" data-role="tagsinput">
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-youtube">
									<div class="row fixgutter">
				            <div class="col-md-12" style="margin-bottom: 20px;">
				                <div class="input-group">
				                    <input type="text" id="video_q" class="form-control" placeholder="Bir şeyler yazın">
				                    <span class="input-group-btn">
				                        <span id="search_btn" class="btn btn-primary"><i class="fa fa-search"></i></span>
				                    </span>
				                </div>
				            </div>
										<div class="col-md-12">
										   <div id="selectedVideoCard" class=" user-card p-md" style="display: none;">
										      <div class="media">
										         <div class="media-left">
										            <div class="avatar avatar-lg avatar-circle"><a href="javascript:void(0)"><img src="../assets/images/221.jpg" class="SelectedvideoThumbnail"></a></div>
										         </div>
										         <div class="media-body">
										            <h5 class="media-heading"><a href="#" target="_blank" class="SelectedvideoTitle title-color"></a></h5>
										            <small class="SelectedvideoChannel media-meta"></small>
										         </div>
										      </div>
										   </div>
										</div>
										<div class="col-lg-12" id="videoList">
											<?php foreach ($youtube_data['items'] as $video) {  ?>
												<div class="col-md-4 col-sm-6" style="height: 300px;">
												  <div class="thumbnail white VideoDiv_<?=$video['url'];?>">
												    <span class="YTVideo" youtube-id="<?=$video['url'];?>"><img src="<?=$video['thumbHigh'];?>"></span>
												    <div class="caption">
												      <div class="videoTitle"><?=uzun_metin_kes($video['title'],35);?></div>
												      <p><span id="VideoButtonDiv_<?=$video['url'];?>" class="selectVideo btn btn-sm btn-primary" videoDuration="<?=$video['duration']?>" videoYoutubeid="<?=$video['url'];?>" videoChannel="<?=$video['channelTitle']?>" videoTitle="<?=$video['title'];?>" videoThumbnail="<?=$video['thumbHigh'];?>" role="button"><i class="fa fa-play"></i>&nbsp;<?=lang('Global.blogs.selectvideo_button_text'); ?></span></p>
												    </div>
												  </div>
												</div>
											 <?php }  ?>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade in" id="tab-faq">
									<div class="row fixgutter">
										<div class="col-lg-12">
											<div class="form-group">
												<label><?=lang('Global.blogs.faq_content_text'); ?></label>
												<textarea class="form-control valid" name="questions" id="questions" rows="1" style="min-height:350px !important;" aria-invalid="false"><?=$blog['questions']?></textarea>
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
				  <div class="widget-body" style="height:350px;overflow-y: scroll;">
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

				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title text-primary pull-left"><i class="fa fa-android" aria-hidden="true"></i> <?=lang('Global.blogs.ai_related_text'); ?></h4>
				    <span class="pull-right btn btn-xs btn-info" id="aiTitlesGet"><i class="fa fa-refresh"></i>&nbsp; <?=lang('Global.blogs.ai_related_button_text'); ?></span>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body" style="height:350px;overflow-y: scroll;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?=lang('Global.blogs.ai_related_title_text'); ?></th>
								<th class="text-right">#</th>
							</tr>
						</thead>
						<tbody id="ai_titles"></tbody>
				  	</table>
					</div>
				</div>

			</div>
		</div><!-- .row -->
		<div class="row">
			<div class="col-md-12">
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title text-danger pull-left"><i class="fa fa-comment" aria-hidden="true"></i> <?=lang('Global.menu.commentslist_text'); ?></h4>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body"  style="height:350px;overflow-y: scroll;">
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?=lang('Global.comments.nickname_text'); ?></th>
								<th style="width:45%"><?=lang('Global.comments.content_text'); ?></th>
								<th class="text-right"><?=lang('Global.comments.create_date_text'); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (! empty($comments) && is_array($comments)) {
							foreach ($comments as $comment) {
						?>							
							<tr>
								<td><?=$comment['nick_name'];?></td>
								<td><a href="/admin/comments/details/<?=hash_encode($comment['_id']);?>" target="_blank"><?=$comment['comment_text'];?></a></td>
								<td class="text-right"><?=trtarihsaat($comment['create_date']);?></td>
							</tr>
						<?php
							}
						} else { echo '<tr class="text-center"><td colspan="3">'.lang('Global.crud.nodata_text').'</td></tr>'; }
						?>
						</tbody>
				
				  	</table>
					</div>
				</div>
			</div>
		</div>
	</section><!-- #dash-content -->
</div><!-- .wrap -->
</main>
<!--========== END app main -->
<?php echo view('admin/common/footer'); ?>

<script>
//$('.YTVideo').click(function() {
$(document).on("click", ".YTVideo", function() {
  var videoId = $(this).attr('youtube-id');
  var iframe = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>';
  $('#myModal').modal().find('.modal-body').html(iframe);

});

$(document).on("click", "#aiTitlesGet", function() {
	$(this).removeClass("btn-info");
  $(this).addClass("btn-dark");
  var btn = $(this);
  btn.html('<i class="fa fa-spinner fa-spin"></i> <?=lang('Global.crud.loading_text'); ?>');

  $.ajax({
    type: 'POST',
    url: '/admin/blog/blog-ai-title-get',
    data: {v_title: '<?=$blog['title'];?>'},
    success: function(response) {
    	btn.removeClass('btn-dark').addClass('btn-info');
    	btn.html('<i class="fa fa-refresh"></i> <?=lang('Global.blogs.ai_related_button_text'); ?>');

      var aiTitles = JSON.parse(response);
      var aiTitlesHTML = "";
      aiTitles.forEach(function(aiTitle) {
        aiTitlesHTML += '<tr><td>' + aiTitle.title + '</td><td class="text-right"><span data-title="' + aiTitle.title + '" class="addAiTitle btn btn-success btn-xs"><i class="fa fa-check"></i>Add</span></td></tr>';
      });
      $("#ai_titles").html(aiTitlesHTML);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Hata: " + textStatus, errorThrown);
    }
  });
});

//$('.addAiTitle').click(function() {
$(document).on("click", ".addAiTitle", function() {
	var selectTitle = $(this).attr('data-title');
	$(this).addClass('hide');
	var data = {"title" : selectTitle};

	$.ajax({
		type: "POST",
		async: true,
		url:"/admin/blog/blog-title-add",
		data:data, 
		dataType: 'text',
		cache: false,
		beforeSend: function() {
			

		},
		success: function (result) {

			$.toast({ 
			  heading : "<strong><?=lang('Global.general.info_text');?></strong>",
			  text : "<?=lang('Global.general.added_title_text');?>", 
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
	});

});

$(document).on("click", ".selectVideo", function() {

	var selectVideoVal = $('.BlogYoutubeId').val();
  var videoYoutubeid = $(this).attr('videoYoutubeid');
  var videoThumbnail = $(this).attr('videoThumbnail');
  var videoTitle = $(this).attr('videoTitle');
  var videoChannel = $(this).attr('videoChannel');
  var videoDuration = $(this).attr('videoDuration');

  
  $('#selectedVideoCard').show();
  $('.SelectedvideoThumbnail').attr('src', videoThumbnail);
  $('.SelectedvideoTitle').html(videoTitle);
  $('.SelectedvideoTitle').attr('href', 'https://www.youtube.com/watch?v='+videoYoutubeid);
  $('.SelectedvideoChannel').html(videoChannel);
  $('.BlogYoutubeId').val(videoYoutubeid);
  $('#YoutubeDuration').val(videoDuration);
  $('#YoutubeTitle').val(videoTitle);

	$('#VideoButtonDiv_'+selectVideoVal).removeClass('btn-success');
  $('#VideoButtonDiv_'+selectVideoVal).addClass('btn-primary');

	$('#VideoButtonDiv_'+videoYoutubeid).removeClass('btn-primary');
  $('#VideoButtonDiv_'+videoYoutubeid).addClass('btn-success');

  $('#VideoButtonDiv_'+selectVideoVal).html('<i class="fa fa-play"></i>&nbsp;<?=lang('Global.blogs.selectvideo_button_text'); ?>');
  $(this).html('<i class="fa fa-check"></i>&nbsp;<?=lang('Global.blogs.selectedvideo_button_text'); ?>');


  $('.VideoDiv_'+selectVideoVal).css('border', '1px solid #ddd');
  $('.VideoDiv_'+videoYoutubeid).css('border', '2px solid green');

});


function uzunMetinKes(metin, uzunluk) {
  return metin.length > uzunluk ? metin.substring(0, uzunluk - 3) + "..." : metin;
}

$(document).ready(function() {
    $("#search_btn").click(function() {
        var q = $("#video_q").val();
        $.ajax({
            type: "POST",
            url: "/admin/blog/AJAXYoutubeSearch",
            dataType: "json",
            data: {q: q},
						success: function(response) {
							if (response && response.items) {
							  var videolar = response.items;
							  var videoListesiHTML = "";
							  videolar.forEach(function(video) {
							    videoListesiHTML += olusturVideoHTML(video);
							  });
							  // Video listesini güncellemek istediğiniz HTML elementine atayın, örneğin: #videoListesi
							  $("#videoList").html(videoListesiHTML);
							}
						},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Hata: " + textStatus, errorThrown);
            }
        });
    });
});

function olusturVideoHTML(video) {
  var videoId = video.id.videoId;
  var thumbnail = video.thumbHigh;
  var channelTitle = video.channelTitle;
  var videoTitle = video.title;
  var videoDuration = video.duration;

  return `
    <div class="col-md-4 col-sm-6" style="height: 300px;">
      <div class="thumbnail white VideoDiv_${videoId}">
        <span class="YTVideo" youtube-id="${videoId}"><img src="${thumbnail}"></span>
        <div class="caption">
          <div class="videoTitle">${uzunMetinKes(videoTitle, 35)}</div>
          <p>
            <span id="VideoButtonDiv_${videoId}" class="selectVideo btn btn-sm btn-primary" videoYoutubeid="${videoId}" videoDuration="${videoDuration}" videoChannel="${channelTitle}" videoTitle="${videoTitle}" videoThumbnail="${thumbnail}" role="button">
              <i class="fa fa-play"></i>&nbsp;<?=lang('Global.blogs.selectvideo_button_text');?>
            </span>
          </p>
        </div>
      </div>
    </div>`;
}
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
