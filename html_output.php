
<?php
//main menu function
//$dir is use to set directory level for individual pages
//$menu_search is use to set if menu mobile search will be displayed or not
function forum_menu($title, $meta_key, $meta_desc, $dir = "", $menu_search=""){
	?>
	
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?php echo $meta_key;  ?>">
<meta name="description" content="<?php echo $meta_desc;   ?>">

	  <meta property="og:url"           content="https://www.bizrator.com<?php echo $_SERVER['REQUEST_URI']; ?>" />
	  <meta property="og:type"          content="website"/>
	  <meta property="og:title"         content="<?php echo $title; ?>" />
	  <meta property="og:description"   content="<?php echo $meta_desc; ?>" />
	  <meta property="og:image"         content="https://www.bizrator.com/biz_connect.jpg"/>
	  <meta property="og:image:url"         content="https://www.bizrator.com/biz_connect.jpg"/>
   
       <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?php echo $dir; ?>favico.png" type="image/x-icon">
   
   
   
<link rel="stylesheet" href="<?php  echo $dir; ?>css/custom_css.css"/>
<link rel="stylesheet" href="<?php  echo $dir; ?>bootstrap-3.3.7/css/bootstrap.css">
<style>
a:hover{
	text-decoration:none !important;
}
a{
	color:navy;
}
.menu a{
	color:white;
}
.navBox a:hover{
	color:lightblue;
}
.navBox li:hover{
	background-color:;
}
</style>
</head>
 <body>
  <div class="page_wrapper">
 <div style="width:100%; position:fixed; display:block; top:0; background-color:navy; z-index:1000; padding-bottom:0px;">
<a id="openPageslide" style="float:left; cursor:pointer;">
					<span></span>
                    <span ></span>
                    <span></span>
					</a>
<a class="navbar-brand" href="https://www.bizrator.com" style="font-size:20px; margin-left:10px; font-weight:800;color:#ffffff; float:left;">
        bizRator  
</a>

	<?php
 if(!isset($_SESSION['all_user'])){
	 ?>
<a class="navbar-brand" style="cursor:pointer;" onclick="backLogin();" id="nav_icon">
        <span style="font-size:14px;"> Log in </span>	
</a>

<a class="navbar-brand" style="cursor:pointer;" onclick="userSignup();" id="nav_icon">
        <span style="font-size:14px;"> sign up </span>	
</a>
	 <?php
	 }
	?>
	
	<?php
 if(isset($_SESSION['all_user'])){
	 ?>
<a class="navbar-brand" href="<?php  echo $dir; ?>messages/?_linkref=msgx01" title="Messages" id="nav_icon">
        <span class="glyphicon glyphicon-envelope"> </span><span style="margin-left:-13px;"> <?php get_message();?> </span>
</a>
	 <?php
	 }
	?>

<?php
 if(isset($_SESSION['all_user'])){
	 ?>
 <a class="navbar-brand" title="Profile"  id="nav_icon" href="<?php echo $dir; ?>forum/profiles/<?php echo $_SESSION['all_user'];?>" style="margin-left:0px;"> <span class="glyphicon glyphicon-user"></span> </a>
	 <?php
	 }
	?>	
	
	<?php
 if(isset($_SESSION['all_user'])){
	 ?>
 <a class="navbar-brand" title="Status Logged in"  id="nav_icon" style="margin-right:-30px;" > <div style="width:10px; height:10px; border-radius:80%; background-color:green;"> </div></a>
	 <?php
	 }
	?>	
<div id="pageslide" class="navBox">
<span id="closeMenu" > &times</span>
  <ul>
   <?php if(isset($_SESSION['all_user'])){
	 ?>
 <li><a  href='<?php echo $dir; ?>forum/profiles/<?php echo $_SESSION['all_user'];?>'> Profile </a></li>
	
	<?php
 }else{
 ?>
 <li> <a href="<?php  echo $dir; ?>company_listing/">Register your business</a></li>
 <li><a style="cursor:pointer;" onclick="userSignup();">  Signup </a> </li>
<?php
 }//end
?>

   <?php
 if(isset($_SESSION['all_user'])){
	 ?>
  <li style="margin-right:-15px;"> <a href="" title="Status Logged in"  id="logged_status"> <div style="width:10px; height:10px; border-radius:80%; background-color:green; margin-top:5px;"> </div></a> </li>
	 <?php
	 }
	?>		

 <?php if(isset($_SESSION['all_user'])){
	 ?>
 <li><a href="<?php  echo $dir; ?>logout/"> Logout </a> </li> 
 <?php
 }else{
 ?>
<li><a style="cursor:pointer;" onclick="backLogin();"> Login </a> </li> 
<?php
 }//end if
?>  

<li> <a href="<?php  echo $dir; ?>biz-list/"> Bizlist </a> </li> 
 <li><a href="<?php  echo $dir; ?>insight/">Bizinsight </a> </li> 
 
  <?php if(isset($_SESSION['all_user'])){
	 ?>
 <li><a href="<?php  echo $dir; ?>messages/?_linkref=msgx01"> Messages <?php get_message(); ?> </a> </li> 
 <?php
 }//end if
 ?>
   <li><a href="<?php  echo $dir; ?>forum/">Home</a> </li> 
  </ul>
</div>

<?php
if($menu_search == ""){
	?>
<div id="menu_search"> 
 <div id="menu_search_wrap" class="col-xs-12">
  <form method="GET" action="<?php if($dir == "../../"){ echo "../";}?>search">
 <div  style="padding:0px; float:left;  width:80%;">
 <input class="search" style="height:30px;" type="text" name="search_key" placeholder="Search Forum...">
  <input type="hidden" name="search_request" value="forum-topics">
</div>
 <div style="float:left; width:20%; padding:0px; margin:0px;">
 <button  class="srch_btn" type="submit" name="search_submit"><span class="glyphicon glyphicon-search"></span></button>
 </div>
 </form>
  </div>
 </div>
 <?php   
}//end if $menu_search
 ?>

</div>

 <div id="page_start_margin">   </div>
<?php	
}//end function forum_menu
?>


