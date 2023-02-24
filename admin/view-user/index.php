<?php
session_start();
include('../../library/library.php');
?>
<?php

if(!isset($_SESSION['admin_username']) ||
  $_SESSION['admin_username']=="") {
header("location:admin_login.php");
}
?>

 <?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
  $dir="../../";
  menu($title, $meta_key, $meta_desc, $dir);
  ?>

<style>
tr:nth-child(odd){
	background-color:#f5f5f5;
	
}
tr:nth-child(even){
	background-color:#000066;
	color:#fff;
	
}
</style>

<br>
<br>

<?php
//get user info from user table
           $db_user = new Db_conn();
			$user = $user_id;
			//select the company that made the biz insight post
			$table_name = "users";
	        $data = array($_GET['ref']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("user_code = "), "data"=>$data);
	
            $db_user->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $user = $db_user->return_sth()->fetch();

?>

<?php
//get user account info from account table
           $db_user = new Db_conn();
			//select the company that made the biz insight post
			$table_name = "account_info";
	        $data = array($user['username']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = "), "data"=>$data);
	
            $db_user->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $acc_info = $db_user->return_sth()->fetch();

?> 


<div class="row" style="border-bottom:1px solid #fff;">
<div class="col-sm-3 text-center">
<?php if(!empty($user['passport'])){ ?>
<img style="width:150px;" src="../../passport/<?php echo $user['passport']; ?>">
<?php 
}else{
	?>
<img style="width:150px;" src="../../img/icon/avatar.jpg">	
<?php	
}//end if else
?>
<h4> <?php echo $user['f_name']." ".$user['l_name']; ?> </h4>
</div>
<div class="col-sm-9">
<div class="row">
<div class="col-sm-4 text-center">
<div style="background-color:#f5f5f5; border:1px solid grey; margin:10px; border-radius:5px;">
<h3><i class="fa fa-money"> </i></h3>
Current Balance
<div class="bg-success" style="background-color:#000066; color:#fff; padding:20px;"> $ <?php echo $acc_info['account_bal']; ?>  </div>
</div>

</div>

<div class="col-sm-4 text-center" style="">
<div style="background-color:#f5f5f5; border:1px solid grey; margin:10px; border-radius:5px;">
<h3><i class="fa fa-cc-diners-club"> </i></h3>
Total Deposited
<div class="bg-success" style="background-color:#000066; color:#fff; padding:20px;"> $ <?php echo $acc_info['total_dep']; ?></div>
</div>

</div> 

<div class="col-sm-4 text-center" style="">
<div style="background-color:#f5f5f5; border:1px solid grey; margin:10px; border-radius:5px;">
<h3><i class="fa fa-credit-card"> </i></h3>
Total Withdrawal
<div class="bg-success" style="background-color:#000066; color:#fff; padding:20px;"> $ <?php echo $acc_info['total_wid']; ?>  </div>
</div>

</div> 
<div style="margin-left:20px; padding:5px;">
<button class="btn btn-primary" onclick="show_credit()"> Credit User </button>
<div id="show_credit" style="border:1px solid grey; background-color:#eaeaea; display:none;">
<form id="credit" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
  
  <span class="input_title">Amount </span>
  <input id="amount" class="modal_input" type="text" name="amount" placeholder="Enter Amount" required="required">
  <input id="amount" class="modal_input" type="hidden" name="user" value="<?php echo $user['username']; ?>">
  <div id="fn_msg" style="color:red;">  </div>
 <center>
 <input type="hidden" name="submit_credit">
 <button onclick="ajax_sub('credit');"  id="signup_user" class="site-btn" type="submit" name="submit_credit">Credit</button> 
 </center>
 </form>
 </div>

</div>

<div style="padding:5px;"> 
<form id="block_trans" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="user" value="<?php echo $user['username']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="status" value="<?php echo $acc_info['status']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="user_code" value="<?php echo $user['user_code']; ?>">
 <input type="hidden" name="submit_block_trans">
<button onclick="ajax_sub('block_trans');" class="btn btn-danger">
 <?php
 if($acc_info['status'] !== "block"){ echo "Block User Transfer";}else{
	 echo "Unblock User Transfer";
 }
 ?>
 </button>
 </form>
</div>

<div style="padding:5px;">
<form id="ban_user" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="user" value="<?php echo $user['username']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="status" value="<?php echo $user['status']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="user_code" value="<?php echo $user['user_code']; ?>">
 <input type="hidden" name="submit_ban_user">
<button onclick="ajax_sub('ban_user');" class="btn btn-danger">
 <?php
 if($user['status'] !== "banned"){ echo "Ban User";}else{
	 echo "Activate User";
 }
 ?>
 </button>
 </form> 
</div>


<div style="padding:5px;">
<form id="admin_trans" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="username" value="<?php echo $user['username']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="balance" value="<?php echo $acc_info['account_bal']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="email" value="<?php echo $user['email']; ?>">
 <input type="hidden" name="submit_admin_trans">
<button onclick="ajax_sub('admin_trans');" class="btn btn-primary">
Transfer
 </button>
 </form> 
</div>

<div style="padding:5px;">
<form id="admin_edit_bal" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="username" value="<?php echo $user['username']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="account_bal" value="<?php echo $acc_info['account_bal']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="total_dep" value="<?php echo $acc_info['total_dep']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="total_wid" value="<?php echo $acc_info['total_wid']; ?>">
 <input type="hidden" name="admin_edit_bal">
<button onclick="ajax_sub('admin_edit_bal');" class="btn btn-primary">
Edit Balance
 </button>
 </form> 
</div>

<div style="padding:5px;">

   <button  onclick="show_change_days('show_change_days');" class="btn btn-success">Changeblock days </button>
			 <div id="show_change_days" style="border:1px solid grey; background-color:#eaeaea; display:none;">
    <form id="change_days" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
  
  <span class="input_title">Enter days </span>
  <input id="amount" class="modal_input" type="text" name="days" placeholder="eg 10" required="required">
 <center>
 <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
 <input type="hidden" name="submit_change_days">
 <button onclick="ajax_sub('change_days');"  id="signup_user" class="site-btn" type="submit" name="submit_credit">Submit</button> 
 </center>
 </form>
 </div>

</div>

</div> 
</div> 
</div> 
<hr>


<div class="row" style="border-bottom:1px solid #fff;">

<div class="col-sm-6">

	<div class="container">
<div class="row">
<div class="col-lg-12  col-md-12 col-sm-12 col-xs-12 " style="background-color:#000066; border-radius:10px; padding:0px;">
<div style="padding:20px; color:#fff; font-weight:bold;" class="text-center"><h5 style="color:#fff;"><b>Edit Account</b></h5></div>
<div style="background-color:#eaeaea; padding:5px;">
<form id="update" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
<span class="input_title">First Name </span>
  <input id="full_name" class="modal_input" type="text" name="f_name" Value="<?php echo $user['f_name']; ?>">
  <div id="fn_msg" style="color:red;">  </div>
  
  <span class="input_title">Last Name </span>
  <input id="full_name" class="modal_input" type="text" name="l_name" Value="<?php echo $user['l_name']; ?>">
  <div id="fn_msg" style="color:red;">  </div>
  <span class="input_title">Email</span>
  <input id="user_email" class="modal_input" type="text" name="email" Value="<?php echo $user['email']; ?>">
  <span class="input_title">Username</span>
  <input id="user_email" class="modal_input" type="text" name="username" Value="<?php echo $user['username']; ?>" disabled="disabled">
  <span class="input_title">Account No</span>
  <input id="user_email" class="modal_input" type="text" name="account_no" Value="<?php echo $user['account_no']; ?>">
  <div id="email_message" style="color:red;">  </div>
  <span class="input_title">Phone No</span>
  <input id="user_ph" class="modal_input" type="text" name="phone" Value="<?php echo $user['phone_no']; ?>">
  
  <span class="input_title">Password</span>
  <input id="user_pw" class="modal_input" type="text" name="password" Value="<?php echo $user['password']; ?>">
  
 <center>
 <input type="hidden" name="admin_user_update">
 <input type="hidden" name="username" Value="<?php echo $user['username']; ?>">
 <button onclick="ajax_sub('update');"  id="signup_user" class="site-btn" type="submit" name="admin_user_update">Update</button> 
 </center>
 </form>

</div>
</div>
</div>
</div>
		

</div>


<div class="col-sm-6 text-center" style="">
<div style="background-color:#f5f5f5; border:1px solid grey; margin:20px;">
<h3><i class="fa fa-user"> </i></h3>
Status
<div class="bg-success" style="background-color:green; padding:20px;"> <?php echo ucfirst($user['status']); ?>  </div>
</div>
<br>

<div style="background-color:#f5f5f5; border:1px solid grey; margin:20px;">
<h3><i class="fa fa-envelope"> </i></h3>
Email Verification
<div class="bg-success" style="background-color:green; padding:20px;"> <?php if($user['verify_status'] == "yes"){echo "Verified";}else{ echo "Not Verified";} ?>  </div>

<div style="padding:5px;">
<form id="verify_email" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="user" value="<?php echo $user['username']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="status" value="<?php echo $user['verify_status']; ?>">
 <input id="amount" class="modal_input" type="hidden" name="user_code" value="<?php echo $user['user_code']; ?>">
 <input type="hidden" name="submit_verify_email">

 <?php
 if($user['verify_status'] !== "yes"){ 
 echo "<button onclick=\"ajax_sub('verify_email');\" class='btn btn-success'> Verify Email";
 }else{
	 
	 echo " <button onclick=\"ajax_sub('verify_email');\" class='btn btn-danger'> Unverify Email";
 }
 ?>
 </button>
 </form> 
</div>

</div>
<br>

</div> 


</div> 
<hr>
<script type="text/javascript" src="../../js/admin.js"></script>
<?php
footer("../../");
?>