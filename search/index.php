<?php
session_start();
include('../library/library.php');
include('../html_output.php');
?>


<?php
/*
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

 */
?>

<?php
$dir = "../";
$title="Bizrator | Search"; 
$meta_key="Bizrator, Search, all products, t-shirt"; 
$meta_desc="Bizrator-Search all catogories of printed materials";
main_menu($title, $meta_key, $meta_desc, $dir); //call menu function
?>
 
  <?php 
	notif_dialog($dir);//call notification dialog from html_functions.php included in library
	modal($dir);//modal display dialog
	
 ?>
 
 <!--for ajax_sub return message-->
 <div id="msg"> </div>

<?php
if(isset($_GET['search_key'])){
	/*
	if it is user self typed keywords, split the keywords and search with all keywords against 
	the required table field ###alternative### is the use of FULLTEXT SEARCH
	(select *from disease where MATCH(disease, symptons) AGAINST ('too much headache'))
	which is supporte only in MYISAM DATABASE ENGINE
	*/
	
	//if the user is searching product and company generically
if($_GET['filter_by'] == "Filter"){
	$keywords = $_GET['search_key'];//get user search terms
	$custom_search = explode(" ", $keywords);//split search terms into keywords 

			$data = array();//initialize array
			$where = array();//initialize array
     //use loop to set the sql search query according to the number of keywords 
	$i = 0;//use to add ")" to the end  of where clause
	foreach($custom_search as $key=>$keywords){
		
	if($key == 0){
			
				if($i == count($custom_search) - 1){
				$where[] .= "(company_name LIKE ?";
				$where[] .= " OR category LIKE ?)";
				
				$where_product[] .= "(product_name LIKE ?";
				$where_product[] .= " OR description LIKE ?)";
			}else{
				$where[] .= "(company_name LIKE ?";
				$where[] .= " OR category LIKE ?";
				
				$where_product[] .= "(product_name LIKE ?";
				$where_product[] .= " OR description LIKE ?";
			}//end if else
			
	}else{
			if($i == count($custom_search) - 1){
				$where[] .= " OR company_name LIKE ?";
				$where[] .= " OR category LIKE ?)";
				
				$where_product[] .= " OR product_name LIKE ?";
				$where_product[] .= " OR description LIKE ?)";
			}else{
				$where[] .= " OR company_name LIKE ?";
				$where[] .= " OR category LIKE ?";
				
				$where_product[] .= " OR product_name LIKE ?";
				$where_product[] .= " OR description LIKE ?";
			}//end if else
			
		}//end if else $key
		
		if(strlen($keywords) > 2){ 
			$data[] .= "%$keywords%"; //set search data array for pdo execute method
			$data[] .= "%$keywords%"; //set search data array for pdo execute method
		}else{
			$data[] .= "%empty_query%"; //set search data array for pdo execute method
			$data[] .= "%empty_query%"; //set search data array for pdo execute method
		}//end if else strlen
		
		$i++;
	}//end foreach
	
   //print_r($data);//print the query array data for clarification
    //print_r($where);//print the where condition array data for clarification
	/*
	search for companies
	*/
    $db = new Db_conn();//instantiate database connection class
	$table_name = "profile";
	//set default query_fields
	$query_fields = array("field_names"=>array("profile_id", "member_id", "company_name", "category", "logo", "country", "biz_type"), "where"=>$where, "data"=>$data, "limit"=>20);
	
	//set pagination data
	  $row_count_query=array("field_names"=>array("count(*) as total", "MAX(profile_id) as max", "MIN(profile_id) as min"), "where"=>$where, "data"=>$data, "custom_placeholder"=>"custom",);
	  $pagination_query = array("field_names"=>array("profile_id", "member_id", "company_name", "category", "logo", "country", "biz_type"), "where"=>array_merge($where, array("AND (profile_id < ?)")), "data"=>$data, "custom_placeholder"=>"custom", "order_by"=>"profile_id Desc", "limit"=>8);	
	$set_pagination = paginate($table_name, $pagination_query, $row_count_query);//call pagination function from librays
	if(!empty($set_pagination)){
		$query_fields = $set_pagination;
      }//end if 
	  
	$db->select_data($table_name, $query_fields);
	?>
	<div class="row">
		<div class="col-sm-8 col-md-8 col-xs-12" style="background-color:#f5f5f5; padding:0px; margin:5px 0px;">
		<div class="sub_head">  <?php  echo $set_pagination['total_rows'];  ?> Total Company Found </div>
		<?php
		$i = 0;
		while($match = $db->return_sth()->fetch()){
			fetched_company($match, "../");//call function to print the company card from library/library/functions.php
			?>
			
				
		<?php	
		$i++;
		$last_id = $match['profile_id'];
		}//end while
			if($i >= 8 && $last_id != $set_pagination['min_id']){
		?>
		
		<center>
		<a href='?<?php echo set_url_var($last_id); ?>'> 
				<div >See more...</div>
				</a>
				</center>
	<?php
		}else{
			if(isset($_GET['num_limit'])){
			echo " <center> <h3 style='color:red;' > End </h3> </center>";
		}//end if !isset
		}//end if else $i
		?>
		
		<?php
		
		/*..............Search for products*/
			$table_name = "products";
		//set default query_fields
		$query_fields = array("field_names"=>array("product_id", "product_name", "description", "img_file", "member_id"), "where"=>$where_product, "data"=>$data, "limit"=>8);
	
	//set pagination data
	  $row_count_query=array("field_names"=>array("count(*) as total", "MAX(product_id) as max", "MIN(product_id) as min"), "where"=>$where_product, "data"=>$data, "custom_placeholder"=>"custom",);
	  $pagination_query = array("field_names"=>array("product_id", "product_name", "description", "img_file", "member_id"), "where"=>array_merge($where_product, array("AND (product_id< ?)")), "data"=>$data, "custom_placeholder"=>"custom", "order_by"=>"product_id Desc", "limit"=>8);	
	$set_pagination = paginate($table_name, $pagination_query, $row_count_query);//call pagination function from librays
	if(!empty($set_pagination)){
		$query_fields = $set_pagination;
      }//end if 
	  
	$db->select_data($table_name, $query_fields);
	
echo"<div class='sub_head'>". $set_pagination['total_rows'] ." Total Product Found</div>";
		$i = 0;
		while($product_details = $db->return_sth()->fetch()){
			?>
			
			    
				
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6" id="product_main" style="padding:2px; position:relative;">
				<a href="<?php echo $dir.preg_replace('/\s+/', '-', $product_details['product_name']); ?>/product/<?php  echo $product_details['product_id'];?>">
				<div style="margin:3px; display:block; border:1px solid grey; height:210px; border-radius:5px; padding:3px; background-color:#ffffff; text-align:center;">
                <div class="ellipse" style="color:#000000;"><b> <?php echo $product_details['product_name']; ?></b> </div>   
                <img class="center-block"   src="../products/<?php echo $product_details['img_file']; ?> " style="width:80%; height:140px;">    
				<br>
				<a href="<?php echo $dir.preg_replace('/\s+/', '-', $product_details['product_name']); ?>/product/<?php  echo $product_details['product_id'];?>">
				View details...
				</a>
				</div>
				</a>
				</div>
		<?php	
		$i++;
		$last_id = $product_details['product_id'];
		}//end while
			if($i >= 8 && $last_id != $set_pagination['min_id']){
		?>
		
		<center>
		<a href='?<?php echo set_url_var($last_id) ?>'> 
				<div >See more...</div>
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
		<?php
		}//if GET ref
		?>
		
		
<?php
//if the user is searching companies only
		if($_GET['filter_by'] == "Company"){
	$keywords = $_GET['search_key'];//get user search terms
	$custom_search = explode(" ", $keywords);//split search terms into keywords 

			$data = array();//initialize array
			$where = array();//initialize array
     //use loop to set the sql search query according to the number of keywords 
	$i = 0;//use to add ) to the end where clause
	foreach($custom_search as $key=>$keywords){
		
	if($key == 0){
			
				if($i == count($custom_search) - 1){
				$where[] .= "(company_name LIKE ?";
				$where[] .= " OR category LIKE ?)";
			}else{
				$where[] .= "(company_name LIKE ?";
				$where[] .= " OR category LIKE ?";
			}//end if else
			
	}else{
			if($i == count($custom_search) - 1){
				$where[] .= " OR company_name LIKE ?";
				$where[] .= " OR category LIKE ?)";
			}else{
				$where[] .= " OR company_name LIKE ?";
				$where[] .= " OR category LIKE ?";
			}//end if else
			
		}//end if else $key
		
		if(strlen($keywords) > 2){ 
			$data[] .= "%$keywords%"; //set search data array for pdo execute method
			$data[] .= "%$keywords%"; //set search data array for pdo execute method
		}else{
			$data[] .= "%empty_query%"; //set search data array for pdo execute method
			$data[] .= "%empty_query%"; //set search data array for pdo execute method
		}//end if else strlen
		
		$i++;
	}//end foreach
	
   //print_r($data);//print the query array data for clarification
    //print_r($where);//print the where condition array data for clarification
	
/* 
Search for companies
*/
    $db = new Db_conn();//instantiate database connection class
	$table_name = "profile";
	//set default query_fields
	$query_fields = array("field_names"=>array("profile_id", "member_id", "company_name", "category", "logo", "country", "biz_type"), "where"=>$where, "data"=>$data, "limit"=>20);
	
	//set pagination data
	  $row_count_query=array("field_names"=>array("count(*) as total", "MAX(profile_id) as max", "MIN(profile_id) as min"), "where"=>$where, "data"=>$data, "custom_placeholder"=>"custom",);
	  $pagination_query = array("field_names"=>array("profile_id", "member_id", "company_name", "category", "logo", "country", "biz_type"), "where"=>array_merge($where, array("AND (profile_id < ?)")), "data"=>$data, "custom_placeholder"=>"custom", "order_by"=>"profile_id Desc", "limit"=>8);	
	$set_pagination = paginate($table_name, $pagination_query, $row_count_query);//call pagination function from librays
	if(!empty($set_pagination)){
		$query_fields = $set_pagination;
      }//end if 
	  
	$db->select_data($table_name, $query_fields);
	?>
	<div class="row">
		<div class="col-sm-8 col-md-8 col-xs-12" style="background-color:#f5f5f5; padding:0px; margin:5px 0px;">
		<div class="sub_head">  <?php  echo $set_pagination['total_rows'];  ?> Total Results Found </div>
		<?php
		$i = 0;
		while($match = $db->return_sth()->fetch()){
			
			?>
			  <div class=" <?php echo $print_size; ?> popular_biz" style="padding:0px;">
			  <div style="border:1px solid grey; border-radius:3px; margin:0px; background-color:#ffffff;">
				<a href="../profile/?x_lograck=<?php  echo $match['member_id'];?>&link_req=view_profile ">
				<div style="float:left; padding:3px;">
				<img style='width:50px; height:50px;' src="../uploads/<?php  echo $match['logo']; ?>" alt="Logo">
		        </div>
				<div style="padding-top:3px;">
				<div class="ellipse"> <b><?php  echo $match['company_name']; ?></b> </div>
				<div style="text-align:left; color:grey;">
				<?php  echo $match['biz_type']; ?>
				</div>
				</div>
				<div style="color:black;">
				<div style="clear:both; padding:5px; border-bottom:1px solid grey;">
				<div >
				<span style="font-weight:bolder;">Category</span><div class="ellipse"> <span style="color:grey;"><?php echo $popular['category']; ?> </span></div>
				</div>				
				<span style="font-weight:bolder;">Country</span> <span style="color:grey;"><?php echo $match['country']; ?> </span>
				</div>
				</div>
				</a>
                <a href="../bizlist.php?x_lograck=<?php  echo $match['member_id'];?>&link_req=add_bizlist ">
				<div style="clear:both; text-align:center; color:white; padding:5px; background-color:navy;">				
				<span >
				 Add to list
				</span>
				</div>
				</a>
				
			    </div>
			    </div>
				
		<?php	
		$i++;
		$last_id = $match['profile_id'];
		}//end while
			if($i >= 8 && $last_id != $set_pagination['min_id']){
		?>
		
		<center>
		<a href='?<?php echo set_url_var($last_id); ?>'> 
				<div >See more...</div>
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
		<?php
		}//if GET ref
		?>
			
	
		
<?php	
//if the user is searching products only	
if($_GET['filter_by'] == "Products"){
	$keywords = $_GET['search_key'];//get user search terms
	$custom_search = explode(" ", $keywords);//split search terms into keywords 
	
	$remove_wrds = array("the", "for", "and", "get", "how", "in", "to", "with", "we"); //array of words to remove from the search string
	$custom_search =  array_values(array_udiff($custom_search, $remove_wrds, 'strcasecmp'));  //remove common joining words and set a new array
			$data = array();//initialize array
			$where = array();//initialize array
     //use loop to set the sql search query according to the number of keywords 
	$i = 0;//use to add ) to the end where clause
	foreach($custom_search as $key=>$keywords){
		
	if($key == 0){
			
				if($i == count($custom_search) - 1){
				$where[] .= "(p_name LIKE ?";
				$where[] .= " OR p_desc LIKE ?)";
			}else{
				$where[] .= "(p_name LIKE ?";
				$where[] .= " OR p_desc LIKE ?";
			}//end if else
			
	}else{
			if($i == count($custom_search) - 1){
				$where[] .= " OR p_name LIKE ?";
				$where[] .= " OR p_desc LIKE ?)";
			}else{
				$where[] .= " OR p_name LIKE ?";
				$where[] .= " OR p_desc LIKE ?";
			}//end if else
			
		}//end if else $key
		
		if(strlen($keywords) > 2){ 
			$data[] .= "%$keywords%"; //set search data array for pdo execute method
			$data[] .= "%$keywords%"; //set search data array for pdo execute method
		}else{
			$data[] .= "%empty_query%"; //set search data array for pdo execute method
			$data[] .= "%empty_query%"; //set search data array for pdo execute method
		}//end if else strlen
		
		$i++;
	}//end foreach
	
   //print_r($data);//print the query array data for clarification
    //print_r($where);//print the where condition array data for clarification
	

    $db = new Db_conn();//instantiate database connection class
	$table_name = "product";
	//set default query_fields
	$query_fields = array("field_names"=>array("p_id", "p_code", "p_name", "p_desc", "p_img", "p_price", "price_cancel", "p_owner"), "where"=>$where, "data"=>$data, "limit"=>8);
	
	//set pagination data
	  $row_count_query=array("field_names"=>array("count(*) as total", "MAX(p_id) as max", "MIN(p_id) as min"), "where"=>$where, "data"=>$data, "custom_placeholder"=>"custom",);
	  $pagination_query = array("field_names"=>array("p_id", "p_code", "p_name", "p_desc", "p_img", "p_owner"), "where"=>array_merge($where, array("AND (p_id< ?)")), "data"=>$data, "custom_placeholder"=>"custom", "order_by"=>"p_id Desc", "limit"=>8);	
	$set_pagination = paginate($table_name, $pagination_query, $row_count_query);//call pagination function from librays
	if(!empty($set_pagination)){
		$query_fields = $set_pagination;
      }//end if 
	  
	$db->select_data($table_name, $query_fields);
	?>
			<div class="row">
		<div class="col-sm-8 col-md-8 col-xs-12" style="background-color:#f5f5f5;">
		<div class="sub_head"><?php echo $set_pagination['total_rows']; ?> Results Found</div>
		
		<?php
		$i = 0;
		while($product_details = $db->return_sth()->fetch()){
			?>
			
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6" id="product_main" style="padding:2px; position:relative;">
				<div style="margin:3px; display:block; border:1px solid grey; height:210px; border-radius:5px; padding:3px; background-color:#ffffff;">
                <div class="ellipse"><b> <?php echo $product_details['p_name']; ?></b> </div>   
                <img class="center-block"   src="../products/img/<?php echo $product_details['p_img']; ?> " style="width:80%; height:140px;">    
				<br>
				<a href="<?php echo $dir."product/".preg_replace('/\s+/', '-', $product_details['p_name'])."-".$product_details['p_code'];?>">
				<button class="order-btn">View Product</button>
				</a>
				</div>
				</div>
		<?php	
		$i++;
		$last_id = $product_details['product_id'];
		}//end while
			if($i >= 8 && $last_id != $set_pagination['min_id']){
		?>
		
		<center>
		<a href='?<?php echo set_url_var($last_id) ?>'> 
				<div >See more...</div>
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
		<?php
		}//if GET ref
		
		
			
		
}//end isset
?>


<div class="col-sm-4 col-md-4 col-xs-12" style="padding:0px;" >
<div style="margin:2px 3px; padding:5px; background-color:#ffffff;">
<div class="sub_head more" style="display:block; clear:both;"> Biz Insight</div>
<?php
//biz_insight("../");
?>
</div>

</div>

</div>


<?php
/*
if(isset($_GET['dsec'])){

  $search = $_GET['dsec'];
  $dbh = db_connect();//call database connection
  $data = array($search); //set search data array for pdo execute method
  $sql = "SELECT d.symptons AS symp, d.disease_name AS d_name, d.disease_code AS d_code, 
            d.causes AS cz, d.overview AS ov, d.prevention AS prv,
             d.diagnosis AS diag, d_dr.dosage,
			 dr.drug_name, dr.drug_code
	        FROM disease_drug d_dr
			LEFT JOIN  disease d ON d_dr.disease_code = d.disease_code
			LEFT JOIN drug dr ON d_dr.drug_code = dr.drug_code 
			WHERE d_dr.disease_code = $search  
			ORDER BY d_dr.id";
	$STH = $dbh->query($sql);
	//$STH->execute($data);
?>
<?php	
while($row = $STH->fetch()){
	
   $dosage[] =  $row['dosage'];
   $title = $row['d_name'];
   $cz = $row['cz'];
   $prv = $row['prv'];
   $ov = $row['ov'];
   $diag = $row['diag'];
   $drug_name[] = $row['drug_name'];
   $drug_code[] = $row['drug_code'];
   
    

}//end while $row
?>
 <div style="border:1px solid grey; margin:2px; padding:10px; border-radius:8px; width:80%;">
  <span style="font-weight:bold; font-size:18;"><h2> <?php echo $title ?> </h2></span>
   <b> Overview </b>
  </p> <?php echo $ov; ?> </p>
  
  <b> Causes </b>
  </p> <?php echo $cz; ?> </p>
  
  <b> Prevention </b>
  </p> <?php echo $prv; ?> </p>
  
  <b> Diagnosis </b>
  </p> <?php echo $diag; ?> </p>
<h3> Prescriptions </h3>
<br>
<?php	
for($i=0; $i<=count($dosage); $i++){
	$d_code = $drug_code[$i];
	print "<b> <a href='./e-pharmacy.php?d_code=". $d_code. "'>". $drug_name[$i]. "</a></b>--";
   print $dosage[$i]. "<br>";
	
}//end while $row
 ?>
   <b> Warning/Precautions </b>
  </p>If the the sickness continues after 2 days, go and see your doctor </p>
<br>
 </div>
 
<?php 
}//end isset
*/
?>

  
<?php
footer($dir);
?>