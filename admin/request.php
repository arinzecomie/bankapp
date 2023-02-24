<?php
session_start();
?>
<?php
if(!isset($_SESSION['admin_username']) ||
  $_SESSION['admin_username']=="") {
header("location:admin_login.php");
}

include('../library/library.php');
?>


<?php
//Admin gas request status update
if(isset($_GET['action']) && $_GET['pg'] == "ord_req"){
		$db = new Db_conn();
		$status =  $_GET['action'];
		$id =  $_GET['track'];
		$date = Date("Y-m-d h:ia");
		
		$table_name = "checkout";
		$data = array($status, $id);
		$query_fields = array("field_names"=>array("status"), "where"=>array("ord_id ="), "data"=>$data );
		    $db->update_db($table_name, $query_fields);
			if($db->rows() > 0){
				
				echo "alert('Successful!');";
				header("location:request.php?pg=order_req");
			}
		
}

?>


<?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
$dir = "../";
menu("$title", "$meta_key", "$meta_desc", $dir)
?>
	<!--custom css-->
	 <style>
	 tr:nth-child(odd){
	background-color:#eaeaea;
	 }
	th{
	color:navy;}
	#add_form{
		background-color:transparent;
	}
	tr:hover,tr:focus{
		background-color:lightgreen;
	}
	</style>
<div style="margin-top:50px;">

</div>


<?php
//fucntion to get the total booking request in the system
function customer_req($where, $data, $request_type){
	$db = new Db_conn();//instantiate database class
	//if booking request, check available rooms for check in
	
	//select the available booking requests
	$table_name = "checkout";
		$select_fields = array("field_names"=>array("ord_id", "member_id", "cart_id", "name", "state_addr", "phone_no", "email", "p_name", "product_id", "img", "description", "date", "time", "quantity", "status"), "where"=>$where, "data"=>$data);
		
		$db->select_data($table_name,$select_fields );//call select method
		$customer_rq = $db->rows();
		?>
		<div class="table-responsive">
		<table class="table" border=1>
		<div style="font-weight:bolder; font-size:20px; text-align:center;"><h3> <?php echo $booking_rq." ".$request_type; ?> </h3> </div>
		<tr style="color:red;">
		<th>S/N</th> <th>Name/Addr</th> <th>Product</th> <th>Qty</th> <th> Contact </th> <th>Sample/Desc</th> 
		<th>Date/Time</th> <th>Status/Action</th>  
		</tr>
		<?php
		$i=1; //counter value for form id

		while($cus_rq = $db->return_sth()->fetch()){
			$form_id = "form".$i;
			$req_id = $cus_rq['req_id'];
			$status = $cus_rq['status'];
			$chk_out = "";
			$room = "";
			if($status == "pending" || $status == "pending_cancelled"){
				$btn_color="btn-primary"; $btn_link = "in_progress"; $stat = "pending";
				
				if($status == "pending_cancelled"){ $stat = "pending_cld"; }
				
				}else{
					$btn_color="btn-danger"; $btn_link = "pending_cancelled"; $stat = "In progress";
					}
?>
		<tr >
		<td><?php echo $i; ?></td>
	 <td> <?php echo $cus_rq['name']; ?><br>( <?php echo $cus_rq['state_addr']; ?> )</td> <td> <a href="<?php echo"../product/".preg_replace('/\s+/', '-', $cus_rq['p_name'])."-".$cus_rq['product_id'];?>"> <?php echo $cus_rq['p_name']; ?> </a> </td> <td><?php echo $cus_rq['quantity']; ?></td> <td><?php echo $cus_rq['phone_no']; ?> <br> <?php echo $cus_rq['email']; ?></td>
		<td><a href="../cart/img/<?php echo $cus_rq['img']; ?>">View sample</a> <br> <?php echo $cus_rq['description']; ?> </td> <td><?php echo $cus_rq['date']; ?> <br> <?php echo $cus_rq['time']; ?></td>  
		<td style="font-size:12px;"><?php echo $stat ."
		<a href='request.php?pg=ord_req&track=".$cus_rq['ord_id']."&action=". $btn_link ."'  class='btn ". $btn_color ."'  style='width:60px; font-size:10px; height:25px; padding:2px; padding-top:5px; margin:5px;'"; ?> onclick="return confirm( 'Do you wish to continue?');" <?php echo ">In progress </a>";?>
		
		<a href='request.php?pg=ord_req&track=<?php echo $cus_rq['ord_id'];?>&action=served' onclick="return confirm( 'Are you sure you have served this customer?');"  class='btn btn-success'  style='width:60px; font-size:10px; height:25px; padding:2px; padding-top:5px;'> Served </a></td>  
		</tr>
		

<?php 
      $i++; //increment counter value
		}//end while
		$db->close_db();
		echo '</table> </div>';
	}//end fucntion booking_req	
?>

<?php
//booking requests
if(isset($_GET['pg']) && $_GET['pg'] == "order_req"){
		$where = array("status <>");
		$data = array("served");
		$request_type ="Product Order Request";
		customer_req($where, $data, $request_type);//call function to get the booking request
}

?>





