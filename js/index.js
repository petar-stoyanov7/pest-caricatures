var prevLink = document.querySelector('a.previous');
var prevSpan = document.querySelector('span.previous');
var nextLink = document.querySelector('a.next');
var nextSpan = document.querySelector('span.next');
var disabledColor = "#cccccc";


function disablePrevious() {
	console.log("Hiding previous");
	prevLink.removeAttribute('href');
	prevSpan.style.color = disabledColor;
}

function disableNext() {
	nextLink.removeAttribute('href');
	nextSpan.style.color = disabledColor;
}