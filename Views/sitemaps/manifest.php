{
  "name": "<?=siteSet('site_name');?>",
  "short_name": "<?=siteSet('site_name');?>",
  "description": "<?=siteSet('description');?>",
  "start_url": "<?=getenv('app.baseURL');?>",
  "orientation": "any",
  "lang": "<?=siteSet('site_language');?>",
  <?php if (!empty(siteSet('android_icon'))) { ?>
  "icons": [
    {
      "src": "<?=getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon');?>-36x36.png",
      "sizes": "36x36",
      "type": "image/png"
    },
    {
      "src": "<?=getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon');?>-48x48.png",
      "sizes": "48x48",
      "type": "image/png"
    },
    {
      "src": "<?=getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon');?>-72x72.png",
      "sizes": "72x72",
      "type": "image/png"
    },
    {
      "src": "<?=getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon');?>-96x96.png",
      "sizes": "96x96",
      "type": "image/png"
    },
    {
      "src": "<?=getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon');?>-144x144.png",
      "sizes": "144x144",
      "type": "image/png"
    },
    {
      "src": "<?=getenv('site.cdnUrl').'/public/upload/icon/'.siteSet('android_icon');?>-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    }
  ],
<?php } ?>
  "url": "<?=getenv('app.baseURL');?>",
  "screenshots": [
    {
      "src": "[Embedded]",
      "sizes": "1280x800",
      "type": "image/png"
    },
    {
      "src": "[Embedded]",
      "sizes": "750x1334",
      "type": "image/png"
    }
  ],
  "display": "fullscreen"
}
