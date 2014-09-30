<?php $this->render("templates/header_admin"); ?>

<section class="admin admin-travel-create">
<div class="title">New Travel</div>

<form class="form" action="/admin/travel/create" method="post">
	<div class="row row-name">
		<div class="cell cell-15"><label class="label" for="id">이름</label></div>
		<div class="cell cell-85"><input class="input" type="text" name="name" id="name"></div>
	</div>
	<div class="row row-link">
		<div class="cell cell-15"><label class="label" for="link">링크</label></div>
		<div class="cell cell-85"><input class="input" type="text" name="link" id="link"></div>
	</div>
	<div class="row row-description">
		<div class="cell cell-15"><label class="label" for="description">설명</label></div>
		<div class="cell cell-85"><input class="input" type="text" name="description" id="description"></div>
	</div>
	<div class="row row-start">
		<div class="cell cell-15"><label class="label" for="start">시작일</label></div>
		<div class="cell cell-85">
			<div class="row row-start-input">
				<div class="cell cell-30">
					<input type="number" name="start_y">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="start_m">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="start_d">
				</div>
			</div>
		</div>
	</div>
	<div class="row row-end">
		<div class="cell cell-15"><label class="label" for="end">종료일</label></div>
		<div class="cell cell-85">
			<div class="row row-end-input">
				<div class="cell cell-30">
					<input type="number" name="end_y">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="end_m">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="end_d">
				</div>
			</div>
		</div>
	</div>
	<div class="form-row">
		<button class="button" type="submit">만들기</button>
	</div>
</form>
</section>

<script src="/assets/js/jquery-2.1.1.min.js"></script>
<script src="/assets/js/page_travel_create.js"></script>

<?php $this->render("templates/footer"); ?>