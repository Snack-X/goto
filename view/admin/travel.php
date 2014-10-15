<?php $this->render("templates/header_admin"); ?>

<section class="admin admin-travel-list">
<div class="title">Travel List</div>

<div class="menu">
	<?php foreach($travels as $travel) { ?>
	<div class="item row">
		<a class="cell cell-70" href="/<?php echo $travel["link"] ?>" target="_blank">
			goto:<strong><?php echo $travel["name"] ?></strong><br>
			<span class="small"><?php echo $travel["description"] ?></span>
		</a>
		<a class="cell cell-15" href="/admin/travel/update/<?php echo $travel["id"] ?>">수정</a>
		<a class="cell cell-15 travel-delete" data-href="/admin/travel/delete/<?php echo $travel["id"] ?>">삭제</a>
	</div>
	<?php } ?>
</div>

<a class="button" href="/admin/travel/create">새로운 여행</a>
</section>

<script src="/assets/js/jquery-2.1.1.min.js"></script>
<script>
$(function() {
$(".travel-delete").click(function() {
	if(confirm("정말로 이 여행을 삭제하시겠습니까?")) {
		location.href = $(this).data("href");
	}
});
});
</script>

<?php $this->render("templates/footer"); ?>