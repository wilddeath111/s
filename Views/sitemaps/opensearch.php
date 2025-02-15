<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:moz="http://www.mozilla.org/2006/browser/search/">
<ShortName><?=siteSet('site_name');?></ShortName>
<Description><?=siteSet('description');?></Description>
<InputEncoding>UTF-8</InputEncoding>
<Image width="16" height="16" type="image/x-icon"><?=getenv('site.cdnUrl')?>/public/upload/favicon/<?=siteSet('site_favicon');?></Image>
<Url type="text/html" method="get" template="<?=getenv('app.baseURL').'/search/{searchTerms}';?>"/>
</OpenSearchDescription>
