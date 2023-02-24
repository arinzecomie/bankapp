<?php
session_start();
if(!isset($_SESSION['user_code']) ||
  $_SESSION['user_code']=="") {
header("location:../");
}

include('../library/library.php');
?>

<?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
  $dir="../";
  main_menu($title, $meta_key, $meta_desc, $dir, "Other Bank Transfer");
  ?>
  
  
  
  <div class="header-title-breadcrumb element-box-shadow">
              <div class="container">
                  <div class="row">
                      <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                        <h3>Transfer to Other Bank</h3>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-12 hide-on-tablet">
                          <ol class="breadcrumb text-right">
                            <li><a href="../">Home</a></li> 
                            <li class="active">Transfer to Other Bank</li>
                          </ol>  
					  
                      </div>
                  </div>
              </div>
            </div>
            <div class="spacer_80"></div>
            <p style="color:red"></p>
            <p style="color:blue"></p>
  
  
  <?php 
  //get user account info from account table
           $db_user = new Db_conn();
			//select the company that made the biz insight post
			$table_name = "account_info";
	        $data = array($_SESSION['user_name']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = "), "data"=>$data);
	
            $db_user->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $acc_info = $db_user->return_sth()->fetch();
			if($acc_info['status'] == "block"){
				
				?>
				
				<div style="margin-top:10px;"></div>
		<div class="container" style="padding:0px";>
<div class="row">
<div class="col-lg-6  col-md-6 col-sm-6 col-12 offset-lg-3 offset-md-3 offset-sm-3">
<div class="bg-danger" style="padding:20px; border-radius:8px; margin-bottom:10px;">
<center> <h3><b> <span class="fa fa-info-circle"> </span> Warning </b> </h3> </center>
<hr>
<h4>FUND TRANSFER HAS BEEN SUSPENDED ON THIS ACCOUNT </h4>
<P style="margin:10px; padding:10px;" class="text-warning">
<B>Multiple transactions has been carried out on this account from an unauthorized Internet Protocol Address (IP-Address) </B>
</P>
<hr>
<h5><b> Further funds transactions has been suspended for <?php echo $acc_info['time']; ?> days </b></h5>
<center> <a href="../dashboard/"> <button class="btn btn-link"><b style="color:blue;"> << Back </b></button></a> </center>
</div>
</div>
</div>
</div>
				<?php
			}else{
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
		
		
		<div style="margin-top:10px;"></div>
		<div class="container">
<div class="row">
<div class="col-lg-3  col-md-3 col-sm-2 col-xs-12">
</div>



<div class="col-md-12 col-lg-8">
<form id="trans_other_bank" method="post" enctype="multipart/form-data" action="../ajax_submit.php">


                  <!--Personal details-->
                  <div class="panel panel-cryptic element-box-shadow">
                    <div class="panel-heading padding_30">
                      <h3 class="no-margin"> <img style="width:80px;" src="../img/icon/transfer.png"> 
Transfer to Other Bank</h3>
                    </div>
                    <div class="panel-body padding_30">
                     
                        <fieldset>
                          <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Amount $</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="amount" style="color:#000 !important;"  required="required">
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Choose bank to transfer amount</label>
                            <div class="col-lg-12">
							 <select id="full_name" class="modal_input" type="text" name="bank" placeholder="Select bank">
  <option> Abbey National Treasury Services Ltd </option>
  <option> Abu Dhabi International Bank Inc. </option>
  <option> Aci Capital Group, Llc </option>
  <option> Aegon Usa Investment Management, Llc </option>
  <option> Agricultural Bank Of China </option>
  <option> American First National Bank </option>
  <option> Atlantic Central Bankers Bank </option>
  <option> Bank of America </option>
  <option> Bank Hapoalim B.M </option>
  <option>Bank Of Hangzhou Co., Ltd </option>
  <option> Chinese Bank </option>
  <option> Deutsche Bank </option>
  <option> Enterprise Bank	Los Angeles </option>
  <option> JP Morgan Bank </option>
  <option> Ping An bank Co. LTD </option>
  <option> Ping An bank Co. LTD </option>
  <option> Shanghai Pudong Development Bank </option>
  <option> Shinhan Bank Korea </option>
  <option> Standard Chartered Bank </option>
  <option> United Bank	Boca Raton,Fl </option>
  <option> Vietcom Bank </option>
  <option> Stripe Bank </option>
  </select>
							</div>
							</div>
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Account Name</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="account_name" style="color:#000 !important;" required="required">
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Account Number</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="account_no" style="color:#000 !important;" required="required" maxlength="10" minlength="10" onblur="return check_no('acc_no');">
                            </div>
                          </div>
						  
						  <div id="acc_no_msg" style="color:red;">  </div>
  
  <script>
 function check_no(acc_no){ 


	var no = document.getElementById(acc_no).value;
	//alert(no); 
	
	if(no.length > 10){
		document.getElementById("acc_no_msg").innerHTML="The account number should not be more than 10";
		return false;
	}//end if
	
	if(no.length < 10){
		document.getElementById("acc_no_msg").innerHTML="The account number should be up to 10";
		return false;
	}//end if
	
	
	if(no.length == 10){
		document.getElementById("acc_no_msg").innerHTML="";
		return false;
	}//end if
	
	
}

</script>

                             <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Swift Code</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="swift_code" style="color:#000 !important;" required="required" maxlength="10" minlength="10" onblur="return check_no('acc_no');">
                            </div>
                          </div>
						  
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Country</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="country" style="color:#000 !important;" required="required" maxlength="10" minlength="10" onblur="return check_no('acc_no');">
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Email</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="email" style="color:#000 !important;" required="required" maxlength="10" minlength="10" onblur="return check_no('acc_no');">
                            </div>
                          </div>
						  
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Type Description</label>
                            <div class="col-lg-12">
                               <textarea class="form-control" name="details" required></textarea>
                            </div>
                          </div>
						
						  <input type="hidden" name="submit_trans_other">
                          <input onclick="ajax_sub('trans_other_bank');" type="submit" value="Transfer Balance" class="btn btn-cryptic button-element sweetalert31" name="submit_trans_other">
                          
                        </fieldset>
                      
                    </div><!-- END panel-body -->
                  </div><!-- END Personal details-->
				  
				 
                  
                  </form>
                </div>
		
		
		<!--<div style="margin-top:10px;"></div>
		<div class="container">
<div class="row">
<div class="col-lg-2  col-md-2 col-sm-1 col-xs-12">
</div>
<div class="col-lg-8  col-md-8 col-sm-10 col-xs-12 " style="background-color:#000066; border-radius:10px; padding:0px; margin-bottom:10px;">
<div style="padding:20px; color:#fff; font-weight:bold; font-size:20px;" class="text-center">
<img style="width:80px;" src="../img/icon/transfer.png"> 
Transfer to Other Bank
</div>
<div style="background-color:#eaeaea; padding:5px;">

<form id="trans_other_bank" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
<span class="input_title">Amount $</span>
  <input id="full_name" class="modal_input" type="number" name="amount" placeholder="Amount USD" required="required">
  <div id="fn_msg" style="color:red;">  </div>
  
  <span class="input_title">Choose bank to transfer amount </span>
  <select id="full_name" class="modal_input" type="text" name="bank" placeholder="Select bank">
  <option> Abbey National Treasury Services Ltd </option>
  <option> Abu Dhabi International Bank Inc. </option>
  <option> Aci Capital Group, Llc </option>
  <option> Aegon Usa Investment Management, Llc </option>
  <option> Agricultural Bank Of China </option>
  <option> American First National Bank </option>
  <option> Atlantic Central Bankers Bank </option>
  <option> Bank of America </option>
  <option> Bank Hapoalim B.M </option>
  <option>Bank Of Hangzhou Co., Ltd </option>
  <option> Chinese Bank </option>
  <option> Deutsche Bank </option>
  <option> Enterprise Bank	Los Angeles </option>
  <option> JP Morgan Bank </option>
  <option> Ping An bank Co. LTD </option>
  <option> Ping An bank Co. LTD </option>
  <option> Shanghai Pudong Development Bank </option>
  <option> Shinhan Bank Korea </option>
  <option> Standard Chartered Bank </option>
  <option> United Bank	Boca Raton,Fl </option>
  <option> Vietcom Bank </option>
  <option> Stripe Bank </option>
  </select>
  <div id="fn_msg" style="color:red;">  </div>

  <span class="input_title">Account Name</span>
  <input id="full_name" class="modal_input" type="text" name="accont_name" placeholder="Account Name" required="required">
  <div id="fn_msg" style="color:red;">  </div>

  <span class="input_title">Account  Number</span>
  <input id="acc_no" class="modal_input" type="text" name="account_no" placeholder="Account Number" required="required" maxlength="10" minlength="10" onblur="return check_no('acc_no');">
  <div id="acc_no_msg" style="color:red;">  </div>
  
  <script>
 function check_no(acc_no){ 


	var no = document.getElementById(acc_no).value;
	//alert(no); 
	
	if(no.length > 10){
		document.getElementById("acc_no_msg").innerHTML="The account number should not be more than 10";
		return false;
	}//end if
	
	if(no.length < 10){
		document.getElementById("acc_no_msg").innerHTML="The account number should be up to 10";
		return false;
	}//end if
	
	
	if(no.length == 10){
		document.getElementById("acc_no_msg").innerHTML="";
		return false;
	}//end if
	
	
}

</script>
  </script>
  
  <span class="input_title">Swift Code</span>
  <input id="full_name" class="modal_input" type="text" name="swift_code" placeholder="Swift Code" required="required">
  <div id="fn_msg" style="color:red;">  </div>

  <span class="input_title">Country</span>
  <input id="full_name" class="modal_input" type="text" name="country" placeholder="Country" required="required">
  <div id="fn_msg" style="color:red;">  </div>

  <span class="input_title">Email</span>
  <input id="full_name" class="modal_input" type="text" name="email" placeholder="Email" required="required">
  <div id="fn_msg" style="color:red;">  </div>
 <span class="input_title">Type Details</span>
 <textarea class="form-control" name="details" required></textarea>
  
 <center>
 <input type="hidden" name="submit_trans_other">
 <button onclick="ajax_sub('trans_other_bank');"  id="signup_user" class="site-btn" type="submit" name="submit_register">Transfer Balance</button> 
 </center>
 </form>

</div>
</div>
</div>
</div>-->
		
		<?php
	}
	}//end else
  
  ?>




<?php
  footer1("../");
  ?>