<?php
//fucntion to update mark contact messages as read
   function update_contact($msg_id){
	   $db = new Db_conn();
        //update booking table
		$table_name = "contact";
		$data = array("read", $msg_id);
		$query_fields = array("field_names"=>array("status",), "where"=>array("cont_id ="), "data"=>$data );
		    $db->update_db($table_name, $query_fields);
			
			if($db->rows() > 0){
				
				echo "<script> alert('Successful!'); </script>";
				
			}//end if
			$db->close_db();
			}//end function update_contact

?>

<?php
//fucntion to update mark quote request as read
   function update_quote($quote_id){
	   $db = new Db_conn();
        //update booking table
		$table_name = "req_quote";
		$data = array("read", $quote_id);
		$query_fields = array("field_names"=>array("status",), "where"=>array("quote_id ="), "data"=>$data );
		    $db->update_db($table_name, $query_fields);
			
			if($db->rows() > 0){
				
				echo "<script> alert('Successful!'); </script>";
				
			}//end if
			$db->close_db();
			}//end function update_contact

?>
	
<?php //update contact message status
	if(isset($_POST['msg_id'])){
		$msg_id = $_POST['msg_id'];
		update_contact($msg_id);//call function from same page
				
	}//end
	
	?>
	
	<?php //update quote request status
	if(isset($_POST['quote_id'])){   
		$quote_id = $_POST['quote_id'];
		echo $quote_id;
		update_quote($quote_id);//call function from same page
				
	}//end
	
	?>	
	
		<?php
//fucntion to fetch the contact messages
function contact_msg($where, $data){
	$table_name = "contact";
		$select_fields = array("field_names"=>array("*"), "where"=>$where, "data"=>$data);
		
		$db = new Db_conn();
		$db->select_data($table_name,$select_fields );//call select method
		$contact_msg = $db->rows();
		?>
		<div class="table-responsive">
		<table class="table" border=1>
		<div style="font-weight:bolder; font-size:20px; text-align:center;"> <?php echo $contact_msg; ?> Contact Messages </div>
		<tr>
		<th>Name</th> <th>email</th> <th>Phone</th>  <th>Message</th> <th>Date</th> <th>Action</th>  
		</tr>
		<?php
		while($bk_rq = $db->return_sth()->fetch()){
			$id = $bk_rq['cont_id'];
?>
		<tr>
		<td> <?php echo $bk_rq['name']; ?> </td> <td><?php echo $bk_rq['email']; ?></td>  <td><?php echo $bk_rq['phone_no']; ?></td> <td><?php echo $bk_rq['msg']; ?></td>   
		 <td><?php echo $bk_rq['date'];?></td> 
		<td><?php echo "<form id='update' method='post' action=''>
		<input type='hidden' name='contact_btn' value='contact_msg'>
		<input type='hidden' name='msg_id' value='". $id ."'>
		<button type='submit' onclick='return confirm(\"Do you wish to continue?\");' class='btn btn-primary'> Mark as read </button></form>"; ?></td>  
		</tr>
		

<?php
		}//end while
		$db->close_db();
		echo '</table> </div>';
	}//end fucntion contact_msg
?>


	<?php
//fucntion to fetch the quote request
function quote_request($where, $data){
	$table_name = "req_quote";
		$select_fields = array("field_names"=>array("*"), "where"=>$where, "data"=>$data);
		
		$db = new Db_conn();
		$db->select_data($table_name,$select_fields );//call select method
		$contact_msg = $db->rows();
		?>
		
		<table class="table" border=1>
		<div style="font-weight:bolder; font-size:20px; text-align:center;"> <?php echo $contact_msg; ?> Contact Messages </div>
		<tr>
		<th>Name</th> <th>email</th> <th>Phone</th>  <th>Request/Addr</th> <th>Message</th> <th>Date</th> <th>Action</th>  
		</tr>
		<?php
		while($bk_rq = $db->return_sth()->fetch()){
			$id = $bk_rq['quote_id'];
?>
		<tr>
		<td> <?php echo $bk_rq['full_name']; ?> </td> <td><?php echo $bk_rq['email']; ?></td>  <td><?php echo $bk_rq['phone_no']; ?></td> <td><?php echo $bk_rq['need']; ?> <br> <?php echo $bk_rq['state_addr']; ?> </td>   
		 <td><?php echo $bk_rq['description'];?></td> <td><?php echo $bk_rq['date'].$bk_rq['time'];?></td> 
		<td><?php echo "<form id='update' method='post' action=''>
		<input type='hidden' name='quote_btn' value='quote_request'>
		<input type='hidden' name='quote_id' value='". $id ."'>
		<button type='submit' onclick='return confirm(\"Do you wish to continue?\");' class='btn btn-primary'> Mark as read </button></form>"; ?></td>  
		</tr>
		

<?php
		}//end while
		$db->close_db();
		echo '</table>';
	}//end fucntion contact_msg
?>


<?php
//contact messages
if(isset($_GET['pg']) && $_GET['pg'] == "contact"){
		$where = array("status =");
		$data = array("new");
		contact_msg($where, $data);//call function to get the contact messages
}
?>

<?php
//quote request
if(isset($_GET['pg']) && $_GET['pg'] == "quote_rq"){
		$where = array("status =");
		$data = array("new");
		quote_request($where, $data);//call function to get the contact messages
}
?>






  <?php
  footer("../")
  ?>