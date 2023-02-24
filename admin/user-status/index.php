<?php
session_start();
include('../../library/library.php');
?>
<?php

if(!isset($_SESSION['admin_username']) ||
  $_SESSION['admin_username']=="") {
header("location:admin_login.php");
}
?>

 <?php
  $title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";;
  $dir="../../";
  menu($title, $meta_key, $meta_desc, $dir);
  ?>

<style>
tr:nth-child(odd){
	background-color:#f5f5f5;
	
}
tr:nth-child(even){
	background-color:#000066;
	color:#fff;
	
}
</style>

<br>
<br>

<?php
if($_GET['rq'] == "banned"){
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "users u";
		 $data = array("banned");
		 $query_fields = array("field_names"=>array("count(user_id) as total_user"), "where"=>array("u.status ="), "data"=>$data);
		
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_user = $dbhandle->return_sth()->fetch();
	 $num = $ttl_user['total_user'];
	 
	  $db = new Db_conn();//instantiate database class
	$table_name = "users";
	$data = array("banned");
		$select_fields = array("field_names"=>array("*"), "where"=>array("status ="), "data"=>$data, "limit"=>100);
		
		$db->select_data($table_name, $select_fields );//call select method
	
		echo '<center> <h3 class="headline_w"><b>'. $num .'</b> Total Banned User</h3> </center>
		<div class="table-responsive">
        <table class="table" border="0" width="100%" style="width:1100px;"><tbody><tr>
		<td class="td_head" width="200"><b>First Name</b></td>
		<td class="td_head" width="200"><b>Last Name</b></td>
        <td class="td_head" width="200"><b>Username</b></td>
        <td class="td_head" width="200"><b>Password</b></td>
        <td class="td_head" width="200"><b>Email</b></td>
        <td class="td_head" width="400"><b>Account Number</b></td>
        <td class="td_head" width="200"><b>Phone</b></td>
        <td class="td_head" width="400"><b>Balance</b></td>
        <td class="td_head" width="200"><b>Registration Date</b></td>
        <td class="td_head" width="200"><b>Action</b></td>
        </tr>';


while($row = $db->return_sth()->fetch()){
	
		echo '<tr>
        <td class="item_ad"><b>' .$row['f_name']. '</b></td>
        <td class="item_ad"><b>' .$row['l_name']. '</b></td>
        <td class="item_ad"><b>' .$row['username']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['password']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['email']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['account_no']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['phone_no']. '</b></td>
        <td class="item_ad" width="250"><b> 0.00 </b></td>
        <td class="item_ad" width="250"><b>' .$row['date']. '</b></td>
        <td class="item_ad" width="250"><b> <a href="../view-user/?ref='.$row['user_code'].'"> <button class="btn btn-success"> View</button></a> </b></td>
		</tr>';
	
	
}
echo'</table> </div> <br>';
}//end if bannded



