<?php
session_start();
include('../library/library.php');
//include('../html_output.php');
?>


<?php
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
if(isset($_GET['form_element']) && $_GET['form_element'] == "descr"){
$pro_details = get_existing_info();
?>	
<center>
<div class="col-sm-5 col-xs-12 col-sm-offset-3">
<form id="upload" method="post"  action="ajax_submit.php">
<br>
<div> <b>Enter company description</b></div>
<br>
<textarea name="description" type="text" class=" input" style="height:200px; width:100%;" required="required"><?php echo $pro_details['description']; ?></textarea>
<br>
<input name="submit_descr" type="hidden" value="descr">
<input type="submit" name="submit_descr" value="Add description" class="login_btn" onclick="ajax_sub();" >
</form>
</div>
</center>
<?php
}//end if descr
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "biz_info"){
	
	$pro_details = get_existing_info();
	
?>	
<form id="upload" method="post" enctype="multipart/form-data" action="ajax_submit.php">
<div class="row">
<div class="col-sm-6">
<div class="bd_b sub_head"> Company Informations</div>
<span class="input_title">Select your business category</span>
<input onclick="read_cat();" id="cat" name="category" type="text" class=" input" value="<?php echo $pro_details['category'];  ?>" required="required">
<span class="input_title">Select your business type</span>
<select name="biz_type" type="text" class=" input">
<?php
if($pro_details['biz_type']!="?"){
?>	
<option><?php echo $pro_details['biz_type'];  ?></option>
<?php
}else{
echo "<option>Select Biz type </option>";
}
?>
<option> Wholesalers </option>
<option> Manufacturers </option>
<option> Distributors </option>
<option> Suppliers </option>
<option> Retailers </option>
<option> News/Media </option>
<option> Hotels</option>
<option> Services </option>
<option> Consultants </option>
<option> NGO </option>

</select>
<span class="input_title">Enter year of establishment</span>
<input name="established" type="text" class=" input" value="<?php echo $pro_details['established'];  ?>">
<span class="input_title">Enter company city</span>
<input name="city" type="text" class=" input" value="<?php echo $pro_details['city'];  ?>">
<span class="input_title">Enter company state</span>
<input name="state" type="text" class=" input" value="<?php echo $pro_details['state'];  ?>">
<span class="input_title">Enter country</span>
<input name="country" type="text" class=" input" placeholder="Country" value="<?php echo $pro_details['country'];  ?>" required="required">

<!--
<input name="submit_descr" type="hidden" value="descr"> -->
<input type="submit" name="submit_biz_info" value="Submit" class="login_btn" onclick="ajax_sub();" >
</form>
</div>
<?php
}
?>

<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "contact"){
//select info from database
    $profile = new Db_conn();
    $table_name = "contact";
	$data = array($_SESSION['mem_id']);
    $query_fields = array("field_names"=>array("*"), "where"=>array("member_id = "), "data"=>$data);
	
    $profile->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	
		$contacts = $profile->return_sth()->fetch();
?>	
<form id="upload" method="post" enctype="multipart/form-data" action="ajax_submit.php">
<div class="row">
<div class="col-sm-8 col-sm-offset-2">
<div class="col-sm-6">
<div class="bd_b sub_head"> Company contacts </div>
<span class="input_title">Company phone number</span>
<input name="Phone" type="text" class=" input" value="<?php echo $contacts['phone']; ?>">
<span class="input_title">Company email</span>
<input name="email" type="text" class=" input" <?php if($contacts['email'] !="?"){ echo 'value="'.$contacts['email'].'"';}else{ echo 'placeholder="me@example.com"';} ?>>
<span class="input_title">Company website</span>
<input name="website" type="text" class=" input" <?php if($contacts['website'] !="?"){ echo 'value="'.$contacts['website'].'"';}else{ echo 'placeholder="www.example.com"';} ?>>
<div class="bd_b sub_head"> Office address </div>
<span class="input_title">Company office address</span>
<input name="office_add" type="text" class="input" value="<?php echo $contacts['address']; ?>">
</div>


<div class="col-sm-6">
<div class="bd_b sub_head"> Social</div>
<span class="input_title">Company facebook page</span>
<input name="facebook" type="text" class=" input"  value="<?php echo $contacts['facebook']; ?>">
<span class="input_title">Company whatsapp number</span>
<input name="whatsapp" type="text" class=" input" value="<?php echo $contacts['whatsapp']; ?>">
<span class="input_title">Company twitter handle</span>
<input name="twitter" type="text" class=" input" value="<?php echo $contacts['twitter']; ?>">
</div>
</div>
</div>
<!--
<input name="submit_descr" type="hidden" value="descr"> -->
<input type="submit" name="submit_social" value="Submit" class="login_btn center-block" onclick="ajax_sub();" >
</form>
<?php
}
?>


<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "product"){
	//check if the request is to change/update the product
if(isset($_GET['_preq']) && $_GET['_preq'] == "update"){
	$url = "?_preq=update&reqrf=".$_GET['reqrf'];
}else{
	$url = null;
}//end if else
?>	
<center>
<form id="upload" method="post" enctype="multipart/form-data" action="ajax_submit.php<?php echo $url;?>">
<b>Product information</b>
<br>
<input name="product_name" type="text" class="input" placeholder="Product Name" required="required">
<br>
<b>Select product image</b>
<input name="fileToUpload" type="file" id="logo" onchange="readUrl(this);" class="">
<img style="display:none;" id="show" src=""> <br>
<b>Enter product description</b>
<br>
<textarea name="p_description" type="text" class="input" required="required"></textarea>
<br>
<!--
<input name="submit_product" type="hidden" name="submit_product"> -->
<input type="submit" name="submit_product" value="Add product" class="login_btn" >
</form>
</center>
<?php
}
?>

<?php
if(isset($_GET['form_element']) && $_GET['form_element'] == "biz_promo"){
?>	
<center>
<form id="upload" method="post" enctype="multipart/form-data" action="ajax_submit.php">
<b>Promo Details</b>
<br>
<input name="promo_caption" type="text" class="input" placeholder="Caption" required="required">
<br>
<b>Select promo banner</b>
<input name="fileToUpload" type="file" id="logo" onchange="readUrl(this);" required="required">
<img style="display:none;" id="show" src=""> <br>
<b>Enter promo description</b>
<br>
<textarea name="promo_description" type="text" class="input" required="required"></textarea>
<input name="start" type="text" class="input" placeholder="Start Date">

<input name="end" type="text" class="input" placeholder="End Date">
<br>
<!--
<input name="submit_product" type="hidden" name="submit_product"> -->
<input type="submit" name="submit_promo" value="Add Promo" class="login_btn" >
</form>
</center>
<?php
}
?>


<?php
//if the user or business is not logged in print the login and reg form for popup
if(!isset($_SESSION['all_user'])){
	
 $login_opt = login_option($dir);
 company_login($dir);
 user_login($dir);
 user_signup($dir);
 
  echo "<div style='display:none;' id='myForm'> <script> document.getElementById('err_msg').innerHTML = '<center> <b> Login to explore more features </b> </center>'; </script> $login_opt </div>";

	}//end if

?>

 <?php
//print login message in the case of error
  echo $login;  
  ?>
  
<?php
footer($dir);
?>