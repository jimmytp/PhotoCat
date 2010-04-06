<?php
require_once("phpFlickr/phpFlickr.php");
$f = new phpFlickr("44449d9d74ed80abe095ab2a6f137dbe","abde3a1309b8d8e1");

$sets = $f->photosets_getList('28973605@N00');

include "header.php";
include "sidebar.php";
?>
<div id="main_right">
	<ul id="cat_title_links">
<?
foreach ($sets['photoset'] as $set) {
	echo '<li><a id="'.$set['id'].'" href="#" class="catTitle">'.$set['title'].'</a></li>';
}
?>
	</ul>
	<div id="cat_box">
<?
foreach ($sets['photoset'] as $set) {
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
	echo "<div class='cat' id='cat_".$photo['set_id']."'><h3>".$photo['title']."</h3>"
		."<div class='cat_image'><img src='".$f->buildPhotoURL($photo, "small")."' alt='".$photo['title']."' /></div>"
		."<p>".$photo['description']."</p><a class='more' href='gallery.php?id=".$photo['set_id']."'>看看我們的產品吧→</a></div>";
}
?>
	</div>
</div>
<script type="text/javascript">
(function() {
	$('#cat_box .cat:first').show();
	$('.catTitle').click(function() {
		$('.cat').hide();
		$('#cat_' + $(this).attr('id')).fadeIn();
	});
	$('.setBox a.more').click(function() {
		alert($(this).attr('set_id'));
		return false;
	});
})();
</script>
<? include "footer.php"; ?>
