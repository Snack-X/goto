<?php

$this->render("templates/header_list", array(
	"css" => array("/assets/css/page_public.min.css"),
	"head" => array(
		"meta" => array(
			"twitter:card" => "summary",
			"twitter:site" => $this->config["global"]["base_url"],
			"twitter:title" => "goto",
			"twitter:description" => "Your Simple Travel Note",
			"twitter:url" => $this->config["global"]["base_url"]
		)
	)
));

?>

<section class="travels">
<div class="title">My goto</div>

<?php foreach($travels as $travel) { ?>
<a class="travel" href="/<?php echo $travel["link"] ?>">
	<div class="title">goto:<strong><?php echo $travel["name"] ?></strong></div>
	<div class="description"><?php echo $travel["description"] ?></div>
	<div class="date"><?php echo substr($travel["start"], 0, 10); ?> ~ <?php echo substr($travel["end"], 0, 10); ?></div>
</a>
<?php } ?>
</section>

<?php $this->render("templates/footer"); ?>