<?php
require_once("phpFlickr/phpFlickr.php");
$f = new phpFlickr("44449d9d74ed80abe095ab2a6f137dbe","abde3a1309b8d8e1");
/*
$f->enableCache(
	"db",
	"mysql://[username]:[password]@[server]/[database]"
);
 */
$photos_url = $f->urls_getUserPhotos('28973605@N00');
$photos = $f->people_getPublicPhotos('28973605@N00', NULL, NULL, 11);
$sets = $f->photosets_getList('28973605@N00')
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="./css/reset-min.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="./css/jquery.lightbox-0.5.css" type="text/css" media="screen" />
<title>上禾友</title>
<script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/jquery.lightbox-0.5.min.js"></script>
<script type="text/javascript">
(function() {
	$(document).ready(function() {
		$('#gallery a').lightBox({fixedNavigation:true});
		$('.setBox a.more').click(function() {
			alert($(this).attr('set_id'));
			return false;
		});
	});
})();
</script>
</head>
<body>
<div id="mother_box">
<?
print_r($set['photoset']);
foreach ($sets['photoset'] as $set) {
	//print_r($set);
	$photo = array(
		'set_id' => $set['id'],
		'id' => $set['primary'],
		'owner' => '28973605@N00',
		'secret' => $set['secret'],
		'server' => $set['server'],
		'farm' => $set['farm'],
		'title' => $set['title'],
		'description' => $set['description']
	);
	//print_r($photo);
	echo "<div class='setBox'><h3>".$photo['title']."</h3><img src='".
			$f->buildPhotoURL($photo, "small")."' /><p>".$photo['description']
			."</p><a class='more' href='#' set_id='".$photo['set_id']."'>瀏覽此分類照片</a></div>";
}
?>
<ul id="gallery" class="gallery">
<?
$i = 0;
foreach ((array)$photos['photos']['photo'] as $photo) {
	//echo 'photo:'.$photo.'<hr />';
	echo "<li><a href='".$f->buildPhotoURL($photo, "medium")."' title='$photo[title]'>";
	echo	"<img alt='$photo[title]' ".
			"src='" . $f->buildPhotoURL($photo, "square").
			"' /></a></li>";
	$i++;
}
?>
</ul>
</div>
<!--
<?
print_r($sets);
//print_r($photos);
//print_r($f->photosets_getPhotos('72157606847890009'));
?>
-->

</body>
</html>
