<?php
session_start();
include('library/library.php');


function get_existing_info(){
//select info from database
    $profile = new Db_conn();
    $table_name = "profile";
	$data = array($_SESSION['mem_id']);
    $query_fields = array("field_names"=>array("*"), "where"=>array("member_id = "), "data"=>$data);
	
    $profile->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	$check_status = $profile->rows();
	
		
		$pro_details = $profile->return_sth()->fetch();
		return $pro_details;
}//end function get_existing_info

?>

<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "upload_photo"){
	echo " <script> document.getElementById('err_msg').innerHTML = ''; </script>";
$pro_details = get_existing_info();
	$dir = "../";
	if($_GET['dir'] == "relative2"){ $dir="../../"; }//end if
?>	
<div class="popup_border">
<div style="margin:20px;">
<center>
<form id="upload" method="post" enctype="multipart/form-data" action="<?php echo $dir; ?>ajax_submit.php">
<b>Select company logo</b>
<br>
<br>
<input name="fileToUpload" type="file" id="logo" onchange="readUrl(this);" class="display:block" required="required">
<img style="display:none;" id="show" src="">
<br>
<b>Company Slogan</b>
<br>
<input name="slogan" type="text" class="input" placeholder="Company slogan" value="<?php echo $pro_details['slogan']; ?>">
<br>
<input name="submit_photo" type="hidden" name="upload">
<input type="submit" name="submit_photo" value="upload" class="login_btn" onclick="ajax_sub_img();" >
</form>
</center>
</div>
</div>
<?php
}
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "biz_insight"){
?>	
<center>
<form id="upload" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
<b>Business insight</b>
<br>
<input name="title" type="text" class="input" placeholder="Tile/heading of your article">
<br>
<b>Type your article</b>
<br>
<textarea name="main_article" type="text" class="input"></textarea>
<br>
<b>Select image</b>
<input name="logo" type="file" id="logo" onchange="readUrl(this);" required="required">
<img style="display:none;" id="show" src="">
<input name="submit_article" type="hidden" name="submit_article">
<input type="submit" name="submit_article" value="Post insight" class="login_btn" onclick="ajax_sub();" >
</form>
</center>
<?php
}
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "upload_advert"){
	echo " <script> document.getElementById('err_msg').innerHTML = ''; </script>";
	$dir = "../";
	if($_GET['dir'] == "relative2"){ $dir="../../"; }//end if
?>	
<div class="popup_border">
<br>
<center>
<b> Place New Advert</b>
<form id="upload" method="post" enctype="multipart/form-data" action="<?php echo $dir; ?>ajax_submit.php">
<input name="slogan" type="text" class="input" placeholder="Enter advert caption" required="required">
<b>Select Advert Banner</b>
<input name="fileToUpload" type="file" id="logo" onchange="readUrl(this);" required="required">
<img style="display:none;" id="show" src="">
<input name="submit_advert" type="hidden">
<input type="submit" name="submit_advert" value="Add Advert" class="login_btn" onclick="ajax_sub_img();" >
</form>
</center>
</div>
<?php
}
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "add_career"){
	echo " <script> document.getElementById('err_msg').innerHTML = ''; </script>";
?>	
<div class="popup_border">
<br>
<center>
<b>Add your career profile</b>
<form id="update" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
<textarea name="career_desc" class="full_input" style="height:150px;" placeholder="Enter your career details"></textarea>
<input name="submit_career" type="hidden" value="add_career" >
<input type="submit" name="submit_career" value="Save" class="login_btn" onclick="ajax_sub();" >
</form>
</center>
</div>
<?php
}
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "feedback"){
	 if($_GET['dir'] == "relative0"){ $dir="../"; }elseif($_GET['dir'] == "relative2"){ $dir="../../"; }
	echo " <script> document.getElementById('err_msg').innerHTML = '<center> <b>Your feedback is important to us</b> </center>'; alert('yesssss'); </script>";
?>
<div class="popup_border">
<br>	
<center>
<form id="update" method="post" enctype="multipart/form-data" action="<?php echo $dir; ?>ajax_submit.php">
<input name="email" class="full_input custom_height" type="text" Placeholder="Enter your email" required="required">
<textarea name="feedback_content" class="full_input" style="height:150px;" placeholder="Enter feedback" required="required"></textarea>
<input name="submit_feedback" type="hidden" value="get_feedback">
<input type="submit" name="submit_feedback" value="Submit" class="login_btn" onclick="ajax_sub();" >
</form>
</center>
</div>
<?php
}
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "request_quote"){
	 if($_GET['dir'] == "relative0"){ $dir="../"; }elseif($_GET['dir'] == "relative2"){ $dir="../../"; }
	echo " <script> document.getElementById('err_msg').innerHTML = '<center> <b class=\"assistant_icon\" style=\"color:#ffffff;\">We are your digital assistant &nbsp <a href=\"https://wa.me/+2348169920495\"><i class=\"fa fa-whatsapp\"></i></a> &nbsp <a href=\"mailto:contact@bizrator.com\"><i class=\"fa fa-envelope\"></i></a> &nbsp <a href=\"https://www.facebook.com/bizrator\"><i class=\"fa fa-facebook\"></i> </b></center>'; </script>";
?>	
<div style="background-color:#f2f2f2; padding:10px;">
<form id="update" method="post" enctype="multipart/form-data" action="<?php echo $dir; ?>ajax_submit.php">
<div style="border-bottom:1px solid #eaeaea; margin-bottom:5px; padding:5px;">
<span class="input_title" style="color:#ff4000;">What do you need? </span><br>
  <div id="fn_msg" style="color:red;">  </div>
  <select name="p_category" type="text" class="input form-control" required="required"> 
<option value="select"> select </option>
<option value="design"> Design</option>
<option value="printing">Printing</option>
<option value="branding"> Branding</option>
<option value="video_advert"> Video Advert </option>
<option value="consultation"> Consultation </option>
<option value="general_enquiry"> General Enquiry </option>
</select>
  </div>
  <span class="input_title">Full Name </span>
  <input id="full_name" class="modal_input" type="text" name="company_name" required="required">
  <div id="fn_msg" style="color:red;">  </div>
  <span class="input_title">Email</span>
  <input id="user_email" class="modal_input" type="text" name="email" required="required">
  <div id="email_message" style="color:red;">  </div>
  <span class="input_title">Phone No</span>
  <input id="user_ph" class="modal_input" type="text" name="phone" required="required">
  <div id="user_phone" style="color:red;">  </div>
  <span class="input_title">State/Address</span>
  <input id="user_state" class="modal_input" type="text" name="state" required="required">
  <div id="user_st" style="color:red;">  </div>
  <span class="input_title">Description (<i> Your message </i>)</span>
  <textarea id="description" class="modal_input form-control" type="text" name="description" required="required"> </textarea>
  <div id="description" style="color:red;">  </div>
  <input name="submit_quote" type="hidden" value="get_quote">
 <center> <button style="border-radius:5px;" onclick="ajax_sub('update');" id="signup_user" class="site-btn" type="submit" name="submit_quote">Submit</button> </center>
 </form>

</div>
<?php
}
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "suggestions"){
	 if($_GET['dir'] == "relative0"){ $dir="../"; }elseif($_GET['dir'] == "relative2"){ $dir="../../"; }
	echo " <script> document.getElementById('err_msg').innerHTML = '<center> <b>Your suggestion is important to us </b> </center>'; </script>";
?>	
<div class="popup_border">
<br>
<center>
<form id="update" method="post" enctype="multipart/form-data" action="<?php echo $dir; ?>ajax_submit.php">
<input name="email" class="modal_input custom_height" type="text" Placeholder="Enter your email" required="required">
<textarea name="suggestion_content" class="modal_input" style="height:150px;" placeholder="Enter your suggestion" required="required"></textarea>
<input name="submit_suggestion" type="hidden" value="get_suggestion">
<input type="submit" name="submit_suggestion" value="Submit" class="login_btn" onclick="ajax_sub();" >
</form>
</center>
</div>
<?php
}
?>
