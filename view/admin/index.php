<?php $this->render("templates/header_admin"); ?>

<section class="admin admin-index">
<div class="title">Menu</div>

<div class="menu">
	<a class="item item-note" href="#">노트 작성</a>
	<div class="item row note-menu">
		<a class="cell cell-50" href="/admin/write/checkin">체크인</a>
		<a class="cell cell-50" href="/admin/write/note">노트</a>
	</div>
	<a class="item" href="/admin/travel">여행 관리</a>
</div>
</section>

<script src="/assets/js/page_admin_index.min.js"></script>

<?php $this->render("templates/footer"); ?>