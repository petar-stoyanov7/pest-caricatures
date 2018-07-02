$("div.container").load("container.php?users");
$('#manage-mode').change(function() {
	switch (this.value) {
		case "users":
			$("div.container").load("container.php?users");	
			break;
		case "categories":
			$("div.container").load("container.php?categories");	
			break;
		default:
			$("#filler").innerHTML = "";
			break;
	}
});

function disable_element(button_id, warn_container="", message="", ) {
	if (warn_container !== "" && message !== "") {
		$(warn_container)[0].innerHTML = message;
	}	
	$(button_id).attr('disabled', true);
}

function form_check() {
	if ($('#new-password')[0].value != $('#new-password2')[0].value) {
		disable_element("#submit", "#password-error", "Passwords don't match");
	} else if ($('#email')[0].value != $('#email2')[0].value) {
		disable_element("#submit", "#email-error", "Emails don't match");
	} else if ($('#new-user')[0].value == "") {
		disable_element("#submit", "#user-error", "User can't be empty");
	} else {
		$('#user-error')[0].value = "";
		$('#password-error')[0].innerHTML = "";
		$('#email-error')[0].innerHTML = "";
		$('#submit').attr("disabled", false);
	}
}

function remove_items(items_array) {
	for (var i = 0; i < items_array.length; i++) {
		$(items_array[i]).remove();
	}
}

//User management
if ($('#new-user-label').length) {	
	//update or delete
	if (typeof(user) !== 'undefined') {			
		$('#new-user').val(user.username);
		$('#email').val(user.email);
		$('#full-name').val(user.full_name);
		$('#notes').val(user.notes);
		//delete
		if (typeof(del) !== 'undefined') {	
			$('<input>').attr({
				type: 'hidden',
				id: 'delete',
				name: 'delete',
				value: '1'
			}).appendTo('#user-management');
			$('h4#title').text('Delete user [ '+user.username+' ] ?!');
			$("br").remove();
			$("#new-user").attr('readonly', true).after("<br>");
			$("#new-user-label").text('username').attr('readonly', true);
			$("#email").attr('readonly', true).after("<br>");
			$("#full-name").attr('readonly', true).after("<br>");
			$("#sex").after("<br>");
			$("#notes").attr('readonly', true);
			var remove = ["#group", "#pass-label", "#pass-label2", "#new-password", "#new-password2", "#email-label2", "#email2"];
			remove_items(remove);
		//edit
		} else {
			disable_element("#submit");
			$('h4#title').text('Update user [ '+user.username+' ]');
			$('<input>').attr({
				type: 'hidden',
				id: 'update',
				name: 'update',
				value: '1'
			}).appendTo('#user-management');
			$('#group option[value = "'+user.group_id+'"]').attr('selected', true);
			$('#new-user').attr('hidden', true);
			$('#new-user-label').attr('hidden', true);
			$('#email2')[0].value = user.email;
			$('#user-management').change(function() {
				form_check();
			});
		}		
		console.log(user);		
	}
	console.log("kur");
	
}

//category management
if ($('#name-label').length) {	
	//update or delete
	if (typeof(category) !== 'undefined') {
		$('#category-name').val(category.name);
		$('#category-description').val(category.description);		
		if (typeof(del) !== 'undefined') {	
			//delete
			$('<input>').attr({
				type: 'hidden',
				id: 'delete',
				name: 'delete',
				value: '1'
			}).appendTo('#category-management');
			$('h4#title').text('Delete category [ '+category.name+' ] ?!');
			$("#category-name").attr('readonly', true);
			$("#category-description").attr('readonly', true);		
		} else {
			$('h4#title').text('Update Category [ '+category.name+' ] :');
			$('<input>').attr({
				type: 'hidden',
				id: 'update',
				name: 'update',
				value: '1'
			}).appendTo('#category-management');
		}		
		console.log(category);		
	}
	console.log("kur");
	
}