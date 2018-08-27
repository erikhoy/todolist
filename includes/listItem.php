<?php

class ListItem {

	public $id;
	public $name;
	public $priority;
	
	//Add list item
	public function create() {
		global $database;

		$sql = "INSERT INTO listItems (name, priority) VALUES ('".$database->escape_string($this->name)."')";

		if($database->query($sql)) {
			$this->id = $database->the_insert_id();
			$message = "success";
		}
	}

	//Find all list items
	public static function find_all_list_items() {
		return self::find_this_query("SELECT * FROM listItems");
	}

	// //Find list item by id
	public static function find_list_item_by_id($id) {
		global $database;

		$result = self::find_this_query("SELECT * FROM listItems WHERE id=$id LIMIT 1");

		return !empty($result) ? array_shift($result) : false;		
	}

	public static function find_this_query($sql) {
		global $database;

		$result = $database->query($sql);
		$obj_array = array();

		while($row = mysqli_fetch_array($result)) {
			$obj_array[] = self::instantiation($row);
		}
		return $obj_array;
	}
	
	//Instantiation function
	public static function instantiation($result) {
		$obj = new self;

        $obj->id = $result["id"];
        $obj->name = $result["name"];

        return $obj;
	}

	//Update list item
	public function update() {
		global $database;
		
		$sql = "UPDATE listItems";
		$sql .= " SET name='".$database->escape_string($this->name)."'";
		$sql .= " WHERE id=".$database->escape_string($this->id);

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}

	//Delete list item
	public function delete() {
		global $database;

		$sql = "DELETE FROM listItems";
		$sql .= " WHERE id=" . $database->escape_string($this->id);
		$sql .= " LIMIT 1";

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}
}