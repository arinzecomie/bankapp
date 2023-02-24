<?php
session_start();
include('../library/library.php');
?>
<?php
//submit cart with checkout details
if(isset($_POST['submit_cart'])){
	    $cart_id = "bizr".rand(1000, 9999).date("s");
		
		//add cart details
			unset($_POST['submit_cart']);
			$email = $_POST['email'];
			$form_data = $_POST;
			$date = Date("Y-m-d");
			$time = Date("H:i:s");
			$db = new Db_conn();
            $table_name = "checkout";
			$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
	//print_r($cart_array["products"]);
	
	$order_summary = "<table><tr> <th> product Name</th>  <th> Qty </th> </tr>";
	foreach( $cart_array["products"]  as $products ){ //Print each item, quantity and price.
		//set variables to use them in HTML content below
			$product_name =  $products["name"]; 
			$product_amount = $products["price"];
			$product_id =  $products["id"];
			$product_qty = $products["quantity"];
			$product_img = $products["design_img"];
			$product_description = $products["description"];
			//$product_color = $products["product_color"];
			//$product_size =  $products["size"];
	    //$order_id = "smg".rand(1000, 9999);
		
	   $validate = new Validation();
	   $validate->validate_data($form_data);
	if($validate->return_passed() == true){
		
		//set order summary for email
		$order_summary .= "<tr> <td>$product_name </td>  <td> $product_qty </td>  </tr>";
		
		$validate->add_valid_data($cart_id);
		$validate->add_valid_data($product_name);
		$validate->add_valid_data($product_amount);
		$validate->add_valid_data($product_id);
		$validate->add_valid_data($product_qty);
		$validate->add_valid_data($product_img);
		$validate->add_valid_data($product_description);
		//$validate->add_valid_data($product_size);
		$validate->add_valid_data($date);
		$validate->add_valid_data($time);
		$validate->add_valid_data("pending");
		if (isset($_SESSION['user_id'])){
		$validate->add_valid_data($_SESSION['user_id']);}else{
		$validate->add_valid_data("guest");	
		}
		$data = $validate->return_valid_data();
		//print_r($data);
        $field_names = array("name", "phone_no", "email", "state_addr", "payment", "cart_id", "p_name", "price", "product_id", "quantity", "img", "description", "date", "time", "status", "member_id"); 
        $db->insert_db($table_name, $field_names, $data);
			if($db->rows()>0){
				unset($_COOKIE['cart_items']);
			setcookie('cart_items', null, -1, '/');
			$cart_no = 0;
			echo "<script> document.getElementById('cart_no').innerHTML=\"$cart_no\";</script>";
		echo "<script> document.getElementById('checkout_cart_no').innerHTML=\"$cart_no\";</script>";
			echo alert_msg("<b>Your Checkout was successful:</b> your Order id is <b>$cart_id</b>! <br> Thank you", "#ffffff");
			}//end if rows
			
			$order_summary .= "</table>";
			//mail the user the cart summary
			$sender ="contact@bizrator.com";
	
$headers = "From:Bizrator<$sender>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	
	$message = "<HTML><BODY>
	<h4>Checkout Summary</h4><br>
 <span style='color:green;'>Your order was successful</span>
 <br>
 <span>Your order id is <b> $cart_id </b> </span>
 </br>
<p> $order_summary </p> <br>
<b> Our professional team will be in touch with you, just to serve you  better </b> <br>
<p>we are always available to assist you with convenience, printing and branding have not been this easy</p>

  <br>
 <a href='https://www.bizrator.com'> <h3>  Bizrator.com </h3> </a>
 
 <a href='mailto:contact@bizrator.com'><span>contact@bizrator.com</span></a>
 
 </BODY>
 </HTML>";

	
       $master_email= $email; 
	   $subject = "Order Confirmation";
	   mail($master_email, $subject, $message, $headers);
	   $master_email= "christomac12@gmail.com"; 
	   mail($master_email, $subject, $message, $headers);
			
	}else{ //echo "no wAY";
		echo alert_msg("<b>Error:</b> Some fields are empty! <br> Fill the required field and try again", "#ffffff");
	}//end if return_passed
	
	}//end foreach
}//end isset
?>


<?php
//submit cart with logged in details
if(isset($_POST['submit_cart_logged_in'])){
	    $cart_id = "bizr".rand(1000, 9999).date("s");
		
		//get the details of the user for checkout
		$user_details = get_user($_SESSION["user_id"]);
		$name = $user_details['full_name'];
		$email = $user_details['email'];
		$phone_no = $user_details['phone_no'];
		$addr = $user_details['state_addr'];
		
		//add cart details
			unset($_POST['submit_cart_logged_in']);
			$form_data = $_POST;
			$date = Date("Y-m-d");
			$time = Date("H:i:s");
			$db = new Db_conn();
            $table_name = "checkout";
			//get cart details from the cookie variable
			$cart_array["products"] = json_decode($_COOKIE['cart_items'], true);
	//print_r($cart_array["products"]);
	foreach( $cart_array["products"]  as $products ){ //Print each item, quantity and price.
		//set variables to use for database insertion
			$product_name =  $products["name"]; 
			$product_amount = $products["price"];
			$product_id =  $products["id"];
			$product_qty = $products["quantity"];
			$product_img = $products["design_img"];
			$product_description = $products["description"];
			//$product_color = $products["product_color"];
			//$product_size =  $products["size"];
	    //$order_id = "smg".rand(1000, 9999);
	   $validate = new Validation();
	   $validate->validate_data($form_data);
	if($validate->return_passed() == true){
		$validate->add_valid_data($cart_id);
		$validate->add_valid_data($name);
		$validate->add_valid_data($phone_no);
		$validate->add_valid_data($email);
		$validate->add_valid_data($addr);
		$validate->add_valid_data($product_name);
		$validate->add_valid_data($product_amount);
		$validate->add_valid_data($product_id);
		$validate->add_valid_data($product_qty);
		$validate->add_valid_data($product_img);
		$validate->add_valid_data($product_description);
		//$validate->add_valid_data($product_size);
		$validate->add_valid_data($date);
		$validate->add_valid_data($time);
		$validate->add_valid_data("pending");
		if (isset($_SESSION['user_id'])){
		$validate->add_valid_data($_SESSION['user_id']);}else{
		$validate->add_valid_data("guest");	
		}
		$data = $validate->return_valid_data();
		//print_r($data);
        $field_names = array("payment", "cart_id", "name", "phone_no", "email", "state_addr", "p_name", "price", "product_id", "quantity", "img", "description", "date", "time", "status", "member_id"); 
        $db->insert_db($table_name, $field_names, $data);
			if($db->rows()>0){
				unset($_COOKIE['cart_items']);
			setcookie('cart_items', null, -1, '/');
			$cart_no = 0;
			echo "<script> document.getElementById('cart_no').innerHTML=\"$cart_no\";</script>";
		echo "<script> document.getElementById('checkout_cart_no').innerHTML=\"$cart_no\";</script>";
			echo alert_msg("<b>Your Checkout was successful:</b> your Order id is <b>$cart_id</b>! <br> Thank you", "#ffffff");
			}//end if rows
			
	}else{ //echo "no wAY";
		echo alert_msg("<b>Error:</b> Some fields are empty! <br> Fill the required field and try again", "#ffffff");
	}//end if return_passed
	
	}//end foreach
}//end isset
?>