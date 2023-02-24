<?php
/*
//track how many visitors that visit a particular page
$page = $_SERVER['REQUEST_URI'];
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$visit_time = Date("Y-m-d H:i:s");
//echo "<script>alert('$visit_time');</script>";
		$db = new Db_conn();
        $field_names = array("page", "ip", "user_agent", "time"); 
		$data = array($page, $ip, $user_agent, $visit_time);
        $db->insert_db("statistics", $field_names, $data);*/
?>

<?php
/*
	//if session is not set
	if(!isset($_SESSION['all_user'])){
		//validate cookie
		if(isset($_COOKIE['remember_me'])){
			//check if it is company's cookie is set
			if(isset($_COOKIE['remember'])){$table_name = "register"; }else{$table_name = "users";}
				
			$my_cookie = $_COOKIE['remember_me'];
				$data = array($my_cookie);
				$query_fields = array("field_names"=>array("*"), "where"=>array("keep_me_in ="), "data"=>$data, "limit"=>1);
				$check_user = new Db_conn();
				$check_user->select_data($table_name, $query_fields);
				
				if($check_user->rows() > 0 ){
					$row = $check_user->return_sth()->fetch();//fetch user data as array
					//set session for user and company
					if($table_name == "users"){
					$_SESSION['user_id'] = $row['member_id'];
					$_SESSION['user_name'] = $row['full_name'];
					}else{
						$_SESSION['email'] = $row['email'];
						$_SESSION['mem_id'] = $row['member_id'];
						$_SESSION['user_name'] = $row['company_name'];
					}//end if else
						
					//set session to print features for logged in company or users
				if(isset($_SESSION['user_id'])){
			
					$_SESSION['all_user'] = $_SESSION['user_id'];
					$_SESSION['all_user_mail'] = $row['email'];
				}elseif(isset($_SESSION['mem_id'])){
	
				$_SESSION['all_user'] = $_SESSION['mem_id'];
				$_SESSION['all_user_mail'] = $_SESSION['email'];
				}//if else
					
				$check_user->close_db();//close database connection
				}// $check_user rows
					
			//echo "<script> alert('$my_cookie'); </script>";
		}//end isset
	}//end !isset session
	*/
?>


