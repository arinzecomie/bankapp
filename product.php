<?php
session_start();
include('library/library.php');
?>


<?php
 if($_GET['link_req'] == "view_product"){
   $db = new Db_conn();
    $table_name = "product";
	$product_code = end(explode("-", $_GET['x_lograck']));
	$data = array($product_code); 
    $query_fields = array("field_names"=>array("*"), "where"=>array("p_code = "), "data"=>$data); 
	
    $db->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
			
	$products = $db->return_sth()->fetch();//set the product data
	/*
		//get the company name
		$table_name = "profile";
		$data = array($products['member_id']); 
		$query_fields = array("field_names"=>array("company_name", "logo", "biz_type", "category"),"where"=>array("member_id = "), "data"=>$data); 
	
    $db->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	$c_name = $db->return_sth()->fetch();//set the company name
	*/
	}//end check_status	
	}//end if	
			?>
			
			
			<?php
$title="Bizrator | all-product"; 
$meta_key="Bizrator, online printing, branding, T-shirt printing, digital marketing"; 
$meta_desc="Bizrator| online digital printing and branding agency";

	if($_GET['link_req'] == "view_product" && $check_status > 0 ){
		$title="Bizrator | Product-".$products['p_name']; 
		$meta_desc = $products['p_name'].",".substr($products['p_desc'], 0, 200);
	}//end if $_GET
	$dir ="../";
if($_GET['link_req'] == "view_product"){
	$dir="../";
}
	
main_menu($title, $meta_key, $meta_desc, $dir); //call menu function
?>

  <?php
 echo $login;//use to output login notification message in every pages//the function is called at the top of the main_menu function
 ?>
 
 <?php
  //login user
if(isset($_POST['submit_login_user'])){ //echo "<script> alert('i see'); </script>";
	$login = login_user();
	echo $login;
 }//end if isset
 ?>
			<?php
 if($_GET['link_req'] == "view_product" && $check_status > 0 ){
	 $design_name = $products['p_code']."-design-".date("i").rand(1000, 9999).date("s");
	 ?>
	 <div class="row">
			    <div class="col-sm-12 col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3" >
			    <div style="border:1px solid grey; border-radius:5px; margin-top:5px; background-color:#ffffff;">
				<div style="margin:0 auto; width:285px;">
				<img class="center-block" style='width:285px; height:285px;' src="<?php echo $dir; ?>products/img/<?php  echo $products['p_img']; ?>" alt="product Banner">
		        </div>
				
				<div class="sm-display" style="padding:20px; border-top:1px solid grey;">
				<div style="margin-right:20px; display:inline;">
				<span style="color:#ff4000; font-size:18px;"><?php  echo $products['p_name']; ?></span> &nbsp
				<span><b>Starting from:</b></span> <?php echo $products['p_price']; ?>
				 <!--<a href="#order_box" class="order-btn" >Add to cart</a>-->
				</div>
				</div>
			    </div>
			    </div>
				
				<div class ="col-sm-12 col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
			<div style="text-align:center;">
		 <h3> <span style="color:#ff4000;"><?php  echo $products['p_name']; ?></span></h3>
		  </div>
		  
		   <div id="order_box">
		   <div style="border:1px solid #eaeaea; padding:10px; margin:2px;">
		  <h4>Description </h4>
		  <?php  echo $products['p_desc']; ?>
		  </div>
		 
		  <div style="margin:20px 20px; display:block;"> 
		 <div style="float:left;"> <b> Starting from: </b> <?php  echo $products['p_price']; ?> </div>
		  <div style="float:right;"><b>Quantity</b> <button onclick="decrease_cart();">- </button> <input type="text" style="width:50px; text-align:center;" id="qty" value="<?php  echo $products['min_order']; ?>" onchange="update_pqty()"> </input> <button onclick="increase_cart();">+ </button></div>
		  </div>
		  <br>
		  <div style="margin:5px; display:inline-block;"> 
		  <span class="ellipse"> Do you have your design?</span> <b style="color:#ff4000;"><span class="ellipse">Upload image here</span> </b>
		  <form id="upload" method="post" enctype="multipart/form-data" action="<?php echo $dir; ?>ajax_submit.php">
		  <input name="fileToUpload" type="file" id="image" onchange="readUrl(this);" class="form-control">
          <center>
		  <img style="display:none;" id="show" src=""> 
		  <input name="attach_photo" type="hidden" value="">
		  <input name="design_name" id="design_name"  type="hidden" value="<?php echo $design_name; ?>">
		  <div id="show_div" > 
		  <span id="show_status"> </span>
		  <button id="show_btn" style="display:none;" type="submit" onclick="ajax_attach_img();"> Attach Design </button>  <span id="attach"> </span>
		  </div>
		  </center><br>
		  
		  </form>
		  </div>
				<form id="<?php echo $products['p_code']; ?>" method="post" action="<?php echo $dir; ?>cart/?dir=<?php echo "ii"; ?>">
							<div> 
							<textarea name="description" class="form-control">Add your discription (optional) </textarea>
							</div>
							<input type="hidden" name="p_name" value="<?php echo $products['p_name']; ?>">
							<input type="hidden" name="size"  value="Nil">
							<input type="hidden" name="p_price"  value="<?php echo $products['p_price']; ?>">
							<input type="hidden" name="p_code"  value="<?php echo $products['p_code']; ?>">
							<input type="hidden" name="design"  value="nil" id="design">
							<input type="hidden" name="qty"  value="<?php  echo $products['min_order']; ?>" id="p_qty">
							<div style="float:right; margin:5px;">
							<button type="submit" class="order-btn"  name="<?php echo $products['p_code']; ?>" onclick="cart_sub('<?php echo $products['p_code']; ?>');">Add to cart</button>
							</div>
							</form>
							
		  </div>
		  </div>
		  </div>
			    <hr/>
				
				
				<div class="container">
<h4>Similar Products</h4>
<br>
<div class="row">

<?php
$skip = $products['p_code'];//main product code to skip it in the relate section
 products("ii", $skip, "featured");
 ?>
</div>
<div class="text-center"><a href="<?php echo $dir; ?>all-products/"> <b> View all Products </b> </a></div>
</div>
			
		<?php	
	}//end if	
