<?php $this->render("templates/header_admin"); ?>

<section class="admin admin-travel-update">
<div class="title">Edit Travel</div>

<form class="form" action="/admin/travel/update/<?php echo $travel["id"] ?>" method="post">
	<div class="row row-name">
		<div class="cell cell-15"><label class="label" for="id">이름</label></div>
		<div class="cell cell-85"><input class="input" type="text" name="name" id="name" value="<?php echo $travel["name"] ?>"></div>
	</div>
	<div class="row row-link">
		<div class="cell cell-15"><label class="label" for="link">링크</label></div>
		<div class="cell cell-85"><input class="input" type="text" id="link" disabled value="<?php echo $travel["link"] ?>"></div>
	</div>
	<div class="row row-description">
		<div class="cell cell-15"><label class="label" for="description">설명</label></div>
		<div class="cell cell-85"><input class="input" type="text" name="description" id="description" value="<?php echo $travel["description"] ?>"></div>
	</div>
	<div class="row row-start">
		<div class="cell cell-15"><label class="label" for="start">시작일</label></div>
		<div class="cell cell-85">
			<div class="row row-start-input">
				<div class="cell cell-30">
					<input type="number" name="start_y" value="<?php echo $travel["start_y"] ?>">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="start_m" value="<?php echo $travel["start_m"] ?>">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="start_d" value="<?php echo $travel["start_d"] ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="row row-end">
		<div class="cell cell-15"><label class="label" for="end">종료일</label></div>
		<div class="cell cell-85">
			<div class="row row-end-input">
				<div class="cell cell-30">
					<input type="number" name="end_y" value="<?php echo $travel["end_y"] ?>">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="end_m" value="<?php echo $travel["end_m"] ?>">
				</div>
				<div class="cell cell-10">
					-
				</div>
				<div class="cell cell-25">
					<input type="number" name="end_d" value="<?php echo $travel["end_d"] ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="form-row">
		<button class="button" type="submit">수정</button>
	</div>
</form>
</section>

<?php $this->render("templates/footer"); ?>