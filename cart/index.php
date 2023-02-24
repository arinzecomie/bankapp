<?php
session_start();
include('../library/library.php');
?>


<?php

if(isset($_GET['try'])){
	$code = rand(1000, 9999);
	$new_product = array();
	$new_product["name"] = "name"; 
	$new_product["id"] = "code"; 
	$new_product["price"] = "price"; 
	//$cart_array = array();
	//setcookie('cart_items', null, -1, '/');
	print count(($_COOKIE['cart_items']));
	exit();
	if(isset($_COOKIE['cart_items']) && count($_COOKIE['cart_items']) > 0 ){
		$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
		$cart_array["products"][$code] = $new_product;
		//unset($cart_array["products"][8452]);
		$items = json_encode($cart_array["products"]);
	   //setcookie('cart_items', $items, time()+86400*15, '/');
		$_COOKIE['cart_items'] = $items;
		print_r (json_decode($_COOKIE["cart_items"] , true));
		//print count($cart_array["products"]);
		// $cart_array["products"][$code] = $new_product;
					 //print_r(json_decode($_COOKIE['cart_items'], true));
	}else{
		//exit();
		$cart_array["products"][$code] = $new_product;
		$items = json_encode($cart_array["products"]);
	   //setcookie('cart_items', $items, time()+86400*15, '/');
	   $_COOKIE['cart_items'] = $items;
		print_r(json_decode($_COOKIE['cart_items'], true));
		//print_r($cart_array["products"]);
		
	}//end isset
	//$cart_array["products"][2] = $new_product;
	//unset($_SESSION["products"]);
	//print_r($new_product);
	//echo count($cart_array["products"]);
	//$items = json_encode($cart_array["products"]);
	//print_r($cart_array["products"]);
	//setcookie('cart_items', $items, time()+86400*15, '/');
	
	//exit();	
}//end isset
?>


<?php
	function view_cart($dir="", $check= array()){
		if(isset($_COOKIE['cart_items']) && count($_COOKIE['cart_items'])> 0){ //if we have cookie variable
		//$cart_box = '<hr style=\"margin:2px;\"> <ul class="cart-products-loaded">';
		$cart_box = '<div style="margin-top:-20px;"> </div> <ul class="cart-products-loaded" style>';
		$total = 0;
		$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
		foreach($cart_array["products"] as $product){ //loop though items and prepare html content
			
			//set variables to use them in HTML content below
			$product_name =  $product["name"]; 
			$product_amount = $product["price"];
			$product_id =  $product["id"];
			$product_qty = $product["quantity"];
			//$product_color = $product["product_color"];
			$product_size = "L"; //$product["size"];
			$product_array_id = $product_id;
			$product_amt = $product_amount * $product_qty;
			
			$cart_box .=  "<li> $product_name (Qty : $product_qty | Price : $product_amt) &mdash; $currency ".sprintf("%01.2f", ($product_price * $product_qty)). " <span onclick =\"remove_item($product_id, \'$dir\');\" style =\" cursor:pointer; color:red; font-size:30px; font-weight:bold; \" title=\"Remove item\" class=\"remove-item\" data-code=\"$product_array_id\">&times;</span></li><hr style=\"margin:2px;\">";
			$subtotal = ($product_amount * $product_qty);
			$total = ($total + $subtotal);
			
		}
		$cart_box .= "</ul>";
		
		$cart_box .= ' <div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="'.$dir.'checkout/" title="Review Cart and Check-Out" style="margin:3px; font-weight:bold; color:#ff4000;">Check-out</a></u></div>';
		//die($cart_box); //exit and output content
		$cart_no = count($cart_array["products"]);
		echo "<script> document.getElementById('cart_no').innerHTML=\"$cart_no\";</script>";
		if($cart_no > 1){ $cart_no_item = "$cart_no items";}else{ $cart_no_item ="$cart_no item"; }
		echo "<script> document.getElementById('checkout_cart_no').innerHTML=\"$cart_no_item\";</script>";
		echo "<script> document.getElementById('modal_title').innerHTML=\"<b>Your Cart <i class='fa fa-cart-plus'></i> </b> $cart_no_item\";</script>";
		echo alert_msg("$cart_box", "#fff", "#fff");
		
		//$ck = count($check);
		//echo "<script> alert('$ck');</script>";
	}else{
		//set the current cart item to 0
		$cart_no = count($cart_array["products"]);
		echo "<script> document.getElementById('cart_no').innerHTML=\"$cart_no\";</script>";
		if($cart_no > 1){ $cart_no_item = "$cart_no items";}else{ $cart_no_item ="$cart_no item"; }
		echo "<script> document.getElementById('checkout_cart_no').innerHTML=\"$cart_no_item\";</script>";
		echo "<script> document.getElementById('modal_title').innerHTML=\"<b>Your Cart <i class='fa fa-cart-plus'></i> </b> $cart_no_item\";</script>";
		//die("Your Cart is empty"); //we have empty cart
		$cont_shopping = "<a href=\"".$dir."all-products/\"> Continue Shopping </a>";
		echo alert_msg("<b style=\"color:orange;\">Your Cart is empty</b> <br> $cont_shopping", "#fff");
	}
		
	}//end fucntion view_cart
?>



