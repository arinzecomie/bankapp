<?php
session_start();
include('../../library/library.php');
?>
<?php

if(!isset($_SESSION['admin_username']) ||
  $_SESSION['admin_username']=="") {
header("location:../../admin");
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
if(isset($_POST['admin_delete'])){
	$staff_id = $_POST['staff_id'];
	   $data = array($staff_id);
	   $table_name = "staff";
	    //table colunm names
	    $query_fields = array("where"=>array("staff_id ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		 $db->delete_db($table_name, $query_fields);//delete data from table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<script> alert(' Admin deleted successfully'); </script>";
			echo "<script> window.location='../view-staff/';</script>";
	
        }else{
	
	        echo "<b>Admin delete was not successful</b>";
        }//end if else
	
	
}//end if isset
?>

	<?php
if(isset($_POST['submit_block'])){
	$staff_id = $_POST['staff_id'];
	$status = $_POST['status'];
	
	if($status == "block"){
		$status_main = "active";
		$msg = "User account was activated successfully";
		 
	}
	if($status == "active"){
		$status_main = "block";
		 $msg = "User account was blocked successfully";
	}
	
	
	
	
	     $data = array($status_main, $staff_id);
	    //table colunm names
	    $query_fields = array("field_names"=>array("access_rank"), "where"=>array("staff_id ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("staff", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<script> alert(' $msg '); </script>";
			echo "<script> window.location='../view-staff/';</script>";
	
        }else{
	
	        echo "<b>Admin $status was not successful</b>";
        }//end if else
	
}//end if isset
?>
	
	
	<?php
if(isset($_POST['submit_staff_edit'])){
	$staff_id = $_POST['user_id'];
	$staff_passw = $_POST['passw'];
	$confirm_passw = $_POST['confirm_passw'];
	$img_passport = basename( $_FILES[ "fileToUpload" ][ "name" ]);
	unset($_POST['submit_staff_edit']);
	unset($_POST['user_id']);
	unset($_POST['confirm_passw']);
	$form_data = $_POST;
	
	if ($staff_passw !== $confirm_passw){ 
		    die("Your password did not match");
		}
		
		//upload image
		$t_dr="../passport/";
$t_file= $t_dr. basename($_FILES["fileToUpload"] ["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($t_file,PATHINFO_EXTENSION);

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 ) {
echo "Sorry, your file
was not uploaded." ;
// if everything is ok, try to upload file
} else {
if (copy ( $_FILES ["fileToUpload" ]
[ "tmp_name" ],
$t_file)) {
$success = "The file " .
basename( $_FILES
[ "fileToUpload" ][ "name" ]).
" has been uploaded." ;
} else {
$success = "Sorry, there
was an error uploading your
file." ;
}
}

        $validate = new Validation();
		$validate->validate_data($form_data);
		if($validate->return_passed() == true ){
			$db = new Db_conn();
			$validate->add_valid_data($img_passport);//data to update status to 1
			$validate->add_valid_data($staff_id);//add staff_id for where clause
		    $data = $validate->return_valid_data();
			$table_name = "staff";
			$query_fields = array("field_names"=>array("surname", "first_name", "gender", "staff_passw", "passport"), "where"=>array("staff_id ="), "data"=>$validate->return_valid_data() );
		    $db->update_db($table_name, $query_fields);
			if($db->rows() > 0){
				$_SESSION['passport'] = $img_passport;
				echo "<script> 
				alert('Staff Account Upadted Successfully!'); 
				    window.location='../view-staff/';
				</script>";
				
			}else{
				echo "Update was not Successful!";
			}
		}else{
			echo "Error!";
		}
	
}//end if $submit_staff_edit
	
	
	if(isset($_GET['ref'])){
	$staff_reg_id = $_GET['ref'];
	$data = array($staff_reg_id);
	$db = new Db_conn();//instantiate database class
	$table_name = "staff";
		$select_fields = array("field_names"=>array("*"), "where"=>array("staff_reg_id ="), "data"=>$data);
		
		$db->select_data($table_name, $select_fields );//call select method
		//$customer_rq = $db->rows();
		$get_staff = $db->return_sth()->fetch();
		
		if( $get_staff['access_rank'] !== "block"){
		$admin_status = "Block";
	}else{ $admin_status = "Activate"; }
	?>
	<div class="row">
<div class="col-sm-3 col-12">
<center>
<form method="post">
<input type="hidden" name="staff_id" value=" <?php echo $get_staff['staff_id']; ?> ">
<input type="hidden" name="status" value="<?php echo $get_staff['access_rank']; ?>">
<button name="submit_block" style="margin:3px;" class="btn btn-primary"> <?php echo $admin_status; ?> Admin </button>
</form>

<form method="post">
<input type="hidden" name="staff_id" value=" <?php echo $get_staff['staff_id']; ?> ">
<button name="admin_delete" style="margin:3px;" class="btn btn-primary"> Delete Admin </button>
</form>

</center>
</div>	
		
<div class="col-sm-6 col-12">
<div style="" class="text-center">
            <h3><b style="font-size:30px; color:#000066;"> Edit Admin Account </b></h3>
        </div>
<center>
<form  method="post" enctype="multipart/form-data">
<div style="border:1px solid #000066; margin:10px; border-radius:8px;">
  <caption class="text-center"><h5>update admin details</h5></caption>
<table  class="table table-borderless table-hover"> 
<tr>
  </tr> <tr>
<td>Surname: </td> <td><input class="form-control" type="text" name="surname" required="required" value=" <?php echo$get_staff['surname']; ?> "> </input></td>
</tr> 
<tr>
<td>First Name: </td> <td><input class="form-control" type="text" name="first_name" required="required" value=" <?php echo$get_staff['first_name']; ?> "> </input></td>
</tr>
<tr>
<td>Gender: </td> <td><input class="form-control" type="text" name="gender" required="required" value=" <?php echo$get_staff['gender']; ?> "> </input></td>
</tr>
 <tr>
<td>Select Image: </td> <td><input class="form-control" type="file" name="fileToUpload" required="required"></td>
</tr>

  <tr>
	<td> Password: </td> <td> <input class="form-control"  type="password" name="passw" required="required"> </input></td>
      </tr>
	  <tr>
	  <td> Confirm Password:</td> <td> <input class="form-control" type="password" name="confirm_passw" required="required"> </input></td>
				  </tr> 
				  <tr>  <input type="hidden" name="user_id" value=" <?php echo $get_staff['staff_id']; ?> "> </input>
	  <td colspan="2" align="center"> <input class="btn btn-primary" type="submit" value="Submit" name="submit_staff_edit"></input> </td> </tr>
  </table>
  </div>
  </form>
  </center>
   </div>
   </div>
  <?php	
}//end if isset
?>

<?php
$data = array(1);
if(isset($_SESSION['tl_staff'])){
	
	echo "<center><h3>". $_SESSION['tl_staff']; 
	echo "</h3></center>";
}else{
//fetch the number of users
		 $dbhandle = new Db_conn();
		 $table_name = "staff u";
		 $query_fields = array("field_names"=>array("count(staff_id) as total_user"), "where"=>array("u.staff_id >"), "data"=>$data);
		
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_user = $dbhandle->return_sth()->fetch();
	 $num = $ttl_user['total_user'];

$_SESSION['tl_staff'] = $num;
}
//UNSET($_SESSION['tl_staff']);

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
	$table_name = "staff";
		$select_fields = array("field_names"=>array("*"), "where"=>array("staff_id >"), "data"=>$data, "limit"=>50);
		
		$db->select_data($table_name, $select_fields );//call select method
		//$customer_rq = $db->rows();

	
		echo '<center> <h3 class="headline_w">'. $num .'Total Admin</h3> </center>
		<table class="table" border="0" width="100%" style="width:1100px;"><tbody><tr>
		<td class="td_head" width="200"><b>First Name</b></td>
		<td class="td_head" width="200"><b>Surname</b></td>
        <td class="td_head" width="200"><b>Username</b></td>
        <td class="td_head" width="200"><b>Password</b></td>
        <td class="td_head" width="200"><b>Designation</b></td>
        <td class="td_head" width="200"><b>Status</b></td>
        <td class="td_head" width="200"><b>Registration Date</b></td>
        <td class="td_head" width="200"><b>Action</b></td>
        </tr>';


while($row = $db->return_sth()->fetch()){
	if( $row['access_rank'] !== "block"){
		$admin_status = "Active";
	}else{ $admin_status = "Blocked"; }
		echo '<tr>
        <td class="item_ad"><b>' .$row['first_name']. '</b></td>
        <td class="item_ad"><b>' .$row['surname']. '</b></td>
        <td class="item_ad"><b>' .$row['username']. '</b></td>
        <td class="item_ad" width="200"><b>' .$row['staff_passw']. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['designation']. '</b></td>
        <td class="item_ad" width="250"><b>' .$admin_status. '</b></td>
        <td class="item_ad" width="250"><b>' .$row['date']. '</b></td>
       <td class="item_ad" width="250"><b> <a href="../view-staff/?ref='.$row['staff_reg_id'].'"> <button class="btn btn-success"> View Admin</button></a> </b></td>
		</tr>';
	
	
	$_SESSION['next'] = $row['id'];
	$get_next = $row['id'];
}
echo'</table> <br>';
if($get_next > 50){
    //print "&nbsp&nbsp&nbsp <a href='../view-staff/?a_prev=$get_next'> <button>Prev</button> </a>";
}
if($get_next != $_SESSION['tl_staff']){
//print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='../view-staff/?a_nxt=$get_next'> <button>Next</button> </a>";
}


?> 


<?php
footer("../../");
?>