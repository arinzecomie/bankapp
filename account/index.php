<?php
session_start();
?>
<?php
if(!isset($_SESSION['user_id']) ||
  $_SESSION['user_id']=="") {
header("location:../");
}

include('../library/library.php');
?>

<?php
//fetch the number of gas  request
		 $dbhandle = new Db_conn();
		 $table_name = "checkout c";
		 $query_fields = array("field_names"=>array("count(ord_id) as total_req"), "where"=>array("c.email =", "OR c.member_id ="), "data"=>array($_SESSION['all_user_mail'], $_SESSION['user_id']) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_req = $dbhandle->return_sth()->fetch();
	 $total_req = $ttl_req['total_req'];
?>

<?php
//fetch the number of cylinder  order
		 $dbhandle = new Db_conn();
		 $table_name = "req_quote rq";
		 $query_fields = array("field_names"=>array("count(quote_id) as total_ord"), "where"=>array("rq.email =","OR rq.member_id ="), "data"=>array($_SESSION['all_user_mail'], $_SESSION['user_id']) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_ord = $dbhandle->return_sth()->fetch();
	 $total_ord = $ttl_ord['total_ord'];
?>

<?php
/*
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "users u";
		 $query_fields = array("field_names"=>array("count(user_id) as total_user"), "where"=>array("u.user_id >"), "data"=>array(0) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_user = $dbhandle->return_sth()->fetch();
	 $total_user = $ttl_user['total_user'];
?>

<?php
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "staff s";
		 $query_fields = array("field_names"=>array("count(staff_id) as total_staff"), "where"=>array("s.staff_id >"), "data"=>array(0) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_staff = $dbhandle->return_sth()->fetch();
	 $total_staff = $ttl_staff['total_staff'];
?>

<?php
//fetch the number of customers served
		 $dbhandle = new Db_conn();
		 $table_name = "checkout";
		 $query_fields = array("field_names"=>array("count(ord_id) as total_served"), "where"=>array("status ="), "data"=>array("served") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_served = $dbhandle->return_sth()->fetch();
	 $total_served = $ttl_served['total_served'];
?>

<?php

//fetch the number of Kg gas delivered
		 $dbhandle = new Db_conn();
		 $table_name = "gas_req";
		 $query_fields = array("field_names"=>array("SUM(quantity) as total_kg"), "where"=>array("status ="), "data"=>array("served") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_kg = $dbhandle->return_sth()->fetch();
	 $total_kg = $ttl_kg['total_kg'];
?>

<?php
//Get the sum of total sales made
		 $dbhandle = new Db_conn();
		 $table_name = "gas_req";
		 $query_fields = array("field_names"=>array("SUM(price) as total_sales"), "where"=>array("status ="), "data"=>array("pending") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_sales = $dbhandle->return_sth()->fetch();
	 $total_sales = $ttl_sales['total_sales'];
	 */
?>

<?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
main_menu("$title", "$meta_key", "$meta_desc", "../");

$dir="../"; //page directory to the root folder
?>

<center>
<div class="container" style="display:inline-block; ">
<div class="row" style="">


			 
        </div>
        </div>
		</center>		
	<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content col-sm-6 col-sm-offset-3 col-xs-12">
    <span class="close">&times;</span>
	<br>
	<br>
	<div id="my_form">
	</div>
     
  </div>

</div>
<center>
<div class="row" style="border-bottom:1px solid #fff;">
<div class="col-sm-3">
<a  href=""><div class="admin_link"> Edit Profile </div></a>
			 
						  
</div>
<div class="col-sm-5">
 <h2> Welcome </h2>
<b><i class="fa fa-user"></i> <?php echo $_SESSION['user_name']; ?></b>
<br>
<?php echo $_SESSION['all_user_mail'];?>
</div>

<div class="col-sm-4" style="">

<a  href="../logout/"><div class="admin_link"> Logout </div></a>
</div> 



</div> 
</center>
<hr>

<div class="container">
<div class="row">
<div class="col-sm-4 text-center" style="border:1px solid #003; border-radius:8px; margin:5px; padding:10px;">
 <span class="icon"><i style="color:red;" class="fa fa-pie-chart fa-3x"></i></span> 
 <br>
 <b style="color:#fff;">
 <span class="badge" style="background-color:#003; font-size:20px;">
								   <?php
								   echo $total_req; 
								   ?> 
								   </span> 
 </b> Total Order
 </div>
 
<div class="col-sm-4 text-center" style="border:1px solid #003; border-radius:8px; margin:5px; padding:10px;">
  <span class="icon"><i style="color:red;" class="fa fa-paper-plane fa-3x"></i></span> 
 <br>
 <b style="color:#fff;">
 <span class="badge" style="background-color:#003; font-size:20px;">
								   <?php
								   echo $total_ord; 
								   ?> 
								   </span>
 </b> Quote Request
 </div>
 
<div class="col-sm-3 text-center" style="border:1px solid #003; border-radius:8px; margin:5px; padding:10px;">
  <span class="icon"><i style="color:red;" class="fa fa-taxi fa-3x"></i></span> 
 <br>
 <b style="color:#000;"><?php echo "0"; ?></b> Promo Offer  
 </div>
 
</div>
</div>

<div style="margin:5px; margin-top:10px;">
</div></a>
<!--
<div style="background-color:#003;">
<center>  
<div class="container" >
                            <div class="row text-center">
                                <div class="col-md-4">
                                   <a href="request.php?pg=order_req"> 
								   <div  style="margin:20px; padding:20px; background-color:#ff4000;">
								  
								   <span class="badge" style="background-color:#fff; font-size:20px;">
								   <?php
								   echo $total_req; 
								   ?> 
								   </span> 
								   <br>
								  <h4> <span style="color:#fff;"> Total Order  </span></h4>
								  
                                        <i class="fa fa-cogs fa-3x"></i>
                                    </a>
                                    </div>
                                </div>

                                <div class="col-md-4">
								<a href="request.php?pg=quote_rq">
                                    <div  style="margin:20px; padding:20px; background-color:#ff4000;">
								   <span class="badge" style="background-color:#fff; font-size:20px;">
								   <?php
								   echo $total_ord; 
								   ?> 
								   </span>
								  <h4> <span style="color:#fff;"> Quote Request </span> </h4>
								   
                                        <i class="fa fa-paint-brush fa-3x"></i>
                                       
										</a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                   <div  style="margin:20px; padding:20px; background-color:#ff4000;">
									<span style="color:Black;">
								   <span class="badge" style="background-color:#fff; font-size:20px;">
								   <?php
								   echo $total_req; 
								   ?> 
								   </span>
								   <h4> <span style="color:#fff;"> Total Request  </span> </h4>
								  
                                       <a href="request.php?pg=bulk_req"> <i class="fa fa-bullhorn fa-3x"></i>
                                        
										</a>
                                    </div>
                                </div>
</div>								
</div>	
</center>							
</div>-->
								
            


<script type="text/javascript" src="../js/admin.js"></script>

  <?php
  footer("../")
  ?>

                