<?php
include('simple_html_dom.php');
$target_url = 'https://moviesverse.com/download-a-hard-day-2014-hindi-480p-720p/'; //Insert Target URL from https://moviesverse.com
$html = new simple_html_dom();
$html->load_file($target_url);
foreach($html->find("div[class=thecontent clearfix]") as $link)
{
	$item['movieThumbnail'] = $link->find("img", 0)->src;
	$movieThumbnail = html_entity_decode(trim($item['movieThumbnail']));
	echo '<center><img src="'.$movieThumbnail.'"/></center><br>';
	$item['movieStoryLine'] = $link->find("p", 2)->plaintext;
	$movieStoryLine = html_entity_decode(trim($item['movieStoryLine']));
	echo "<h3>Fetched Movie Story Line: </h3>".$movieStoryLine."<br>";
	$item['movieInfo'] = $link->find("ul", 0);
	$movieInfo = html_entity_decode(trim($item['movieInfo']));
	echo "<h3>Fetched Movie Info: </h3>".$movieInfo."<br>";
	echo "<center><h3>Fetched Movie Screenshots: </h3></center>";
	for($i = 1 ; $i <= 3 ; $i++)
	{
		$item['movieScreenshots'] = $link->find("img", $i)->src;
		$movieScreenshots = html_entity_decode(trim($item['movieScreenshots']));
		echo '<center><img src="'.$movieScreenshots.'" width="400" height="200"/></center><br></br>';
	}
}
foreach($html->find("div[class=inline canwrap]") as $link)
{
	for($i = 0 ; $i <= 2 ; $i++)
	{
		$item['movieDownload'] = $link->find("h4", $i);
		$movieDownload = html_entity_decode(trim($item['movieDownload']));
		echo $movieDownload."<br>";
		$item['movieDownloadLink'] = $link->find("a", $i);
		$movieDownloadLink = html_entity_decode(trim($item['movieDownloadLink']));
		echo "<center>".$movieDownloadLink."</center><br>";
	}
}
?>
