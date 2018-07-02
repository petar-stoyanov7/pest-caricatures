<?php
class View {
	protected $Caricature_DAO;
	protected $Timeline_DAO;
	protected $Post_DAO;
	protected $User_DAO;

	public function __construct() {
		$this->Caricature_DAO = new Caricature_DAO();
		$this->Timeline_DAO = new Timeline_DAO();
		$this->Post_DAO = new Post_DAO();
		$this->User_DAO = new User_DAO();
	}

	public function newline($number) {
		for ($i = 0; $i < $number; $i++) {
			echo '<br>';
		}
	}

	public function number_of_pages($num_elements, $posts_only=FALSE) {
		if($posts_only) {
			$count = $this->Timeline_DAO->count_elements(2);
		} else {
			$count = $this->Timeline_DAO->count_elements();
		}
		$number_of_pages = ceil($count/$num_elements);
		return $number_of_pages;
	}

	
	public function display_timeline($page, $num_elements=NULL, $only_posts=false) {
		if ($num_elements === NULL) {
			$num_elements = 10;
		}
		if ($only_posts) {
			$start = ($page-1)*$num_elements;
			$number = $num_elements;
		} else {
			$num_pinned = $this->Timeline_DAO->count_pinned();		
			$start = (($page - 1) * $num_elements) - $num_pinned;
			$number = $page * $num_elements - $num_pinned;
			if ($start < 0) {
				$start = 0;
			}
		}		
		
		if ($page == 1 && !$only_posts) {
			$pinned_items = $this->Timeline_DAO->list_pinned();
			$normal_items = $this->Timeline_DAO->list_timeline($start, $number);

			$this->show_timeline($pinned_items);
			echo '<hr class="division">';		
			$this->show_timeline($normal_items);
		} 
		else if ($only_posts) {
			$items = $this->Timeline_DAO->list_only_posts($start, $number);
			$this->show_timeline($items);
		} else if (!$only_posts) {
			$normal_items = $this->Timeline_DAO->list_timeline($start, $number);
			$this->show_timeline($normal_items);
		}
		
	}

	public function show_timeline($timeline_array) {
		foreach ($timeline_array as $timeline) {
			if (empty($timeline['post_title']) && empty($timeline['post_text']) &&
				empty($timeline['car_title']) && empty($timeline['car_desc']) &&
				empty($timeline['path'])) 
			{
				continue;
			}
			switch ($timeline['type']) {
				case 1:
					$this->show_timeline_caricature($timeline);
					break;
				case 2:
					$this->show_timeline_post($timeline);
					break;
				default:					
					break;
			}
		}
	}

	public function show_popup() {
		echo '<div id="myModal" class="modal">';
		echo '<div class="modal-content">';
		echo '<span class="close">&times;</span>';
		echo '<p>ВНИМАНИЕ! Този сайт използва курабии(cookies)! Курабиите са богати на глутен, 
			използван е животински труд, съдържат животински продукти, тествани са върху животни и 
			от животни. Богати са на холестерол, евтино чувство за хумор, плоски шеги и други опити за хумор.
			Може да съдържат следи от ирония. </p>';
		echo '<p>От Pest Caricatures сме силно загрижени за Вашите лични данни и с радост
			ще ги продадем на всеки предложил над 50 стотинки! </p>';
		echo '<p>С посещението си в този сайт се съгласявате, че ще се наложи да гледате зле нарисувани
			карикатури, дебелашки шеги, просташки хумор. Авторът не носи никаква отговорност за обидени
			огОрчени и душевно наранени индивиди, припознали себе си в карикатурите. Авторът обещава, 
			че ще продължи да не се съобразява и да драска каквото му скимне.</p>';
		echo '<p>FUCK GDPR!</p>';
		echo '</div>';
		echo '</div>';
		echo '<script type="text/javascript" src="./js/popup.js"></script>';
		echo '<script type="text/javascript">showModal()</script>';
	}

	public function first_visit() {
		if (!isset($_COOKIE['first-visit'])) {
			setcookie('first-visit', 'yes', time() + (86400 * 30), "/");
			$this->show_popup();
		}
	}

	public function set_title($title) {
		echo '<script type="text/javascript">document.title = '.json_encode($title).'</script>';
	}

	public function show_gallery($category_id = NULL) {
		if (is_null($category_id)) {
			$items = $this->Caricature_DAO->list_categories();
			echo '<div class="site-content">';
			foreach ($items as $item) {
				$thumb = $this->Caricature_DAO->get_thumb($item['thumb_id']);
				echo '<div class="gallery-entry">';
				echo '<a href="gallery.php?gid='.$item['id'].'">';
				echo '<h4 class="gallery-title">'.$item['name'].'</h4>';
				echo '<img class="gallery-image" src="'.$thumb.'">';
				echo '<span class="description">'.$item['description'].'</span>';
				echo '</a>';
				echo '</div>';		
			}
			echo '</div>';
			$this->set_title("Галерия");
		} else {
			$items = $this->Caricature_DAO->caricatures_by_category($category_id);
			$name = $this->Caricature_DAO->category_by_id($category_id);
			echo '<div class="site-content">';
			echo '<h3>Галерия '.$name.'</h3>';
			for ($i = 0; $i < sizeof($items); $i++) {
				$thumb = $items[$i]['path'];			
				echo "<div class='gallery-entry'>";
				$this->show_edit_content($items[$i]['id'], 1);
				echo "<a href='caricature.php?cid=".$items[$i]['id']."'>";
				echo "<h4 class='gallery-title'>".$items[$i]['title']."</h4>";
				echo "<img class='gallery-image' src='".$thumb."'>";
				echo "</a>";
				echo $items[$i]['description'];
				echo "</div>";		
			}
			echo '</div>';
			$this->set_title("Галерия: ".$name);
		}
	}

