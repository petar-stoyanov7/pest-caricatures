<?php
$css_array = array('main.css', 'add.css');
$js_array = array('toolbar.js', 'new_entry.js');
require_once("header.php");
echo '<div class="site-content">';
$c_dao = new Caricature_DAO();
$list_categories = $c_dao->list_categories();
// echo <<<TEXT
?>
<div class='container'>
<h4 class='title'>Add new:</h4>
<form method="post" action="manage-content.php" enctype="multipart/form-data">
	<select id="type" name="type">
		<option value="caricature" selected>Caricature</option>
		<option value="post">Post</option>
	</select>
	<label for="title">Title</label>
	<input id="title" type="text" name="title" placeholder="title" ><br>

	<div id='add-caricature'>
		<label for='category'>Category: </label>
		<select id='category' name='category'>
			<optgroup label='Existing'>
			<?php			
				foreach ($list_categories as $category) {
					echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
				}
			?>
			</optgroup>
			<optgroup label='New:'>
				<option value='new'>Нова Категория</option>
			</optgroup>
		</select><br>
		<div id='category-add'>
		</div>
		<label for='is-post'>post?</label>
		<select id='is-post' name='is-post'>
			<option value=1 selected>yes</option>
			<option value=0>no</option>
		</select>
		<label for='is-pinned'> pinned?</label>
		<select id='is-pinned' name='is-pinned'>
			<option value=1>yes</option>
			<option value=0 selected>no</option>
		</select><br>
		<label for='description'>Description:</label><br>
		<textarea id='description' name='description' ></textarea><br>
		<input id='file-upload'	type='file' name='file-upload'  accept='image/*'>
	</div>

	<div id='add-post'>
		<label for='is-post2'>post?</label>
		<select id='is-post2' name='is-post'>
			<option value=1 selected>yes</option>
			<option value=0>no</option>
		</select>
		<label for='is-pinned2'> pinned?</label>
		<select id='is-pinned2' name='is-pinned'>
			<option value=1>yes</option>
			<option value=0 selected>no</option>
		</select><br>
		<textarea id='content' name='content'></textarea>
	</div>

	<button id="submit" type="submit">Submit</button>

</form>
</div>

<script type="text/javascript">var listCategories = <?= json_encode($list_categories) ?>;</script>
<!-- <script type="text/javascript" src="./js/new_entry.js"></script> -->
<?php
// TEXT;
echo '</div>';
require_once("footer.php");
?>