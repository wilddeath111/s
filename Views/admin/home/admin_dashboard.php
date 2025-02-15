<?php
echo view('admin/common/header');
$timestamp = time() + ((getenv('site.PublishingCronTime') * 60)*($dashboard['total_pending_blog']-1));
$date = date('Y-m-d H:i:s', $timestamp);
?>
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
<div class="wrap">
	<section class="app-content">
		<div class="row">
			<?php if (empty(siteSet('openai_apikey'))) { echo '<div class="col-md-12">'.alertbox('openai_apikey', lang('Global.alert.openai_apikey'), 'fa-info').'</div>'; } ?>
			<?php if (siteSet('openai_blog_cron') == 'passive') { echo '<div class="col-md-12">'.alertbox('openai_blog_cron', lang('Global.alert.openai_blog_cron'), 'fa-info').'</div>'; } ?>

			<?php if (empty(siteSet('unsplash_accesskey'))) { echo '<div class="col-md-12">'.alertbox('unsplash_accesskey', lang('Global.alert.unsplash_accesskey'), 'fa-info').'</div>'; } ?>
			<?php if (siteSet('unsplash_status') == 'passive') { echo '<div class="col-md-12">'.alertbox('unsplash_status', lang('Global.alert.unsplash_status'), 'fa-info').'</div>'; } ?>
			
			<div class="col-md-3">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="fa fa-file"></i> <?=lang('Global.dashboard.total_blog_text'); ?></h4>
						<small class="pull-right text-muted"></small>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="text-color m-t-xs m-b-md fw-600 fz-lg"><i class="fa fa-file"></i> <span data-plugin="counterUp"><?=$dashboard['total_blog']?></span></h3>
							<div class="text-primary">
								<sapn><a href="/admin/blog/list" class="text-primary"><i class="fa fa-check"></i> <?=lang('Global.general.all_show_text'); ?></a></sapn>
							</div>
						</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div>

			<div class="col-md-3">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="fa fa-file"></i> <?=lang('Global.dashboard.total_pending_blog_text'); ?></h4>
						<span class="pull-right badge badge-dark"><?=trtarihsaat($date); ?></span>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="text-color m-t-xs m-b-md fw-600 fz-lg"><i class="fa fa-file"></i> <span data-plugin="counterUp"><?=$dashboard['total_pending_blog']?></span></h3>
							<div class="text-primary">
								<sapn><a href="/admin/blog/pending-list" class="text-primary"><i class="fa fa-check"></i> <?=lang('Global.general.all_show_text'); ?></a></sapn>
							</div>
						</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div>

			<div class="col-md-3">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left text-success"><i class="fa fa-file"></i> <?=lang('Global.dashboard.today_publish_blog_text'); ?></h4>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body clearfix">
						<div class="pull-left">
							<h3 class="text-success m-t-xs m-b-md fw-600 fz-lg"><i class="fa fa-file"></i> <span data-plugin="counterUp"><?=$dashboard['todayBlogCount']->total_publish_blog?></span></h3>
							<div class="text-primary">
								<sapn><a href="/admin/blog/publish-list" class="text-primary"><i class="fa fa-check"></i> <?=lang('Global.general.all_show_text'); ?></a></sapn>
							</div>
						</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div>
			<div class="col-md-3">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title"><i class="fa fa-comments"></i> <?=lang('Global.menu.commentslist_text'); ?></h4>
					</header>
					<hr class="widget-separator">
					<div class="widget-body row">
						<div class="col-xs-4">
							<div class="text-center p-h-md" style="border-right: 2px solid #eee">
								<h2 class="fz-md fw-400 m-0" data-plugin="counterUp"><?=$dashboard['total_active_comments'];?></h2>
								<span class="text-success fz-sm"><?=lang('Global.comments.all_comments_text'); ?></span>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="text-center p-h-md" style="border-right: 2px solid #eee">
								<h2 class="fz-md fw-400 m-0" data-plugin="counterUp"><?=$dashboard['total_pending_comments'];?></h2>
								<span class="text-warning fz-sm"><?=lang('Global.comments.pending_comments_text'); ?></span>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="text-center p-h-md">
								<h2 class="fz-md fw-400 m-0" data-plugin="counterUp"><?=$dashboard['today_active_comments'];?></h2>
								<span class="text-primary fz-sm"><?=lang('Global.comments.today_comments_text'); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>	

		</div><!-- .row -->

		<div class="row">
			<div class="col-md-5">
			<?php if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) { ?>
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title pull-left"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?=lang('Global.dashboard.realtime_visitor_text');?></h4>
				    <h5 class="pull-right text-danger m-0 fw-500"><span style="text-decoration: underline;font-weight:bold;" id="online-users"></span> <?=lang('Global.dashboard.analytics.active_visitor_text');?></h5>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body">
					<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="text-left"><?=lang('Global.dashboard.analytics.device_details_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.page_url_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.location_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.visitor_count_text');?></th>
							</tr>
						</thead>
						<tbody id="online-users-data"></tbody>
					</table>
					<p class="small text-muted"><i class="fa fa-info"></i> <?=lang('Global.dashboard.analytics_realtime_info_text');?></p>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			<?php } ?>
			</div><!-- END column -->
			<div class="col-md-5">
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title text-info pull-left"><i class="fa fa-info" aria-hidden="true"></i> <?=lang('Global.dashboard.last_log_title'); ?></h4>
				    <a href="/admin/logs" class="btn btn-dark btn-xs pull-right"><i class="fa fa-check"></i> <?=lang('Global.general.all_show_text'); ?></a>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body">
					<table class="table table-striped">
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
									echo '<td>'.$log['client_ip'].'</td>';
								}
								?>
								<td><?=$log['log_text'];?></td>
								<td><a href="/admin/<?=$log['item'].'/details/'.hash_encode($log['item_id']);?>"><?=$log['item'].'</a> / '. $log['item_id'];?></td>
								<td><?=trtarihsaat($log['log_date']);?></td>
							</tr>
						<?php
							}
						} else { echo '<tr class="text-center"><td colspan="5">'.lang('Global.crud.nodata_text').'</td></tr>'; }
						?>
						</tbody>
				
				  	</table>
					</div>
				</div>
			</div>

