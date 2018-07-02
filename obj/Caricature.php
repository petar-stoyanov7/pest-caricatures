<?php
class Caricature {
	private $title;
	private $path;
	private $url;
	private $tag_id;
	private $category_id;
	private $is_pinned;
	private $is_post;
	private $date;
	private $description;

	public function __construct($title, $description, $path, $cid, $ispost=false, $ispinned = 0, $date=NULL, $url=NULL, $tag_id=NULL) {
		$this->title = $title;
		$this->description = $description;
		$this->path = $path;
		$this->url = $url;
		$this->tag_id = $tag_id;
		$this->category_id = $cid;
		$this->is_post = $ispost;
		$this->is_pinned = $ispinned;
		if (!is_null($date) || $date != "") {
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