<?php
//select popular businesses
function popular_biz($size = "", $dir=""){
	if($size != ""){
		$print_size = $size;
	}else{
		$print_size = "col-xs-4 col-sm-6 col-md-6 col-lg-4";
	}
    $db = new Db_conn();
    $table_name = "profile";
	//$data = array($_SESSION['mem_id']); "where"=>array("member_id = "), "data"=>$data
    $query_fields = array("field_names"=>array("*"), "limit"=>6, "order_by"=>"profile_id DESC"); 
	
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
		
		while($popular = $db->return_sth()->fetch()){
			$comp_name = $popular['company_name'];
			$biz_type = $popular['biz_type'];
			$category = $popular['category'];
			$city  = $popular['city'];
			$country  = $popular['country'];
            $logo = $popular['logo'];
            if($logo == "?"){ $de_logo = "<div class='de_logo'><div class='logo_txt'>".ucfirst($comp_name[0])."</div> </div>";}
			//if the company have not updated its vital informations, dont list them
			if($category != "?" || $country != "?"){
			
			?>
			
			    <div class=" <?php echo $print_size; ?> popular_biz" style="padding:0px;">
				<div class="popular_biz_inner" style="border:1px solid lightgrey; border-radius:3px; margin:5px 2px; background-color:#ffffff;">
				<a href="<?php echo $dir; ?>biz/<?php  echo preg_replace('/\s+/', '-', $comp_name)."-".$popular['member_id']; ?>">				<div style="float:left; padding:3px;">
				<?php if($logo != "?"){
					?>
				<img style='width:50px; height:50px;' src="<?php echo $dir; ?>uploads/<?php  echo $logo; ?>" alt="Logo">
				<?php
				}else{echo $de_logo;}
				?>
		        </div>
				<div style="padding-top:3px; min-height:55px;" class="bd_b">
				<div class="ellipse"> <b><?php  echo ucfirst($comp_name); ?></b> </div>
				<div style="text-align:left; color:grey;">
				<?php  echo $biz_type ?>
				</div>
				</div>
				<div style="color:black;">
				<div style="clear:both; padding:5px; border-bottom:1px solid grey;">
				<div >
				<div class="ellipse"> <span style="color:#000;"><?php echo $category; ?> </span></div>
				</div>				
				<div class="ellipse">				
				<span style="font-weight:bolder;" class="glyphicon glyphicon-map-marker"></span>  <span style="color:grey;"><?php echo $city.", ".$country; ?> </span>
				</div>
				</div>
				</div>
				</a>
				<div class="row" style="clear:both;">
				<div class="col-sm-6 col-xs-6" style="padding:0px; border-right:1px solid grey;">
				<a href="<?php echo $dir."biz/".preg_replace('/\s+/', '-', $comp_name); ?>-<?php  echo $popular['member_id'];?>">
				<div class="card_btn">
				 Profile
				</div>
				</a>
				</div>
				<div class="col-sm-6 col-xs-6" style="padding:0px;">
				<a href="<?php echo $dir; ?>bizlist/?add_req=add-list&_list=<?php  echo $popular['member_id'];?>">
				<div class="card_btn">
				 Add to list
				</div>
				</a>
				</div>
				</div>
				
			    </div>
			    </div>
			
		<?php	
		}//end if !="?"
		}//end while
		
	}//end if
}//end function popular_biz
	
	?>
	
	<?php
	/*function to print company card for individual pages after their respective query, it is called inside while loop
	$company_array is the database fetched array, $print_size is the size of the card to print(default is empty)
	$dir is to set the directory level for any page
	*/
			function fetched_company($company_array, $dir="", $print_size=""){
			$comp_name = $company_array['company_name'];
			$logo = $company_array['logo'];
			$biz_type = $company_array['biz_type'];;
			$category = $company_array['category'];
			$country  = $company_array['country'];
			$city  = $company_array['city'];
			if($logo == "?"){ $de_logo = "<div class='de_logo'><div class='logo_txt'>".ucfirst($comp_name[0])."</div> </div>";}//biz_connect.jpg
			//if the company have not updated its vital informations, dont list them
			//if($category != "?" || $country != "?"){
				?>
			  <div class="<?php echo $print_size; ?>popular_biz" style="padding:0px;">
			  	<div style="border:1px solid lightgrey; border-radius:3px; margin:2px; background-color:#ffffff;">
				<a href="<?php echo $dir; ?>biz/<?php  echo preg_replace('/\s+/', '-', $comp_name)."-".$company_array['member_id']; ?>">
				<div style="float:left; padding:3px;">
				<?php if($logo != "?"){
					?>
				<img style='width:50px; height:50px;' src="<?php echo $dir; ?>uploads/<?php  echo $logo; ?>" alt="Logo">
				<?php
				}else{echo $de_logo;}
				?>
		        </div>
				<div style="padding-top:3px; min-height:55px;" class="bd_b">
				<div class="ellipse"> <b><?php  echo ucfirst($comp_name); ?></b> </div>
				<div style="text-align:left; color:grey;">
				<?php  echo $biz_type; ?>
				</div>
				</div>
				<div style="color:black;">
				<div style="clear:both; padding:5px; border-bottom:1px solid grey;">
				<div >
				<div class="ellipse"> <span style="color:#000;"> <?php echo $category; ?> </span></div>
				</div>	
				<div class="ellipse">					
				<span style="font-weight:bolder;" class="glyphicon glyphicon-map-marker"></span> <span style="color:grey;"><?php echo $city.", ".$country; ?> </span>
				</div>
				</div>
				</div>
				</a>
				
				<div class="row" style="clear:both;">
				<div class="col-sm-6 col-xs-6" style="padding:0px; border-right:1px solid grey;"">
				<a href="<?php echo $dir."biz/".preg_replace('/\s+/', '-', $comp_name); ?>-<?php  echo $company_array['member_id'];?>">
				<div class="card_btn">
				 Profile
				</div>
				</a>
				</div>
				<div class="col-sm-6 col-xs-6" style="padding:0px;">
				<a href="<?php echo $dir; ?>bizlist/?add_req=add-list&_list=<?php  echo $company_array['member_id'];?>">
				<div class="card_btn">
				 Add to list
				</div>
				</a>
				</div>
				</div>
				
			    </div>
			    </div>
				<?php
				//}//end if !="?"
				}//end function fetched_company
	?>
	
	
	<?php

//select business promos
function biz_promo(){
    $db = new Db_conn();
    $table_name = "promo";
	//$data = array($_SESSION['mem_id']); "where"=>array("member_id = "), "data"=>$data
    $query_fields = array("field_names"=>array("*"), "limit"=>5); 
	
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
		
		while($promos = $db->return_sth()->fetch()){
			
			?>
			    <div class="promo col-xs-4 col-sm-6" style="border:none; overflow:visible;">
				<a href="<?php echo preg_replace('/\s+/', '-', $promos['promo_caption']); ?>/promos/<?php  echo $promos['member_id'];?>">
			    <div class="promo_inner">
				<div class="ellipse" style="margin-bottom:-8px; width:100%; background:rgba(0, 0, 0, .8); z-index:1; padding:5px; color:#fff;">
				<p style="width:100%; display:inline; height:50px; text-overflow:ellipsis;">
				<b><?php  echo $promos['promo_caption']; ?></b>
				</p>
				</div>
				<img id="promo_img" src="promo_imgs/<?php  echo $promos['promo_banner']; ?>" alt="Promo Banner">

				</div>
				</a>
				</div>
				
			
		<?php	
		}//end while
	}//end if
}//end function biz_promo
	
	?>
	
	
	<?php

