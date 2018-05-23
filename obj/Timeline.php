<?php
class Timeline {
	private $content_type;
	private $item_id;
	private $date;
	private $is_pinned;

	public function __construct($type, $iid, $is_pinned=0, $date=NULL) {
		$this->content_type = $type;
		$this->item_id = $iid;
		$this->is_pinned = $is_pinned;
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