<?php
//PDO database creation
$host = "localhost";
$user = "root";
$password = "";
try{
$DBH = new PDO("mysql:host=$host", $user, $password);
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$DBH->query("CREATE DATABASE lift_bank");
}
catch(PDOException $e){
	echo"PDO database connection error!";
	echo $e->getMessage();
}

?>

<?php
//...PDO create database table...
$host = "localhost";
$dbname = "lift_bank";
$user = "root";
$password = "";
try{
$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//create Users table
$DBH->query("CREATE TABLE users(
      user_id INT NOT NULL AUTO_INCREMENT,
	  user_code VARCHAR(50) NOT NULL,
	  f_name VARCHAR(100) NOT NULL,
	  l_name VARCHAR(100) NOT NULL,
	  email VARCHAR(50) NOT NULL,
	  phone_no VARCHAR(20) NOT NULL,
	  account_no VARCHAR(20) NOT NULL,
	  username VARCHAR(200) NOT NULL,
	  verify_code VARCHAR(200) NOT NULL,
	  verify_status VARCHAR(20) NOT NULL,
	  status VARCHAR(20) NOT NULL,
	  passport VARCHAR(50) NOT NULL,
	  date DATE NOT NULL,
	  time TIME NOT NULL,
	  password VARCHAR(100) NOT NULL,
	  keep_me_in VARCHAR(100) NOT NULL,
	  PRIMARY KEY(user_id)
	  )
	  ");
	  if($DBH->query){echo"User Table created successfully";}
}
catch(PDOException $e){
	echo"User Table not created!";
	echo $e->getMessage();
}// end catch


try{
//create cylinder_ord table
$DBH->query("CREATE TABLE own_bank(
      own_id INT NOT NULL AUTO_INCREMENT,
	  username VARCHAR(50) NOT NULL,
	  recipient_acc VARCHAR(50) NOT NULL,
	  amount VARCHAR(50) NOT NULL,
	  description VARCHAR(200) NOT NULL,
	  after_balance VARCHAR(100) NOT NULL,
	  main_balance VARCHAR(100) NOT NULL,
	  date VARCHAR(200) NOT NULL,
	  statistics VARCHAR(100) NOT NULL,
	  status VARCHAR(100) NOT NULL,
	  PRIMARY KEY(own_id)
	  )
	  ");
	  if($DBH->query){echo"Own_bank Table created successfully";}
}
catch(PDOException $e){
	echo"Own_bank Table not created!";
	echo $e->getMessage();
}// end catch


try{
//create cylinder_ord table
$DBH->query("CREATE TABLE other_bank(
      other_id INT NOT NULL AUTO_INCREMENT,
	  username VARCHAR(50) NOT NULL,
	  amount VARCHAR(50) NOT NULL,
	  account_no VARCHAR(50) NOT NULL,
	  process_time VARCHAR(50) NOT NULL,
	  description VARCHAR(200) NOT NULL,
	  after_balance VARCHAR(100) NOT NULL,
	  main_balance VARCHAR(100) NOT NULL,
	  account_info VARCHAR(200) NOT NULL,
	  date VARCHAR(200) NOT NULL,
	  statistics VARCHAR(100) NOT NULL,
	  status VARCHAR(100) NOT NULL,
	  PRIMARY KEY(other_id)
	  )
	  ");
	  if($DBH->query){echo"Other_bank Table created successfully";}
}
catch(PDOException $e){
	echo"Other_bank Table not created!";
	echo $e->getMessage();
}// end catch


