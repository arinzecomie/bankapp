<?php
session_start();
?>
<?php
if(!isset($_SESSION['admin_username']) ||
  $_SESSION['admin_username']=="") {
header("location:../admin");
}

include('../library/library.php');
?>

<?php
/*
//fetch the number of gas  request
		 $dbhandle = new Db_conn();
		 $table_name = "checkout c";
		 $query_fields = array("field_names"=>array("count(ord_id) as total_req"), "where"=>array("c.status <>"), "data"=>array("served") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_req = $dbhandle->return_sth()->fetch();
	 $total_req = $ttl_req['total_req'];
	 
?>

<?php
//fetch the number of cylinder  order
		 $dbhandle = new Db_conn();
		 $table_name = "req_quote rq";
		 $query_fields = array("field_names"=>array("count(quote_id) as total_ord"), "where"=>array("rq.quote_id >"), "data"=>array(0) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_ord = $dbhandle->return_sth()->fetch();
	 $total_ord = $ttl_ord['total_ord'];
	 */
?>

<?php
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
		 $query_fields = array("field_names"=>array("count(staff_id) as total_staff"), "where"=>array("s.staff_id >"), "data"=>array(1) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_staff = $dbhandle->return_sth()->fetch();
	 $total_staff = $ttl_staff['total_staff'];
?>

<?php

//fetch the number of customers served
		 $dbhandle = new Db_conn();
		 $table_name = "users";
		 $query_fields = array("field_names"=>array("count(user_id) as total_banned"), "where"=>array("status ="), "data"=>array("banned") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_banned = $dbhandle->return_sth()->fetch();
	 $total_banned = $ttl_banned['total_banned'];
?>

<?php

//fetch the number of Kg gas delivered
		 $dbhandle = new Db_conn();
		 $table_name = "users";
		 $query_fields = array("field_names"=>array("count(user_id) as total_unemail"), "where"=>array("verify_status ="), "data"=>array("no") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_unemail = $dbhandle->return_sth()->fetch();
	 $total_unemail = $ttl_unemail['total_unemail'];
?>

<?php

//Get the sum of total credit card 
		 $dbhandle = new Db_conn();
		 $table_name = "card";
		 $query_fields = array("field_names"=>array("count(card_id) as total_card"), "where"=>array("card_id >"), "data"=>array(0) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_card = $dbhandle->return_sth()->fetch();
	 $total_card = $ttl_card['total_card'];
	 
?>

<?php

//Get the sum of total blocked_transfers
		 $dbhandle = new Db_conn();
		 $table_name = "account_info";
		 $query_fields = array("field_names"=>array("count(info_id) as total_bl"), "where"=>array("status ="), "data"=>array("block") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_blocked = $dbhandle->return_sth()->fetch();
	 $total_bl = $ttl_blocked['total_bl'];
	 
?>

<?php

//Get the sum of total blocked_transfers
		 $dbhandle = new Db_conn();
		 $table_name = "other_bank";
		 $query_fields = array("field_names"=>array("count(other_id) as total_other"), "where"=>array("status ="), "data"=>array("pending") );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_pending = $dbhandle->return_sth()->fetch();
	 $total_pending = $ttl_pending['total_other'];
	 
?>

<?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth"; 
menu("$title", "$meta_key", "$meta_desc", "../", "Admin");

$dir="../"; //page directory to the root folder
?>
<div style="margin-top:50px;"> </div>
<center>
<div class="container" style="margin:0px; padding:0px; z-index:99px;">
<div class="row" style="padding:0px;">

                 <div class="col-3 col-sm-2" style="margin-top:5px; padding:0px;">
                 <a  href="admin-reg/"><div class="admin_link">
			 <span class="fa fa-user-circle"> </span> <br> Admin </div></a>
				 </div>
				 
				    <div class="col-4 col-sm-2 " style="margin-top:5px; padding:0px;">
                <a href="../admin/request.php?pg=contact"> <div class="admin_link"><?php echo get_message(); ?>  <br> Messsage </div></a>
				</div>
                
         

             
            <?php if ($_SESSION['desig'] == "Super_admin") {?>
			 <div class="col-5 col-sm-2" style="margin-top:5px; padding:0px;">
              <a onclick="add_staff();" style="cursor:pointer;"> <div class="admin_link">
			  <span class="fa fa-user-plus"></span>
			  <br>
			  Add Admin 
			  </div></a>
			  </div>
			       <?php
            }//end if
            ?>
			     <!--<div class="col-5 col-sm-2" style="margin-top:5px;">
              <a href="<?php echo $dir; ?>manage-product/?pg_rq=add_product" style="cursor:pointer;"> <div class="admin_link">
			  <span class="fa fa-sign-out">
			 </span> <br> Add product </div></a>
			  </div>-->
			  
			     <div class="col-3 col-sm-2 " style="margin-top:5px; padding:0px;">
             <a  href="<?php echo $dir; ?>admin/admin_logout.php"><div class="admin_link"> 
			 <span class="fa fa-sign-out">
			 </span> <br> Logout </div></a>

             
			</div>
			
			   <div class="col-5 col-sm-2" style="margin-top:5px; padding:0px;">
			 <a  href="user-status/?rq=blocked_trans"><div class="admin_link">
			 <span class="badge" style="background-color:#ff4000; padding:5px; color:#fff;"><?php echo $total_bl; ?> </span>
			 <br> Blocked trans </div></a>
			 </div>
			 
			   <!--<div class="col-4 col-sm-2 " style="margin-top:5px;">
             <a  onclick="show_change_days('show_change_days');" style="cursor:pointer;"><div class="admin_link"> 
			 <span class="fa fa-ban"> Change
			 </span> <br> block days </div></a>
			 <div id="show_change_days" style="border:1px solid grey; background-color:#eaeaea; display:none;">
    <form id="change_days" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
  
  <span class="input_title">Enter days </span>
  <input id="amount" class="modal_input" type="text" name="days" placeholder="eg 10" required="required">
 <center>
 <input type="hidden" name="submit_change_days">
 <button onclick="ajax_sub('change_days');"  id="signup_user" class="site-btn" type="submit" name="submit_credit">Submit</button> 
 </center>
 </form>
 </div>

             
			</div>-->
						  
        </div>
        </div>
		</center>	
		<hr style="border:0.5px solid #000066;">
	<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content col-sm-6 col-sm-offset-3 col-xs-12">
    <span style="color:red;" class="close">&times;</span>
	<br>
	<br>
	<div id="my_form">
	</div>
     
  </div>

</div>
<center>
<div class="row" style="border-bottom:1px solid #fff;">
<div class="col-sm-3">
<div style="border:1px solid lightgrey; border-radius:5px;">
<?php
echo "<b style='margin:5px; font-size:18px;'>". $_SESSION['desig'] ."</b><br>";
echo "<img src='passport/".$_SESSION['passport']."' style='width:90px; height:90px;' alt='Admin Passport'> <br>";
echo "<div style='background-color:#000066; padding:5px; padding-top:10px; color:#fff;'><b>Welcome: </b>".$_SESSION['surname']." ".$_SESSION['f_name']."</div>";
?>
</div>
</div>

<div class="col-sm-5">
<div style="margin:10px;">
 <h2> <b>Barclay Admin Panel</b></h2>
</div>
</div>

<div class="col-sm-4" style="">
<a  <?php if ($_SESSION['desig'] == "Super_admin") {?> href="view-staff/" <?php }else{?> href="#"  <?php } ?> >
 <div style="border:1px solid lightgrey; border-radius:8px; background-color:#eaeaea;">
 <div class="row">
 <div class="col-sm-4 col-4" style="border-right:1px solid lightgrey; background-color:lightblue; padding:10px;">
		    <span class="fa fa-briefcase" style="font-size:50px; color:#000066;"> </span>
		   </div>
		   <div class="col-sm-8 col-8" style="padding:10px;">
		   <span class="badge" style="background-color:#000066; font-size:20px; color:#fff;">
		   <?php
		   echo $total_staff; 
		   ?> 
		   </span>
		   <h5><b>Total Admin</b></h5>
		   </div>
		   </div>
		   </div>
		   </a>
		   
		    <div style="border:1px solid lightgrey; border-radius:8px; margin-top:5px; background-color:#eaeaea;">
		   <a href="users/?rq=all">
			 <div class="row">
             <div class="col-sm-4 col-4" style="border-right:1px solid lightgrey; background-color:lightblue; padding:10px;">
			<span class="fa fa-users" style="font-size:50px; color:#000066;"> </span>
			</div>
			 <div class="col-sm-8 col-8" style="padding:10px;">
		   <span class="badge" style="background-color:#000066; font-size:20px; color:#fff;">
		   <?php
		   echo $total_user; 
		   ?> 
		   </span>
		   <h5><b>Total Customers</b></h5>
		   </div>
		   </div>
		   </a>
		   </div>
</div> 



</div> 
</center>
<hr>

<!--<div class="row">
<div class="col-sm-4 text-center">
 <span class="icon"><i style="color:red;" class="fa fa-pie-chart fa-3x"></i></span> 
 <br>
 <b style="color:#000;">NGN <?php echo $total_sales; ?></b> Total Sales 
 </div>-->
 
<div class="col-sm-4 offset-sm-4 text-center">
 <a href="pending-transfer">
<div style="border:1px solid lightgrey; border-radius:10px; padding:5px;">
  <span class="icon"><i style="color:red;" class="fa fa-paper-plane fa-3x"></i></span> 
 <br>
 <b style="color:#000; font-size:20px;"><?php echo $total_pending; ?></b> Pending Transfers
 </div>
  </a>
 </div>

 
<!--<div class="col-sm-4 text-center">
  <span class="icon"><i style="color:red;" class="fa fa-taxi fa-3x"></i></span> 
 <br>
 <b style="color:#000;"><?php echo $total_kg; ?></b> Total in progress  
 </div>
 
</div>-->

<div style="margin:5px; margin-top:25px;">
</div></a>
<div style="background-color:#003;">
<center>  
<div class="container" >
                            <div class="row text-center">
                                <div class="col-md-4">
                                   <a href="user-status?rq=banned"> 
								   <div  style="margin:20px; padding:20px; background-color:#eaeaea;">
								  
								   <span class="badge" style="background-color:#fff; font-size:20px;">
								   <?php
								   echo $total_banned; 
								   ?> 
								   </span> 
								   <br>
								  <h4> <span style="color:#000066;">Banned Users </span></h4>
								  
                                        <i class="fa fa-cogs fa-3x"></i>
                                   
                                    </div><!-- /.row -->
									 </a>
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-4">
								<a href="credit_card/">
                                    <div  style="margin:20px; padding:20px; background-color:#eaeaea;">
								   <span class="badge" style="background-color:#fff; font-size:20px;">
								   <?php
								   echo $total_card; 
								   ?> 
								   </span>
								  <h5> <span style="color:#000066;"> Credit Card Transfer </span> </h5>
								   
                                        <i class="fa fa-paint-brush fa-3x"></i>
                                       
										
                                    </div><!-- /.row -->
									 </a>
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-4">
								 <a href="user-status?rq=email"> 
                                   <div  style="margin:20px; padding:20px; background-color:#eaeaea;">
								
								   <span class="badge" style="background-color:#fff; font-size:20px;">
								   <?php
								   echo $total_unemail; 
								   ?> 
								   </span>
								   <h4> <span style="color:#000066;"> Unverified Email  </span> </h4>
								  
                                       <i class="fa fa-bullhorn fa-3x"></i>
                                        
										
                                    </div><!-- /.row -->
									 </a>
                                </div><!-- /.col-md-4 -->
</div>								
</div>								
            </center>
<script type="text/javascript" src="../js/admin.js"></script>
  <?php
  footer("../")
  ?>