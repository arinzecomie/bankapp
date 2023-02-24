<?php
session_start();
include('../library/library.php');
if(isset($_SESSION['user_code'])){
	//validate cookie
	if(isset($_COOKIE['remember_me'])){
		unset($_COOKIE['remember_me']);
		setcookie('remember_me', null, -1, '/');
		
		//unset cookie for company cookie identification
		if(isset($_COOKIE['remember'])){
			
			unset($_COOKIE['remember']);
			setcookie('remember', null, -1, '/');
		}//end if isset
		if(isset($_SESSION['mem_id'])){$table_name ="register";}else{$table_name ="users";}//set the table to update wether the its user or company
		$data = array("?", $_SESSION['user_id']);
		$query_fields = array("field_names"=>array("keep_me_in"), "where"=>array("member_id ="), "data"=>$data);
		$check_user = new Db_conn();
		$check_user->update_db($table_name, $query_fields);
		$check_user->close_db();
	}//end isset cookie

		unset($_SESSION['user_code']);
		header("location:../");
}//end if isset
?>