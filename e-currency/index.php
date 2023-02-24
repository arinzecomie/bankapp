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
  main_menu($title, $meta_key, $meta_desc, $dir);
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
                        <h3>E-Currency Methods</h3>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-12 hide-on-tablet">
                          <ol class="breadcrumb text-right">
                            <li><a href="../">Home</a></li> 
                            <li class="active">E-Currency Methods</li>
                          </ol>  
					  
                      </div>
                  </div>
              </div>
            </div>
            <div class="spacer_80"></div>
            <p style="color:red"></p>
            <p style="color:blue"></p>
		
		
		<div class="container">
		<center>
		<h3> E-Currency Log </h3>
		</div>
		</center>
<div class="row">
<div class="col-lg-2  col-md-2 col-sm-2 col-xs-12">
</div>
<div class="col-lg-8  col-md-8 col-sm-10 col-xs-12 " style="background-color:lightblue; border-radius:10px; padding:0px;">
<div style="padding:20px; color:#fff; font-weight:bold;" class="text-center">
<table class="table" style="color:#fff;"> 
<tr>
<th> AMOUNT </th>
<th> METHOD </th>
<th> ACCOUNT </th>
<th> TRX TIME </th>
<th> STATUS </th>
</tr>
</table>
 No Data Available
</div>
<div style="background-color:#eaeaea; padding:5px;">

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