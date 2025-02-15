<?xml version="1.0"?>
<rss version="2.0">
	<channel>
		<title><?=siteSet('site_name');?></title>
		<description><?=siteSet('description');?></description>
	<?php foreach ($blogs as $blog) {
		echo '<item>
			<title>'.specialCharClear($blog['title']).'</title>
			<description>'.specialCharClear($blog['description']).'</description>
			<tags>'.specialCharClear($blog['keywords']).'</tags>
			<pubDate>'.date('Y-m-d H:i:s', strtotime($blog['create_date'])).'</pubDate>
			<guid>'.$blog['_id'].'</guid>
			<link>'.getblogSeoUrl($blog['seo_name'], $blog['_id']).'</link>
			<image>'.getBlogImage($blog['image']).'</image>
		</item>';
	} ?>

	</channel>
</rss>
	
