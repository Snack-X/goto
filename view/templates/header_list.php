<?php

$this->render("templates/header", array(
	"title" => "goto",
	"head" => array_merge($head, array("css" => array("/assets/css/page_public.min.css")))
));

?>
<header>
<h1 class="title"><a href="/"><span class="goto">goto</span></span></a></h1>
<h2 class="description">Your Simple Travel Note.</h2>
<div class="more">
<div class="icon"></div> <span class="name">Snack</span>
</div>
</header>