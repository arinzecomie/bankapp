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
  main_menu($title, $meta_key, $meta_desc, $dir, "Our Branch");
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
                        <h3>Our Branch</h3>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-12 hide-on-tablet">
                          <ol class="breadcrumb text-right">
                            <li><a href="../">Home</a></li> 
                            <li class="active">Our Branch</li>
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
<div class="col-lg-6  col-sm-6">
<div style="background-color:#fff; padding:20px; color:#000066; font-weight:bold;" class="text-center">
<h4> <img style="width:50px;" src="../img/icon/location.png"> London, UK</h4>

<div style="background-color:#eaeaea; padding:20px;">
Leaf C, Tower 42, 25 Old Broad Street, London EC2N 1HQ, United Kingdom
</div>

</div>
</div>

<div class="col-lg-6  col-sm-6" style="background-color:lightblue; border-radius:10px; padding:0px;">
<div style="padding:20px; color:#fff; font-weight:bold;" class="text-center">
<h4 class="text-white"> <img style="width:50px;" src="../img/icon/location.png"> Canada</h4>
</div>
<div style="background-color:#eaeaea; padding:20px;">
600 Guachetiere St W, 4th Floor, Monstreal Canada
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