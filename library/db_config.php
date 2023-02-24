<?php
class Db_conn{
	
	private $DBH;
	private $STH;
	private static $db_handle = null;
	private $db_success = false;
	public $sql;
	
	//use construct to connect to database on class instantiation
	public function __construct(){
		$host = "localhost";
        $db_name = "lift_bank";
        $db_user = "root";
        $db_password= "";
	 
	    $this->DBH = new PDO("mysql:host = $host;dbname=$db_name", $db_user, $db_password);
        $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

	}//end construct
	
     //....................................................................
	/*
	public static function get_db_handle($host, $db_name, $db_user, $db_password){
		if(!isset(self::$db_handle)){
		    self::$db_handle = new Database_connect($host, $db_name, $db_user, $db_password);
		}//end if
		return self::$db_handle;
	}//end method get_db_handle
	*/
	
	//....................................................................
	//METHOD TO SELECT DATA FROM DATABASE
	/* $query_fields = array("field_names"=>array(field names to select sepereted by "", ),
	   "where"=>array(where conditions, eg "email=", "AND phone <"),
	   "data"=>array(data values for where clause),
	   "order_by"=>'order by column', 
	   "limit"=>limit number, 
	   "custom_placeholder"=>"any_value//set it to indicate that your query is with placeholder")
	*/
		public function select_data($table_name, $query_fields){
		$col_names = null;
		$where_col = null;
		$data = null;
		foreach($query_fields as $key=>$values){
			
	    switch($key){
				
				CASE "field_names":
				$field_names = $values;
				
		for($i=0; $i<=count($field_names) - 1; $i++){
		    if($i !== count($field_names) - 1){
		        $col_names .= $field_names[$i]. ",";
		    }
		    else{
			    $col_names .= $field_names[$i];
		    }//end else
			
	    }//end for
				;//end CASE field_names
				break;
				
				CASE "where":
				$where = $values;
				//check if the query_fields is with placeholder
				if(!isset($query_fields['custom_placeholder'])){
					for($i=0; $i<=count($where) - 1; $i++){
					$where_col .= $where[$i]. " ? ";
					}//end for
				}else{
					
					for($i=0; $i<=count($where) - 1; $i++){
					$where_col .= $where[$i];
					}//end for
				
				}//end if else custom_placeholder
				;//end CASE where
				break;
				
				CASE "data":
				$data = $values;
				;//end CASE data
				break;
				
				CASE "order_by":
				$order_by = " ORDER BY " .$values;
				;//end CASE order_by
				break;
				
				CASE "limit":
				$limit = $key. " " .$values;
				;//end CASE limit
				break;
				
				Default:;
				break;
				
		}//end switch
			
			
		}//end foreach
		

    $sql = "SELECT $col_names 
	        FROM $table_name";
			
	if(isset($where_col)){
		if(count($where) != count($data)){
			die("Error!, SQL Where clause and data value not matched");
		}
		$sql .= " WHERE " .$where_col; 
	}//end isset $where
	
	if(isset($order_by)){
		$sql .= " " .$order_by; 
	}//end isset $order_by
	
	if(isset($limit)){
		$sql .= " " .$limit; 
	}//end isset $limit

	$this->STH = $this->get_handle()->prepare($sql);
    $this->STH->execute($data); 

	}//end method select_data()
	
	//.................................................................
	//INSERT INTO DATABASE
	public function insert_db($table_name, $field_names, $data){
	$values = null;
	$col_names = null;
	$where_col = null;
	for($i=0; $i<=count($field_names) - 1; $i++){
		if($i !== count($field_names) - 1){
		$col_names .= $field_names[$i]. ",";
		$values .= "?,";
		}
		else{
			$col_names .= $field_names[$i];
			$values .= "?";
		}//end else
	}//end for

    $sql = "INSERT INTO $table_name ("; 
	    //table field names
	    $sql .= $col_names;
        $sql .= ") VALUES ("; 
	    $sql .= $values; 
	    $sql .= ")";
	    $this->STH = $this->get_handle()->prepare($sql);
		$this->STH->execute($data);
	}//end method insert()
	
