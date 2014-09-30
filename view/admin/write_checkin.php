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

<script src="/assets/js/jquery-2.1.1.min.js"></script>
<script>
function find_venue(keyword) {
	$(".button-venue").addClass("disabled");
	$(".button-venue2").addClass("disabled");

	if(!navigator.geolocation) {
		alert("이 브라우저에서는 체크인할 수 없습니다.");
		return;
	}

	navigator.geolocation.getCurrentPosition(function(p) { on_getposition(p, keyword); });
}

function on_getposition(position, keyword) {
	var url = "https://api.foursquare.com/v2/venues/search?v=20140901&m=swarm";
	url += "&ll=" + position.coords.latitude + "," + position.coords.longitude;
	url += "&limit=50&query=" + encodeURIComponent(keyword);
	url += "&client_id=<?php echo $this->config["foursquare"]["client_id"] ?>";
	url += "&client_secret=<?php echo $this->config["foursquare"]["client_secret"] ?>";

	$.getJSON(url, on_getvenue);
}

function on_getvenue(result) {
	if(result.meta.code !== 200) {
		alert("error");
		return;
	}

	$(".frm-venue").html("");

	for(i in result.response.venues) {
		var v = result.response.venues[i];
		var name = v.name;
		var lat = v.location.lat;
		var lng = v.location.lng;

		$(".frm-venue").append("<option value='" + lat + "," + lng + "," + name + "'>" + name + "</option>");
	}
	$(".frm-venue option:first-child").attr("selected", "selected");

	$(".button-venue").removeClass("disabled");
	$(".button-venue2").removeClass("disabled");
	$(".button-checkin").removeClass("disabled");
}

$(function() {
	$(".button-venue").click(function() {
		if($(this).hasClass("disabled")) return;

		$(".venue-search").show();
		find_venue("");
	});

	$(".button-venue2").click(function() {
		if($(this).hasClass("disabled")) return;

		var keyword = $(".search").val();
		find_venue(keyword);
	});

	$(".button-checkin").click(function() {
		$(this).hasClass("disabled")
		if($(this).hasClass("disabled")) return;

		$(".form").submit();
	});
});
</script>

<?php $this->render("templates/footer"); ?>