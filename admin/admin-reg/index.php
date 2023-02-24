<?php
session_start();
?>
<?php
include('../../library/library.php');
?>

<?php

if(isset($_POST['submit_staff_reg'])){
	$staff_id = $_POST['staff_reg_id'];
	$staff_passw = $_POST['passw'];
	$confirm_passw = $_POST['confirm_passw'];
	$img_passport = basename( $_FILES[ "fileToUpload" ][ "name" ]);
	unset($_POST['staff_reg_id']);
	unset($_POST['submit_staff_reg']);
	unset($_POST['confirm_passw']);
	$form_data = $_POST;
	$db = new Db_conn();
	$table_name = "staff";
	$query_fields = array("field_names"=>array("staff_reg_id", "status"), "where"=>array("staff_reg_id = "), "data"=>array($staff_id) );
	$db->select_data($table_name, $query_fields);
	$staff_r = $db->return_sth()->fetch();
	if($db->rows() < 1){
		
		die("<b> The Admin code is invalid! </b>");
	}else if( $staff_r['status'] == 1){
		
		die("<b> The Admin code has already been used! </b>");
		
	}else{
		
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
			$validate->add_valid_data(1);//data to update status to 1
			$validate->add_valid_data($img_passport);//data to update status to 1
			$validate->add_valid_data($staff_id);//add staff_id for where clause
		    $data = $validate->return_valid_data();
			$query_fields = array("field_names"=>array("surname", "first_name", "gender", "username",  "staff_passw", "status", "passport"), "where"=>array("staff_reg_id ="), "data"=>$validate->return_valid_data() );
		    $db->update_db($table_name, $query_fields);
			if($db->rows() > 0){
				
				echo "<script> 
				alert('Registration was successful!'); 
				    window.location='../../admin/';
				</script>";
				
			}
		}
		
	}
}

?>

<?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
menu("$title", "$meta_key", "$meta_desc", "../../")
?>
 <div style="margin-top:100px;">
 </div>
<center> <p id="message"></p>
</center>

<div style="margin-top:50px;" class="text-center">
            <h2><b style="font-size:40px; color:#000066;">Admin Registration</b></h2>
        </div>

<center>
<form  method="post" enctype="multipart/form-data">
<div class="col-sm-6 col-sm-offset-3">
<div style="border:1px solid #000066; margin:10px; border-radius:8px;">
  <caption class="text-center"><h5>Enter your details</h5></caption>
<table  class="table table-borderless table-hover"> 
<tr>
 <td> Admin Code: </td> <td> <input class="form-control" type="text" name="staff_reg_id" required="required"> </input></td>
  </tr> <tr>
<td>Surname: </td> <td><input class="form-control" type="text" name="surname" required="required"> </input></td>
</tr> 
<tr>
<td>First Name: </td> <td><input class="form-control" type="text" name="first_name" required="required"> </input></td>
</tr>
<tr>
<td>Gender: </td> <td><input class="form-control" type="text" name="gender" required="required"> </input></td>
</tr>
 <tr>
<td>Username: </td> <td><input class="form-control" type="text" name="username" required="required"> </input></td>
</tr>
 <tr>
<td>Select Image: </td> <td><input class="form-control" type="file" name="fileToUpload" required="required"></td>
</tr>
<!--
<tr>
<td>Form Class: </td> <td><input type="text" name="form_cl" required="required"> </input><td>
</tr>-->
  <tr>
	<td> Password: </td> <td> <input class="form-control"  type="password" name="passw" required="required"> </input></td>
      </tr>
	  <tr>
	  <td> Confirm Password:</td> <td> <input class="form-control" type="password" name="confirm_passw" required="required"> </input></td>
				  </tr> <tr> 
	  <td colspan="2" align="center"> <input class="btn btn-primary" type="submit" value="Submit" name="submit_staff_reg"></input> </td> </tr>
  </table>
  </div>
  </div>
  </form>
  </center>
  <?php
  footer("../");
  ?>