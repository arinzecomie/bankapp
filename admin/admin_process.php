<?php
session_start();
?>
<?php
if(!isset($_SESSION['admin_username']) || $_SESSION['admin_username']=="") {
header("location:admin_login.php");
exit();
}

$staff_name = $_SESSION['surname']." ".$_SESSION['f_name'];
$staff_username = $_SESSION['admin_username'];
include("../library/library.php");
?>

<?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
menu("$title", "$meta_key", "$meta_desc", "../")
?>
 <div style="margin-top:50px;">
 </div>
<center> <p id="message"></p>
</center>

 <!-- Bootstrap Core CSS -->
    <link href="../bootstrap.min.css" rel="stylesheet">
    <link href="../grand_custom.css" rel="stylesheet">
	
<?php

if(isset($_POST['generate_staff']) && $_POST['generate_code'] == "staff_code"){
	
	$desig = $_POST['designation'];
	$staff_code = "ADM".rand(1000, 9999).Date("s");
	$status = 0;
	$date = Date("m-d-Y h:ma");
	
	if($desig == "select_position"){
		
		die("<b>Please select admin position</b>");
		
	}
	
	if($desig == "Super_admin"){
		$db = new Db_conn();
	$table_name = "staff";
	$query_fields = array("field_names"=>array("designation", "status"), "where"=>array("designation = "), "data"=>array($desig) );
	$db->select_data($table_name, $query_fields);
	$staff_r = $db->return_sth()->fetch();
	if($db->rows() > 0){
		
		die("<b>Super_admin has been registered! It can only be once <br> Please select another designation</b>");
		
	}
	}//if desig
	
	$db = new Db_conn();
	$table_name= "staff";
	$field_names = array("designation", "staff_reg_id", "status", "date");
	$data = array($desig, $staff_code, $status, $date);
	
	$db->insert_db($table_name, $field_names, $data);//call method to insert data into the database from Db_conn() class
	if($db->rows() > 0){
		
		//add to log
				$field_names = array("customer_code", "staff_username", "staff_name", "activity", "date", "time");
		         $data = array($staff_code, $staff_username, $staff_name, "Generated_staff_code_for_registration(".$desig.")");
		
		echo"
		<center>
		<div style='min-width:300px; border:1px solid lightgrey; margin:10px; border-radius:10px;'>
		 	<h4 style='color:#000066; margin:10px;'>
		Admin code generated successfully!
		</h4>
		<hr>
		<table>
		<tr>
		<td>
		<b> Admin Code:</b></td> <td> $staff_code</td>
		</tr>
		<tr>
		<td>
		<b> Admin Position:</b></td> <td> $desig </td>
		</tr>
		<tr>
		<td>
		<b> Date generated:</b></td> <td> $date</td>
		</tr>
		</table>
		<br>
		<h5 style='color:red; margin-bottom:10px;'> Save and give to the admin for registration</h5>
		 </center>
		</div>
		";
		
	}
	
}

	
?>

<?php
footer("../");
?>

