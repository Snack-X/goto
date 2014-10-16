$ = document.querySelectorAll.bind(document);

function validate() {
	var err_list = [];

	var v_name        =  $("[name='name']")[0].value;
	var v_link        =  $("[name='link']")[0].value;
	var v_description =  $("[name='description']")[0].value;
	var v_start_y     = +$("[name='start_y']")[0].value;
	var v_start_m     = +$("[name='start_m']")[0].value;
	var v_start_d     = +$("[name='start_d']")[0].value;
	var v_end_y       = +$("[name='end_y']")[0].value;
	var v_end_m       = +$("[name='end_m']")[0].value;
	var v_end_d       = +$("[name='end_d']")[0].value;

	var get_last_day = function(y, m) {
		return new Date(y, m, 0).getDate();
	};

	if(!/^.{1,30}$/.test(v_name)) err_list.push("name");
	if(!/^[a-z0-9-_]{1,30}$/.test(v_link)) err_list.push("link");
	if(!/^.{1,100}$/.test(v_description)) err_list.push("description");

	if(v_start_y < 2014) err_list.push("start_y");
	if(v_start_m < 1 || v_start_m > 12) err_list.push("start_m");
	if(v_start_d < 1 || v_start_d > get_last_day(v_start_y, v_start_m)) err_list.push("start_d");
	if(v_end_y < 2014) err_list.push("end_y");
	if(v_end_m < 1 || v_end_m > 12) err_list.push("end_m");
	if(v_end_d < 1 || v_end_d > get_last_day(v_end_y, v_end_m)) err_list.push("end_d");

	if(err_list.length === 0) {
		return true;
	}

	var list = $("input, textarea, select");
	Array.prototype.slice.call(list).forEach(function(el) {
		el.classList.remove("error");
	});

	for(var i in err_list) {
		$("[name='" + err_list[i] + "']")[0].classList.add("error");
	}

	return false;
}

$(".form")[0].onsubmit = validate;