//select biz-insigth 
function biz_insight($dir=""){
    $db = new Db_conn();
    $table_name = "insight";
	//$data = array($_SESSION['mem_id']); "where"=>array("member_id = "), "data"=>$data
    $query_fields = array("field_names"=>array("*"), "limit"=>5, "order_by"=>"insight_id DESC"); 
	
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
		
		while($insight = $db->return_sth()->fetch()){
			$db_company = new Db_conn();
			$company = $insight['member_id'];
			//select the company that made the biz insight post
			$table_name = "profile";
	        $data = array($company);
            $query_fields = array("field_names"=>array("member_id", "company_name", "country"), "where"=>array("member_id = "), "data"=>$data);
	
            $db_company->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $company = $db_company->return_sth()->fetch();
			
			?>
			    <div style="display:inline-block; border-bottom:1px solid grey; margin:0px 0px 0px 0px; padding:2px 0px;; width:100%; height:auto;">
                <a href="<?php echo $dir; ?>insights/<?php  echo preg_replace('/\s+/', '-', $insight['insight_topic'])."-".$insight['insight_code']; ?>">				
				<div style="float:left; padding:3px;">
				<img style="width:50px; height:50px;" src="<?php echo $dir; ?>insight/insight_imgs/<?php if ($insight['insight_img'] == "?"){echo "biz_insight.jpg";}else{ echo $insight['insight_img']; } ?>" alt="Insight Banner">
		        </div>
				<div style="display:inline; padding-top:5px;">
				<div class="ellipse"><b><?php  echo $insight['insight_topic']; ?></b></div>
				<div style="padding-top:5px;">
				<span style="color:grey;"> <?php echo $company['company_name']; ?></span>
				 <span style="color:black; margin-left:5px;" > <?php if($insight['insight_views'] != 0){ echo "(". $insight['insight_views'] ." Views)";} ?> </span>
				</div>
				</div>
				</a>
				</div>
				
		<?php	
		}//end while
	}//end if
}//end function biz_insight
	
	?>
	
	
	<?php

//select products
function products($dir="", $skip="", /* use to skip publishing the same product in the related products section*/ $category=""){
	if($dir=="ii"){$dir_url="ii"; $dir="../";}
	//fetch product list from database
    $hot_pro = new Db_conn();
    $table_name = "product";
	//$data = array($query_id);
    $query_fields = array("field_names"=>array("p_id", "p_code", "p_price", "price_cancel", "p_name", "p_desc", "p_img", "p_owner"), "limit"=>4, "order_by"=>"RAND()");
	
    $hot_pro->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $hot_pro->rows();
	
	if($check_status > 0){
		$i = 1;
		while($product_details = $hot_pro->return_sth()->fetch()){
			
			if($product_details['p_code'] == $skip){
				//don't print anything
			}else{
				if($category ==""){
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="categories__item set-bg" data-setbg="<?php echo $dir;?>products/img/<?php echo $product_details['p_img']; ?> ">
                            <h5><a href="<?php echo $dir."product/".preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>"><span> <?php echo $product_details['p_name']; ?></span></a></h5>
					
							<a href="<?php echo $dir.'product/'.preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>">
							<button type="submit" class="order-btn categories_ord_btn" ">Order Now</button>
							</a>
                        </div>
						<?php 
						if(isset($_SESSION['admin_username'])){
						?>
						<a href="<?php echo $dir; ?>manage-product/?pg_rq=edit_product&prod_ref=<?php echo $product_details['p_code']; ?>" class="card_btn text-white"> Edit </a>
						<?php 
						}//end if isset
						?>
                    </div>
			
				<?php
				}//end if $category
				if($category == "featured" ){
				?>
				
				
				 <div class="col-lg-3 col-md-4 col-sm-6 col-6 mix oranges fresh-meat">
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
		}//end if $category
		
		}//end if
		$i = $i++;
		}//end while
			//print_r($product_details);
	}//end if

}//end function products



//select products
function top_products($dir="", $skip="", /* use to skip publishing the same product in the related products section*/ $category=""){
	if($dir=="ii"){$dir_url="ii"; $dir="../";}
	//fetch product list from database
    $hot_pro = new Db_conn();
    $table_name = "product";
	$data = array(2);
    $query_fields = array("field_names"=>array("p_id", "p_code", "p_price", "price_cancel", "p_name", "p_desc", "p_img", "p_owner"), "where"=>array("p_tag < "), "data"=>$data, "limit"=>8, "order_by"=>"RAND()");
	
    $hot_pro->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $hot_pro->rows();
	
	if($check_status > 0){
		$i = 1;
		while($product_details = $hot_pro->return_sth()->fetch()){
			
			if($product_details['p_code'] == $skip){
				//don't print anything
			}else{
				
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="categories__item set-bg" data-setbg="<?php echo $dir;?>products/img/<?php echo $product_details['p_img']; ?> ">
                            <h5><a href="<?php echo $dir."product/".preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>"><span> <?php echo $product_details['p_name']; ?></span></a></h5>
					
							<a href="<?php echo $dir.'product/'.preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>">
							<button type="submit" class="order-btn categories_ord_btn" ">Order Now</button>
							</a>
                        </div>
						<?php 
						if(isset($_SESSION['admin_username'])){
						?>
						<a href="<?php echo $dir; ?>manage-product/?pg_rq=edit_product&prod_ref=<?php echo $product_details['p_code']; ?>" class="card_btn text-white"> Edit </a>
						<?php 
						}//end if isset
						?>
                    </div>
			
				<?php
		}//end if
		$i = $i++;
		}//end while
			//print_r($product_details);
	}//end if

}//end function products
	
	?>


	<?php

