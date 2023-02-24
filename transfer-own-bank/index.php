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
  main_menu($title, $meta_key, $meta_desc, $dir, "Own Bank Transfer");
  ?>
  
  
  
  <div class="header-title-breadcrumb element-box-shadow">
              <div class="container">
                  <div class="row">
                      <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                        <h3>Transfer to Own Bank</h3>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-12 hide-on-tablet">
                          <ol class="breadcrumb text-right">
                            <li><a href="../">Home</a></li> 
                            <li class="active">Transfer to Own Bank</li>
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
  
 <?php 
  //get user account info from account table
           $db_user = new Db_conn();
			//select the company that made the biz insight post
			$table_name = "account_info";
	        $data = array($_SESSION['user_name']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = "), "data"=>$data);
	
            $db_user->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $acc_info = $db_user->return_sth()->fetch();
			//if user is blocked from transfer
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
		
		
		<div style="margin-top:10px;"></div>
		<div class="container">
<div class="row">
<div class="col-lg-3  col-md-3 col-sm-2 col-xs-12">
</div>



<div class="col-md-12 col-lg-8">
<form id="trans_own" method="post" enctype="multipart/form-data" action="../ajax_submit.php">


                  <!--Personal details-->
                  <div class="panel panel-cryptic element-box-shadow">
                    <div class="panel-heading padding_30">
                      <h3 class="no-margin"><img style="width:80px;" src="../img/icon/transfer.png"> 
Transfer to Own Bank</h3>
                    </div>
                    <div class="panel-body padding_30">
					<div style="margin:10px; border-radius:8px; border:1px solid grey; text-align:center; padding:10px;">Balance Transfer Charge 1.00 USD fixed and 1.50% of your total amount to transfer balance  </div>
                     
                        <fieldset>
                          <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Account No</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="account_no" style="color:#000 !important;">
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Amount $</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1"  type="text" name="new_password" style="color:#000 !important;">
                            </div>
                          </div>
						
						  <input type="hidden" name="submit_trans_own">
                          <input onclick="ajax_sub('trans_own');" type="submit" value="Transfer Balance" class="btn btn-cryptic button-element sweetalert31" name="submit_trans_own">
                          
                        </fieldset>
                      
                    </div><!-- END panel-body -->
                  </div><!-- END Personal details-->
				  
				 
                  
                  </form>
                </div>


  
<!--<div style="margin-top:10px;"></div>
		<div class="container">
<div class="row">
<div class="col-lg-3  col-md-3 col-sm-2 col-xs-12">
</div>
<div class="col-lg-6  col-md-6 col-sm-10 col-xs-12 " style="background-color:#000066; border-radius:10px; padding:0px; margin-bottom:10px;">
<div style="padding:20px; color:#fff; font-weight:bold; font-size:20px;" class="text-center">
<img style="width:80px;" src="../img/icon/transfer.png"> 
<b>Transfer to Own Bank</b>
</div>
<div style="background-color:#eaeaea; padding:5px;">

<div style="margin:10px; border-radius:8px; border:1px solid grey; text-align:center; padding:10px;">Balance Transfer Charge 1.00 USD fixed and 1.50% of your total amount to transfer balance  </div>

<form id="trans_own" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
<span class="input_title">Account Number </span>
  <input id="account_no" class="modal_input" type="text" name="account_no" placeholder="Enter Account Number" required="required">
  <div id="fn_msg" style="color:red;">  </div>
  
  <span class="input_title">Amount $</span>
  <input id="amount" class="modal_input" type="number" name="amount" placeholder="Enter Amount" required="required">
  <div id="fn_msg" style="color:red;">  </div>
 <center>
 <input type="hidden" name="submit_trans_own">
 <button onclick="ajax_sub('trans_own');"  id="signup_user" class="site-btn" type="submit" name="submit_register">Transfer Balance</button> 
 </center>
 </form>

</div>
</div>
</div>
</div>-->
<?php
			}//end else
			?>

<?php
  footer1("../");
  ?>