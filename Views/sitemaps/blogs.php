<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php foreach ($blogs as $blog) {
  echo '<url>
  <loc>'.getblogSeoUrl($blog['seo_name'], $blog['_id']).'</loc>
  <lastmod>'.date('Y-m-d', strtotime($blog['create_date'])).'</lastmod>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>';
} ?>
</urlset>