?>

 
<?php
if($_GET['link_req'] == "all_products"){
 ?>
 <div class="container">
 <div style="text-align:center; margin:20px;">
 <h3> Our Products </h3>
 </div>
 
 </div>
 
 <?php
//fetch product list from database
    $profile = new Db_conn();
    $table_name = "product";
	$data = array($query_id);
	//set default query_fields
    $query_fields = array("field_names"=>array("p_id", "p_code", "p_price", "price_cancel", "p_name", "p_desc", "p_img", "p_owner"), "limit"=>20);
	
	//set pagination data
	  $row_count_query=array("field_names"=>array("count(*) as total", "MAX(p_id) as max", "MIN(p_id) as min")/*, "where"=>array("member_id = "),"data"=>$data*/);
	  $pagination_query = array("field_names"=>array("p_id", "p_code", "p_price", "price_cancel", "p_name", "p_desc", "p_img", "p_owner"), "where"=>array("p_id <"), "data"=>array(), "order_by"=>"p_id Desc", "limit"=>20);	
	$set_pagination = paginate($table_name, $pagination_query, $row_count_query);//call pagination function from librays
	if(!empty($set_pagination)){
		$query_fields = $set_pagination;
      }//end if 
	
    $profile->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	$check_status = $profile->rows();
	
	if($check_status > 0){
		?>
		<div class="container">
		<div class="row">
		<?php
		$i = 0;
		while($product_details = $profile->return_sth()->fetch()){
			?>
			
			    
				
				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="<?php echo $dir;?>products/img/<?php echo $product_details['p_img']; ?> ">
						<a href="<?php echo $dir."product/".preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>">
							<button type="submit" class="order-btn categories_ord_btn" >View</button>
							</a>
                            <ul class="featured__item__pic__hover">
							<a href="<?php echo $dir."product/".preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>">
							<button type="submit" class="order-btn" > <i class="fa fa-cart-plus"></i> Order Now</button>
							</a>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="<?php echo $dir."product/".preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>"><?php echo $product_details['p_name']; ?></a></h6>
							
							<?php 
						if(isset($_SESSION['admin_username'])){
						?>
						<a href="<?php echo $dir; ?>manage-product/?pg_rq=edit_product&prod_ref=<?php echo $product_details['p_code']; ?>" class="card_btn text-white"> Edit </a>
						<?php 
						}//end if isset
						?>
                        </div>
                    </div>
                </div>
		<?php	
		$i++;
		$last_id = $product_details['p_id'];
		}//end while
			if($i >= 20 && $last_id != $set_pagination['min_id']){
		?>
		
		<center>
		<a href='<?php echo $dir; ?>all-products/<?php echo $last_id ?>'> 
				<div style="margin:10px; font-weight:bold;">See more...</div>
				</a>
				</center>
	<?php
		}else{
			if(isset($_GET['num_limit'])){
				if($_GET['num_limit'] != "/"){
			echo " <center> <h3 style='color:red;' > End </h3> </center>";
				}//end 
		}//end if !isset
		}//end if else $i
			
	}//end if
?>
	</div>
	</div>
	<?php
}//end if isset
?>

<?php
footer($dir);
?>