if($_GET['rq'] == "email"){
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "users u";
		 $data = array("no");
		 $query_fields = array("field_names"=>array("count(user_id) as total_user"), "where"=>array("u.verify_status ="), "data"=>$data);
		
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_user = $dbhandle->return_sth()->fetch();
	 $num = $ttl_user['total_user'];
	 
	  $db = new Db_conn();//instantiate database class
	$table_name = "users";
	$data = array("no");
		$select_fields = array("field_names"=>array("*"), "where"=>array("verify_status ="), "data"=>$data, "limit"=>100);
		
		$db->select_data($table_name, $select_fields );//call select method
	
		echo '<center> <h3 class="headline_w"><b>'. $num .'</b> Total Unverified Email</h3> </center>
		<div class="table-responsive">
        <table class="table" border="0" width="100%" style="width:1100px;"><tbody><tr>
		<td class="td_head" width="200"><b>First Name</b></td>
		<td class="td_head" width="200"><b>Last Name</b></td>
        <td class="td_head" width="200"><b>Username</b></td>
        <td class="td_head" width="200"><b>Password</b></td>
        <td class="td_head" width="200"><b>Email</b></td>
        <td class="td_head" width="400"><b>Account Number</b></td>
        <td class="td_head" width="200"><b>Phone</b></td>
        <td class="td_head" width="400"><b>Balance</b></td>
        <td class="td_head" width="200"><b>Registration Date</b></td>
        <td class="td_head" width="200"><b>Action</b></td>
        </tr>';


while($row = $db->return_sth()->fetch()){
	
		echo '<tr>
        <td class="item_ad"><b>' .$row['f_name']. '</b></td>
        <td class="item_ad"><b>' .$row['l_name']. '</b></td>
        <td class="item_ad"><b>' .$row['username']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['password']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['email']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['account_no']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['phone_no']. '</b></td>
        <td class="item_ad" width="250"><b> 0.00 </b></td>
        <td class="item_ad" width="250"><b>' .$row['date']. '</b></td>
        <td class="item_ad" width="250"><b> <a href="../view-user/?ref='.$row['user_code'].'"> <button class="btn btn-success"> View</button></a> </b></td>
		</tr>';
	
	
}
echo'</table> </div> <br>';
}//end if email

?> 


<?php
if($_GET['rq'] == "blocked_trans"){

//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "account_info u";
		 $data = array("block");
		 $query_fields = array("field_names"=>array("count(info_id) as total_user"), "where"=>array("u.status ="), "data"=>$data);
		
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_user = $dbhandle->return_sth()->fetch();
	 $num = $ttl_user['total_user'];
	 
	  $db = new Db_conn();//instantiate database class
	$table_name = "account_info";
	$data = array("block");
		$select_fields = array("field_names"=>array("*"), "where"=>array("status ="), "data"=>$data, "limit"=>100);
		
		$db->select_data($table_name, $select_fields );//call select method
	
		echo '<center> <h3 class="headline_w"><b>'. $num .'</b> Blocked Transfer</h3> </center>
		<div class="table-responsive">
        <table class="table" border="0" width="100%" style="width:1100px;"><tbody><tr>
		<td class="td_head" width="200"><b>First Name</b></td>
		<td class="td_head" width="200"><b>Last Name</b></td>
        <td class="td_head" width="200"><b>Username</b></td>
        <td class="td_head" width="200"><b>Password</b></td>
        <td class="td_head" width="200"><b>Email</b></td>
        <td class="td_head" width="400"><b>Account Number</b></td>
        <td class="td_head" width="200"><b>Phone</b></td>
        <td class="td_head" width="400"><b>Balance</b></td>
        <td class="td_head" width="200"><b>Registration Date</b></td>
        <td class="td_head" width="200"><b>Action</b></td>
        </tr>';


while($row = $db->return_sth()->fetch()){
	     //get user details
	$get_u = get_user($row['username']);
	
		echo '<tr>
        <td class="item_ad"><b>' .$get_u['f_name']. '</b></td>
        <td class="item_ad"><b>' .$get_u['l_name']. '</b></td>
        <td class="item_ad"><b>' .$row['username']. '</b></td>
        <td class="item_ad" width="200"><b>' .$get_u['password']. '</b></td>
        <td class="item_ad" width="200"><b>' .$get_u['email']. '</b></td>
        <td class="item_ad" width="250"><b>' .$get_u['account_no']. '</b></td>
        <td class="item_ad" width="250"><b>' .$get_u['phone_no']. '</b></td>
        <td class="item_ad" width="250"><b>$ ' .$row['account_bal']. ' </b></td>
        <td class="item_ad" width="250"><b>' .$get_u['date']. '</b></td>
        <td class="item_ad" width="250"><b> <a href="../view-user/?ref='.$get_u['user_code'].'"> <button class="btn btn-success"> View</button></a> </b></td>
		</tr>';
	
	
}
echo'</table> </div> <br>';
}//end if bannded

?> 


<?php
footer("../../");
?>