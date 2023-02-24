<?php
session_start();
/*include('../library/library.php');
require('Exception.php');
require('PHPMailer.php');
require('SMTP.php');*/
?>

<?php
/*
if(!isset($_SESSION['username']) ||
  $_SESSION['username']=="") {
header("location:../admin_login.php");
}
*/
/*

$to = $_POST['to'];
$cc = $_POST['cc'];
$subject = $_POST['subject'];
$msg_body = $_POST['msg_body'];

     $mailer = new PHPMailer\PHPMailer\PHPMailer();
         $mailer->From ='info@babankonline.com';
         $mailer->FromName='Barclays Bank Online';
         $mailer->Subject = $subject;
         $mailer->AddReplyTo('info@babankonline.com');
		 $mailer->AddAddress($to);
        if(!empty($cc)){$mailer->addCC($cc);}
        //if(!empty($bcc)){$mailer->addBCC($bcc);}
		
			$userN = $row['username'];
			$email = $row['email'];
			$mailer->AddAddress($email);
	

               $mailer->IsHTML(true);

         $mailer->AddEmbeddedImage('logo_bank.png', 'logo', 'logo_bank.png');
         $mailer->Body =" <div style='width:98%; margin:0 auto; padding:5px;'> <img src=\"cid:logo\" alt=\"Barclays Bank Logo\" height=\"150\"  width=\"100\"/> </div>
		 <br>
		 Hello <b> $userN </b> <br> <br>
         <div style='text-wrap:pre-line;'> $msg_body</div> <br>
     <p> $embed_img_below
    <hr> <a href='https://www.babankonline.com'><img src=\"cid:logo\" alt=\"Barclays Bank Logo\" height=\"150\"  width=\"100\"/><br>Barclays Bank Online</a> </p>";
	
	$mailer->Send();
*/
?>