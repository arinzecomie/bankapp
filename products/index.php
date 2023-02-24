<?php
if(isset($_GET['pg_rq']) && $_GET['pg_rq'] == "add_product"){
	//check if the request is to change/update the product
if(isset($_GET['_preq']) && $_GET['_preq'] == "update"){
	$url = "?_preq=update&reqrf=".$_GET['reqrf'];
}else{
	$url = null;
}//end if else
?>	
<center>
<form id="upload" method="post" enctype="multipart/form-data" action="../ajax_submit.php<?php echo $url;?>">
<b>Product information</b>
<br>
<input name="p_name" type="text" class="input" placeholder="Product Name" required="required">
<br>
<b>Select product image</b>
<input name="fileToUpload" type="file" id="logo" onchange="readUrl(this);" class="">
<img style="display:none;" id="show" src=""> <br>

<input name="p_price" type="text" class="input" placeholder="Real Price" required="required">
<br>

<input name="price_cancel" type="text" class="input" placeholder="Price Cancel" required="required">
<br>

<select name="p_category" type="text" class=" input"required="required" > 
<option value=""> Select Category</option>
<option value="gift_items"> Gift Items</option>
<option value="tshirt"> T-Shirt Printing</option>
<option value="branding"> Branding</option>
<option value="promo_materials"> Promotional Materials</option>
</select>
<br>

<b>Enter product description</b>
<br>
<textarea name="p_desc" type="text" class="input" required="required"></textarea>
<br>
<!--
<input name="submit_product" type="hidden" name="submit_product"> -->
<input type="submit" name="submit_product" value="Add product" class="login_btn" >
</form>
</center>
<?php
}
?>