<article class="checkin">

<div class="image">
<?php if($image !== false) { ?>
	<img src="<?php echo $image; ?>">
<?php } else { ?>
	<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $venue[0]; ?>,<?php echo $venue[1]; ?>&zoom=13&size=638x360&maptype=roadmap&sensor=false&key=<?php echo $this->config["google"]["key"] ?>">
<?php } ?>
</div>

<div class="content">
	<h1 class="venue">
		<span class="js-geomicon geomicon-sm" data-icon="pin"></span>
		<?php echo $venue[2]; ?>
	</h1>
<?php
if($content !== "") {
	echo Parsedown::instance()->text($content);
}
?>
</div>

<div class="info">
	<a href="<?php echo $permalink; ?>"><?php echo date("Y-m-d H:i:s", $time); ?></a>
</div>

</article>