<?php 
//notification modal display function
function search_lg_forum($dir="", $meta_desc=""){
	?>
	
 <div class="row wrap_search_wlc">
 <div class="row">
<div class="col-sm-2 col-xs-12" > 
</div>
<div id="search_wrap_lg" class="col-sm-6 col-xs-12" > 
 <form method="GET" action="<?php if($dir=="../../"){echo "../";}else{echo "";}?>search">
 <div class="col-xs-12" style="padding-left:1px; padding-right:0px;">

 <div  style="padding:0px; float:left;  width:90%;">
 <input class="search" style="border:none; border-radius:5px 0px 0px 5px;" type="text" name="search_key" placeholder="Search Forum...">
  <input type="hidden" name="search_request" value="forum-topics">
</div>
 <div style="float:left; width:10%; padding:0px; margin:0px;">
 <button  class="srch_btn" style="height:40px;" type="submit" name="search_submit"><span class="glyphicon glyphicon-search"></span></button>
 </div>
 </div>
 </form>
 </div>
 
  <div id="welcome" class="col-sm-4 col-xs-12"> 
 <div class="col-sm-6 col-xs-6">
 <div class="ellipse"> <b>Welcome</b> <?php echo $_SESSION['user_name']; ?></div>
 </div >
 <div class="col-sm-6 col-xs-6">
     <!-- Your share button code 
  <div class="fb-share-button" 
    data-href="http://www.bizrator.com/<?php echo $_SERVER['REQUEST_URI']; ?>" 
    data-layout="button_count" data-size="small">
  </div>-->
  <a href=" https://www.facebook.com/sharer/sharer.php?u=https://www.bizrator.com<?php echo $_SERVER['REQUEST_URI']; ?>">
 <img class="share_logo"  src="<?php echo $dir; ?>icons/fb_share_btn.png">
 </a>
 <img class="social_logo" src="<?php echo $dir; ?>icons/facebook_btn.png">
 <!-- <img class="social_logo" src="images/twitter_logo2.png">
 <img class="social_logo" src="images/linkedin_logo1.png"> -->
 </div> 
 
 </div>
 
 </div>
 </div>
	<?php 
}//end function search large screen forum
	?>



<?php
function menu(){
?>

<head>
<title>Biz Social</title>
<link rel="stylesheet" href="../css/custom_css.css"/>
<link rel="stylesheet" href="../bootstrap-3.3.7/css/bootstrap.css">
</head>
<div class="menu"> <span style="font-weight:bold; font-size:18;">Biz Social</span> 
 <a href="../insight/?link=_new_insight"> <span style="float:right; margin:10px;"> Post business insight </span> </a>
<a href="../bizcard"> <span style="float:right; margin:10px;"> create bizcard</span> </a> 
<a href="../update"> <span style="float:right; margin:10px;"> Setup your profile </span> </a> 
<a href="../messages/?_linkref=msgx01"> <span style="float:right; margin:10px;"> Messages <?php get_message(); ?> </span> </a> 
</div>

<?php
}//end function menu
?>

<?php
function menu2(){
?>

<head>
<title>Biz Social</title>
<link rel="stylesheet" href="css/custom_css.css"/>
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.css">
</head>
<div class="menu"> <span style="font-weight:bold; font-size:18;">Biz Social</span>
 <a href="../insight"> <span style="float:right; margin:10px;"> Post business insight </span> </a> 
 <a href="../update"> <span style="float:right; margin:10px;"> Setup your profile </span> </a> 
 </div>

<?php
}//end function menu
?>



<?php 
function user_menu(){
?>

<head>
<title>Biz Social</title>
<link rel="stylesheet" href="css/custom_css.css"/>
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.css">
</head>
<div class="menu"> <span style="font-weight:bold; font-size:18;">Biz Social</span>
 
 <?php if(isset($_SESSION['all_user'])){
	 ?>
 <a href=""> <span style="float:right; margin:10px;"> Settings </span> </a>
 <?php
 }else{
 ?>
 <a href="../signup"> <span style="float:right; margin:10px;"> Signup </span> </a>
<?php
 }//end
?> 
 
 <?php if(isset($_SESSION['all_user'])){
	 ?>
 <a href=""> <span style="float:right; margin:10px;"> Logout </span> </a> 
 <?php
 }else{
 ?>
<a href="../signin"> <span style="float:right; margin:10px;"> Login </span> </a> 
<?php
 }
?> 
 <a href="../bizlist.php?link_req=my_bizlist"> <span style="float:right; margin:10px;"> Bizlist </span> </a> 
 <a href="../insight/"> <span style="float:right; margin:10px;"> Bizinsight </span> </a> 
 <a href="../"> <span style="float:right; margin:10px;"> Skills </span> </a> 
  <a href="../forum/"> <span style="float:right; margin:10px;"> Forum </span> </a> 
  <a href="../"> <span style="float:right; margin:10px;"> Notifications </span> </a> 
 </div>
<?php
}//end function user_menu
?>