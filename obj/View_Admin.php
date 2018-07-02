<?php
class View_Admin extends View {

	public function __construct() {
		parent::__construct();
		if (!User_DAO::check_if_admin()) {
			die("Admin rights required for this action!");
		}
	}

	public function show_options_menu() {
		echo '<select id="manage-mode">';
		echo '<option value="users">users</option>';
		echo '<option value="categories">categories</option>';
		echo '</select>';
		echo '<div class="container">';
		echo '</div>';
	}

	public function list_categories($action = "mng13.php") {
		$categories = $this->Caricature_DAO->list_categories();
		echo '<table id="categories-table">';
		echo '<tr>';
		echo '<th>Name</th> <th>Description</th> <th>path</th> <th>Actions</th>';
		foreach ($categories as $category) {
			echo '<tr>';
			echo '<td>'.$category['name'].'</td>';
			echo '<td>'.$category['description'].'</td>';
			echo '<td>'.$category['path'].'</td>';
			echo '<td>';
			echo '<a href="'.$action.'?categories&ce='.$category['id'].'">[e]</a> ';
			echo '<a href="'.$action.'?categories&cd='.$category['id'].'">[x]</a> ';
			echo '</td>';
			echo '</tr>';
		}
		echo '</tr>';
		echo '</table>';
		echo '<a href="'.$action.'?categories=new">[ new ]</a>';
	}

	public function list_users($action = "mng13.php") {
		$users = $this->User_DAO->list_users();
		echo '<table id="users-table">';
		echo '<tr>';
		echo '<th>Username</th> <th>Full Name</th> <th>Group</th> <th>Notes</th> <th> Actions </th>';
		echo '</tr>';
		foreach ($users as $user) {
			echo '<tr>';
			echo '<td>'.$user['username'].'</td>';
			echo '<td>'.$user['full_name'].'</td>';
			echo '<td>';
			echo $user['group_id'] == 1 ? "Admin" : "User";
			echo '</td>';
			echo '<td>'.$user['notes'].'</td>';
			echo '<td>';
			echo '<a href="'.$action.'?users&ue='.$user['id'].'">[e]</a> ';
			echo '<a href="'.$action.'?users&ud='.$user['id'].'">[x]</a> ';
			echo '</td>';
		}		
		echo '</table>';
		echo '<a href="'.$action.'?users=new">[ new ]</a>';
	}


	public function new_user_form($action = '"manage-admin.php"') {		
		echo '<h4 id="title" class="title">New User:</h4>';
		echo '<form id="user-management" method="post" action='.$action.'>';
		echo '<input type="hidden" name="type" value="user">';
		echo '<div id="create-user">';
		$this->show_user_group_menu();
		echo '<br>';
		echo '<label id="new-user-label" for="new-user">new username:</label>';
		echo '<input type="text" id="new-user" name="new-user">';
		echo '<span id="user-error"></span><br>';

		echo '<label id="pass-label" for="new-password">new password</label>';
		echo '<input type="password" id="new-password" name="new-password"><br>';

		echo '<label id="pass-label2" for="new-password2">repeat password</label>';
		echo '<input type="password" id="new-password2" name="new-password2">   ';
		echo '<span id="password-error"></span><br>';

		echo '<label id="email-label" for="email">e-mail address</label>';
		echo '<input type="text" id="email" name="email"><br>';

		echo '<label id="email-label2" for="email2">repeat e-mail</label>';
		echo '<input type="text" id="email2" name="email2">    ';
		echo '<span id="email-error"></span><br>';

		echo '<label for="full-name">Full Name</label>';
		echo '<input type="text" id="full-name" name="full-name"><br>';
		
		echo '<select id="sex" name="sex">';
			echo '<option value="male" selected>male</option>';
			echo '<option value="female">female</option>';
		echo '</select><br>';

		echo '<textarea id="notes" name="notes" placeholder="notes"></textarea>';

		echo '</div>';
		echo '<button id="submit" type="submit">Submit</button>';		
		if (!empty($_GET['ue'])) {
			$user = $this->User_DAO->get_user_by_id($_GET['ue']);
			echo '<input type="hidden" name="id" value="'.$_GET['ue'].'">';
			echo '<script type="text/javascript">var user = '.json_encode($user).'</script>';
		} else if (!empty($_GET['ud'])) {
			$user = $this->User_DAO->get_user_by_id($_GET['ud']);
			echo '<input type="hidden" name="id" value="'.$_GET['ud'].'">';
			echo '<script type="text/javascript">var user = '.json_encode($user).'</script>';
			echo '<script type="text/javascript">var del = 1</script>';
		}
		echo '</form>';
	}