//select products
function categories_products($dir="", $category=""){
	if($dir=="ii"){$dir_url="ii"; $dir="../";}
	//fetch product list from database
    $hot_pro = new Db_conn();
    $table_name = "product";
	$data = array($category);
    $query_fields = array("field_names"=>array("p_id", "p_code", "p_price", "price_cancel", "p_name", "p_desc", "p_img", "p_owner"),  "where"=>array("p_category = "), "data"=>$data, "limit"=>4, "order_by"=>"RAND()");
	
    $hot_pro->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $hot_pro->rows();
	
	if($check_status > 0){
		$i = 1;
		while($product_details = $hot_pro->return_sth()->fetch()){
			
				?>
				
				 <a href="<?php echo $dir."product/".preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo $dir;?>products/img/<?php echo $product_details['p_img']; ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $product_details['p_name']; ?></h6>
                                        <span>View</span>
                                    </div>
                                </a>
								<?php 
						if(isset($_SESSION['admin_username'])){
						?>
						<a href="<?php echo $dir; ?>manage-product/?pg_rq=edit_product&prod_ref=<?php echo $product_details['p_code']; ?>" class="card_btn text-white"> Edit </a>
						<?php 
						}//end if isset
						?>
				
				
		<?php	
		
		$i = $i++;
		}//end while
			//print_r($product_details);
	}//end if

}//end function products
	
	?>
	
	
	
	<?php

//select business adverts
function biz_advert(){
    $db = new Db_conn();
    $table_name = "advert";
	//$data = array($_SESSION['mem_id']); "where"=>array("member_id = "), "data"=>$data
    $query_fields = array("field_names"=>array("*"), "limit"=>5, "order_by"=>"advert_id DESC"); 
	
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
		
		while($advert = $db->return_sth()->fetch()){
			
			?>
				<a href="<?php echo preg_replace('/\s+/', '-', $advert['advert_caption']); ?>/adverts/<?php  echo $advert['member_id'];?>">
				<div class="advert col-xs-4 col-sm-6">
				<div class="ellipse" style="margin-bottom:0px; text-align:center; color:grey;"><?php  echo $advert['advert_caption']; ?></div>
				<img id="advert_img" src="adverts/<?php  echo $advert['advert_banner']; ?>" alt="Advert Banner">
				</a>
			    </div>
				
		<?php	
		}//end while
		?>
				<?php
	}//end if
}//end function advert
?>

<?php
//function to get received messages
function get_message(){
	        $db = new Db_conn();
	       //print all new recieved messages
			$table_name = "contact";
	        $data = array("new");
            $query_fields = array("field_names"=>array("count(cont_id) as total"), "where"=>array("status = "), "data"=>$data); 
	
            $db->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $num_msg = $db->return_sth()->fetch();
			$num_msg = $num_msg['total'];
	
	    if($num_msg > 0){
			?>
			<div  style="color:#fff; background-color:#ff4000;" class="badge">
			<?php echo $num_msg; ?>
			</div>
<?php
		}//end
}//end function get_message


//function to format the date and time output
function time_elapsed_string($prev_time) { 
$prev_time = strtotime($prev_time);
$date = date_create($prev_time);
$etime = time() - $prev_time;
 if ($etime < 1) {
 return '0 seconds'; 
 } 
 $a = array( 365 * 24 * 60 * 60 => 'year', 30 * 24 * 60 * 60 => 'month', 24 * 60 * 60 => 'day', 60 * 60 => 'hour', 60 => 'minute', 1 => 'second' ); 
 $a_plural = array( 'year' => 'years', 'month' => 'months', 'day' => 'days', 'hour' => 'hours', 'minute' => 'minutes', 'second' => 'seconds' );
 foreach ($a as $secs => $str) {
 $d = $etime / $secs; 
 if ($d >= 1) {
 $r = round($d); 
   $check_day = $etime /86400;
 if($check_day > 6){
	 return date("j M Y", $prev_time);
	 }else{
 return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago'; 
	 }//end if else
 }//end if
 } //end foreach
 }//end function time_elapsed_string




//function to get company per message or post
function get_company($company_id){
	$db_company = new Db_conn();
			$company = $company_id;
			//select the company that made the biz insight post
			$table_name = "profile";
	        $data = array($company);
            $query_fields = array("field_names"=>array("member_id", "company_name", "country"), "where"=>array("member_id = "), "data"=>$data);
	
            $db_company->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $company = $db_company->return_sth()->fetch();
			return $company;
}//end function get_company


