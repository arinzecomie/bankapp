<?php
session_start();
include('library/library.php');
?>

<?php
$cat = $_GET['cat'];
$title= "Bizrator|Categories-".$cat;
$meta_key = "Birator, Online Printing, Digital branding, Graphic Design".$cat;
$meta_desc = "Bizrator online printing and branding agency";
$dir ="../";
main_menu($title, $meta_key, $meta_desc, $dir); //call menu function
?>

<div class="container">

<div style="text-align:center; width:100%; margin:20px;">
<h2> 
<?php
echo ucfirst(preg_replace('/\-/', ' ', $_GET['cat']));
?>
</h2>
</div>
<div class="row">

<?php
 if($_GET['link_req'] == "view_category"){
   $hot_pro = new Db_conn();
    $table_name = "product";
	$category = $_GET['cat'];
	$data = array($category); 
    $query_fields = array("field_names"=>array("*"), "where"=>array("p_category = "), "data"=>$data, "limit"=>8, "order_by"=>"p_id DESC"); 
	
    $hot_pro->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	$check_status = $hot_pro->rows();
	
	if($check_status > 0){
		$dir = "../";
		
		while($product_details = $hot_pro->return_sth()->fetch()){
			
				?>
				<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
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
	}//end while
	}else{
		echo "<div class='container'> <h4> No product in this category yet! </h4> <br> Please check back soon</div>";
	}//end if else $check_status
	}//end if isset $product
			?>
			
			</div>
			</div>
			
			<?php
			footer("../");
			?>