	public function new_category_form($action = '"manage-admin.php"') {
		echo '<h4 id="title" class="title">New Category:</h4>';
		echo '<form id="category-management" method="post" action='.$action.'>';
		echo '<input type="hidden" name="type" value="category">';
		echo '<label for="category-name" id="name-label" name="category-name">Cateogory name</label>';
		echo '<input id="category-name" name="category-name"><br>';
		echo '<textarea id="category-description" name="category-description"></textarea><br>';
		echo '<button id="submit" type="submit">Submit</button>';
		if (!empty($_GET['ce'])) {
			$category = $this->Caricature_DAO->get_category($_GET['ce']);
			echo '<input type="hidden" name="id" value="'.$_GET['ce'].'">';
			echo '<script type="text/javascript">var category = '.json_encode($category).'</script>';
		} else if (!empty($_GET['cd'])) {
			$category = $this->Caricature_DAO->get_category($_GET['cd']);
			echo '<input type="hidden" name="id" value="'.$_GET['cd'].'">';
			echo '<script type="text/javascript">var category = '.json_encode($category).'</script>';
			echo '<script type="text/javascript">var del = 1</script>';
		}
		echo '</form>';
	}

	public function new_content_form($id=NULL, $type = 1) {
		if ($this->User_DAO->check_if_admin()) {	
			$list_categories = $this->Caricature_DAO->list_categories();
			if (empty($list_categories)) {
				$this->Caricature_DAO->new_category("Caricatures");
			}
			$list_categories = $this->Caricature_DAO->list_categories();
			echo '<h4 class="title">Add new:</h4>';
			echo '<form id="form" method="post" action="manage-content.php" enctype="multipart/form-data">';
			echo '<input name="id" id="id" type="hidden">';
			echo '<select id="type" name="type">';
				echo '<option value="caricature" selected>Caricature</option>';
				echo '<option value="post">Post</option>';
			echo '</select>';
			echo '<label for="title">Title</label>';
			echo '<input id="title" type="text" name="title"><br>';
			//caricatures
			echo '<div id="add-caricature">';
			echo '<label for="category">Category: </label>';
			echo '<select id="category" name="category">';
				echo '<optgroup label="Existing">';
				foreach ($list_categories as $category) {
					echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
				}
				echo '</optgroup>';
				echo '<optgroup label="New:">';
					echo '<option value="new">Нова Категория</option>';
				echo '</optgroup>';
			echo '</select><br>';
			echo '<div id="category-add">';
			echo '</div>';
			echo '<label for="is-post">post?</label>';
			echo '<select id="is-post" name="is-post">';
				echo '<option value=1 selected>yes</option>';
				echo '<option value=0>no</option>';
			echo '</select>';
			echo '<label for="is-pinned"> pinned?</label>';
			echo '<select id="is-pinned" name="is-pinned">';
				echo '<option value=1>yes</option>';
				echo '<option value=0 selected>no</option>';
			echo '</select><br>';
			echo '<label for="description">Description:</label><br>';
			echo '<textarea id="description" name="description" ></textarea><br>';
			echo '<input id="file-upload"	type="file" name="file-upload"  accept="image/*">';
			echo '</div>';
			//post
			echo '<div id="add-post">';
			echo '<label for="is-post2">post?</label>';
			echo '<select id="is-post2" name="is-post2">';
				echo '<option value=1 selected>yes</option>';
				echo '<option value=0>no</option>';
			echo '</select>';
			echo '<label for="is-pinned2"> pinned?</label>';
			echo '<select id="is-pinned2" name="is-pinned2">';
				echo '<option value=1>yes</option>';
				echo '<option value=0 selected>no</option>';
			echo '</select><br>';
			echo '<textarea id="content" name="content"></textarea>';
			echo '</div>';

			echo '<button id="submit" type="submit">Submit</button>';
			echo '  <span id="error"></span>';
			echo '<script type="text/javascript" src="./js/new_entry.js"></script>';

			echo '</form>';
			echo '<script type="text/javascript">var listCategories = '.json_encode($list_categories).'</script>';
			if (isset($id) && $type == 1) {			
				$caricature = $this->Caricature_DAO->caricature_by_id($id);
				if (empty($caricature)) {
					header("Location: new.php");
				}
				$caricature['is_pinned'] = $this->Timeline_DAO->is_pinned($id, 1);
				$caricature = json_encode($caricature);
				echo '<script type="text/javascript">var caricature = '.$caricature.';</script>';			
				echo '<script type="text/javascript">fillCaricatureData(caricature)</script>';
			} else if (isset($id) && $type == 2) {			
				$post = $this->Post_DAO->post_by_id($id);
				if (empty($post)) {
					header("Location: new.php");
				}
				$post['is_pinned'] = $this->Timeline_DAO->is_pinned($id, 2);
				$post = json_encode($post);				
				echo '<script type="text/javascript">var post = '.$post.' </script>';
				echo '<script type="text/javascript">fillPostData(post)</script>';
			}
		} else {
			echo "HOW DID YOU GET HERE?!";
		}
	}

}

?>

