<?php
class Post {
	private $title;
	private $tag_id;
	private $is_post;
	private $is_pinned;
	private $date;
	private $text;

	public function __construct($title, $text, $ispost=true, $ispinned = false, $date=NULL) {
		$this->title = $title;
		$this->text = $text;
		$this->is_post = $ispost;
		$this->is_pinned = $ispinned;
		if ($date != NULL || $date != "") {
			$this->date = $date;
		} else {
			$this->date = date("Y-m-d H:i:s");
		}
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
}
?>