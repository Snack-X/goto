<article class="note">

<?php if($image !== false) { ?>
<div class="image">
<?php foreach($image as $i) { ?>
	<img src="<?php echo $i; ?>">
<?php } ?>
</div>
<?php } ?>

<div class="content">
	<?php echo Parsedown::instance()->text($content); ?>
</div>

<div class="info">
	<a href="<?php echo $permalink; ?>"><?php echo date("Y-m-d H:i:s", $time); ?></a>
</div>

</article>
