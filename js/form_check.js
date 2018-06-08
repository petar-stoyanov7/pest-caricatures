var form = document.getElementById('form');
var type = document.getElementById('type');
var title = document.getElementById('title');
var isPost = document.getElementById('is-post');
var isPost2 = document.getElementById('is-post2');
var isPinned = document.getElementById('is-pinned');
var isPinned2 = document.getElementById('is-pinned2');
var button = document.getElementById('submit');
var fileUpload = document.getElementById('file-upload');

var isUpdate = document.getElementById('is-update');

var errorMessage = document.getElementById('error');


function disableButton() {
	button.disabled = true;
}

function enableButton() {
	button.disabled = false;
}

disableButton();

form.addEventListener("input", function () {
	errorMessage.innerHTML = "";
	if (type[0].selected == true) {
		//caricature
	    if (title.value == "") {
	    	title.placeholder = "Title is manditory!";
	    	disableButton();
	    } else {
	    	enableButton();
	    }
	    if (fileUpload.value == "" && isUpdate == null) {
	    	disableButton();
	    	errorMessage.innerHTML += "File is manditory for new Caricatures! ";
	    }
	    if (isPost[1].selected == true && isPinned[0].selected == true) {
	    	disableButton();
	    	errorMessage.innerHTML += "Content can't be pinned if it's not a post! ";
	    }
	} else if (type[1].selected == true) {
		//post
		if (title.value == "") {
	    	title.placeholder = "Title is manditory!";
	    	disableButton();
	    } else {
	    	enableButton();
	    }
		if (isPost2[1].selected == true && isPinned2[0].selected == true) {
	    	disableButton();
	    	errorMessage.innerHTML += "Content can't be pinned if it's not a post!";
	    }
	}
});