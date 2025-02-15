<?php echo view('admin/common/header');?>
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
<div class="wrap">
	<section class="app-content">
		<div class="row">
			<div class="col-md-2">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="fa fa-users" aria-hidden="true"></i> <?=lang('Global.dashboard.realtime_visitor_text');?></h4>
						<small class="pull-right text-muted"></small>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body text-center">
						<div class="big-icon m-b-md watermark"><i class="fa fa-5x fa-users"></i></div>
						<h3 class="m-b-md text-success"><span id="online-users"></span> <?=lang('Global.dashboard.analytics.active_visitor_text');?></h3>
					</div>
				</div><!-- .widget -->
			</div>
			<div class="col-md-2">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?=lang('Global.dashboard.analytics.today_visitor_text');?></h4>
						<small class="pull-right text-muted"></small>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body text-center">
						<div class="big-icon m-b-md watermark"><i class="fa fa-5x fa-bar-chart"></i></div>
						<h3 class="m-b-md"><?=$visitor['today'];?> <?=lang('Global.dashboard.analytics.visitor_text');?></h3>
					</div>
				</div><!-- .widget -->
			</div>
			<div class="col-md-2">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?=lang('Global.dashboard.analytics.yesterday_visitor_text');?></h4>
						<small class="pull-right text-muted"></small>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body text-center">
						<div class="big-icon m-b-md watermark"><i class="fa fa-5x fa-bar-chart"></i></div>
						<h3 class="m-b-md"><?=$visitor['yesterday'];?> <?=lang('Global.dashboard.analytics.visitor_text');?></h3>
					</div>
				</div><!-- .widget -->
			</div>
			<div class="col-md-2">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?=lang('Global.dashboard.analytics.last7_visitor_text');?></h4>
						<small class="pull-right text-muted"></small>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body text-center">
						<div class="big-icon m-b-md watermark"><i class="fa fa-5x fa-bar-chart"></i></div>
						<h3 class="m-b-md"><?=$visitor['last7'];?> <?=lang('Global.dashboard.analytics.visitor_text');?></h3>
					</div>
				</div><!-- .widget -->
			</div>
			<div class="col-md-2">
				<div class="widget">
					<header class="widget-header">
						<h4 class="widget-title pull-left"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?=lang('Global.dashboard.analytics.total_visitor_text');?></h4>
						<small class="pull-right text-muted"></small>
					</header><!-- .widget-header -->
					<hr class="widget-separator">
					<div class="widget-body text-center">
						<div class="big-icon m-b-md watermark"><i class="fa fa-5x fa-bar-chart"></i></div>
						<h3 class="m-b-md"><?=$visitor['total'];?> <?=lang('Global.dashboard.analytics.visitor_text');?></h3>
					</div>
				</div><!-- .widget -->
			</div>		
		</div><!-- .row -->
		<div class="row">
			<div class="col-lg-6">
			<?php if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) { ?>
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title pull-left"><i class="fa fa-file-code-o" aria-hidden="true"></i> <?=lang('Global.dashboard.analytics.popular_pages_text');?></h4>
				    <span class="pull-right text-info"><i class="fa fa-info" aria-hidden="true"></i> <small class="text-info">today</small></a>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body">
					<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="text-left"><?=lang('Global.dashboard.analytics.page_title_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.page_url_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.visitor_total_text');?></th>
								<th class="text-left">sessionCount</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (! empty($visitor['popular_pages_today']) && is_array($visitor['popular_pages_today'])) {
						foreach ($visitor['popular_pages_today'] as $page) {
							echo'
							<tr>
								<td class="text-left">'.$page[0].'</td>
								<td class="text-left">'.$page[1].'</td>
								<td class="text-left">'.$page[2].'</td>
								<td class="text-left">'.$page[3].'</td>
							</tr>';
						} } ?>
						</tbody>
					</table>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			<?php } ?>
			</div>
			<div class="col-lg-6">
			<?php if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) { ?>
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title pull-left"><i class="fa fa-file-code-o" aria-hidden="true"></i> <?=lang('Global.dashboard.analytics.popular_pages_text');?></h4>
				    <span class="pull-right text-info"><i class="fa fa-info" aria-hidden="true"></i> <small class="text-info">dün</small></a>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body">
					<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="text-left"><?=lang('Global.dashboard.analytics.page_title_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.page_url_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.visitor_total_text');?></th>
								<th class="text-left">sessionCount</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (! empty($visitor['popular_pages_yesterday']) && is_array($visitor['popular_pages_yesterday'])) {
						foreach ($visitor['popular_pages_yesterday'] as $page) {
							echo'
							<tr>
								<td class="text-left">'.$page[0].'</td>
								<td class="text-left">'.$page[1].'</td>
								<td class="text-left">'.$page[2].'</td>
								<td class="text-left">'.$page[3].'</td>
							</tr>';
						} } ?>
						</tbody>
					</table>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			<?php } ?>
			</div>
			<div class="col-lg-4">
			<?php if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) { ?>
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title pull-left"><i class="fa fa-file-code-o" aria-hidden="true"></i> <?=lang('Global.dashboard.analytics.popular_pages_text');?></h4>
				    <span class="pull-right text-info"><i class="fa fa-info" aria-hidden="true"></i> <small class="text-info"><?=lang('Global.dashboard.analytics.popular_pages_info_text');?></small></a>
				  </header><!-- .widget-header -->
				  <hr class="widget-separator">
				  <div class="widget-body">
					<table id="default-datatable" class="table table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="text-left"><?=lang('Global.dashboard.analytics.page_title_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.page_url_text');?></th>
								<th class="text-left"><?=lang('Global.dashboard.analytics.visitor_total_text');?></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (! empty($visitor['popular_pages_thismonth']) && is_array($visitor['popular_pages_thismonth'])) {
						foreach ($visitor['popular_pages_thismonth'] as $page) {
							echo'
							<tr>
								<td class="text-left">'.$page[0].'</td>
								<td class="text-left">'.$page[1].'</td>
								<td class="text-left">'.$page[2].'</td>
							</tr>';
						} } ?>
						</tbody>
					</table>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
			<?php if ((!empty(siteSet('gAnalytics_ViewId'))) OR (siteSet('gAnalytics_ViewId') != 0) ) { ?>
				<div class="widget">
				  <header class="widget-header">
				    <h4 class="widget-title pull-left"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?=lang('Global.dashboard.realtime_visitor_text');?></h4>
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
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			<?php } ?>
			</div>
		</div>
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
