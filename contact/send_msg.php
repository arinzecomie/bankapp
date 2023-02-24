<?php
session_start();
?>
<?php

include('../library/library.php');
?>


<?php
if(isset($_POST['submit_contact'])){
			//update add career profile
			unset($_POST['submit_contact']);
			$form_data = $_POST;
			$date = Date("Y-m-d H:i:s");
			$time = Date("H:i:s");
			$validate = new Validation();
			$validate->validate_data($form_data);
			
	if($validate->return_passed() == true){
		$validate->add_valid_data($date);
		$validate->add_valid_data($time);
		$validate->add_valid_data("new");
		$db = new Db_conn();
		$data = $validate->return_valid_data();
		
        $table_name = "contact";
        $field_names = array("name", "email", "phone_no", "msg", "date", "time", "status"); 
        $db->insert_db($table_name, $field_names, $data);
			if($db->rows()>0){
			echo alert_msg("<b>Success:</b> Your message was received successfully! <br> Thank you", "#ffffff");
	exit();
			}//end if rows
	}else{
		echo alert_msg("<b>Error:</b> Some fields are empty! <br> Fill the required field and try again", "#ffffff");
	}//end if return_passed
}//end isset
?>
