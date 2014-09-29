<?php $this->render("templates/header_travel", array("travel" => $travel)); ?>

<section class="articles">
<?php
foreach($notes as $note) {
	$data = unserialize($note["data"]);
	$data["permalink"] = "/".$travel["link"]."/".$note["id"];
	$data["time"] = $note["time"];

	if($note["type"] === "checkin") {
		$this->render("public/_checkin", $data);
	}
	else if($note["type"] === "note") {
		$this->render("public/_note", $data);
	}
}
?>
</section>

<section class="pagination">
<?php
for($p = 1 ; $p <= $count_pages ; $p++) {
	if($page === $p) {
		echo "<span class=\"current\">".$p."</span>";
	}
	else {
		$link = "/".$travel["link"]."?page=".$p;
		if($direction === "ASC") $link .= "&from=old";

		echo "<a href=\"".$link."\">".$p."</a>";
	}
}
?>
<br>
<?php
if($direction === "ASC") {
	$link = "/".$travel["link"];
	echo "<a href=\"$link\">최근 노트부터 보기</a>";
}
else {
	$link = "/".$travel["link"]."?from=old";
	echo "<a href=\"$link\">오래된 노트부터 보기</a>";
}
?>
</section>

<?php $this->render("templates/footer"); ?>