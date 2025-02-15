<!--========== END app main -->
	<!-- build:js ../assets/js/core.min.js -->
	<script src="/public/admin/libs/bower/jquery/dist/jquery.js"></script>
	<script src="/public/admin/libs/bower/jquery-ui/jquery-ui.min.js"></script>
	<script src="/public/admin/libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
	<script src="/public/admin/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
	<script src="/public/admin/libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="/public/admin/libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="/public/admin/libs/bower/PACE/pace.min.js"></script>
	<!-- endbuild -->
	<!-- build:js ../assets/js/app.min.js -->
	<script src="/public/admin/js/library.js"></script>
	<script src="/public/admin/js/plugins.js"></script>
	<script src="/public/admin/js/app.min.js"></script>
	<!-- endbuild -->
	<script src="/public/admin/libs/bower/moment/moment.js"></script>
	<script src="/public/admin/libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="/public/admin/js/fullcalendar.js"></script>
  <script type="text/javascript" src="/public/admin/js/jquery.toast.js"></script>

<script>
var maintitle = "<?=siteSet('site_name');?>"

function refreshNotifications() {
  $.ajax({
    url:"/refreshNotifications",
    success:function(response) {
      if (response.count > 0) {
        $('.badge.badge-notify').text(response.count);
        $('.badge.badge-notify').css('visibility', 'visible');

        let notifications = JSON.parse(response.notifications)

        let htmlData = '';
        notifications.forEach(function(element) {
          let flag = '';
          if (element.Flag === 'info') {
            flag = '<span class="badge badge-info"><i class="fas fa-info"></i></span>';
          } else if (element.Flag === 'warn') {
            flag = '<span class="badge badge-warning"><i class="fas fa-exclamation"></i></span>';
          } else if (element.Flag === 'error') {
            flag = '<span class="badge badge-danger"><i class="fas fa-times"></i></span>';
          }

          htmlData += `
          <li class="${element.Seen ? 'seen' : ''}">
              <a href="/panel/user/notifications/${element.Id}">
                  <div class="level">
                      <div class="flex badges">
                          ${flag}
                      </div>
                      <div class="flex">
                          <small class="" style="color: #1d2129;">${element.Message}</small>
                          <div>
                              <i class="far fa-clock text-muted"></i> <small class="text-muted align-middle notification-date">${moment(element.Date).fromNow()}</small>
                          </div>
                      </div>
                  </div>
              </a>
          </li>`
        });

        $('.notification-items').html(htmlData);
      }
    },
    error:function(){
      console.log("error");
    }
  });
}

$(function(){
	var notification = $('.notiy');
	if (notification.length> 0) {
		refreshInterval = setInterval(function() { refreshNotifications() }, 60000);
	}
	jQuery(window).focus(function() {
		document.title = maintitle
		if (notification.length> 0) {
		refreshInterval = setInterval(60000);
		}
	}).blur(function() {
		//clearInterval(refreshInterval)
		document.title = "Çıkış Yapmayı Unutma! - Control Panel"
	})
});
</script>

<?php
if (!empty(session()->get('toast_title'))) {
  echo toast(session()->get('toast_title'));
  unset($_SESSION['toast_title']);
} else if (!empty($alert)) {
  echo toast($alert);
}
?>
</body>
</html>
