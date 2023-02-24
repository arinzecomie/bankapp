<?php
session_start();
include('../library/library.php');
?>

<?php 
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
$dir ="../";
menu($title, $meta_key, $meta_desc, $dir);
?>

<div class="header_img" style="background-image:url(<?php echo $dir; ?>img/reg.jpg);">
	<div class="text-center" style="background:rgba(0,0,0,0.5); top:50%; padding:20px; line-height:50px; height:100%;">
	<h2 style="color:#ff4000; font-size:50px;"><b> Join Us Today!</b></h2> <h3><span style="color:#fff;">  Experience financial stability </span></h3>
	</div>
	</div>

<div style="margin-top:20px;">
</div>

<div class="container">
<div class="row">
<div class="col-lg-2  col-md-2 col-sm-1 col-xs-12">
</div>
<div class="col-lg-8  col-md-8 col-sm-10 col-xs-12 " style="background-color:#000066; border-radius:10px; padding:0px; margin-bottom:10px;">
<div style="padding:20px; color:#fff; font-weight:bold; border-bottom:1px solid grey;" class="text-center">
<img src="../img/icon/registration.png" style="width:100px;">
 <h4 style="color:#aeaeae;">Create New Account</h4></div>
<div style="background-color:#000066; padding:5px; color:#fff;">
<form id="register" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
<span class="input_title"> <i class="fa fa-address-book"> </i> First Name </span>
  <input id="full_name" class="modal_input" type="text" name="f_name" required="required">
  <div id="fn_msg" style="color:red;">  </div>
  
  <span class="input_title"> <i class="fa fa-address-book-o"> </i> Last Name </span>
  <input id="full_name" class="modal_input" type="text" name="l_name" required="required">
  <div id="fn_msg" style="color:red;">  </div>
  <span class="input_title"> <i class="fa fa-envelope"> </i> Email</span>
  <input id="user_email" class="modal_input" type="text" name="email" required="required">
  <div id="email_message" style="color:red;">  </div>
  <span class="input_title"> <i class="fa fa-phone"> </i> Phone No</span>
  <input id="user_ph" class="modal_input" type="text" name="phone" required="required">
  <div id="user_phone" style="color:red;">  </div>
  <span class="input_title"> <i class="fa fa-user"> </i> Username</span>
  <input id="user_state" class="modal_input" type="text" name="username" required="required">
  <div id="user_st" style="color:red;">  </div>
  <span class="input_title"> <i class="fa fa-lock"> </i> Password </span>
  <input id="user_pw" class="modal_input" type="password" name="password" required="required">
  <div id="pw1" style="color:red;">  </div>
  <span class="input_title">  <i class="fa fa-lock"> </i> Confirm Password</span>
  <input id="re_user_pw" class="modal_input" type="password" name="re_password" required="required">
  <div id="pw2" style="color:red;">  </div>
  <div class="col-xs-12"> By signing up, you agree to the babankonline.com's <a>privacy policy</a> and <a>Terms of use</a> </div>
 <center>
 <input type="hidden" name="submit_register">
 <button onclick="ajax_sub('register');"  id="signup_user" class="site-btn" type="submit" name="submit_register"> <i class="fa fa-send"> </i> Signup</button> 
 </center>
 </form>

</div>
</div>
</div>
</div>


 <?php
footer($dir); 
 ?>
 <?php 
 //signup user
if(isset($_POST['submit_register'])){
	$login = signup_user();
 }//end if isset

?>