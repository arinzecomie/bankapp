<?php
session_start();
?>
<?php

include('../library/library.php');
?>

<?php
if(isset($_POST['submit_newsletter'])){
			//update add career profile
			unset($_POST['submit_newsletter']);
			$form_data = $_POST;
			$date = Date("Y-m-d H:i:s");
			$time = Date("H:i:s");
			$client_mail = $_POST['EMAIL'];
			//send the client email
			$mail_body = "<b> Client Email</b> = <a href='mailto:".$client_mail."'>".$client_mail."</a>";
			
			$validate = new Validation();
			$validate->validate_data($form_data);
			
			
	if($validate->return_passed() == true){
		$validate->add_valid_data($date);
		$validate->add_valid_data($time);
		$validate->add_valid_data("new");
		$db = new Db_conn();
		$data = $validate->return_valid_data();
		//print_r($data);
        $table_name = "newsletter";
        $field_names = array("email", "date", "time", "status"); 
        $db->insert_db($table_name, $field_names, $data);
			if($db->rows()>0){
			echo alert_msg("<strong>Success</strong> <br> Welcome to our monthly digital marketing newsletter! <br> It is time to top up the game! <br> <br> <strong>Stay tunned!</strong>", "#ffffff");
			
			
					  //mail the customer contact
			$sender ="contact@bizrator.com";
	
$headers = "From:Bizrator<$sender>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	
	$message = "<HTML><BODY> <center>
	<h4>Newsletter Subscription</h4><br>
 <span style='color:green;'>Details of client</span>
 <br>
 $mail_body
 <a href='https://www.bizrator.com'> <h4>  Bizrator.com </h4> </a>
 <br> 
 </center>
 </BODY>
 </HTML>";

//echo $message;
       $master_email= "christomac12@gmail.com"; 
	   $subject = "Newsletter Subscription";
	   //mail($master_email, $subject, $message, $headers);
	   
			
	exit();
			}//end if rows
	}else{
		echo alert_msg("<span style='color:#000;'>Error: Some fields are empty! <br> Fill the required field and try again</span>", "#e6e6ff");
	}//end if return_passed
}//end isset
?>
