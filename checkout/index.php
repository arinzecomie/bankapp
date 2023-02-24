<?php
session_start();
include('../library/library.php');
?>

<?php 
$title="Online Digital printing and Branding Services";
$meta_key="Online Printing, Digital Branding Agency";
$meta_desc="Bizrator is online print on demand service company";
$dir ="../";
main_menu($title, $meta_key, $meta_desc, $dir);
?>

  <?php
 echo $login;//use to output login notification message in every pages//the function is called at the top of the main_menu function
 ?>

<div style="margin-top:-10px;">   </div>

<div class="container"> 
<div class="col-lg-12 text-center">
<?php
if (!isset($_SESSION['user_id'])){
	?>
 Continue check out in guest mode. <a onclick="userLogin();"  style="cursor:pointer; color:blue;" ><i class="fa fa-user"></i> Login </a> Or <a href="../sign-up/?login_pg=checkout"> Sign Up </a> for better experience
<?php
}//end if
?>
 </div>
<div class="row"> 
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 offset-sm-2 offset-md-2 offset-lg-2" style="padding:0px; background-color:#eaeaea; margin-top:10px;"> 
<div style="background-color:#ff4000; padding:10px; margin:0px; width:100%">
<h5 style="text-align:center; color:#fff;"><i class="fa fa-cart-plus"></i> Review Your Cart</h5>
<center> <span style="color:lightgrey;"><b> You have  <?php $cart_no = count(json_decode($_COOKIE["cart_items"], true)); if($cart_no > 1){ $cart_no_item = "$cart_no items";}else{ $cart_no_item ="$cart_no item"; }?> <span id="checkout_cart_no"> <?php  echo $cart_no_item; ?></span> in your cart!</b> </span> </center>
</div>
<div style="margin-left:20px; margin-top:0px;" id="checkout_view">

</div>

<hr style="background-color:#ff4000; margin-top:30px;">
<div id="checkout_info_div">
<?php
if (isset($_SESSION['user_id'])){
	?>
<center> <input type="checkbox" id="checkout_mode" onclick="checkout_mode();"> Checkout with defualt details <br> <b> Or</b> </center>
<div id="default_checkout" style="display:none;">
<form id="d_checkout" action="../checkout/add_checkout.php" method="post">
<div style="margin:10px;">
<b>Payment Option:</b>
<input type="hidden" name="submit_cart_logged_in" value="submit_cart_logged_in">
<input type="radio" name="payment" value="pay_now" required="required" disabled="disabled">&nbsp Pay Now
&nbsp &nbsp <input type="radio" name="payment" value="pay_later" required="required" checked>&nbsp See your sample before payment 
</div>
<button class="site-btn" onclick="cart_sub('d_checkout');" type="submit">Checkout</button>
</form>
</div>
<?php
}//end if
?>

<div id="checkout_details" class="container" style="padding:5px;">
<center><h5><span style="color:#ff4000;">Enter your contact details to check out</span><h5></center>
<form id="checkout" action="../checkout/add_checkout.php" method="post">
NAME:
<input class="form-control" type="text" name="name" required="required"><br>
PHONE:
<input class="form-control" type="text" name="phone" required="required"><br>
EMAIL:
<input class="form-control" type="text" name="email" required="required"><br>
ADDRESS:
<input class="form-control" type="text" name="address" required="required">
<div style="margin:10px;">
<b>Payment Option:</b>
<input type="hidden" name="submit_cart" value="submit_cart">
<input type="radio" name="payment" value="pay_now" required="required" disabled="disabled">&nbsp Pay Now
&nbsp &nbsp <input type="radio" name="payment" value="pay_later" required="required" checked>&nbsp See your sample before payment 
</div>
<button class="site-btn" onclick="cart_sub('checkout');" type="submit">Checkout</button>
</form>
</div >

</div >
</div >
<div id="msg"></div>
<br>
</div>
</div>
</div>

<script>
//Ajax submit 
function checkout_sub(){
    $("#checkout").submit(function(event){
	  event.preventDefault();
	  var form_data = $(this);
	  $.ajax({
	    type:'POST',
        url:form_data.attr('action'),
        data: form_data.serialize(),
        success: function(data){
		  //print success message
		  alert('sucessful')
		  $('#msg').html(data);
		},
        error: function(error){
		  //error message
		  alert('sbmission failed');
		}		
	  });
	});
}//end ajax_sub
</script> 
 
 <?php
footer($dir); 
 ?>
 <script >
view_cart("checkout");

setInterval(function(){
	var crt_no = document.getElementById("cart_no").innerHTML;
	var checkout_details = document.getElementById("checkout_info_div");

	if(crt_no > 0){
		checkout_details.style.display = 'block';
	}else{
		checkout_details.style.display = 'none';
	}//end if
		//alert(crt_no);
}, 1000); 

</script>
<?php
if(isset($_SESSION['notification'])){
echo $_SESSION['notification'];
unset($_SESSION['notification']);
}//end
?>