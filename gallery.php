<?php
if(!isset($_GET['id'])) header('Location:index.php');
require_once("phpFlickr/phpFlickr.php");
$f = new phpFlickr("44449d9d74ed80abe095ab2a6f137dbe","abde3a1309b8d8e1");
$photos = $f->photosets_getPhotos($_GET['id']);
if(sizeof($photos['photoset']['photo'])<=0) header('Location:index.php');
$p = $f->photosets_getInfo($photos['photoset']['id']);
$set_title = $p['title'];
include "header.php";
//include "sidebar.php";
?>
<div id="main_left">
	<img src="<?=$f->buildPhotoURL($photos['photoset']['photo'][0], 'medium')?>" />
</div>
<div id="main_right">
	<ul id="gallery" class="gallery">
<?
$i = 0;
foreach ((array)$photos['photoset']['photo'] as $photo) {
	//echo 'photo:'.$photo.'<hr />';
	echo "<li><a href='".$f->buildPhotoURL($photo, "medium")."' title='".$photo['title']."'>";
	echo "<img alt='".$photo['title']."' "."src='" . $f->buildPhotoURL($photo, "square")."' /></a></li>";
	$i++;
}
?>
	</ul>
</div>
<script type="text/javascript">
(function() {
	$('#gallery a').lightBox({fixedNavigation:true});
})();
</script>
<? include "footer.php"; ?>
