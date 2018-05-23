var formSelector = document.querySelector('select#type');
var caricatureContainer = document.querySelector('div#add-caricature')
var postContainer = document.querySelector('div#add-post')

hidePost();

function hidePost() {
	console.log('is it going here "post"');
	postContainer.style.display = 'none';
	caricatureContainer.style.display = 'block';
}

function hideCaricature() {
	console.log('is it going here "caricature"');
	postContainer.style.display = 'block';
	caricatureContainer.style.display = 'none';
}

function displayNewCategory()
{	
	container.innerHTML += '<label for="new">Нова категория: </label>';
	container.innerHTML += '<input type="text" name="new-category" placeholder="Име на категорията">';
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
				clearElement(container);
				break;
		}
	}
});