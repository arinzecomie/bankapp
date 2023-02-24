<?php
session_start();
?>
<?php
if(!isset($_SESSION['admin_username']) ||
  $_SESSION['admin_username']=="") {
header("location:admin_login.php");
}

include('../library/library.php');
?>

<?php
$title= "Bizrator-Online Digital Printing";
$meta_key = "Bizrator, printing, branding";
$meta_desc = "Bizrator, printing, branding";
main_menu("$title", "$meta_key", "$meta_desc", "../");

$dir="../"; //page directory to the root folder
?>

<?php
if(isset($_GET['pg_rq']) && $_GET['pg_rq'] == "add_product"){
	//check if the request is to change/update the product
if(isset($_GET['_preq']) && $_GET['_preq'] == "update"){
	$url = "?_preq=update&reqrf=".$_GET['reqrf'];
}else{
	$url = null;
}//end if else
?>	

<div class="container">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<form id="upload" method="post" enctype="multipart/form-data" action="../ajax_submit.php<?php echo $url;?>">
<b>Product information</b>
<br>
<input name="p_name" type="text" class="form-control" placeholder="Product Name" required="required">
<br>
<b>Select product image</b> <br>
<input name="fileToUpload" type="file" id="logo" onchange="readUrl(this);" class="form-control"> <br>
<img style="display:none;" id="show" src=""> <br>

<input name="min_order" type="text" class="form-control" placeholder="Minimum Order Qty" required="required">
<br>
<input name="p_price" type="text" class="form-control" placeholder="Real Price" required="required">
<br>

<input name="price_cancel" type="text" class="form-control" placeholder="Price Cancel" required="required">
<br>

<select name="p_category" type="text" class="input form-control" required="required"> 
<option value="nil"> Select Category</option>
<option value="gift-items"> Gift Items</option>
<option value="t-shirt-printing"> T-Shirt Printing</option>
<option value="branding"> Branding</option>
<option value="promotional-materials"> Promotional Materials</option>
<option value="publicity"> Publicity</option>
<option value="graphic-design"> Graphic Design</option>
<option value="video-advert"> Video Advert</option>
<option value="sourvinir"> Sourvinir</option>
</select>
<br>
<div style="display:block; clear:both;"> <b>Enter product description</b> </div>
<textarea name="p_desc" type="text" class="form-control" required="required"></textarea>
<br>
<!--
<input name="submit_product" type="hidden" name="submit_product"> -->
<input type="submit" name="submit_product" value="Add product" class="login_btn" >
</form>
</div>
</div>
</div>

<?php
}//end if
?>


<?php //edit/update product form
if(isset($_GET['pg_rq']) && $_GET['pg_rq'] == "edit_product"){
	
	
// get the existing product information
   $db = new Db_conn();
    $table_name = "product";
	$product_code = $_GET['prod_ref'];
	$data = array($product_code); 
    $query_fields = array("field_names"=>array("*"), "where"=>array("p_code = "), "data"=>$data); 
	
    $db->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
			
	$products = $db->return_sth()->fetch();//set the product data
	
	}//end check_status	
			
	
	
	
?>	

<div class="container">
<div class="row">

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<h3> Current Product </h3>
<img src ="<?php echo $dir."products/img/".$products["p_img"];?>">
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div style="border:1px solid grey; border-radius:8px; padding:10px;">
<form id="upload" method="post" enctype="multipart/form-data" action="../ajax_submit.php?prod_ref=<?php echo $products["p_code"]; ?>">
<h4><span style="color:#ff4000"> Product information </span></h4>
<br>
Product Name
<input name="p_name" type="text" class="form-control" value="<?php echo $products["p_name"];?>" required="required">
<br>
<b>Change product image</b> <br>
<input name="fileToUpload" type="file" id="logo" onchange="readUrl(this);" class="form-control"> <br>
<img style="display:none;" id="show" src=""> <br>
Enter Tag(1=hot, 2=most sales, 3=featured, 4=offers)
<input name="p_tag" type="text" class="form-control" value="<?php echo $products["p_tag"];?>" required="required">
Enter Minimum Order Qty
<input name="min_order" type="text" class="form-control" value="<?php echo $products["min_order"];?>" required="required">

<br>
<div class="row">

<div class="col-md-6">
Real Price
<input name="p_price" type="text" class="form-control" value="<?php echo $products["p_price"];?>" required="required">
</div>

<div class="col-md-6">
Price Cancel
<input name="price_cancel" type="text" class="form-control" value="<?php echo $products["price_cancel"];?>" required="required">
</div>

</div>
<br>
Select Category <br>
<select name="p_category" type="text" class="input form-control" required="required"> 
<option value="<?php echo $products["p_category"];?>""> <?php echo $products["p_category"];?></option>
<option value="gift-items"> Gift Items</option>
<option value="t-shirt-printing"> T-Shirt Printing</option>
<option value="branding"> Branding</option>
<option value="promotional-materials"> Promotional Materials</option>
<option value="publicity"> Publicity</option>
<option value="graphic-design"> Graphic Design</option>
<option value="video-advert"> Video Advert</option>
<option value="sourvinir"> Sourvinir</option>
</select>
<br>
<div style="display:block; clear:both;"> <b>Enter product description</b> </div>
<textarea name="p_desc" type="text" class="form-control" required="required"><?php echo $products["p_desc"];?>"</textarea>
<br>
<!--
<input name="submit_product" type="hidden" name="submit_product"> -->
<input type="submit" name="update_product" value="Add product" class="login_btn" >
</form>
</div>
</div>

</div>
</div>

<?php
}
?>


<?php
footer('../');
?>