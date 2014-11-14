<?php $this->render("templates/header_list", array("head" => array())); ?>
<link rel="stylesheet" href="/assets/style_error.min.css">

<div class="error-message">
	<p>Goto can't load that page. It's not server problem. <strong>You</strong> are the problem.</p>
<?php if($message !== "") { ?>
	<p class="small">In fact, <?php echo $message; ?></p>
<?php } ?>
</div>

<?php $this->render("templates/footer"); ?>
