<?php $this->render("templates/header_travel", array("travel" => $travel)); ?>

<section class="articles">
<?php
$data = unserialize($note["data"]);
$data["permalink"] = "/".$travel["link"]."/".$note["id"];
$data["time"] = $note["time"];

if($note["type"] === "checkin") {
	$this->render("public/_checkin", $data);
}
else if($note["type"] === "note") {
	$this->render("public/_note", $data);
}
?>
</section>

<?php $this->render("templates/footer"); ?>