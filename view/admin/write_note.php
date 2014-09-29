<?php $this->render("templates/header_admin"); ?>

<section class="admin admin-note-create">
<div class="title">New Travel</div>

<form class="form" action="/admin/write/note" method="post" enctype="multipart/form-data">
	<div class="row row-travel-id">
		<div class="cell cell-15"><label class="label" for="travel_id">여행</label></div>
		<div class="cell cell-85"><select class="input" name="travels_id" id="travel_id">
		<?php foreach($travels as $travel) { ?>
			<option value="<?php echo $travel["id"]?>"
			    <?php if(isset($latest_note["id"]) && $latest_note["id"] === $travel["id"]) { ?>
			        selected
			    <?php } ?>>
				<?php echo $travel["name"] ?>
			</option>
		<?php } ?>
		</select></div>
	</div>
	<div class="row row-content">
		<div class="cell cell-15"><label class="label" for="link">내용</label></div>
		<div class="cell cell-85"><textarea class="input" name="content" id="content"></textarea></div>
	</div>
	<div class="row row-description">
		<div class="cell cell-15"><label class="label" for="description">이미지</label></div>
		<div class="cell cell-85"><input class="input" type="file" name="image[]" accept="image/*" multiple></div>
	</div>

	<input class="button" type="submit" value="작성">
</form>
</section>

<?php $this->render("templates/footer"); ?>