<?php
function checkout_cart_view(){
if(isset($_COOKIE['cart_items']) && count($_COOKIE['cart_items'])> 0){ //if we have session variable
		$cart_box = '<ul class="cart-products-loaded">';
		$total = 0;
		$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
			foreach($cart_array["products"] as $product){ //loop though items and prepare html content
			
			//set variables to use them in HTML content below
			$product_name =  $product["name"]; 
			$product_amount = $product["price"];
			$product_id =  $product["id"];
			$product_qty = $product["quantity"];
			//$product_color = $product["product_color"];
			$product_size = "L"; //$product["size"];
			$product_array_id = $product_id;
			$product_amt = $product_amount * $product_qty;
			$dir = "../";
			//if($_GET["dir"] == 1){$dir = "../";}
			$cart_box .=  "<li> $product_name (Qty : $product_qty | Price : $product_amt) &mdash; $currency ".sprintf("%01.2f", ($product_amount * $product_qty)). " <span onclick ='remove_item_checkout_pg($product_id, \"../\");' style =\" cursor:pointer; color:red; font-size:30px; font-weight:bold; \" title=\"Remove item\" class=\"remove-item\" data-code=\"$product_array_id\">&times;</span></li><hr style=\"margin:2px;\">";
			$subtotal = ($product_amount * $product_qty);
			$total = ($total + $subtotal);
			
		}
		$cart_box .= "</ul>";
		
		$cart_box .= ' <div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="'.$dir.'checkout/" title="Review Cart and Check-Out" style="margin:3px; font-weight:bold; color:orange;">Check-out</a></u></div>';
		//die($cart_box); //exit and output content
		$cart_no = count($cart_array["products"]);
		echo "<script> document.getElementById('cart_no').innerHTML=\"$cart_no\";</script>";
		if($cart_no > 1){ $cart_no_item = "$cart_no items";}else{ $cart_no_item ="$cart_no item"; }
		echo "<script> document.getElementById('checkout_cart_no').innerHTML=\"$cart_no_item\";</script>";
		echo $cart_box;
	}else{
		$cart_no = count($cart_array["products"]);
		echo "<script> document.getElementById('cart_no').innerHTML=\"$cart_no\";</script>";
		if($cart_no > 1){ $cart_no_item = "$cart_no items";}else{ $cart_no_item ="$cart_no item"; }
		echo "<script> document.getElementById('checkout_cart_no').innerHTML=\"$cart_no_item\";</script>";
		//die("Your Cart is empty"); //we have empty cart
		$cont_shopping = "<a href=\"".$dir."all-products/\"> Continue Shopping </a>";
		echo "<b style=\"color:orange;\">Your Cart is empty</b> <br> $cont_shopping";
	}//end else
	}//end function checkout_cart_view
?>

<?php
if(isset($_POST['p_name'])){
	
	$new_product["name"] = $_POST["p_name"]; 
	$new_product["id"] = $_POST["p_code"]; 
	$new_product["price"] = $_POST["p_price"]; 
	$new_product["quantity"] = $_POST["qty"]; 
	$new_product["design_img"] = $_POST["design"]; 
	$new_product["description"] = $_POST["description"]; 
	$p_code = $new_product["id"];
	//check if product has been added to the product array
if(isset($_COOKIE['cart_items']) && count($_COOKIE['cart_items']) > 0 ){
		$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
					}//end isset
		$cart_array["products"][$p_code] = $new_product;
		$items = json_encode($cart_array["products"]);
	    setcookie('cart_items', $items, time()+86400*15, '/');
	     $_COOKIE['cart_items'] = $items;
		 
	    $dir = "";
		if($_GET["dir"] == "ii"){$dir = "../";}
	view_cart($dir);
	
	//exit();	
}//end isset

//remove item from the cart and view cart
if(isset($_GET["form_id"])){
		$product_id = $_GET["form_id"];
		
		$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
		unset($cart_array["products"][$product_id]);
		$items = json_encode($cart_array["products"]);
	   setcookie('cart_items', $items, time()+86400*15, '/');
	   $_COOKIE['cart_items'] = $items;
	   
		$check = count(json_decode($_COOKIE['cart_items'])); //check if user is removing the last item in the cart
		if($check == 0){
			unset($_COOKIE['cart_items']);
			setcookie('cart_items', null, -1, '/');
		}
		$dir = "";
		if($_GET["dir"] == "ii"){$dir = "../";}
		
		view_cart($dir);
		
	}//end isset $_GET
	
	//remove item from the cart and view cart //for the checkout page
if(isset($_GET["remove_id"])){
		$product_id = $_GET["remove_id"];
		
		$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
		unset($cart_array["products"][$product_id]);
		$items = json_encode($cart_array["products"]);
	   setcookie('cart_items', $items, time()+86400*15, '/');
	   $_COOKIE['cart_items'] = $items;
	   
		$check = count(json_decode($_COOKIE['cart_items'])); //check if user is removing the last item in the cart
		if($check == 0){
			unset($_COOKIE['cart_items']);
			setcookie('cart_items', null, -1, '/');
		}
		checkout_cart_view();
		
	}//end isset $_GET

	//view the main cart content in checkout page
if(isset($_GET["checkout_pg_view"])){
		
		checkout_cart_view();
		
	}//end isset $_GET

	
	if(isset($_GET["view_cart"])){
		$dir = "";
	   if($_GET["dir"] == "ii"){$dir = "../";}
	view_cart($dir);
	}//end isset $_GET


?>

