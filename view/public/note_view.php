<?php

$meta_title = "goto:".$travel["name"];
$meta_url = $this->config["global"]["base_url"]."/".$travel["link"]."/".$note["id"];

// meta description process start
$data = unserialize($note["data"]);

$content = $data["content"];
$content = Parsedown::instance()->text($content);
$content = strip_tags($content);
if(mb_strlen($content, "UTF-8") >= 150) {
	$content = trim(mb_substr($content, 0, 150, "UTF-8"))."...";
}

if($note["type"] === "checkin") {
	$location = $data["venue"][2];
	$meta_description = "(@ ".$location.")";

	if($content !== "") {
		$meta_description = $content." ".$meta_description;
	}
}
else if($note["type"] === "note") {
	$meta_description = "See my travel note at goto.";

	if($content !== "") {
		$meta_description = $content;
	}
}
// meta description process done

var_dump($data);

$meta = array(
	"description" => $meta_description,
	"twitter:card" => "summary",
	"twitter:site" => $this->config["global"]["base_url"],
	"twitter:title" => $meta_title,
	"twitter:description" => $meta_description,
	"twitter:url" => $meta_url,
	"og:title" => $meta_title,
	"og:description" => $meta_description,
	"og:url" => $meta_url
);

// meta image process start
if($data["image"] !== false) {
	if(is_array($data["image"])) $meta_image = $data["image"][0];
	else $meta_image = $data["image"];

	$meta["twitter:image"] = $meta_image;
	$meta["og:image"] = $meta_image;
}
// meta image process done

$this->render("templates/header_travel", array(
	"travel" => $travel,
	"head" => array("meta" => $meta)
));

?>

<section class="articles">
<?php
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