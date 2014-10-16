$ = document.querySelectorAll.bind(document);

function find_venue(keyword) {
	$(".button-venue")[0].classList.add("disabled");
	$(".button-venue2")[0].classList.add("disabled");

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

	var request = new XMLHttpRequest();
	request.open("GET", url, true);

	request.onload = function() {
		if (request.status >= 200 && request.status < 400){
			data = JSON.parse(request.responseText);
			on_getvenue(data);
		} else {
			alert("에러가 발생했습니다.");
		}
	};

	request.onerror = function() {
		alert("에러가 발생했습니다.");
	};

	request.send();
}

function on_getvenue(result) {
	if(result.meta.code !== 200) {
		alert("에러가 발생했습니다.");
		return;
	}

	$(".frm-venue")[0].innerHTML = "";

	for(var i in result.response.venues) {
		var v = result.response.venues[i];
		var name = v.name;
		var lat = v.location.lat;
		var lng = v.location.lng;

		var option = document.createElement("option");
		option.setAttribute("value", "" + lat + "," + lng + "," + name);
		option.innerHTML = name;

		$(".frm-venue")[0].appendChild(option);
	}

	$(".frm-venue option:first-child")[0].setAttribute("selected", "selected");

	$(".button-venue")[0].classList.remove("disabled");
	$(".button-venue2")[0].classList.remove("disabled");
	$(".button-checkin")[0].classList.remove("disabled");
}

$(".button-venue")[0].onclick = function() {
	if(this.classList.contains("disabled")) return;

	$(".venue-search")[0].style.display = "block";
	find_venue("");
};

$(".button-venue2")[0].onclick = function() {
	if(this.classList.contains("disabled")) return;

	var keyword = $(".search")[0].value;
	find_venue(keyword);
};

$(".button-checkin")[0].onclick = function() {
	if(this.classList.contains("disabled")) return;

	$(".form")[0].submit();
};