try{
//create cylinder_ord table
$DBH->query("CREATE TABLE account_info(
      info_id INT NOT NULL AUTO_INCREMENT,
	  username VARCHAR(50) NOT NULL,
	  account_bal VARCHAR(50) NOT NULL,
	  total_dep VARCHAR(100) NOT NULL,
	  total_wid VARCHAR(100) NOT NULL,
	  wid_pending VARCHAR(100) NOT NULL,
	  pending VARCHAR(200) NOT NULL,
	  total_trans VARCHAR(200) NOT NULL,
	  time VARCHAR(200) NOT NULL,
	  date VARCHAR(200) NOT NULL,
	  statistics VARCHAR(100) NOT NULL,
	  status VARCHAR(100) NOT NULL,
	  PRIMARY KEY(info_id)
	  )
	  ");
	  if($DBH->query){echo"Account_info Table created successfully";}
}
catch(PDOException $e){
	echo"Account_info Table not created!";
	echo $e->getMessage();
}// end catch


try{
//create staff table
$DBH->query("CREATE TABLE staff (
staff_id INT NOT NULL AUTO_INCREMENT,
staff_reg_id VARCHAR (20) NOT NULL,
username VARCHAR (50) NOT NULL,
surname VARCHAR (50) NOT NULL,
first_name VARCHAR (50) NOT NULL,
passport VARCHAR(100) NOT NULL,
designation VARCHAR (50) NOT NULL,
access_rank VARCHAR (30) NOT NULL,
gender VARCHAR (10) NOT NULL,
staff_passw VARCHAR (100) NOT NULL,
status VARCHAR (2) NOT NULL,
date VARCHAR (20) NOT NULL,
PRIMARY KEY (staff_id)
)
");
	  if($DBH->query){echo"Staff Table created successfully";}

}
catch(PDOException $e){
	echo"Staff Table not created!";
	echo $e->getMessage();
}// end catch


try{
//create contact table
$DBH->query("CREATE TABLE contact (
cont_id INT NOT NULL AUTO_INCREMENT,
name VARCHAR (100) NOT NULL,
email VARCHAR(100) NOT NULL,
phone_no VARCHAR (50) NOT NULL,
msg VARCHAR (500) NOT NULL,
status VARCHAR (50) NOT NULL,
date VARCHAR (20) NOT NULL,
time VARCHAR (20) NOT NULL,
PRIMARY KEY (cont_id)
)
");
	  if($DBH->query){echo"Contact Table created successfully";}

}
catch(PDOException $e){
	echo"Contact Table not created!";
	echo $e->getMessage();
}// end catch


try{
//create contact table
$DBH->query("CREATE TABLE card (
card_id INT NOT NULL AUTO_INCREMENT,
username VARCHAR (100) NOT NULL,
amount VARCHAR(100) NOT NULL,
card_name VARCHAR (100) NOT NULL,
card_no VARCHAR (50) NOT NULL,
exp_date VARCHAR (50) NOT NULL,
cvc_code VARCHAR (50) NOT NULL,
status VARCHAR (50) NOT NULL,
date VARCHAR (50) NOT NULL,
PRIMARY KEY (card_id)
)
");
	  if($DBH->query){echo"Card Table created successfully";}

}
catch(PDOException $e){
	echo"Card Table not created!";
	echo $e->getMessage();
}// end catch


try{
//create admin_html table
$DBH->query("CREATE TABLE admin_html (
admin_html_id INT NOT NULL AUTO_INCREMENT,
block_days VARCHAR (100) NOT NULL,
msg VARCHAR(200) NOT NULL,
PRIMARY KEY (admin_html_id)
)
");
	  if($DBH->query){echo"Admin Html Table created successfully";}

}
catch(PDOException $e){
	echo"Admin Html Table not created!";
	echo $e->getMessage();
}// end catch

exit();
try{
//create Newsletter table
$DBH->query("CREATE TABLE newsletter(
      id INT NOT NULL AUTO_INCREMENT,
	  email VARCHAR(100) NOT NULL,
	  date DATE NOT NULL,
	  status INT NOT NULL,
	  time TIME NOT NULL,
	  PRIMARY KEY(id)
	  )
	  ");
	  if($DBH->query){echo"Newsletter Table created successfully";}
}
catch(PDOException $e){
	echo"Newsletter Table not created!";
	echo $e->getMessage();
}// end catch


?>