<?php
session_start();
if(!isset($_SESSION['user_code']) ||
  $_SESSION['user_code']=="") {
header("location:../");
}

include('../library/library.php');
?>

<?php 
  $user = get_user($_SESSION['user_name']);
  $_SESSION['f_name'] = $user['f_name'];
  $_SESSION['l_name'] = $user['l_name'];
 ?>
 
 
 <?php

//get user account info from account table
           $db_user = new Db_conn();
			//select the company that made the biz insight post
			$table_name = "account_info";
	        $data = array($user['username']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = "), "data"=>$data);
	
            $db_user->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $acc_info = $db_user->return_sth()->fetch();



//auto run transactions in the user account if its first time loggin

if($acc_info['statistics'] !== "auto_added"){

$bank_list = array("Shanghai Pudong Development Bank ", "Shinhan Bank Korea", "Standard Chartered Bank", "Vietcom Bank", "Ping An bank Co. LTD", "Deutsche Bank", "Ping An bank Co. LTD", "Abu Dhabi International Bank Inc.", "Abbey National Treasury Services Ltd", "Enterprise Bank	Los Angeles", " United Bank	Boca Raton,Fl", "Abbey National Securities Inc.", "Aci Capital Group, Llc", "Aegon Usa Investment Management, Llc", "Agricultural Bank Of China", "Ally Financial Inc", "American First National Bank", "Apollo Bank	Miami,Fl", "Ares Management Llc", "Atlantic Central Bankers Bank", "Bank Hapoalim B.M", "Bank Of Hangzhou Co., Ltd");


$acc_name = array("Van Leeuwen Company", " Carbon Steel Pipes Company", "Mark Jedidiah Wong", "Pham lee Dinh", "Niedersachsen steel and metal", "China Sait-Co LTD", "A R T International Inc.", "724 Solutions Inc.", "Edward Jason", "Eric Shirley", "Converium Holding AG", "Stephen Larry", "Scot Nicole", "Frank Denis", "Cream Minerals Ltd.", "Energy Power Systems Ltd", "Aaron Jose", "Nathan Kyle", "Harold Walter", "Sean Noah", "Bryan Billy", "Alan Juan");


$swift_code = array("ICBKCNBJGDG", "094GUH11", "DBSSSGSGXXX", "CVZBYVNPX", "SZCBCNBSDGNA", "094GUH11", "SZCBCNBSDGNA", "BTSIUS44BTS", "BOFAUS3DSG3", "AGIGUS33MKT", "BBVAUS33GCI", "CRESUS33LNO", "BEASCNSHCCC", "HZCBCN2HSHB", "JZCBCNBJSYN", "NOSCCN22SHI", "RZCBCNBDQD1", "BOSHCNSHNJA", "CRESUS33FXO", "CSFBUS33OCE", "POALUS33MIA", "WY5HLDU6GK9");
 
 $bnk_list = $bank_list[array_rand($bank_list)]; 
 
 $ac_name = $acc_name[array_rand($acc_name)]; 
 
 $sw_cd = $swift_code[array_rand($swift_code)]; 
	

$bal = rand(100000, 1000000);
$num_tans= rand(8, 20);
$date = Date("Y-m-d H:i:s");

$_SESSION["info"]= array("bal"=>$bal, "total_dep"=>0, "total_wid"=>0, "total_trans"=>0);
 $db = new Db_conn();//instantiate database connection
 
 //set the starting date for transactions
 $duration = "-6 months -3 days";
$_SESSION['add_date'] =  date('Y-m-d H:i:s', strtotime($duration));
 
 //for the number of transactions
for($i=1; $i<=$num_tans; $i++){
	 $acc_no = rand(1000000000, 9999999999);//for other bank transaction
	 
	//set date session variable 
	$confm_date = $_SESSION['add_date'];
$sub_days = rand(1, 15);
$duration = "+$sub_days days";
//end date variable
	
$max_amount = rand(10,25)/100*$bal;
$amount = rand(20000, $max_amount);

$tipe = rand(1, 20);
$tipe2 = rand(1, 20);
if($tipe % 2){
	$type = "debit";
	$after_balance = ($_SESSION["info"]["bal"] - $amount);
	$_SESSION["info"]= array("bal"=>$after_balance, "total_dep"=>$_SESSION["info"]["total_dep"]+0, "total_wid"=>$_SESSION["info"]["total_wid"]+$amount, "total_trans"=>$_SESSION["info"]["total_trans"]+1);
}else{
	$type = "credit";
	$after_balance = ($_SESSION["info"]["bal"] + $amount);
	$_SESSION["info"]= array("bal"=>$after_balance, "total_dep"=>$_SESSION["info"]["total_dep"]+$amount, "total_wid"=>$_SESSION["info"]["total_wid"]+0, "total_trans"=>$_SESSION["info"]["total_trans"]+1);
}//end if
	
	if($tipe2 % 2){
	$bank_type = "own";
	$description = "Successful transaction of <b>USD $amount </b> was ".$type."ed in your account. Account Name: <b> $ac_name</b>. Bank Name: Barclays Online Bank . After Balance: <b>USD $after_balance </b>.";
$data = array($_SESSION['user_name'], $_SESSION['account_no'], $amount, $description, $after_balance, $_SESSION['add_date'], "authorized", $type);
$field_names = array("username", "recipient_acc", "amount", "description", "after_balance", "date", "status", "statistics");
          //insert into database
		$db->insert_db("own_bank", $field_names, $data);
}else{
	$bank_type = "other";
	$description = "Successful transaction of <b> USD $amount </b> was ".$type."ed in your account.  Account Name:<b>$ac_name </b>. Bank Name: $bnk_list . Swift Code: <b> $sw_cd</b>. After Balance: <b> USD $after_balance </b>.";
$data = array($_SESSION['user_name'], $acc_no, $amount, $description, $after_balance, "Within 24 hours", $_SESSION['add_date'], "confirmed", $type);
$field_names = array("username", "account_no", "amount", "account_info", "after_balance", "process_time", "date", "status", "statistics");
           //insert into database
		$db->insert_db("other_bank", $field_names, $data);
}//end if

$last = $i;
if($last == $num_tans){
	//if it is the last statement in the loop, 
	//insert the account_info statement
	
	$data_info = array($_SESSION['info']['bal'], $_SESSION['info']['total_dep'], $_SESSION['info']['total_wid'], $_SESSION['info']['total_trans'], "auto_added", $_SESSION['user_name'], $_SESSION['user_name']);

	    //table colunm names
	    $query_fields = array("field_names"=>array("pending", "total_dep", "total_wid", "total_trans", "statistics", "username"), "where"=>array("username ="), "data"=>$data_info);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("account_info", $query_fields);//update verification status table
}


$_SESSION['add_date'] = date('Y-m-d H:i:s', strtotime($duration, strtotime($confm_date)));
}//end for
	echo "<script> window.location='../dashboard/'; </script>";	
}//statistics
?>
 
 

<?php
  $title="Barclays World Largest Online Bank";
  $meta_desc="Grow your finance with barclays";
  $meta_key="Banking, Loan, Investment";
  $dir="../";
  main_menu($title, $meta_key, $meta_desc, $dir, "Account Dashboard");
 
?> 
 <style>
 .name_user{
 font-size:18px;
 }
 @media(min-width:300px){
	.sm_h3{
		font-size:18px !important;
		
	}
	.name_user{
 ...
 }
 }
 </style>
 
 
 <div class="account_header" style="border-bottom:1px solid #eaeaea; background-color:#e6e6ff; padding-top:15px; padding-bottom:10px;">
	<div class="row">
	<div class="col-sm-4 col-4" style="padding:0px;"> 
	<?php 
	if(empty($_SESSION['passport'])){
		$btn_upload = "Select Image";
	?>
	<center>
	<div style="border-radius:50%; border:1px solid #000066; width:110px; overflow:hidden;">
	<img id="avatar"  style="width:100px;" src="<?php echo $dir; ?>img/icon/avatar.jpg">
	</div>
	</center>
	<?php
	}else{
		$btn_upload = "Change";
		?>
		<center>
		<div style="border-radius:50%; border:1px solid #000066; width:125px; overflow:hidden;">
		<img class="image-responsive" id="avatar" style="width:120px; height:120px;" src="<?php echo $dir; ?>passport/<?php echo $_SESSION['passport']; ?>">
		</div>
		</center>
	<?php	
	}
	?>
	<center>
	<div style="margin-top:-10px; display:inline-block;">
		  <form id="upload" method="post" enctype="multipart/form-data" action="<?php echo $dir; ?>ajax_submit.php">
		  <center>
		  <div style="text-align:center; background-color:#000066; color:#fff; padding:3px; cursor:pointer; border-radius:5px;" class="upload">
	<label style="cursor:pointer;" for="file-input">
	<center><?php echo $btn_upload; ?></center>
	</label>
		  <input style="display:none;" name="fileToUpload" type="file" id="file-input" onchange="readUrl(this);" class="form-control">
		  </div>
          </center>
          <center>
		  <img style="display:none;" id="show" src=""> 
		  <input name="attach_photo" type="hidden" value="">
		  <input name="design_name" id="design_name"  type="hidden" value="<?php echo $_SESSION['user_name']; ?>">
		  <div id="show_div" > 
		  <span id="show_status"> </span>
		  <button id="show_btn" style="display:none;" type="submit" onclick="ajax_attach_img();"> Upload Image </button>  <span id="attach"> </span>
		  </div>
		  </center><br>
		  
		  </form>
		  </div>
		  </center>
	
	</div>
	
	<div class="col-sm-8 col-8" style="padding:0px; padding-left:30px;">
	<div class="row">
	<div class="col-sm-6 col-xs-6">
<span style="color:#ff4000; font-weight:bold;">WELCOME</span>
<br>	
	<img style="width:50px;" src="<?php echo $dir; ?>img/icon/wlc_user.png">
	<br>
	 <span class="name_user" style="color:#000066;">  <?php echo ucfirst($_SESSION['f_name'])." ".$_SESSION['l_name']; ?> </span>
	<div style="padding-left:0px; padding-bottom:0px; margin-top:5px;">
	<i style="color:#ff4000;" class="fa fa-user-circle"></i>  <?php echo $_SESSION['user_name']; ?> 
	</div>
	</div>
	<div class="col-sm-6 col-xs-6">
	<img style="width:40px;" src="<?php echo $dir; ?>img/icon/statement.png"> 
<span style="color:#ff4000; font-weight:bold;">ACC. NO - </span> <span style="color:#000066;"> <b> <?php echo $_SESSION['account_no']; ?> </b> </span>
<div style="padding-left:0px; padding-bottom:0px; margin-top:5px;">
	<i style="color:#ff4000;" class="fa fa-envelope"></i>  <?php echo $_SESSION['email']; ?> 
	</div>

	</div>
	</div>
	</div>
		
	</div>
	</div>
	
  
  <div class="container">
	<div class="row" style="padding:10px;">
	
	
	<div class="col-xs-12 col-sm-6 col-lg-4 col-sm-offset-3 col-lg-offset-4" style="margin-top:10px;">
                <div class="panel panel-info element-box-shadow market-place">
                  <div class="panel-heading no-padding" style="padding-top:10px; border-radius:8px;">
                    <div class="div-market-place">
                      <h3> Account Balance </h3>
                      <h1>$ <?php echo $acc_info['account_bal']; ?></h1>
                      <h2>USD</h2>
					   <center><img style="width:100px;" src="../img/icon/balance-sheet.png"></center>
                      <!--<p class="text-bold text-white">Deposits
                          </p>-->
                    </div>
                  </div>
                </div>
              </div>
			  
	
	
	
	
	<!--<div class="col-sm-6 offset-sm-3 text-center"> 
	<div style="border:1px solid grey; margin:10px; padding-top:10px; border-radius:8px;"> 
	<img style="width:100px;" src="../img/icon/balance-sheet.png"> 
	<div style="background-color:#000066; padding:20px;" >
          <h4 style="color:#aeaeae;"> Account Balance </h4>
		  <h3 style="color:yellow;">$ <?php echo $acc_info['account_bal']; ?> </h3>
		  </div>
    </div></div>-->
	
  </div>
	</div>

	<div class="container" style="padding:0px;">
	<div class="row" style="padding:10px;">
	
	
	
	<div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-success element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Total Deposited </h3>
                      <h1>$ <?php echo $acc_info['total_dep']; ?> </h1>
                      <h2>USD</h2>
					  <center><img style="width:100px;" src="../img/icon/money.png"> </center>
                      <!--<p class="text-bold text-white">Earnings
                          </p>-->
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-danger element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Total Withdrawal</h3>
                      <h1>$ <?php echo $acc_info['total_wid']; ?> </h1>
                      <h2>USD</h2>
					  <center><img style="width:100px;" src="../img/icon/withdraw.png"> </center>
                      <!--<p class="text-bold text-white">Withdrawals
                          </p>-->
                    </div>
                  </div>
                </div>
              </div>
	
	
	
	<!--<div class="col-sm-5  offset-sm-1 col-6 text-center" style="padding:0px;"> 
	<a href="../statement/">
	<div style="border:1px solid grey; margin:10px; padding:10px; border-radius:10px 0px; background-color:#000;"> 
	<img style="width:100px;" src="../img/icon/money.png"> 
          <h4 style="color:#aeaeae;"> Total Deposited </h4>
		  <h3 class="sm_h3" style="color:yellow;">$  <?php echo $acc_info['total_dep']; ?> </h3>
    </div>
    </a>
	</div>
	
	<div class="col-sm-5 offset-sm-1 col-6 text-center" style="padding:0px;">
    <a href="../statement/">	
	<div style="border:1px solid grey; margin:10px; padding:10px; border-radius:10px 0px; background-color:#000;"> 
	<img style="width:100px;" src="../img/icon/withdraw.png"> 
          <h4 style="color:#aeaeae;"> Total Withdrawal </h4>
		  <h3 class="sm_h3" style="color:yellow;">$  <?php echo $acc_info['total_wid']; ?> </h3>
    </div>
    </a>
	</div>-->
	
  </div>
	</div>
	
	
	<div class="container" style="padding:0px; margin:0px; width:100%;">
	<div class="row" style="background-color:#eaeaea; margin:0px;">
	<div class="col-sm-4 text-center"> 
	<div style="border:1px solid #000066; margin:10px; padding:10px; border-radius:5px;">
	
	<img style="width:100px;" src="../img/icon/pending.png">
          <h4> Withdrawal Pending </h4>
		  <h3> <?php echo $acc_info['wid_pending']; ?> </h3>
    </div>
	</div>
	
	<div class="col-sm-4 text-center"> 
	<a href="../statement/">
	<div style="border:1px solid #000066; margin:10px; padding:10px; border-radius:5px;">
	
	<img style="width:100px;" src="../img/icon/other_pending.png">
          <h4> Pending Other Bank Transaction </h4>
		  <h3> 0 </h3>
    </div>
    </a>
	</div>
	
	<div class="col-sm-4 text-center"> 
	<a href="../statement/">
	<div style="border:1px solid #000066; margin:10px; padding:10px; border-radius:5px;"> 
	
	<img style="width:100px;" src="../img/icon/transaction.png"> 
          <h4> Total Transaction </h4>
		  <h3>  <?php echo $acc_info['total_trans']; ?> </h3>
    </div>
    </a>
	</div>
	
  </div>
	</div>
  
  
  
  <?php
  footer1("../");
  ?>