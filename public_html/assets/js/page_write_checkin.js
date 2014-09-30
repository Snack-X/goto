$(function() {

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
	url += "&client_id=" + fsq_client_id;
	url += "&client_secret=" + fsq_client_secret;

	$.getJSON(url, on_getvenue);
}

function on_getvenue(result) {
	if(result.meta.code !== 200) {
		alert("error");
		return;
	}

	$(".frm-venue").html("");

	for(var i in result.response.venues) {
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