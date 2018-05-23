<?php
class View {
	private $Caricature_DAO;
	private $Timeline_DAO;
	private $Post_DAO;

	public function __construct() {
		$this->Caricature_DAO = new Caricature_DAO();
		$this->Timeline_DAO = new Timeline_DAO();
		$this->Post_DAO = new Post_DAO();
	}

	public function number_of_pages($num_elements) {
		$count = $this->Timeline_DAO->count_elements();
		$number_of_pages = ceil($count/$num_elements);
		return $number_of_pages;
	}

	public function display_timeline($num_elements=NULL, $start=NULL, $end=NULL) {
		if ($num_elements == NULL) {
			$num_elements = 25;
		}
		if ($start == NULL) {
			$start = 0;
		}		
		$end = $start + $num_elements;		
				
		if ($start == 0) {
			$pinned_items = $this->Timeline_DAO->list_pinned();
			$pin_count = count($pinned_items);
			$normal_items = $this->Timeline_DAO->list_timeline();

			$this->show_timeline($pinned_items);			
			$this->show_timeline($normal_items);
		} else {
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

	public function show_timeline_post($timeline_element) {
		echo '<div class="timeline">';
		// echo '<a href="post.php?pid='.$timeline_element['iid'].'>';
		echo '<h3 class="timeline-title">'.$timeline_element['post_title'].'</h3>';
		echo '<h5 class="timeline-date">'.$timeline_element['date'].'</h5>';
		echo '<span class="description">'.$timeline_element['post_text'].'</span>';
		// echo '</a>';
		echo '</div>';
		echo '<hr class="division">';
	}

	public function show_timeline_caricature($timeline_element) {
		echo '<div class="timeline">';
		echo '<h3 class="timeline-title">'.$timeline_element['car_title'].'</h3>';
		echo '<img class="timeline-image" src="'.$timeline_element['path'].'">';
		echo '<span class="description">'.$timeline_element['car_desc'].'</span>';
		echo '</div>';
		echo '<hr class="division">';
	}

	public function index_previous($current_page) {
		$prev = $current_page - 1;
		echo '<a class="previous" href="index.php?p='.$prev.'">';
		echo '<span class="previous"><< Предишна страница </span>';
		echo '</a>';
	}

	public function index_next($current_page) {
		$next = $current_page + 1;
		echo '<a class="next" href="index.php?p='.$next.'">';
		echo '<span class="next">Следваща страница >> </span>';
		echo '</a>';
	}

	public function index_pages($number) {
		echo '<span class="pages">страница [ ';
		for ($i = 1; $i < $number; $i++) {		
			echo '<a href=index.php?p='.$i.'>';
			echo $i.", ";
			echo '</a>';
		}
		echo '<a href=index.php?p='.$i.'>';
		echo $number;
		echo '</a>';
		echo ' ]</span>';
	}
}
/*
<div class="entry">
		<h3 class="entry-title">Ракията се пробужда!</h3>
		<h5 class="entry-date">4.12.2017</h5>
		<img class="entry-image" src="./static/rakiata.png">
		<span class="description">Пиян Соло и Чичака в поредното им приключение в земите на Шоплъка!</span>
	</div>
*/

?>