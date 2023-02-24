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
  main_menu($title, $meta_key, $meta_desc, $dir, "E-Deposit");
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
                        <h3>Deposit Methods</h3>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-12 hide-on-tablet">
                          <ol class="breadcrumb text-right">
                            <li><a href="../">Home</a></li> 
                            <li class="active">Deposit Methods</li>
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
<div class="col-xs-12 col-sm-4 col-lg-4">
<div style="padding:20px; color:#000; font-weight:bold; background-color:lightblue; border-radius:10px 0px;" class="text-center">
<h4 class="text-dark">Paypal</h4>
</div>
<div style="background-color:#eaeaea; padding:5px;">
<img src="../img/icon/paypal.jpeg">
</div>

<div style="background-color:#eaeaea;">
<span style="margin:20px;">Unit </span> $1 - $1000
<hr style="margin:5px;">
<span style="margin:20px;">Charge</span> 1.5% + 0.5%
</div>

<form id="paypal" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="user" value="<?php echo $user['username']; ?>">
<input class="form-control" type="text" name="amount" placeholder="Enter Amount" required="required">
<input type="hidden" name="submit_paypal">
<button onclick="ajax_sub('paypal');" class="btn btn-primary form-control"> Deposit Now </button>
</form>

</div>

<div class="col-xs-12 col-sm-4 col-lg-4">
<div style="padding:20px; color:#000; font-weight:bold; background-color:lightblue; border-radius:10px 0px;" class="text-center">
<h4 class="text-dark">Credit Cards</h4>
</div>
<div style="background-color:#eaeaea; padding:5px;">
<img src="../img/icon/cards.jpeg">
</div>

<div style="background-color:#eaeaea;">
<span style="margin:20px;">Unit </span> $1 - $1000
<hr style="margin:5px;">
<span style="margin:20px;">Charge</span> 1.5% + 0.5%
</div>

<div class="text-center" style="padding:5px;">
<form id="credit_card" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="user" value="<?php echo $user['username']; ?>">
<input class="form-control" type="text" name="amount" placeholder="Enter Amount" required="required">
<input type="hidden" name="submit_credit_card">
<button onclick="ajax_sub('credit_card');" class="btn btn-primary form-control"> Deposit Now </button>
</form>
</div>

</div>

<div class="col-xs-12 col-sm-4 col-lg-4">
<div style="padding:20px; color:#000; font-weight:bold; background-color:lightblue; border-radius:10px 0px;" class="text-center">
<h4 class="text-dark">Bitcoin</h4>
</div>
<div style="background-color:#eaeaea; padding:5px;">
<img class="image-responsive" src="../img/icon/bitcoin.png">
</div>

<div style="background-color:#eaeaea;">
<span style="margin:20px;">Unit </span> $1 - $1000
<hr style="margin:5px;">
<span style="margin:20px;">Charge</span> 1.5% + 0.5%
</div>

<div class="text-center" style="padding:5px;">
<form id="bitcoin" method="post" enctype="multipart/form-data" action="../ajax_submit.php">
 <input id="amount" class="modal_input" type="hidden" name="user" value="<?php echo $user['username']; ?>">
<input class="form-control" type="text" name="amount" placeholder="Enter Amount" required="required">
<input type="hidden" name="submit_bitcoin">
<button onclick="ajax_sub('bitcoin');" class="btn btn-primary form-control"> Deposit Now </button>
</form>
</div>

</div>

</div>
</div>
		
		<?php
	}
  
  ?>




<?php
  footer1("../");
  ?>