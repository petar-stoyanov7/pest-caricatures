var formSelector = document.querySelector('select#type');
var caricatureContainer = document.querySelector('div#add-caricature');
var postContainer = document.querySelector('div#add-post');

hidePost();

function hidePost() {
	postContainer.style.display = 'none';
	caricatureContainer.style.display = 'block';
}

function hideCaricature() {
	postContainer.style.display = 'block';
	caricatureContainer.style.display = 'none';
}

function displayNewCategory()
{	
	container.innerHTML += '<label for="new">Нова категория: </label>';
	container.innerHTML += '<input type="text" name="new-category" placeholder="Име на категорията"><br>';
	container.innerHTML += '<textarea id="category-description" name="category-description" placeholder="Описание"></textarea><br>';

}

formSelector.addEventListener('change', function()
{
	var option = formSelector.value;
	switch(option)
	{
		case 'post':
			hideCaricature();
			break;
		case 'caricature':
			hidePost();			
			break;
		default:
			hidePost();
			break;
	}
});

function makeSelected(select, compare) {
	for (i = 0; i < select.length; i++) {
		if (select[i].value == compare) {
			select[i].setAttribute('selected', true);
		}
	}
}

function fillCaricatureData(caricature) {
	hidePost();
	var type = document.getElementById('type');
	var title = document.querySelector('input#title');
	var id = document.querySelector('input#id');
	var category = document.getElementById('category');
	var isPost = document.getElementById('is-post');
	var isPinned = document.getElementById('is-pinned');
	var description = document.getElementById('description');
	var update = document.createElement('input');
	update.name = 'update';
	update.id = 'is-update';
	update.value = 1;
	update.type = 'hidden';
	document.querySelector('div#add-caricature').appendChild(update);

	makeSelected(type, "caricature");
	makeSelected(category, caricature.cid);
	makeSelected(isPost, caricature.is_post);
	makeSelected(isPinned, caricature.is_pinned);
	
	description.value = caricature.description;
	title.value = caricature.title;
	id.value = caricature.id
}

function fillPostData(post) {
	console.log(post);
	hideCaricature();
	var type = document.getElementById('type');
	var title = document.querySelector('input#title');
	var id = document.getElementById('id');
	var text = document.getElementById('content')
	var isPost = document.getElementById('is-post2');
	var isPinned = document.getElementById('is-pinned2');
	var update = document.createElement('input');
	update.name = 'update';
	update.id = 'is-update';
	update.value = 1;
	update.type = 'hidden';
	document.querySelector('div#add-post').appendChild(update);

	makeSelected(type, "post");
	makeSelected(isPost, post.is_post);
	makeSelected(isPinned, post.is_pinned);

	id.value = post.id;
	title.value = post.title;
	text.value = post.text;
}

var catSelector = document.querySelector('select#category');
var container = document.querySelector('div#category-add');
catSelector.addEventListener('change', function() 
{
	if (typeof(catSelector) != 'undefined' && catSelector != null)
	{
		container.innerHTML = '';
		var option = catSelector.value;
		switch(option) 
		{
			case 'new': 
				displayNewCategory();
				break;
			default:
				container.innerHTML = "";
				break;
		}
	}
});