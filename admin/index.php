<?php
session_start();
include('../library/library.php');
?>

<?php
 if(isset($_POST['login_submit'])){
	 $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['password'];
	
 	$host = "localhost";
    $dbname = "lift_bank";
    $user = "root";
    $password = "";
try{
$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT username,staff_id, staff_passw, surname, passport, first_name, designation
				 From staff 
				 Where username = ? and staff_passw = ? ";
				 
$STH = $DBH->prepare($sql);
$data = array($admin_username, $admin_password);
$STH->execute($data);
$STH->setFetchMode(PDO::FETCH_ASSOC);  
}
catch(PDOException $e){
	echo $e->getMessage();
}//end catch
$numrow = $STH->rowCount();

if($numrow  > 0){
$admin = $STH->fetch();
$_SESSION['staff_id'] = $admin['staff_id'];
$_SESSION['admin_username'] = $admin['username'];
$_SESSION['surname'] = $admin['surname'];
$_SESSION['f_name'] = $admin['first_name'];
$_SESSION['desig'] = $admin['designation'];
$_SESSION['passport'] = $admin['passport'];

header("location:admin_panel.php");
}
else{
	$print_Invalid_message =' <script>
	 document.getElementById("message").style.display = "block";
 document.getElementById("message").innerHTML="Invalid Credentials <br> <span style=\'color:blue;\'>Please contact your developer</span>";
 </script>';
	session_start();
$_SESSION['username'] ="";
	
}//end if else
 }//end isset
?>
<?php
$title= "Barclays Online Bank - World Largest Bank";
$meta_key = "Barclays Online Bank";
$meta_desc = "We give the best banking experience for your financial growth";
menu("$title", "$meta_key", "$meta_desc", "../")
?>
     <div style="margin-top:50px;" class="text-center">
            <h2><b style="font-size:40px; color:#000066;">Barclay Admin Login</b></h2>
        </div>
 
   

   
   <center> <p id="message"></p>
</center>
<center>
<h4> <span class="fa fa-unlock"></span> Login</h4>
<div class="col-sm-6 text-center" id="login_box"  style=" border:2px solid #000066; float:none; margin:auto; border-radius:8px;">
<br>
<form method="post" action="">
<input  name="admin_username" type="text" class="form-control " placeholder="Username" required="required"></input>
<br>
<input id="passw"  name="password" type="password" class="form-control" placeholder="Password" required="required">
<br>
<div style="float:left; color:blue;"><input type="checkbox" name="remember">Remember me!</div> 
<br>
<input style="margin:10px;" onclick="return check();" name="login_submit" type="submit" value="login" class="input-lg btn btn-primary"  id="login_btn">
</form>
</div>
</br>

 <b style="color:#000066; font-style:italic;">Admin?</b> <a style="font-weight:bold;" href="admin-reg/">Register!</a></br>
<br>
</center>

  
   <!--custom javascript-->
	  <script src="custom_script.js"></script> 
	  
	  <script>
	  function check(){
	var passwrd = document.getElementById("passw").value;
	if(passwrd.length > 10){
		alert("The password must be 6 in number");
		return false;
	}//end if
	  }
	  </script>

  <?php
print $print_Invalid_message;
?>
  <?php
 footer("../")
  ?>