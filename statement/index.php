<?php
session_start();
if(!isset($_SESSION['user_code']) ||
  $_SESSION['user_code']=="") {
header("location:../");
}

include('../library/library.php');
?>

<?php
  $title="Bitcoin Investment Platform";
  $meta_desc="Grow your bitcoin with the world largest bitcoin investment platform";
  $meta_key="Bitcoin, Crypto, Investment";
  $dir="../";
  main_menu($title, $meta_key, $meta_desc, $dir, "Account Statement");
  ?>
  <style>
  th{
	  font-size:14px;
  }
  td{
	  font-size:14px;
  }
  </style>
  
  <?php
  
  $db = new Db_conn();
    $table_name = "own_bank";
	$data = array($_SESSION['user_name'], $_SESSION['account_no']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = ", "OR recipient_acc ="), "data"=>$data);
	
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
		while($statement1 = $db->return_sth()->fetch()){
			$date = $statement1['date'];
			$amount = $statement1['amount'];
			$description = $statement1['description'];
			$after_balance = $statement1['after_balance'];
		$own_stmt .="
		<tr> 
		<td> $date </td>
		<td>$ $amount .00</td>
		<td> $description </td>
		<td>$ $after_balance .00</td>
		</tr>
		";
		
		}//end while
	}else{
		$feed_back = " No Data Available";
	}//end if status
   ?>


   <?php  
  $db = new Db_conn();
    $table_name = "other_bank";
	$data = array($_SESSION['user_name']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = "), "data"=>$data);
	
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	
	if($check_status > 0){
		while($statement1 = $db->return_sth()->fetch()){
			$date = $statement1['date'];
			$amount = $statement1['amount'];
			$description = $statement1['account_info'];
			$after_balance = $statement1['after_balance'];
			$after_balance = $statement1['after_balance'];
			$process_time = $statement1['process_time'];
			$status = $statement1['status'];
		$other_stmt .="
		<tr> 
		<td> $date </td>
		<td>$ $amount .00 </td>
		<td>$ $after_balance .00</td>
		<td> $description </td>
		<td> $process_time </td>
		<td> $status</td>
		</tr>
		";
		
		}//end while
	}else{
		$feed_back = " No Data Available";
	}//end if status
   ?>
   
   <div class="header-title-breadcrumb element-box-shadow">
              <div class="container">
                  <div class="row">
                      <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                        <h3>Account Statement</h3>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-12 hide-on-tablet">
                          <ol class="breadcrumb text-right">
                            <li><a href="../">Home</a></li> 
                            <li class="active">Account Statement</li>
                          </ol>  
					  
                      </div>
                  </div>
              </div>
            </div>
            <div class="spacer_80"></div>
            <p style="color:red"></p>
            <p style="color:blue"></p>
  
		<div class="container">
<div class="row">
<div id="own_btn" onclick="show_statement('own_b', 'own_btn');" class="col-lg-6  col-sm-6 col-xs-6" style="background-color:lightblue; padding:0px; cursor:pointer; border:1px solid #000066;">
<div style="padding:20px; font-weight:bold;" class="text-center">
<h4 id="h4_own" class="h4_white" style="color:#fff;">OWN BANK</h4>
</div>
</div>
<div id="other_btn" onclick="show_statement('other_b', 'other_btn');"  class="col-lg-6  col-sm-6 col-xs-6" style="padding:0px; cursor:pointer; border:1px solid #000066;">
<div style="padding:20px; font-weight:bold;" class="text-center">
<h4 id="h4_other" class="h4_black">OTHER BANK </h4>
</div>
</div>

<div id="own_b" style="width:100%;">
<div class="col-lg-12  col-sm-12 col-xs-12" style="border-radius:10px; padding:0px; overflow:scroll;">
<div style="padding:20px; color:#fff; font-weight:bold;" class="text-center">
<table class="table table-striped no-margin">
<thead>
<tr style="color:#003; background:lightblue;">
<th> DATE </th>
<th> AMOUNT </th>
<th style="min-width:200px;"> DESCRIPTION </th>
<th> AFTER BALANCE </th>
</tr>
</thead>
<?php  echo $own_stmt; ?>
</table>
<?php  echo $feed_back ?>
</div>
<div style="background-color:#eaeaea; padding:5px;">

</div>
</div>
</div>

<div id="other_b" style="display:none; width:100%;">
<div class="col-lg-12  col-sm-12 col-xs-12" style="border-radius:10px; padding:0px; overflow:scroll;">
<div style="padding:20px; color:#fff; font-weight:bold;" class="text-center">
<table class="table table-striped no-margin">
<thead>
<tr style="color:#003; background:lightblue;">
<th> DATE </th>
<th> AMOUNT </th>
<th> AFTER BALANCE </th>
<th style="min-width:200px;"> ACCOUNT INFO </th>
<th> PROCESSING TIME </th>
<th> STATUS </th>
</tr>
</thead>
<?php echo $other_stmt; ?>

</table>
 <?php echo $feed_back; ?>
</div>
<div style="background-color:#eaeaea; padding:5px;">

</div>
</div>
</div>

</div>
</div>
		




<?php
  footer1("../");
  ?>