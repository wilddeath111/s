<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="robots" content="noindex,nofollow">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<link rel="shortcut icon" sizes="32x32" href="/public/upload/favicon/<?=siteSet('site_favicon');?>">
	<title><?=siteSet('site_name').' - '.lang('Global.system_title');?></title>
	<link rel="stylesheet" href="/public/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="/public/admin/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
	<!-- build:css ../assets/css/app.min.css -->
	<link rel="stylesheet" href="/public/admin/animate.css/animate.min.css">
	<link rel="stylesheet" href="/public/admin/libs/bower/fullcalendar/dist/fullcalendar.min.css">
	<link rel="stylesheet" href="/public/admin/libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
  <link rel="stylesheet" href="/public/admin/css/bootstrap.css">
  <link rel="stylesheet" href="/public/admin/css/core.css">
	<link rel="stylesheet" href="/public/admin/css/app.css">
  <link rel="stylesheet" href="/public/admin/css/custom.css">
  <link rel="stylesheet" href="/public/admin/css/jquery.toast.css">
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<script src="/public/admin/libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
	<script>
		Breakpoints();
	</script>
</head>
<style>
[class*="col-"] {
    padding-right: 0.3rem;
    padding-left: 0.3rem;
}
</style>
<?php if (siteSet('onesignal_notify_status') == 'active') { ?>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" defer></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "6fa4ec31-149e-49a8-bd07-3f0623f2a13f",
    });
  });

  OneSignal.push(function() {
    OneSignal.getUserId().then(function(userId) {
        console.log("Kullanıcı kimliği (Player ID):", userId);
    });
  });
</script>
<?php } ?>
<body class="menubar-left menubar-unfold menubar-light theme-danger">
<!--============= start main area -->

<!-- APP NAVBAR ==========-->
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top danger">
  
  <!-- navbar header -->
  <div class="navbar-header">
    <button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
      <span class="sr-only">Toggle navigation</span>
      <span class="hamburger-box"><span class="hamburger-inner"></span></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-more"></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-search"></span>
    </button>

    <a <?php if (session()->get('user_type') == 'admin') { echo 'href="/admin/dashboard"'; } else { echo 'href="/user/dashboard"'; } ?> class="navbar-brand">
      <span class="brand-icon"><i class="fa fa-gg"></i></span>
      <span class="brand-name"><?=getenv('app.systemName');?></span>
    </a>
  </div>
  
  <div class="navbar-container container-fluid">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
        <li class="hidden-float hidden-menubar-top">
          <a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
          </a>
        </li>
        <li>
          <h5 class="page-title hidden-menubar-top hidden-float">Dashboard</h5>
        </li>
      </ul>

      <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-notifications"></i></a>
          <div class="media-group dropdown-menu animated flipInY notification-items" style="width: 320px !important;">
          </div>
        </li>

        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-settings"></i></a>
          <ul class="dropdown-menu animated flipInY">
            <?php
            if (session()->get('user_type') == 'admin') {
              echo '<li><a href="/admin/profile"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>'.lang('Global.profile_text').'</a></li>';
              echo '<li><a href="/admin/delete-cache"><i class="zmdi m-r-md zmdi-hc-lg zmdi-refresh-sync"></i>'.lang('Global.all_delete_cache_text').'</a></li>';
            } else {
              echo '<li><a href="/user/profile"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>'.lang('Global.profile_text').'</a></li>';
            } ?>
            <?php if (session()->get('user_type') == 'admin') { echo '<li><a href="'.getenv('app.baseURL').'" target="_blank"><i class="zmdi m-r-md zmdi-hc-lg zmdi-pin-assistant"></i>'.lang('Global.header_quick.gosite_text').'</a></li>'; } ?>
            <li><a href="/logout" class="text-success"><i class="zmdi m-r-md zmdi-hc-lg zmdi-lock"></i><?=lang('Global.logout_text'); ?></a></li>
            
          </ul>
        </li>
      </ul>
    </div>
  </div><!-- navbar-container -->
</nav>
<!--========== END app navbar -->

<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="/public/admin/images/221.jpg" alt="avatar"/></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          <h5><a href="javascript:void(0)" class="username"><?=session()->get('name') ?></a></h5>
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <small></small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="/<?=session()->get('user_type');?>/dashboard">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span><?=lang('Global.home_text'); ?></span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="/<?=session()->get('user_type');?>/profile">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span><?=lang('Global.profile_text'); ?></span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="/logout">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span><?=lang('Global.logout_text'); ?></span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->
<?php echo view('admin/common/sidebar_left'); ?>
</aside>
<!--========== END app aside -->
