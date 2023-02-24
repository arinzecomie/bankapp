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
$meta_desc = "We give the best banking experience for your financial growth";
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
if(isset($_POST['user_delete'])){
	$user_code = $_POST['user_code'];
	   $data = array($user_code);
	   $table_name = "users";
	    //table colunm names
	    $query_fields = array("where"=>array("user_code ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		 $db->delete_db($table_name, $query_fields);//delete data from table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<script> alert(' User deleted successfully'); </script>";
			echo "<script> window.location='../users/?rq=all';</script>";
	
        }else{
	
	        echo "<b>Admin delete was not successful</b>";
        }//end if else
	
	
}//end if isset
?>



<a href="../admin_panel.php"> Admin Dashboard </a>
<?php
$data = array(0);
if(isset($_SESSION['tl_rows'])){
	
	echo "<center><h3>". $_SESSION['tl_rows']; 
	echo "</h3></center>";
}else{
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "users u";
		 $query_fields = array("field_names"=>array("count(user_id) as total_user"), "where"=>array("u.user_id >"), "data"=>$data);
		
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_user = $dbhandle->return_sth()->fetch();
	 $num = $ttl_user['total_user'];

$_SESSION['tl_rows'] = $num;
}
//UNSET($_SESSION['tl_rows']);

if(isset($_GET)){
foreach($_GET as $key=>$value){
	
	if($key == "a_prev"){
		$order_by = "id ASC";
		$get_prev = $value;
		$get_next = $value;
		$data = array($get_next-10);
	}else{
		$order_by = "id ASC";
		$get_next = $value;
		$data = array($get_next);
		$get_prev = $value;
	}
}
}
/*
$table_name = "users";
$query_data = array("field_names"=>array("*"), "where"=>array("id >"), "data"=>$data, "limit"=>5 );
$select = new Select("localhost", "bit_data", "root", "");
$select->select_data($table_name, $query_data);
*/

    $db = new Db_conn();//instantiate database class
	$table_name = "users";
		$select_fields = array("field_names"=>array("*"), "where"=>array("user_id >"), "data"=>$data, "limit"=>5);
		
		$db->select_data($table_name, $select_fields );//call select method
		//$customer_rq = $db->rows();

	
		echo '<center> <h3 class="headline_w">Total Users</h3> </center>
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
        <td class="td_head" width="200"><b>Delete</b></td>
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
		
		<td class="item_ad" width="400"><form method="post">
<input type="hidden" name="user_code" value="'.$row['user_code'].'">
<button onclick="return confirm(\'Do you want to continue? \')" name="user_delete" style="margin:3px;" class="btn btn-danger"> Delete User </button>
</form></td>
		</tr>';
	
	
	$_SESSION['next'] = $row['user_id'];
	$get_next = $row['user_id'];
}
echo'</table> </div><br>';
if($get_next > 5){
    print "&nbsp&nbsp&nbsp <a href='../users/?a_prev=$get_next'> <button>Prev</button> </a>";
}
if($get_next != $_SESSION['tl_rows']){
print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='../users/?a_nxt=$get_next'> <button>Next</button> </a>";
}


?> 


<?php
footer("../../");
?>