//function to get user per message or post
function get_user($user_id){
	$db_company = new Db_conn();
			$user = $user_id;
			//select the company that made the biz insight post
			$table_name = "users";
	        $data = array($user_id);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = "), "data"=>$data);
	
            $db_company->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $company = $db_company->return_sth()->fetch();
			return $company;
}//end function get_user

//function to get users per specific query
function get_user_spec($table, $where, $data_value){
	        $db_user = new Db_conn();
			//select the company that made the biz insight post
			$table_name = $table;
			$where = $where;
	        $data = array($data_value);
            $query_fields = array("field_names"=>array("*"), "where"=>array(" $where "), "data"=>$data);
	
            $db_user->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        //$user = $db_user->return_sth()->fetch();
			return $db_user;
}//end function get_user
	
	
	/*
function to set the url variable of a page
$last_id set the database id value from which pagination starts < or >
*/
function set_url_var($last_id=""){
if(isset($_GET)){
$i = 0;
$url_var = null;
foreach($_GET as $url_variable=>$url_value){
	switch($url_variable){
	
		CASE "num_limit":;
		BREAK;
		DEFAULT:
		if($i == 0 ){
		$url_var .="$start$url_variable=$url_value";
	}else{
		$url_var .="&$url_variable=$url_value";
	}//end if else $i
	BREAK;
	}//end switch
	$i++;
}//end foreach

if($last_id != ""){
	$url_var .="&num_limit=$last_id";	
}//end if $last_id

}//end isset
return $url_var;
}//end function set url_var
?>

<?php
/*
function for user login from different directories
$redirect_link is optional link parameter to for redirection after succesful login
*/
function login_user($redirect_link=""){
	 
    $submit_button = $_POST['submit_login_user'];
    $keep_me_in = $_POST['keep_me_in'];
	unset($_POST['submit_login_user']);//remove submit button from array
	unset($_POST['keep_me_in']);//remove keep_me_in data from the array
    $validation = new Validation();//instantiate validation class
    $validation->validate_data($_POST);//validate_data and return as array
	
	if($validation->return_passed() == true ){
		
		$table_name = "users";
		$data = $validation->return_valid_data();
		$salt1 = "!@%^";
		$salt2 = "0*1*7";
		$pw = $data[1];
		$data[1] = hash("ripemd128", "$salt1$pw$salt2");
		
		$query_fields = array("field_names"=>array("*"), "where"=>array("email =", "AND password ="), "data"=>$data, "limit"=>1);
		$check_user = new Db_conn();
		$check_user->select_data($table_name, $query_fields);
		
		if($check_user->rows() > 0 ){
			$row = $check_user->return_sth()->fetch();//fetch user data as array
			$_SESSION['user_id'] = $row['member_id'];
			$_SESSION['user_name'] = $row['full_name'];
			
			//set session to print features for logged in company or users
if(isset($_SESSION['user_id'])){
	
	$_SESSION['all_user'] = $_SESSION['user_id'];
	$_SESSION['all_user_mail'] = $row['email'];
	//set cookie for remember me if checked
		if(isset($keep_me_in)){
			if($keep_me_in == "signed_in"){
				$user_agent = $_SERVER['HTTP_USER_AGENT'];
				$value = hash("ripemd128", $user_agent.rand(time(), 9999).rand(1, 9999));
				setcookie('remember_me', $value, time()+86400*15, '/');
				$data = array($value, $_SESSION['all_user']);
				$query_fields = array("field_names"=>array("keep_me_in"), "where"=>array("member_id ="), "data"=>$data);
				$check_user->update_db($table_name, $query_fields);
			}//end if
			
		}//end isset
	$check_user->close_db();//close database connection
	}elseif(isset($_SESSION['mem_id'])){
	
	$_SESSION['all_user'] = $_SESSION['mem_id'];
	$_SESSION['all_user_mail'] = $_SESSION['email'];

	}//end if
				//don't redirect after logging in if the redirect parameter is no
			if($redirect_link != "no"){
			//header("location:$redirect_link");
			echo "<script> window.location='$redirect_link';  </script>";
			}//end if $redirect_link
			
		}else{
			$msg = "<script> 
			document.getElementById('myNotif').style.display='block';  
			document.getElementById('err_msg').innerHTML ='<b style=\"color:#fff;\">Wrong Details! </b> <br>';
			var user = document.getElementById('user_login').innerHTML;
		document.getElementById('notif_display').innerHTML = user;
			</script>";
			
		}
		
	}else{
		
	 $empty = $validation->return_error();
	 $msg = $empty[0];
	       //$msg = alert_msg("$msg", "#fff", "#fff");
			$msg = "<script>
			document.getElementById('myNotif').style.display='block';  
			document.getElementById('err_msg').innerHTML ='<b style=\"color:#fff;\">$msg </b> <br>';
			var user = document.getElementById('user_login').innerHTML;
		   document.getElementById('notif_display').innerHTML = user;
			</script>";
	}
return $msg;
}//end function login_user
?>

