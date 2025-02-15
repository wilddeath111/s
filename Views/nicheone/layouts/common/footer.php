<?php
$footer_pages = footerPages();
echo siteSet('footer_code');
?>
<?php if (siteSet('recaptcha_status') == 'active') { echo '<script src="https://www.google.com/recaptcha/api.js?render='.siteSet('recaptcha_site_key').'"></script>'; } ?>

   </main>
    <footer class="text-muted py-5">
      <div class="container">
        <p class="float-end mb-1"><a href="#" class="no-underline"><?=lang('Site.back_to_top_text');?></a></p>
        <p class="mb-1"><?=siteSet('footer_copyright');?></p>
        <p class="mb-0 footerPages">
        <?php foreach ($footer_pages as $f_page) {
            echo '<a class="no-underline" href="'.getpageSeoUrl($f_page->seo_name, $f_page->_id).'" title="'.$f_page->name.'">'.$f_page->name.'</a> | ';
        }
        ?>
        </p>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
    <script src="/public/layouts/lazyload.js"></script>
    <script>
      $(function () {
       $("img.lazy").lazyload({
           effect: "fadeIn"
       });
    });
    </script>

  </body>
</html>
