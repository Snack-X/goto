$ = document.querySelectorAll.bind(document);

$(".item-note")[0].onclick = function() {
	var menu = $(".note-menu")[0];
	var dp = menu.style.display || window.getComputedStyle(menu).display;
	if(dp === "none") menu.style.display = "block";
	else if(dp === "block") menu.style.display = "none";
};