	public function show_toolbar() {
		echo '<div id="navigation-bar">	';
		echo '<div class="navbar">';
		echo '<span class="navbar-entry">';
		echo '<a href="./index.php">Начало</a>';
		echo '</span>';
		echo '<span class="navbar-entry">';
		echo '<a href="gallery.php">Галерия</a>';
		echo '</span>';
		echo '<span class="navbar-entry">';
		echo '<a href="index.php?posts">Постове</a>';
		echo '</span>';
		echo '<span class="navbar-entry">';
		echo '<a href="caricature.php?random=1">Случайна</a>';
		echo '</span>';
		echo '<span class="navbar-entry">';
		echo '<a href="about.php">За автора</a>';
		echo '</span>';
		if ($this->User_DAO->check_if_admin()) {
			echo '<span class="navbar-entry">';
			echo '<a href="new.php">[+]</a>';
			echo '</span>';
			echo '<span class="navbar-entry">';
			echo '<a href="mng13.php">[adm]</a>';
			echo '</span>';
		}
		echo '</div>';
		echo '</div>';
	}

	public function show_caricature($Caricature, $next, $previous, $title) {
		echo "<h1 class='caricature-title'>".$title."</h1>";
		echo "<a href='".$Caricature['path']."' target='_blank'>";
		echo "<img class='caricature' src='".$Caricature['path']."'>";
		echo "</a><br>";
		echo "<span class='caricature-description'>".$Caricature['description']."</span><br>";
		echo "<a id='caricature-prev' href='caricature.php?".$previous."'> << </a>";
		echo "<a id='caricature-next' href='caricature.php?".$next."'> >> </a>";
	}
	

	public function show_user_group_menu() {
		if ($this->User_DAO->check_if_admin()) {
			$groups = $this->User_DAO->list_groups();
			echo '<select id="group" name="group">';
			foreach ($groups as $group) {
				if ($group['id'] == 2) {
					echo '<option value='.$group['id'].' selected="true" >'.$group['name']."</option>";
				} else {
					echo '<option value='.$group['id'].'>'.$group['name']."</option>";
				}
			}
			echo '</select>';
		}
	}

	public function show_timeline_post($timeline_element) {
		echo '<div class="timeline">';
		echo '<a href="post.php?pid='.$timeline_element['iid'].'">';
		echo '<h3 class="timeline-title">'.$timeline_element['post_title'].'</h3>';
		echo '<h5 class="timeline-date">'.$timeline_element['date'].'</h5>';
		echo '<span class="description">'.$timeline_element['post_text'].'</span>';
		echo '</a>';
		echo '</div>';
		echo '<hr class="division">';
	}

	public function show_timeline_caricature($timeline_element) {
		echo '<div class="timeline">';
		echo '<a href="caricature.php?cid='.$timeline_element['iid'].'">';
		echo '<h3 class="timeline-title">'.$timeline_element['car_title'].'</h3>';
		echo '<img class="timeline-image" src="'.$timeline_element['path'].'">';
		echo '<span class="description">'.$timeline_element['car_desc'].'</span>';
		echo '</a>';
		echo '</div>';
		echo '<hr class="division">';
	}

	public function index_previous($current_page, $post="") {
		$prev = $current_page - 1;
		echo '<a class="previous" href="index.php?p='.$prev.$post.'">';
		echo '<span class="previous"><< Предишна страница </span>';
		echo '</a>';
	}

	public function index_next($current_page, $post="") {
		$next = $current_page + 1;
		echo '<a class="next" href="index.php?p='.$next.$post.'">';
		echo '<span class="next">Следваща страница >> </span>';
		echo '</a>';
	}

	public function index_pages($number, $post="") {
		echo '<span class="pages">страница [ ';
		for ($i = 1; $i < $number; $i++) {
			echo '<a href=index.php?p='.$i.$post.'>';
			echo $i;
			echo '</a>, ';
		}
		echo '<a href=index.php?p='.$i.'>';
		echo $number;
		echo '</a>';
		echo ' ]</span>';
	}

	public function show_post($post) {
		echo '<h1 class="post-title">'.$post['title'].'</h1>';
		echo '<h5 class="post-date">'.$post['date'].'</h5>';
		$this->newline(3);
		echo $post['text'];
		$this->newline(3);
	}

	public function show_edit_content($id, $type) {
		if ($this->User_DAO->check_if_admin()) {
			echo '<div id="edit-item">';
			if ($type == 1) {
				$new = "new.php?cid=";
				$delete = "delete.php?cid=";
				echo '<a href="manage-content.php?make-cover='.$id.'">[C]</a> ';	
			} else if ($type == 2) {
				$new = "new.php?pid=";
				$delete = "delete.php?pid=";
			}
			
			echo '<a href="'.$new.$id.'">[E]</a> ';
			echo ' <a href="'.$delete.$id.'">[X]</a>';
			echo '</div>';
		}
	}

	public static function login_form($action = '"manage-admin.php"') {
		echo '<form id="user-management" method="post" action='.$action.'>';
		echo '<div id="user-login">';
		echo '<label for="username">user:</label>';
		echo '<input type="text" id="username" name="username"><br>';
		echo '<label for="password">pass:</label>';
		echo '<input type="password" id="password" name="password"><br>';
		echo '<button id="submit" type="submit">Submit</button>';
		echo '</div>';
		echo '</form>';
	}

}

?>