<div class="col-md-2">
   <div class="widget countries-widget">
      <header class="widget-header">
         <h4 class="widget-title text-success pull-left"><i class="fa fa-arrow-up" aria-hidden="true"></i> İstatistikler</h4>
      </header>
      <!-- .widget-header -->
      <hr class="widget-separator">
      <div class="widget-body" style="height:400px;overflow-y: scroll;padding: 0.3rem;">
         <div class="list-group m-0">
            <a href="/admin/app/details/72R" class="list-group-item clearfix" style="padding:10px;">
               <span class="pull-left fw-500 fz-sm"><?=lang('Global.dashboard.today_publish_blog_text'); ?></span>
               <div class="pull-right"><span data-plugin="counterUp"><?=$dashboard['todayBlogCount']->total_publish_blog?></span></div>
            </a>
            <!-- .list-group-item -->
            <a href="/admin/app/details/MXN" class="list-group-item clearfix" style="padding:10px;">
               <span class="pull-left fw-500 fz-sm">Öncelikli İçerik</span>
               <div class="pull-right"><span data-plugin="counterUp">9999999</span></div>
            </a>
            <a href="/admin/app/details/MXN" class="list-group-item clearfix" style="padding:10px;">
               <span class="pull-left fw-500 fz-sm">Fotoğraf havuzu</span>
               <div class="pull-right"><span data-plugin="counterUp">9999999</span></div>
            </a>
            <a href="/admin/app/details/MXN" class="list-group-item clearfix" style="padding:10px;">
               <span class="pull-left fw-500 fz-sm">Videolu İçerik</span>
               <div class="pull-right"><span data-plugin="counterUp">9999999</span></div>
            </a>
            <!-- .list-group-item -->
         </div>
         <!-- .list-group -->
      </div>
      <!-- .widget-body -->
   </div>
   <!-- .widget -->
</div>

		</div><!-- .row -->		
	</section><!-- .app-content -->
</div><!-- .wrap -->
</main>
<?php echo view('admin/common/footer'); ?>

<script>
function getRealtimeData() {
    $.post('/admin/analytics/real_time', {}, function (response) {
        $('#online-users').text(response.online);
        $('#online-users-data').html('');
        $.each(response.data, function (key, val) {
        	if (val[5] == 'MOBILE') { var device = '<i class="fa fa-mobile" aria-hidden="true"></i>'; }
        	if (val[5] == 'DESKTOP') { var device = '<i class="fa fa-desktop" aria-hidden="true"></i>'; }
            $('#online-users-data').append('<tr>' +
                '<td>' + (device + ' <small>' + val[6]) + '</small></td>' +
                '<td><a href="<?=getenv('site.URL');?>/'+(val[0])+'" target="_blank">' + (val[0]) + '</a> </td> ' +
                '<td>' + (val[2] + ' / ' + val[1]) + '</td>' +
                '<td>' + (val[7]) + ' </td> ' +
                '</tr>');
        });
        console.log('çalıştı!');
    }, 'json');
}
getRealtimeData();
setInterval(getRealtimeData, 1000);
</script>
