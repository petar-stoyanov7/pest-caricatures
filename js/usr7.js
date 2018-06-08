var form = document.getElementById('user-management');
var title = document.getElementById('title');
var operation = document.getElementById('operation');
var newUser = document.getElementById('new-user');
var pass1 = document.getElementById('new-password');
var pass2 = document.getElementById('new-password2');
var passwordError = document.getElementById('password-error');
var email1 = document.getElementById('email');
var email2 = document.getElementById('email2');
var emailError = document.getElementById('email-error');
var button = document.getElementById('submit');
var loginContainer = document.getElementById('user-login');
var newUserContainer = document.getElementById('create-user');


function hideLogin() {
	operation[0].removeAttribute('selected');
	operation[1].setAttribute('selected', true);
	title.innerHTML = "New User:";
	loginContainer.style.display="none";
	newUserContainer.style.display="";
}

function hideNewUser() {
	operation[1].removeAttribute('selected');
	operation[0].setAttribute('selected', true);
	title.innerHTML = "Login:";
	newUserContainer.style.display="none";
	loginContainer.style.display="";
}

function disableNewUser() {
	newUserContainer.innerHTML = "";
	operation.remove();
}

function disableButton() {
	button.disabled = true;
}

function enableButton() {
	button.disabled = false;
}

function clearError() {
	passwordError.innerHTML = "";
	emailError.innerHTML = "";
}

hideNewUser();

operation.addEventListener("change", function () {
	var option = operation.value;
	switch (option) {
		case "login":			
			hideNewUser();
			break;
		case "new":			
			hideLogin();
			break;
		default:
			hideNewUser();
			break;
	}
});
if (newUserContainer.innerHTML != "") {
	form.addEventListener("change", function() {
		if (email1.value != email2.value) {
			emailError.innerHTML = "Emails don't match!";
			disableButton();
		}
		if (pass1.value != pass2.value) {
			passwordError.innerHTML = "Passwords don't match!";
			disableButton();
		}


		if (email1.value == email2.value && 
			pass1.value == pass2.value) {
			clearError();
			enableButton();
		}
	});
}
