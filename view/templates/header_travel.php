<?php $this->render("templates/header", array("title" => "goto:".$travel["name"])); ?>
<link rel="stylesheet" href="/assets/style_public.css">
<header class="travel">
<h1 class="title"><a href="/<?php echo $travel["link"]; ?>"><span class="goto">goto</span><span class="colon">:</span><span class="location"><?php echo $travel["name"] ?></span></a></h1>
<h2 class="description"><?php echo $travel["description"] ?></h2>
<div class="more">
<a href="/"><div class="icon"></div> <span class="name">Snack</span></a>
<span class="date"> / <?php echo substr($travel["start"], 0, 10); ?> ~ <?php echo substr($travel["end"], 0, 10); ?></span>
</div>
</header>