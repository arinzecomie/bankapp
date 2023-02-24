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
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "other_bank o";
		 $data = array("pending");
		 $query_fields = array("field_names"=>array("count(other_id) as total_other"), "where"=>array("o.status ="), "data"=>$data);
		
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_pending = $dbhandle->return_sth()->fetch();
	 $total_other = $ttl_pending['total_other'];
	 
	  $db = new Db_conn();//instantiate database class
	$table_name = "other_bank";
	$data = array("pending");
		$select_fields = array("field_names"=>array("*"), "where"=>array("status ="), "data"=>$data, "limit"=>100);
		
		$db->select_data($table_name, $select_fields );//call select method
	
		echo '<center> <h3 class="headline_w"><b>'. $total_other .'</b> Pending Transfer</h3> </center>
		<div class="table-responsive">
        <table class="table" border="0" width="100%" style="width:1100px;"><tbody><tr>
		<td class="td_head" width="200"><b>Username</b></td>
		<td class="td_head" width="200"><b>Account No</b></td>
        <td class="td_head" width="200"><b>Amount</b></td>
        <td class="td_head" width="200"><b>Balance</b></td>
        <td class="td_head" width="200"><b>Date</b></td>
        <td class="td_head" width="400"><b>status</b></td>
        <td class="td_head" width="200"><b>Action</b></td>
        <td class="td_head" width="200"><b>View User</b></td>
        </tr>';


while($row = $db->return_sth()->fetch()){
	$user = get_user($row['username']);
		echo '<tr>
        <td class="item_ad"><b>' .$row['username']. '</b></td>
        <td class="item_ad"><b>' .$row['account_no']. '</b></td>
        <td class="item_ad"><b>$' .$row['amount']. '</b></td>
        <td class="item_ad" width="200"><b>$' .$row['after_balance']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['date']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['status']. '</b></td>
		<td class="item_ad" width="250">
		<form id="confirm_trans" method="post" enctype="multipart/form-data" action="../../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="user" value="'.$user['username'].'">
 <input id="amount" class="modal_input" type="hidden" name="other_id" value="'.$row['other_id'].'">
 <input type="hidden" name="confirm_transfer">
<button onclick="ajax_sub(\'confirm_trans\');" class="btn btn-success">
 Confirm</button>
 </form> </td>
		
        <td class="item_ad" width="250"><b> <a href="../view-user/?ref='.$user['user_code'].'"> <button class="btn btn-success"> View</button></a> </b></td>
		</tr>';
	
	
}
echo'</table> </div> <br>';

?> 



<?php
footer("../../");
?>