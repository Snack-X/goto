<?php $this->render("templates/header_admin"); ?>

<section class="admin admin-checkin-create">
<div class="title">New Checkin</div>

<form class="form" action="/admin/write/checkin" method="post" enctype="multipart/form-data">
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
	<div class="row row-venue">
		<div class="cell cell-15"><label class="label">장소</label></div>
		<div class="cell cell-85">
			<button class="button button-venue" type="button">장소 탐색</button>
		</div>
	</div>

	<div class="venue-search">
		<div class="row row-search">
			<div class="cell cell-85">
				<input type="text" class="search">
			</div>
			<div class="cell cell-15">
				<button class="button button-venue2" type="button">검색</button>
			</div>
		</div>

		<div class="row row-search-result">
			<div class="cell cell-100">
				<select name="venue" class="frm-venue"></select>
			</div>
		</div>
	</div>

	<div class="row row-content">
		<div class="cell cell-15"><label class="label" for="content">내용</label></div>
		<div class="cell cell-85"><textarea class="input" name="content" id="content"></textarea></div>
	</div>
	<div class="row row-image">
		<div class="cell cell-15"><label class="label" for="description">이미지</label></div>
		<div class="cell cell-85"><input class="input" type="file" name="image" accept="image/*" id="image"></div>
	</div>

	<button type="button" class="button button-checkin disabled">체크인</button>
</form>
</section>

<script>
var fsq_client_id = "<?php echo $this->config["foursquare"]["client_id"] ?>";
var fsq_client_secret = "<?php echo $this->config["foursquare"]["client_secret"] ?>";
</script>
<script src="/assets/js/page_write_checkin.min.js"></script>

<?php $this->render("templates/footer"); ?>