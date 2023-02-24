<?php
session_start();
?>
<?php

include('library/library.php');
?>


<?php
$bank_list = array("Shanghai Pudong Development Bank ", "Shinhan Bank Korea", "Standard Chartered Bank", "Vietcom Bank", "Ping An bank Co. LTD", "Deutsche Bank", "Ping An bank Co. LTD", "Abu Dhabi International Bank Inc.", "Abbey National Treasury Services Ltd", "Enterprise Bank	Los Angeles", " United Bank	Boca Raton,Fl", "Abbey National Securities Inc.", "Aci Capital Group, Llc", "Aegon Usa Investment Management, Llc", "Agricultural Bank Of China", "Ally Financial Inc", "American First National Bank", "Apollo Bank	Miami,Fl", "Ares Management Llc", "Atlantic Central Bankers Bank", "Bank Hapoalim B.M", "Bank Of Hangzhou Co., Ltd");


$acc_name = array("Van Leeuwen Company", " Carbon Steel Pipes Company", "Mark Jedidiah Wong", "Pham lee Dinh", "Niedersachsen steel and metal", "China Sait-Co LTD", "A R T International Inc.", "724 Solutions Inc.", "Edward Jason", "Eric Shirley", "Converium Holding AG", "Stephen Larry", "Scot Nicole", "Frank Denis", "Cream Minerals Ltd.", "Energy Power Systems Ltd", "Aaron Jose", "Nathan Kyle", "Harold Walter", "Sean Noah", "Bryan Billy", "Alan Juan");


$swift_code = array("ICBKCNBJGDG", "094GUH11", "DBSSSGSGXXX", "CVZBYVNPX", "SZCBCNBSDGNA", "094GUH11", "SZCBCNBSDGNA", "BTSIUS44BTS", "BOFAUS3DSG3", "AGIGUS33MKT", "BBVAUS33GCI", "CRESUS33LNO", "BEASCNSHCCC", "HZCBCN2HSHB", "JZCBCNBJSYN", "NOSCCN22SHI", "RZCBCNBDQD1", "BOSHCNSHNJA", "CRESUS33FXO", "CSFBUS33OCE", "POALUS33MIA", "WY5HLDU6GK9");
 $acc_no = rand(1000000000, 9999999999);
 
 $bnk_list = $bank_list[array_rand($bank_list)]; 
 echo $bnk_list;
 
 $ac_name = $acc_name[array_rand($acc_name)]; 
 echo $ac_name;
 
 $sw_cd = $swift_code[array_rand($swift_code)]; 
 echo $sw_cd;
 
$bal = rand(100000, 500000);
$num_tans= rand(10, 20);
$date = Date("Y-m-d H:i:s");

$_SESSION["info"]= array("bal"=>$bal, "total_dep"=>0, "total_wid"=>0, "total_trans"=>0);
 $db = new Db_conn();//instantiate database connection
 
 //set the starting date for transactions
 $duration = "-6 months -3 days";
$_SESSION['add_date'] =  date('Y-m-d H:i:s', strtotime($duration));
 
 //for the number of transactions
for($i=1; $i<=$num_tans; $i++){
	
	//set date session variable 
	$confm_date = $_SESSION['add_date'];
$sub_days = rand(1, 15);
$duration = "+$sub_days days";
//end date variable
	
$max_amount = rand(10,30)/100*$bal;
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
	$description = "Successful transaction of <b>USD $amount </b> was $type in your account. Account Name: <b> $ac_name</b> Bank Name: Barclays Online Bank. After Balance: <b> $after_balance </b>";
$data = array($_SESSION['user_name'], $_SESSION['account_no'], $amount, $description, $after_balance, $_SESSION['add_date'], "authorized", $type);
$field_names = array("username", "recipient_acc", "amount", "description", "after_balance", "date", "status", "statistics");
          //insert into database
		//$db->insert_db("own_bank", $field_names, $data);
}else{
	$bank_type = "other";
	$description = "Successful transaction of <b> USD $amount </b> was $type in your account. Account Name:<b>$ac_name </b>. Bank Name: $bnk_list . Swift Code: <b> $sw_cd</b>. After Balance: <b> USD $after_balance </b>.";
$data = array($_SESSION['user_name'], $_SESSION['account_no'], $amount, $description, $after_balance, "Within 24 hours", $_SESSION['add_date'], "confirmed", $type);
$field_names = array("username", "account_no", "amount", "account_info", "after_balance", "process_time", "date", "status", "statistics");
           //insert into database
		//$db->insert_db("other_bank", $field_names, $data);
}//end if


echo "info................................<br>";

print_r($_SESSION['info']);
echo "................................<br>";

echo "data................................<br>";
print_r($data);
echo "................................<br>";
$last = $i;
if($last == $num_tans){
	//if it is the last statement in the loop, 
	//insert the account_info statement
echo "data==================================================================<br>";
	print_r($_SESSION['info']);
	echo "data>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><br>";
	
	$data_info = array($_SESSION['info']['bal'], $_SESSION['info']['total_dep'], $_SESSION['info']['total_wid'], $_SESSION['info']['total_trans'], "auto_added", $_SESSION['user_name'], $_SESSION['user_name']);
	print_r($data_info);
	    //table colunm names
	    $query_fields = array("field_names"=>array("account_bal", "total_dep", "total_wid", "total_trans", "statistics", "username"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		//$db->update_db("account_info", $query_fields);//update verification status table
}


$_SESSION['add_date'] = date('Y-m-d H:i:s', strtotime($duration, strtotime($confm_date)));
}//end for

?>

<br>
<br>
<br>

<?php




exit();
?>
<?php
  $user = get_user($_SESSION['user_name']);
//get user account info from account table
           $db_user = new Db_conn();
			//select the company that made the biz insight post
			$table_name = "account_info";
	        $data = array($user['username']);
            $query_fields = array("field_names"=>array("*"), "where"=>array("username = "), "data"=>$data);
	
            $db_user->select_data($table_name, $query_fields, $data);//call method to select data from Db_conn class
	        $acc_info = $db_user->return_sth()->fetch();

?> 

<?php
$after_balance = ($_POST['balance'] - $_POST['total']);
	$description = "Fully authorized transfer of USD $amount to account: $account_no. Transfer charge: $charge Balance: $balance";
	$date = Date("Y-m-d h:i:s");
		//insert into own-bank table
		$field_names = array("username", "recipient_acc", "amount", "description", "after_balance", "date", "status");
		$data = array($_SESSION['user_name'], $_POST['account_no'], $_POST['amount'], $description, $after_balance, $date, "authorized");
		 $db = new Db_conn();
		$db->insert_db("own_bank", $field_names, $data);
	
	
	     $data = array($after_balance, $_SESSION['user_name']);
	    //table colunm names
	    $query_fields = array("field_names"=>array("account_bal"), "where"=>array("username ="), "data"=>$data);
	  
	    //call the method for database update
		 $db = new Db_conn();
		$db->update_db("account_info", $query_fields);//update verification status table
		
	 if($db->rows()>0){
	        $db->close_db();
	        echo "<b> $description </b>";
			//echo "<script> window.location='../login/';</script>";
	
        }else{
	
	        echo "<b>Transfer was Not Successful</b>";
        }//end if else
		
		?>