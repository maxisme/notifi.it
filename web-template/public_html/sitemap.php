<?php
Header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');

//////////////
// get timestamp of latest edited page on website
//////////////
$timestamp = filemtime("index.php");
$files = glob('pages/*.{html,php}', GLOB_BRACE);
foreach($files as $file) {
    $file_time = filemtime($file);
    if($file_time > $timestamp) $timestamp = $file_time;
}
//////////////

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">
<url>
  <loc>https://".$_SERVER['HTTP_HOST']."/</loc>
  <lastmod>".date('c', $timestamp)."</lastmod>
  <changefreq>monthly</changefreq>
</url>
</urlset>
";