	//.................................................................
	//UPDATE DATABASE
	public function update_db($table_name, $query_fields){
		$col_names = null;
		$where_col = null;
		foreach($query_fields as $key=>$values){
			
	    switch($key){
				
				CASE "field_names":
				$field_names = $values;
				
		for($i=0; $i<=count($field_names) - 1; $i++){
		    if($i !== count($field_names) - 1){
		        $col_names .= $field_names[$i]. " = ?" . ", ";
		    }
		    else{
			    $col_names .= $field_names[$i]. " = ?";
		    }//end else
			
	    }//end for
				;//end CASE field_names
				break;
				
				CASE "where":
				$where = $values;
				
		for($i=0; $i<=count($where) - 1; $i++){
		    $where_col .= $where[$i]. " ? ";
	    }//end for
				;//end CASE where
				break;
				
				CASE "data":
				$data = $values;
				;//end CASE data
				break;
				
				CASE "order_by":
				$order_by = " ORDER BY " .$values;
				;//end CASE order_by
				break;
				
				CASE "limit":
				$limit = $key. " " .$values;
				;//end CASE limit
				break;
				
				Default:;
				break;
				
		}//end switch
			
			
		}//end foreach
		

    $sql = "UPDATE $table_name SET $col_names";
			
	if(isset($where_col)){
		
		if(count($where) != count($data)){
			//die("Error!, SQL Where clause and data value not matched");
		}
		$sql .= " WHERE " .$where_col; 
	}//end isset $where
	
	if(isset($order_by)){
		$sql .= " " .$order_by; 
	}//end isset $order_by
	
	if(isset($limit)){
		$sql .= " " .$limit; 
	}//end isset $limit
	
	$this->STH = $this->get_handle()->prepare($sql);
    $this->STH->execute($data); 
	
	}//end method update_db
	
	
	//.................................................................
	//DELETE DATA DATABASE
	public function delete_db($table_name, $query_fields){
		$col_names = null;
		$where_col = null;
		foreach($query_fields as $key=>$values){
			
	    switch($key){
				
				CASE "field_names":
				$field_names = $values;
				
		for($i=0; $i<=count($field_names) - 1; $i++){
		    if($i !== count($field_names) - 1){
		        $col_names .= $field_names[$i]. " = ?" . ", ";
		    }
		    else{
			    $col_names .= $field_names[$i]. " = ?";
		    }//end else
			
	    }//end for
				;//end CASE field_names
				break;
				
				CASE "where":
				$where = $values;
				
		for($i=0; $i<=count($where) - 1; $i++){
		    $where_col .= $where[$i]. " ? ";
	    }//end for
				;//end CASE where
				break;
				
				CASE "data":
				$data = $values;
				;//end CASE data
				break;
				
				CASE "order_by":
				$order_by = " ORDER BY " .$values;
				;//end CASE order_by
				break;
				
				CASE "limit":
				$limit = $key. " " .$values;
				;//end CASE limit
				break;
				
				Default:;
				break;
				
		}//end switch
			
			
		}//end foreach
		

    $sql = "DELETE FROM $table_name";
			
	if(isset($where_col)){
		
		if(count($where) != count($data)){
			//die("Error!, SQL Where clause and data value not matched");
		}
		$sql .= " WHERE " .$where_col; 
	}//end isset $where
	
	if(isset($order_by)){
		$sql .= " " .$order_by; 
	}//end isset $order_by
	
	if(isset($limit)){
		$sql .= " " .$limit; 
	}//end isset $limit
	
	$this->STH = $this->get_handle()->prepare($sql);
    $this->STH->execute($data); 
	
	}//end method delete_db
	

	//.................................................................
	//RETURN DATABASE CONNECTION HANDLE
	public function get_handle(){
		return $this->DBH;
	}//end get_handle

	//....................................................................
	//RETURN DATABASE STATEMENT HANDLE
	public function return_sth(){
		return $this->STH;
	}//end return_sth	
	
	//....................................................................
	//CLOSE DATABASE CONNECTION
	public function close_db(){
		$this->STH = null;
		$this->DBH = null;
	}//end close_db	
	
	//....................................................................
	//GET ROWCOUNTS OF DATABASE QUERY
	public function rows(){
	return	$this->STH->rowCount();
	}//end close_db	
	
}//end class Database_connect

//................................................................

?>