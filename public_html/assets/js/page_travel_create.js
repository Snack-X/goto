$(function() {

$(".form").submit(function(e) {
	var err_list = [];

	var v_name        =  $(this).find("[name='name']").val();
	var v_link        =  $(this).find("[name='link']").val();
	var v_description =  $(this).find("[name='description']").val();
	var v_start_y     = +$(this).find("[name='start_y']").val();
	var v_start_m     = +$(this).find("[name='start_m']").val();
	var v_start_d     = +$(this).find("[name='start_d']").val();
	var v_end_y       = +$(this).find("[name='end_y']").val();
	var v_end_m       = +$(this).find("[name='end_m']").val();
	var v_end_d       = +$(this).find("[name='end_d']").val();

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

	$(this).find("input, textarea, select").removeClass("error");
	for(var i in err_list) {
		$(this).find("[name='" + err_list[i] + "']").addClass("error");
	}

	return false;
});

});