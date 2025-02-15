<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=siteSet('site_name');?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<link rel="shortcut icon" sizes="196x196" href="/public/admin/images/logo.png">
	<link rel="stylesheet" href="/public/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="/public/admin/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="/public/admin/animate.css/animate.min.css">
	<link rel="stylesheet" href="/public/admin/css/bootstrap.css">
	<link rel="stylesheet" href="/public/admin/css/core.css">
	<link rel="stylesheet" href="/public/admin/css/misc-pages.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<meta name="robots" content="noindex,nofollow">
</head>
<body class="simple-page">
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="/">
				<span><i class="fa fa-gg"></i></span>
				<span><?=siteSet('site_name');?></span>
			</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center"><?=lang('Global.system_title'); ?></h4>
        <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
			<form action="/login" method="POST">
				<div class="form-group">
					<input id="sign-in-email" name="email" type="email" class="form-control" placeholder="<?=lang('Global.email_text'); ?>">
				</div>

				<div class="form-group">
					<input id="sign-in-password" name="password" type="password" class="form-control" placeholder="<?=lang('Global.password_text'); ?>">
				</div>
				<button type="submit" class="btn btn-lg btn-success"><?=lang('Global.login_text'); ?></button>
			</form>
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
		</div><!-- #login-form -->
	</div><!-- .simple-page-wrap -->
</body>
</html>
