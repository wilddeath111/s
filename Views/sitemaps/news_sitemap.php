<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" >
<?php foreach ($blogs as $blog) {
  echo '<url>

  <loc>'.getblogSeoUrl($blog['seo_name'], $blog['_id']).'</loc>
<news:news>
<news:publication>
<news:name>'.siteSet('site_publication_name').'</news:name>
<news:language>'.siteSet('site_language').'</news:language>
</news:publication>
<news:publication_date>'.date('Y-m-d\TH:i:sP', strtotime($blog['update_date'])).'</news:publication_date>
<news:title><![CDATA['.$blog['title'].']]></news:title>
<news:keywords><![CDATA['.$blog['keywords'].']]></news:keywords>
  <lastmod>'.date('Y-m-d\TH:i:sP', strtotime($blog['update_date'])).'</lastmod>

</news:news>
</url>';
} ?>
</urlset>