<?php
/*
function for user login from different directories
$redirect_link is optional link parameter to for redirection after succesful login
*/
function login_company($redirect_link=""){
	$submit_button = $_POST['submit_login_company'];
	$keep_me_in = $_POST['keep_me_in'];
	unset($_POST['keep_me_in']);//remove keep_me_in data from the array
	unset($_POST['submit_login_company']);//remove submit button from array
    $validation = new Validation();//instantiate validation class
    $validation->validate_data($_POST, $submit_button);//validate_data and return as array
	
	if($validation->return_passed() == true ){
		$table_name = "register";
		$data = $validation->return_valid_data();
		$salt1 = "!@%^";
		$salt2 = "0*1*7";
		$pw = $data[1];
		$data[1] = hash("ripemd128", "$salt1$pw$salt2");
		$query_fields = array("field_names"=>array("*"), "where"=>array("email =", "AND password ="), "data"=>$data, "limit"=>1);
		$check_user = new Db_conn();
		$check_user->select_data($table_name, $query_fields);
		
		if($check_user->rows() > 0 ){
			$row = $check_user->return_sth()->fetch();//fetch user data as array
			$_SESSION['email'] = $row['email'];
			$_SESSION['mem_id'] = $row['member_id'];
			$_SESSION['user_name'] = $row['company_name'];
			
//set session to print features for logged in company or users
if(isset($_SESSION['user_id'])){
	
	$_SESSION['all_user'] = $_SESSION['user_id'];
	$_SESSION['all_user_mail'] = $_SESSION['email'];

	
	}elseif(isset($_SESSION['mem_id'])){
	
	$_SESSION['all_user'] = $_SESSION['mem_id'];
	$_SESSION['all_user_mail'] = $_SESSION['email'];
	
	//set cookie for remember me if checked
		if(isset($keep_me_in)){
			if($keep_me_in == "signed_in"){
				$user_agent = $_SERVER['HTTP_USER_AGENT'];
				$value = hash("ripemd128", $user_agent.rand(time(), 9999).rand(1, 9999));
				setcookie('remember_me', $value, time()+86400*15, '/');
				setcookie('remember', "company", time()+86400*15, '/');
				$data = array($value, $_SESSION['all_user']);
				$query_fields = array("field_names"=>array("keep_me_in"), "where"=>array("member_id ="), "data"=>$data);
				$check_user->update_db($table_name, $query_fields);
			}//end if
			
		}//end isset
	$check_user->close_db();//close database connection

	}//end if
			
			//header("location:$redirect_link");
			echo "<script> window.location='';  </script>";
			
		}else{
			$msg = "<script>
			document.getElementById('myNotif').style.display='block';  
			document.getElementById('err_msg').innerHTML ='<b style=\"color:red;\">Wrong Details! </b> <br>';
			var previous = document.getElementById('myForm').innerHTML;
			document.getElementById('notif_display').innerHTML = previous;
			</script>";
		}
		
	}else{
		
	 $empty = $validation->return_error();
	 $msg = $empty[0];
			$msg = "<script>
			document.getElementById('myNotif').style.display='block';  
			document.getElementById('err_msg').innerHTML ='<b style=\"color:red;\">$msg </b> <br>';
			var previous = document.getElementById('myForm').innerHTML;
			document.getElementById('notif_display').innerHTML = previous;
			</script>";	}
	return $msg;
}//end function login_company
?>


<?php 
/* 
function to signup user from any called directory
*/

function signup_user(){
	
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
	
	$valid = new Validation();
	$valid->validate_password($password, $re_password);

	
    $array_data = array("email"=>$email, "phone"=>$phone);
    $table_name = "users";//database table name
    $submit_button = "submit_register";
	unset($_POST['captcha']);
    unset($_POST['re_password']);
    unset($_POST['submit_register']);
	$form_data = $_POST;//valid form data
//print_r($form_data); exit(); 
    $validation = new Validation();
    $validation->validate_data($array_data, $submit_button);
if($validation->return_passed() == true){
	
    $query_fields = array("field_names"=>array("email", "phone_no"), "where"=>array("email =", "OR phone_no ="), "data"=>$validation->return_valid_data());
    $db = new Db_conn();
    $db->select_data($table_name, $query_fields);
	$row = $db->return_sth()->fetch();
	
	if($db->rows() < 1){
		
	$member_id = rand(time(), 9999).Date("s");
	$date = Date("Y-m-d");
	$time = Date("h:i:sa");
	$validate = new Validation();
	
	$validate->validate_data($form_data, $submit_button);
	$validate->add_valid_data($date);
	$validate->add_valid_data($time);
	$validate->add_valid_data($member_id);
	$data = $validate->return_valid_data();
	$salt1 = "!@%^";
	$salt2 = "0*1*7";
	$pw = $data[4];
	$data[4] = hash("ripemd128", "$salt1$pw$salt2");
	if($validate->return_passed() == true){
		
		//table colunm names
	    $field_names = array("full_name", "email", "phone_no", "state_addr", "password","date", "time", "member_id");
	   
	    //call the method for database insert into the table
		$db->insert_db($table_name, $field_names, $data);//insert into signup table
		/**
		//insert into fourun profile table
		$field_names = array("user_code", "user_type", "level");
		$data = array($member_id, "user", "bronze");
		$db->insert_db("forum_profile", $field_names, $data);
		*/
		
        if($db->rows() > 0){
	         $db->close_db();
			 
			  //mail the user the token and and recovery link
			$sender ="contact@bizrator.com";
	
$headers = "From:Bizrator<$sender>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	
	$message = "<HTML><BODY>
	<h4>Welcome to Bizrator</h4><br>
 <span style='color:green;'>Your registration was successful</span>
 <br>
<b> We are trusted by many organizations and individuals because of our professional services</b> <br>
<p>we are always available to assist you with convenience, printing and branding have not been this easy</p>

  <br>
 <a href='https://www.bizrator.com'> <h3>  Bizrator.com </h3> </a>
 
 <a href='mailto:contact@bizrator.com'><span>contact@bizrator.com</span></a>
 
 </BODY>
 </HTML>";

	
       $master_email= $email; 
	   $subject = "Registration Confirmation";
	   mail($master_email, $subject, $message, $headers);
	   
	   
			 
	        $msg = "Registration Successful!";
			$msg = "<script> document.getElementById('myNotif').style.display='block';   document.getElementById('err_msg').innerHTML ='<b style=\"color:#ffffff;\">$msg </b> <br>'; var user = document.getElementById('user_login').innerHTML; document.getElementById('notif_display').innerHTML = user; </script>";
	
        }else{
		    $msg =  "Registration Not Successful! Try again";
		    $msg = "<script> document.get ElementById('myNotif').style.display='block'; document.getElementById('err_msg').innerHTML ='<b style=\"color:green;\">$msg </b> <br>';  var user = document.getElementById('signup_form').innerHTML; document.getElementById('notif_display').innerHTML = user;   </script>";
	
            }//end if else
	   }else{
		   $empty = $validate->return_error();
		   $msg =  $empty[0];
		   $msg = "<script> document.getElementById('myNotif').style.display='block';  document.getElementById('err_msg').innerHTML ='<b style=\"color:red;\">$msg </b> <br>';  var user = document.getElementById('signup_form').innerHTML; document.getElementById('notif_display').innerHTML = user;   </script>";
	
	   }//end else
	 
	   }else{
		$msg =  "<div style=\'color:#fff; padding:20px;\'>Email and phone number already exists!</div>";
		$msg = "<script> document.getElementById('myNotif').style.display='block';  document.getElementById('err_msg').innerHTML ='<b style=\"color:red;\">$msg </b> <br>';  var user = document.getElementById('signup_form').innerHTML; document.getElementById('notif_display').innerHTML = user;   </script>";
	}
	//end if 
	
}else{
	   $empty = $validation->return_error();
		$msg =  $empty[0];
		$msg = "<script> document.getElementById('myNotif').style.display='block';  document.getElementById('err_msg').innerHTML ='<b style=\"color:red;\">$msg </b> <br>';  var user = document.getElementById('signup_form').innerHTML; document.getElementById('notif_display').innerHTML = user;   </script>";
	
}//end if else
 //return $msg;
 echo $msg;
}//end function signup_user
?>

<?php
//login_signup function(a function to login or signup user in individual pages)
function login_signup(){
//user
 if(isset($_POST['submit_login_user'])){
	$login = login_user();
 }//end if isset
 
//company
 if(isset($_POST['submit_login_company'])){
	$login = login_company();
 }//end if isset

 //signup user
if(isset($_POST['submit_register'])){
	$login = signup_user();
 }//end if isset

}//end function login_signup
?>

<?php 
function alert_msg($message, $b_color){
	
	$msg =  "<script> document.getElementById('myNotif').style.display = 'block'; document.getElementById('notif_display').innerHTML='<div style=\"background:$b_color; padding:20px; text-align:center;\"> $message </div>'; </script>";
	return $msg;
}
?>

<?php 
function close_modal($id1="", $id2=""){
	
	$msg =  "<script> document.getElementById('myNotif').style.display = 'none'; document.getElementById('notif_display').innerHTML=''; </script>";
	return $msg;
}
?>


<?php
	//function to select all biz insight  for the insight page
function all_insight($dir){
	//select biz-insigth for the whole system
    $db = new Db_conn();
    $table_name = "insight";
	//$data = array($_SESSION['mem_id']); 
	
	
	//set default query 
	$query_fields = array("field_names"=>array("insight_id", "member_id", "insight_code", "insight_content", "insight_topic", "insight_img", "insight_views", "date"), "where"=>array("insight_id >"), "data"=>array(), "order_by"=>"insight_id Desc", "limit"=>8);		  		  
	  
	  //set pagination data
	  	$row_count_query = array("field_names"=>array("count(*) as total", "MAX(insight_id) as max", "MIN(insight_id) as min"));
		$pagination_query = array("field_names"=>array("insight_id", "member_id", "insight_code", "insight_content", "insight_topic", "insight_img", "insight_views", "date"), "where"=>array("insight_id <"), "data"=>array(), "order_by"=>"insight_id Desc", "limit"=>8);	
	$set_pagination = paginate($table_name, $pagination_query, $row_count_query);//call pagination function from librays
	if(!empty($set_pagination)){
		$query_fields = $set_pagination;
      }//end if  
	  
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	?>

	<?php
	if($check_status > 0){
		?>
				<div class="row">
				<div class="col-sm-6 col-sm-offset-3 col-xs-12" style="padding:3px;">
		<?php
		$i = 1;
		while($insight = $db->return_sth()->fetch()){
			$last_id = $insight['insight_id'];
			$company_id = $insight['member_id'];
			$company = get_company($company_id);//call function to get the company that has the post from functions.php
			
			?>
				<div style="margin-bottom:5px; width:100%;">
				<div class="insight_thumb">
				<center>
				 <a href="<?php echo $dir; ?>insights/<?php  echo preg_replace('/\s+/', '-', $insight['insight_topic'])."-".$insight['insight_code']; ?>">
				<div style="display:block; padding-top:5px;"><h4><?php  echo $insight['insight_topic']; ?></h4></div>
				</a>
				</center>
				<div style="height:60px; display:block; padding:5px; margin-bottom:5px; overflow:hidden;">
				<?php  echo substr($insight['insight_content'], 0, 300); ?>
				</div>
				<center>
				 <a href="<?php echo $dir; ?>insights/<?php  echo preg_replace('/\s+/', '-', $insight['insight_topic'])."-".$insight['insight_code']; ?>">
				Read more...
				</a>
				<br>
				 <a href="<?php echo $dir; ?>insights/<?php  echo preg_replace('/\s+/', '-', $insight['insight_topic'])."-".$insight['insight_code']; ?>">
				<img style='width:150px; height:150px;' src="<?php echo $dir; ?>insight/insight_imgs/<?php if ($insight['insight_img'] == "?"){echo "biz_insight.jpg";}else{ echo $insight['insight_img']; } ?>" alt="Insight Banner">
		        </a>
				</center>
				<div style="border-top:1px solid lightgrey; margin-top:3px; padding:10px 5px;;">
				<b>Insight by:</b> 
				<a href="<?php echo $dir."biz/".preg_replace('/\s+/', '-', $company['company_name']) ?>-<?php  echo $company['member_id'];?>">
				<?php echo $company['company_name']; ?>
				</a>
				&nbsp <span style="white-space:nowrap;"> <span class="glyphicon glyphicon-time"></span> <span class="forum_date"> <?php echo time_elapsed_string($insight['date']); ?> </span>
				<span style="white-space:nowrap;">
				<span style="color:black; margin-left:5px; color:orange;" > <?php if($insight['insight_views'] != 0){ echo "(". $insight['insight_views'] ." Views)";} ?> </span>
				</span>
				</div>
				</div>
				</div>
				
				
		<?php	
		$i++;
		}//end while
		if($i >= 8 && $last_id != $set_pagination['min_id']){
		?>
		
		<center>
		<a href='<?php echo $dir; ?>insight/?num_limit=<?php echo $last_id ?>'> 
				<div style="margin:20px;">See more...</div>
				</a>
				</center>
	<?php
		}else{
			if(isset($_GET['num_limit'])){
			echo " <center> <h3 style='color:red;' > End </h3> </center>";
		}//end if !isset
		}//end if else $i
		?>
			</div>
			</div>
		<?php
	}//end if check_rows
	}//end function all_insight()
	?>
	
	
	<?php
function fetch_comment($news_code){

		//fetch comments for individual news
		 $db = new Db_conn();
		 $table_name = "news_comment c";
		 $query_fields = array("field_names"=>array("c.news_code AS code", "c.name AS name", "c.date AS date", "c.comment AS comm"), "where"=>array("c.news_code ="), "data"=>array($news_code) );
		 $db->select_data($table_name, $query_fields);	
	      $total_comm = $db->rows();
		  
		  echo " <h3> User Comments </h3>";
		  while($all_comment = $db->return_sth()->fetch()){
			  ?>
			
			 <div style="display:inline-block; border-bottom:1px solid lightgrey; background-color:#fafafa; margin:0px 0px 0px 0px; padding:20px; padding-top:0px; width:100%; height:auto;">	
				<div style="float:left; padding:3px;">
				<span style="width:50px;" class="glyphicon glyphicon-user" > </span>
		        </div>
				<div style="display:inline; padding-top:5px;">
				<div class="ellipse"><b><?php  echo $all_comment['name']; ?> </b> <br><?php  echo $all_comment['comm']; ?></div>
				<div style="padding-top:5px;">
				<span style="white-space:nowrap;"> <span class="glyphicon glyphicon-time"></span> <span class="forum_date"> <?php echo time_elapsed_string($all_comment['date']); ?> </span></span>
				<!-- <span style="color:black; margin-left:5px;" > <?php //if($insight['insight_views'] != 0){ echo "(". $insight['insight_views'] ." Views)";} ?> </span> -->
				</div>
				</div>
				</div>
			
<?php			
		  }
}//end function fetch_comment

?>
