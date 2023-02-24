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
  main_menu($title, $meta_key, $meta_desc, $dir, "Edit User Account");
  ?>
  
  <?php
  
  $db = new Db_conn();
    $table_name = "users";
	$data = array($_SESSION['user_code']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("user_code = "), "data"=>$data);
	
    $db->select_data($table_name, $query_fields);//call method to select data from Db_conn class
	$check_status = $db->rows();
	$user = $db->return_sth()->fetch();
	
	if($check_status > 0){
		?>
		
		
		<div class="header-title-breadcrumb element-box-shadow">
              <div class="container">
                  <div class="row">
                      <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                        <h3>Edit Profile</h3>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-12 hide-on-tablet">
                          <ol class="breadcrumb text-right">
                            <li><a href="../">Home</a></li> 
                            <li class="active">Profile</li>
                          </ol>  
<?php if(isset($_SESSION["update"])){
	echo $_SESSION["update"];
	unset($_SESSION["update"]);
} ?>						  
                      </div>
                  </div>
              </div>
            </div>
            <div class="spacer_80"></div>
            <p style="color:red"></p>
            <p style="color:blue"></p>
			
			
		
		
		<div style="margin-top:10px;"></div>
		<div class="container">
<div class="row">
<div class="col-lg-3  col-md-3 col-sm-2 col-xs-12">
</div>



<div class="col-md-12 col-lg-8">
<form id="update" method="post" enctype="multipart/form-data" action="../ajax_submit.php">


                  <!--Personal details-->
                  <div class="panel panel-cryptic element-box-shadow">
                    <div class="panel-heading padding_30">
                      <h3 class="no-margin">Personal details</h3>
                    </div>
                    <div class="panel-body padding_30">
                     
                        <fieldset>
                          <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label"> Email</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="inputFirstName" placeholder="<?php echo $user['email']; ?>" type="text" disabled="disabled">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputLastName" class="col-lg-12 control-label">Username</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="inputLastName" placeholder="<?php echo $user['username']; ?>" type="text" disabled="disabled">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail" class="col-lg-12 control-label">Account No</label>
                            <div class="col-lg-12">
                                                            <input class="form-control input-type-1" id="inputEmail" placeholder="christomac12@gmail.com" type="text" name="email" value="<?php echo $user['account_no']; ?>" disabled="disabled">
                                                          </div>
                          </div>
                          <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">First name</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" placeholder="<?php echo $user_acc['f_name']; ?>" type="text" name="f_name" value="<?php echo $user['f_name']; ?>" style="color:#000 !important;">
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Last name</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" placeholder="<?php echo $user_acc['f_name']; ?>" type="text" name="l_name" value="<?php echo $user['l_name']; ?>" style="color:#000 !important;">
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Phone No</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" placeholder="<?php echo $user_acc['f_name']; ?>" type="text" name="phone_no" value="<?php echo $user['phone_no']; ?>" style="color:#000 !important;">
                            </div>
                          </div>
						  <input type="hidden" name="submit_update">
                          <input onclick="ajax_sub('update');"  type="submit" value="Update Profile" class="btn btn-cryptic button-element sweetalert31" name="submit_update">
                          
                        </fieldset>
                      
                    </div><!-- END panel-body -->
                  </div><!-- END Personal details-->
				  
				 
                  
                  </form>
                </div>



<!--<div class="col-lg-6  col-md-6 col-sm-10 col-xs-12 " style="background-color:#000066; border-radius:10px; padding:0px; margin-bottom:10px;">
<div style="padding:20px; color:#fff; font-weight:bold; font-size:20px;" class="text-center">Update Your Account</div>
<div style="background-color:#eaeaea; padding:5px;">
<form id="update" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
<span class="input_title">First Name </span>
  <input id="full_name" class="modal_input" type="text" name="f_name" Value="<?php echo $user['f_name']; ?>">
  <div id="fn_msg" style="color:red;">  </div>
  
  <span class="input_title">Last Name </span>
  <input id="full_name" class="modal_input" type="text" name="l_name" Value="<?php echo $user['l_name']; ?>">
  <div id="fn_msg" style="color:red;">  </div>
   <span class="input_title">Phone No</span>
  <input id="user_ph" class="modal_input" type="text" name="phone" Value="<?php echo $user['phone_no']; ?>">
 
  <span class="input_title">Email</span>
  <input id="user_email" class="modal_input" type="text" name="email" Value="<?php echo $user['email']; ?>" disabled="disabled">
  <span class="input_title">Username</span>
  <input id="user_email" class="modal_input" type="text" name="email" Value="<?php echo $user['username']; ?>" disabled="disabled">
  <span class="input_title">Account No</span>
  <input id="user_email" class="modal_input" type="text" name="email" Value="<?php echo $user['account_no']; ?>" disabled="disabled">
  <div id="email_message" style="color:red;">  </div>
  <center>
 <input type="hidden" name="submit_update">
 <button onclick="ajax_sub('update');"  id="signup_user" class="site-btn" type="submit" name="submit_register">Update</button> 
 </center>
 </form>

</div>
</div>-->


</div>
</div>
		
		<?php
	//print_r($user);
	}
  
  ?>




<?php
  footer1("../");
  ?>