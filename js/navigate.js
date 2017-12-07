var prev = document.getElementById('caricature-prev').href
var next = document.getElementById('caricature-next').href

function leftArrow() {
	window.open(prev, "_self");
}

function rightArrow() {
	window.open(next, "_self");
}

document.onkeydown = function(evt) {
	evt = evt || window.event;
	switch (evt.keyCode) {
		case 37:
			leftArrow();
			break;
		case 39:
			rightArrow();
			break;
	}
}