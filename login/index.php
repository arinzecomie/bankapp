<?php
session_start();

include('../library/library.php');

 if(isset($_POST['login_submit'])){
	 
    $submit_button = $_POST['submit_login'];
	unset($_POST['login_submit']);//remove submit button from array
    $validation = new Validation();//instantiate validation class
    $validation->validate_data($_POST, $submit_button);//validate_data and return as array
	
	if($validation->return_passed() == true ){
		
		//print_r($validation->return_valid_data());
		$table_name = "users";
		$query_fields = array("field_names"=>array("username", "bitcoin_w", "ref_link", "date" ), "where"=>array("username =", "AND password ="), "data"=>$validation->return_valid_data(), "limit"=>1);
		$check_user = new Select('localhost', 'bit_data', 'root', '');
		$check_user->select_data($table_name, $query_fields);
		
		if($check_user->return_sth()->rowCount() > 0 ){
			echo "<script>alert('yesss');</script>";
		    $row = $check_user->return_sth()->fetch();
			$_SESSION['bitcoin_w'] = $row['bitcoin_w'];
			$_SESSION['user_n'] = $row['username'];
			$_SESSION['ref_link'] = $row['ref_link'];
			$_SESSION['date'] = $row['date'];
			header("location:../account/?a_rqs=account");
			echo "<b> Valid User! </b>";
			
		}else{
		echo "<script> alert('Invalid Login! Try again'); </script>";
	}
		
	}else{
		print_r($validation->return_error());
	}

 }//end isset
  ?>


  <?php
  $title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
  $dir="../";
  menu($title, $meta_key, $meta_desc, $dir);
  ?>
  
  <div class="header_img" style="background-image:url(<?php echo $dir; ?>img/reg.jpg);">
	<div class="text-center" style="background:rgba(0,0,0,0.5); top:50%; padding:20px; line-height:50px; height:100%;">
	<h3 style="color:#ff4000; font-size:40px;"><b>
	<?php
			if(isset($_GET['user'])){
				echo "Account Verification!";
			}else{
	echo "Login to Dashboard!";
			}//end else
				?>
	</b></h3> <h3><span style="color:#fff;">  Experience financial stability </span></h3>
	</div>
	</div>
  
    <!-- breadcumb-area start -->
    <div class="breadcumb-area flex-style  black-opacity">
        <div class="container" style="padding:0px;">
				
				<div class="contact-page-area" style="margin-top:10px; color:#fff;">
        <div class="container">
            <div class="row">
			<?php
			if(isset($_GET['user'])){
				$username = $_GET['user'];
			?>
			<div class="col-lg-8 offset-lg-2 col-12" style="padding:0px;">
                    <div class="contact-form"  style="background-color:#000066;">
					<center>
					<img style="width:100px;" src="../img/icon/login.png">
                        <h3 style="color:#eaeaea;"> <span>User Verification </span>  </h3>
						<div  style="padding:5px; border:1px solid grey; border-radius:8px; width:auto; margin:10px;">
						<h5 style="color:#ff4000;"> Your account need verification </h5>
						<span> A verification code was sent to your email </span>
						</div>
						</center>
						<br>
                        <form id="verify" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
                            <div class="row">
                                <div class="col-12">
                                    <span class="input_desc"><b> <i class="fa fa-check-square"></i> Enter Verification Code</b> </span><br>
<input class="input_main" id="verify_code" type="text" name="verify_code" required="required"/>
<input class="input_main" id="username" type="hidden" name="username" value="<?php echo $username; ?>" required="required"/>
                                </div>
								
                                <div class="col-12" style="padding:0px;">
								<div class="row">
								<div class="col-6 col-sm-6" style="padding:2px;">
                                    <button class="site-btn" onclick="ajax_sub('verify');" id="button" type="submit" name="verify_submit"> <i class="fa fa-check-square-o"></i>  Verify</button>
									</div>
									 </form>
									 
									<div class="col-6 col-sm-6" style="padding:2px;">
									<form id="resend" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
									<input class="input_main" id="verify_code" type="hidden" name="resend_code" required="required"/>
									<i>Did'nt Get it?</i>  
									<button class="btn btn-link" onclick="ajax_sub('resend');" style="color:red;">Resend Code</button>
									</form>
									</div>
									</div>
                                </div>
                            </div>
                       
                    </div>
                </div>
			
			<?php
			}else{
			?>
                <div class="col-lg-8 offset-lg-2" style="padding:0px;">
                    <div class="contact-form" style="background-color:#000066;">
                       <center> 
					   <img style="width:100px;" src="../img/icon/user.png">
					   <h3 style="color:#aeaeae;"><span>User Login </span>  </h3></center>
                        <form id="login" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
                            <div class="row">
                                <div class="col-12">
                                    <span class="input_desc">  <i class="fa fa-user-circle"> </i> Username</span><br>
<input class="input_main" id="username" type="text" name="username" required="required"/>
                                </div>
                                <div class="col-12">
<span class="input_desc"> <i class="fa fa-unlock-alt"> </i> Password</span><br>
<input class="input_main" id="password" type="password" name="password" required="required"/>
<input  id="password" type="hidden" name="login_submit" required="required"/>
                                </div>
                                <div class="col-12" style="padding:0px;">
								<div class="row">
								<div class="col-6 col-sm-6" style="padding:2px;">
                                    <button class="site-btn" onclick="ajax_sub('login');" id="button" type="submit" name="login_submit" style="font-size:14px;"><i class="fa fa-sign-in"></i> Login</button>
									</div>
									<div class="col-6 col-sm-6" style="padding:2px;">
									<i>New User?</i>  <a href="../sign-up/" style="color:red;">Sign up</a>
									</div>
									</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
				<?php
			}//end isset
				?>
				
                
				
				
            </div>
        </div>
    </div>
        </div>
    </div>
    <!-- breadcumb-area end -->

<?php
footer("../");
?>