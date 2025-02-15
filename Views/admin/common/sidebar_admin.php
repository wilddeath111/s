 <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
        <li>
          <a href="/admin/dashboard">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.menu.dashboard_text'); ?></span>
          </a>
        </li>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-badge-check zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.menu.blogs_text');?></span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="/admin/blog/list"><span class="menu-text"><i class="menu-icon zmdi zmdi-collection-item zmdi-hc-lg"></i><?=lang('Global.menu.bloglist_text'); ?></span></a></li>
            <li><a href="/admin/blog/publish-day-list/<?=date('Y-m-d');?>"><span class="menu-text"><i class="menu-icon zmdi zmdi-calendar-alt zmdi-hc-lg"></i><?=lang('Global.menu.publish_blogs_day_text'); ?></span></a></li>
            <li><a href="/admin/blog/publish-list"><span class="menu-text text-success"><i class="menu-icon zmdi zmdi-collection-text zmdi-hc-lg"></i><?=lang('Global.menu.publish_blogs_text'); ?></span></a></li>
            <li><a href="/admin/blog/pending-list"><span class="menu-text text-danger"><i class="menu-icon zmdi zmdi-collection-bookmark zmdi-hc-lg"></i><?=lang('Global.menu.pending_bloglist_text'); ?></span></a></li>
            <li><a href="/admin/blog/add"><span class="menu-text"><i class="menu-icon zmdi zmdi-collection-plus zmdi-hc-lg"></i><?=lang('Global.menu.blog_add_text'); ?></span></a></li>
            <li><a href="/admin/blog/csv-import"><span class="menu-text"><i class="menu-icon zmdi zmdi-cloud-upload zmdi-hc-lg"></i><?=lang('Global.menu.csv_import_text'); ?></span></a></li>
            <li><a href="/admin/blog/keyword-blog-add"><span class="menu-text"><i class="menu-icon zmdi zmdi-view-list zmdi-hc-lg"></i><?=lang('Global.menu.keywords_blog_add_text'); ?></span></a></li>
            <li><a href="/admin/author/list"><span class="menu-text"><i class="menu-icon zmdi zmdi-accounts-list zmdi-hc-lg"></i><?=lang('Global.menu.author_list_text'); ?></span></a></li>
          </ul>
        </li>
      <?php if (siteSet('blog_comments') == 'active') { ?>
        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-comment-list zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.menu.comments_text');?></span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="/admin/comments/list"><span class="menu-text"><i class="menu-icon zmdi zmdi-comment-more zmdi-hc-lg"></i><?=lang('Global.menu.commentslist_text'); ?></span></a></li>
            <li><a href="/admin/comments/pending-list"><span class="menu-text"><i class="menu-icon zmdi zmdi-comment-outline zmdi-hc-lg"></i><?=lang('Global.menu.comments_pendinglist_text'); ?></span></a></li>
          </ul>
        </li>
      <?php } ?>
        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-image zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.menu.photos_pool_text');?></span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="/admin/photospool/list"><span class="menu-text"><i class="menu-icon zmdi zmdi-collection-image zmdi-hc-lg"></i><?=lang('Global.menu.photopoollist_text'); ?></span></a></li>
            <li><a href="/admin/photospool/keyword-add"><span class="menu-text"><i class="menu-icon zmdi zmdi-collection-plus zmdi-hc-lg"></i><?=lang('Global.menu.photopool_add_text'); ?></span></a></li>
          </ul>
        </li>


        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-chart zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.menu.report_text');?></span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="/admin/analytics/index"><span class="menu-text"><i class="menu-icon zmdi zmdi-chart zmdi-hc-lg"></i><?=lang('Global.menu.analytics_text'); ?></span></a></li>
          </ul>
        </li>
        <li class="menu-separator"><hr></li>
        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.profile.admin_profile_text');?></span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="/admin/profile"><span class="menu-text"><i class="menu-icon zmdi zmdi-account-box zmdi-hc-lg"></i><?=lang('Global.profile.my_profile_text'); ?></span></a></li>
            <li><a href="/admin/site-settings"><span class="menu-text"><i class="menu-icon zmdi zmdi-code-setting zmdi-hc-lg"></i><?=lang('Global.profile.site_settings_text'); ?></span></a></li>
            <li><a href="/admin/caches"><span class="menu-text"><i class="menu-icon zmdi zmdi-network zmdi-hc-lg"></i><?=lang('Global.menu.caches_text'); ?></span></a></li>
          </ul>
        </li> 

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-collection-text zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.menu.pages_text');?></span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="/admin/page/index"><span class="menu-text"><i class="menu-icon zmdi zmdi-collection-item zmdi-hc-lg"></i><?=lang('Global.menu.pagelist_text'); ?></span></a></li>
            <li><a href="/admin/page/add"><span class="menu-text"><i class="menu-icon zmdi zmdi-collection-plus zmdi-hc-lg"></i><?=lang('Global.menu.page_add_text'); ?></span></a></li>
          </ul>
        </li>
        
        <li>
          <a href="/admin/logs" class="text-danger" style="font-weight: bold">
            <i class="menu-icon zmdi zmdi-accounts-list-alt zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.menu.logs_text'); ?></span>
          </a>
        </li> 

        <li>
          <a href="/logout" class="text-success">
            <i class="menu-icon zmdi zmdi-lock zmdi-hc-lg"></i>
            <span class="menu-text"><?=lang('Global.logout_text'); ?></span>
          </a>
        </li>
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div>
