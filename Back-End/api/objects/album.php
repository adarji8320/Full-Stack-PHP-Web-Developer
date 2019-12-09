<?php

class Album{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_album";
 
    // object properties
    public $album_id;
    public $album_title;
    public $album_description;
    public $album_img;
    public $album_date;
    public $album_featured;
    public $user_id;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

	function read($user_id){
	 
		// select all query
		$query = "SELECT * FROM " . $this->table_name ." WHERE user_id = " . $user_id;
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}

}

?>
