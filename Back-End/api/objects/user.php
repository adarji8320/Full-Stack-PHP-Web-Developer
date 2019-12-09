<?php

class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_user";
 
    // object properties
    public $user_id;
    public $user_name;
    public $user_phone;
    public $user_email;
    public $user_bio;
    public $user_profile_picture;
 
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
