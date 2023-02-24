<?php
//main menu function
//$dir is use to set directory level for individual pages
//$menu_search is use to set if menu mobile search will be displayed or not
 
function main_menu($title, $meta_key, $meta_desc, $dir = "", $pg=""){
	?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Bizrator|Online print on demand, branding and digital marketing agency. We deliver nationwide with our head office in Abuja FCT Nigeria">
    <meta name="keywords" content="Bizrator, Online printing, graphic design, branding, digital marketing, print on demand">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo $dir; ?>img/favicon.png">
    <title>World Largest Bank</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo $dir; ?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/animate.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/owl.transitions.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/custom_css.css" type="text/css">
</head>

<body>

    <!-- Page Preloder -->
    <!--<div id="preloder">
        <div class="loader"></div>
    </div>-->
	
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
	<!--
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/bizrator-print-logo-2.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a onclick="userLogin();"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
		-->
		<div style="margin-top:55px;"> </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                            <li class="active"><a href="<?php echo $dir; ?>">Dashboard</a></li>
                            <li><a href="#">Transfer</a>
                                <ul class="header__menu__dropdown">
                            <li><a href="../transfer-own-bank/">Own Bank</a></li>
                            <li><a href="../transfer-other-bank/">International Bank Transfer</a></li>
                            <li><a href="../e-currency/">E-Currency</a></li>
                                </ul>
                            </li>
                            <li><a href="../statement/">Account Statement</a></li>
                            <li><a href="../e-deposit/">E-Deposit</a></li>
                            <li><a href="../our-branch/">Our Branch</a></li>
                        </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <!--<div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>-->
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>  Info@babankonline.com</li>
                <li> <i class="fa fa-phone"></i>
                                 +9487646796 
                           </li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->
	
     <nav class="" style="position:fixed; top:0; z-index:1000; width:100%;">
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li> <a href="mailto:info@babankonline.com"> <i class="fa fa-envelope"></i> info@babankonline.com</a></li>
                            
                               <li> <i class="fa fa-phone"></i>
                                +2348169920595
                           </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
							<!--<div class="header__top__right__auth"> <a>Dashboard</a> </div> |-->
                            <div class="header__top__right__auth" style="max-width:132px">
							
							<?php if(isset($_SESSION['user_id'])){ $account = $dir."account/"; echo "<a title='view Profile' href='$account'><i style='font-size:18px;' class='fa fa-user'></i> ".$_SESSION['user_name']."</a>";}else{ ?>
                               <a href="../logout/"><i class="fa fa-power-off"></i> Logout </a>
							<?php 
							}//end ifelse
							?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		 <div class="col-lg-3 show_menu_sm" style="padding:0px;">
                    <div class="header__cart">
					
					<div class="header__top__right__social" style="float:left;">
                                <a href="mailto:info@babankonline.com" class="show_sm_social" id="hide_xs"><i class="fa fa-envelope-square"></i> info@babankonline.com </a>
                                <!--<a href="tel:08169920495" class="show_sm_social"><i class="fa fa-phone"></i> Call</a>-->
                            </div>
                          
					<div class="header__top__right__auth" style="max-width:132px">
                        <!--<ul>
                            <li style="color:#000066;">-->
							<a href="../logout/"> <i class="fa fa-power-off"> </i> Logout </a>
							<!--</li> |
                            <li><a style="cursor:pointer;" onclick="view_cart('');"> Dashboard
							</a></li>
                        </ul>-->
                    </div>
                    </div>
                </div>
		
        <div class="" style="background-color:#000066; width:100% !important; height:70px; box-shadow:0px 1px 1px 0px black; -moz-box-shadow:0px 1px 1px 0px black; -webkit-box-shadow:0px 1px 1px 0px black;">

            <div class="row">
                <div class="col-lg-3" style="padding:0px;">
                    <div class="header__logo">
                        <a href="<?php echo $dir ?>"><img class="logo_img" src="<?php echo $dir; ?>img/logo_bank.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="<?php echo $dir; ?>">Dashboard</a></li>
                            <li><a href="#">Transfer</a>
                                <ul class="header__menu__dropdown">
                            <li><a href="../transfer-own-bank/">Own Bank</a></li>
                            <li><a href="../transfer-other-bank/">International Bank Transfer</a></li>
                            <li><a href="../e-currency/">E-Currency</a></li>
                                </ul>
                            </li>
                            <li><a href="../statement/">Account Statement</a></li>
                            <li><a href="../e-deposit/">E-Deposit</a></li>
                            <li><a href="../our-branch/">Our Branch</a></li>
                        </ul>
                    </nav>
                </div>
               
            </div>
			<br>
			<br>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
	</nav>
	
	
	<div style="margin-top:130px;"> </div>
	
	
	<div class="row">
		<?php
modal($dir);
notif_dialog($dir);
//echo $_SESSION['notification'];
//unset($_SESSION['notification']);
?>
	</div>
	<div id="msg">  </div>
	
	<div class="account_header" style="border-bottom:1px solid #000066;">
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
	
	<div class="col-sm-4 col-8" style="padding:0px;">
<span style="color:#ff4000; font-weight:bold;">WELCOME</span>
<br>	
	<img style="width:50px;" src="<?php echo $dir; ?>img/icon/wlc_user.png">
	 <span class="name_user" style="color:#000066;">  <?php echo $_SESSION['f_name']." ".$_SESSION['l_name']; ?> </span>
	<div style="padding-left:50px; padding-bottom:0px; margin-top:-15px;">
	<i style="color:#ff4000;" class="fa fa-user-circle"></i>  <?php echo $_SESSION['user_name']; ?> 
	</div>
	<hr style="margin-top:10px; margin-bottom:5px;">
	<img style="width:40px;" src="<?php echo $dir; ?>img/icon/statement.png"> 
<span style="color:#ff4000; font-weight:bold;">ACC NO - </span> <span style="color:#000066;"> <b> <?php echo $_SESSION['account_no']; ?> </b> </span>
<div style="">
<ul>
<li style="list-style:none; display:inline-block;"><a href="<?php echo $dir; ?>profile">Account Settings</a></li> 
<li style="list-style:none; display:inline-block;"><a href="<?php echo $dir; ?>reset">Change Password</a></li>
</ul>
</div>

	</div>
	
  <div class="col-sm-4 col-12 categories__item set-bg" data-setbg="<?php echo $dir; ?>img/icon/my-dashboard.jpg" style="height:200px; padding:0px;"> 
	<div style="background:rgba(0,0,0,0.5); height:100%;">
	<div style="top:50%; position:relative;" >
	<center><h3  style="color:#ff4000;"> <?php echo $pg; ?> </h3></center>
	</div>

</div>
	</div>
	
	
	
	
	</div>
	</div>
	
<?php	
}//end function main_menu
?>


<?php
function menu($title, $meta_key, $meta_desc, $dir = "", $menu_search="", $share_link="", $share_img=""){
	?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Bizrator|Online print on demand, branding and digital marketing agency. We deliver nationwide with our head office in Abuja FCT Nigeria">
    <meta name="keywords" content="Bizrator, Online printing, graphic design, branding, digital marketing, print on demand">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo $dir; ?>img/favicon.png">
    <title>World Largest Bank</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo $dir; ?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/animate.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/owl.transitions.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $dir; ?>css/custom_css.css" type="text/css">
</head>

<body>

    <!-- Page Preloder -->
    <!--<div id="preloder">
        <div class="loader"></div>
    </div>-->
	
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
	
		<div style="margin-top:55px;"> </div>
        <nav class="humberger__menu__nav mobile-menu">
           <ul>
                            <li class="active"><a href="<?php echo $dir; ?>">Home</a></li>
							<li><a href="<?php echo $dir; ?>#about-us">About</a></li>
                            <li><a href="<?php echo $dir; ?>#services">Services</a>
                                <ul class="header__menu__dropdown">
                            <li><a href="#">Loan</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo $dir; ?>#">Gallery</a></li>
                            <li><a href="<?php echo $dir; ?>#team">Team</a></li>
                            <li><a href="<?php echo $dir; ?>#testimonial">Testimonial</a></li>
                            <li><a href="<?php echo $dir; ?>#contact">Contact</a></li>
                        </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <!--<div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>-->
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>  Info@babankonline.com</li>
                <li> <i class="fa fa-phone"></i>
                                +9487646796 
                           </li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->
	
     <nav class="" style="position:fixed; top:0; z-index:1000; width:100%;">
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li> <a href="mailto:Info@babankonline.com"> <i class="fa fa-envelope"></i> Info@babankonline.com</a></li>
                            
                               <li> <i class="fa fa-phone"></i>
                                +9487646796
                           </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
							<div class="header__top__right__auth"> <a href="<?php echo $dir; ?>sign-up/">Register</a> </div> |
                            <div class="header__top__right__auth" style="max-width:132px">
							
							<?php if(isset($_SESSION['user_id'])){ $account = $dir."account/"; echo "<a title='view Profile' href='$account'><i style='font-size:18px;' class='fa fa-user'></i> ".$_SESSION['user_name']."</a>";}else{ ?>
                               <a href="<?php echo $dir; ?>login/" style="cursor:pointer;"><i class="fa fa-user"></i> Login </a>
							<?php 
							}//end ifelse
							?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		 <div class="col-lg-3 show_menu_sm" style="padding:0px;">
                    <div class="header__cart">
					
					<div class="header__top__right__social" style="float:left;">
                                <a href="mailto:info@babankonline.com" class="show_sm_social" id="hide_xs"><i class="fa fa-envelope-square"></i> info@babankonline.com </a>
                                <!--<a href="tel:08169920495" class="show_sm_social"><i class="fa fa-phone"></i> Call</a>-->
                            </div>
                          
					<div class="header__top__right__auth"> 
					<a href="<?php echo $dir; ?>login/">  Login</a>
					</div> |
                            <div class="header__top__right__auth" style="max-width:132px">
                      
					<a href="<?php echo $dir; ?>sign-up/">Register</a> 
							
                        </div>
                        
                    </div>
                </div>
		
        <div class="" style="background-color:#000066; width:100% !important; height:70px; box-shadow:0px 1px 1px 0px black; -moz-box-shadow:0px 1px 1px 0px black; -webkit-box-shadow:0px 1px 1px 0px black;">

            <div class="row">
                <div class="col-lg-3" style="padding:0px;">
                    <div class="header__logo">
                        <a href="<?php echo $dir ?>"><img class="logo_img" src="<?php echo $dir;?>img/logo_bank.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="<?php echo $dir; ?>">Home</a></li>
							<li><a href="<?php echo $dir; ?>#about-us">About</a></li>
                            <li><a href="<?php echo $dir; ?>#services">Services</a>
                                <ul class="header__menu__dropdown">
                            <li><a href="<?php echo $dir; ?>#">Loan</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo $dir; ?>#">Gallery</a></li>
                            <li><a href="<?php echo $dir; ?>#team">Team</a></li>
                            <li><a href="<?php echo $dir; ?>#testimonial">Testimonial</a></li>
                            <li><a href="<?php echo $dir; ?>#contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
               
            </div>
			<br>
			<br>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
	</nav>
	<div style="margin-top:110px;"> </div>
	
	
	<div class="row">
		<?php
modal($dir);
notif_dialog($dir);
//echo $_SESSION['notification'];
//unset($_SESSION['notification']);
?>
	</div>
	<div id="msg">  </div>
	
<?php	
}//end function menu
?>


<?php
//quick menu function
function quick_menu($dir = ""){
	?>
	 <div id="quick_menu_wrap" class="overflow">
 
 <div onclick="read_categories<?php if($dir =="../"){echo "2";}elseif($dir =="../../"){echo "3";} ?>();" style="cursor:pointer;" id="quick_menu">
 All Category
 </div>
<a href="<?php  echo $dir; ?>forum/">
 <div id="quick_menu" >
 Business Forum
 </div>
 </a>
<a href="<?php  echo $dir; ?>insight/">
 <div id="quick_menu">
 Biz Insight
 </div>
</a>
<a href="<?php  echo $dir; ?>biz-list/">
 <div id="quick_menu" >
 Bizlist
 </div>
 </a>
<a href="<?php  echo $dir; ?>all-products/">
 <div id="quick_menu" >
 Product
 </div>
 </a>
 <a href="<?php  echo $dir; ?>all-advert/">
 <div id="quick_menu" >
 Trending
 </div>
 </a>
 <a href="<?php  echo $dir; ?>all-promo/">
 <div id="quick_menu" >
 Promo
 </div>
 </a>
 
 </div>
<?php	
}//end function quick menu
?>



<?php 
//notification modal display function
function search_large($dir="", $meta_desc=""){
	?>
	
 <div class="row wrap_search_wlc">
<div id="search_wrap_lg" class="col-sm-7 col-md-8 col-lg-8 col-xs-12" > 
 <form method="GET" action="<?php echo $dir ?>search">
 <div class="col-xs-12" style="padding-left:1px; padding-right:0px;">
 <div style="float:left; width:25%;">
 <select style="border:none; width:100%; height:40px; border-radius:5px 0px 0px 5px;"  name="filter_by">
 <option> Filter </option>
 <option> Company </option>
 <option> Products </option>
 </select>
 </div>
 <div  style="padding:0px; float:left;  width:68%;">
 <input class="search" type="text" style="border:none;" name="search_key" placeholder="Search Company or Products">
</div>
 <div style="float:left; width:7%; padding:0px; margin:0px;">
 <button  class="srch_btn" style="height:40px;" type="submit" name="search_submit"><span class="glyphicon glyphicon-search"></span></button>
 </div>
 </div>
 </form>
 </div>
 <div id="welcome" class="col-sm-4 col-md-4 col-lg-4 col-xs-12"> 
 <div class="col-sm-6 col-xs-6">
 <div class="ellipse"> <b>Welcome</b> <?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; }?></div>
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
<!-- <a href='whatsapp://send?text=<?php echo $meta_desc; ?>:http://www.bizrator.com<?php echo $_SERVER['REQUEST_URI'];  ?>'  data-action="share/whatsapp/share"><img src="<?php echo $dir; ?>icons/whatsap_share.png" style="width:20px;"></a>-->
 <!-- <img class="social_logo" src="images/twitter_logo2.png">
 <img class="social_logo" src="images/linkedin_logo1.png"> -->
 </div> 
 
 </div>
 </div>
	<?php 
}//end function search large screen
	?>
	
     <?php
	//share icon function
	function share_icon($dir=""){
     ?>
     
     <span style="cursor:pointer; margin:0px 10px;" title="Share this page" id="share_icon" class="btn-link"><img src="<?php echo $dir; ?>icons/sh_ico.png" style="width:20px;"> </span>
     <?php
     }//end share icon function
     ?> 

     <?php
	//share icon function
	function share_icon_big($dir=""){
     ?>
     
     <span style="cursor:pointer; margin:0px 10px;" title="Share this page" id="share_icon_big" class="btn-link"><img src="<?php echo $dir; ?>icons/sh_ico.png" style="width:20px;"> </span>
     <?php
     }//end share icon function
     ?>     
     
     <?php
	//share dialog function
	function share_dialog($dir="", $meta_desc=""){
     ?>

     <div id="share_dialog" style="display:none; float:right; position:absolute; z-index:1; width:100%;">
         <div style="background-color:#fafafa; padding:10px; float:right; min-width:200px;">
         <!-- Your share button code -->
  <a href=" https://www.facebook.com/sharer/sharer.php?u=https://www.bizrator.com<?php echo $_SERVER['REQUEST_URI']; ?>">
 <img class="share_logo"  src="<?php echo $dir; ?>icons/fb_share_btn.png">
 </a>
       
         &nbsp <a href='whatsapp://send?text=<?php echo $meta_desc; ?>:https://www.bizrator.com<?php echo $_SERVER['REQUEST_URI'];  ?>'  data-action="share/whatsapp/share"><img src="<?php echo $dir; ?>icons/whatsap_share.png" style="width:20px;"></a>
     </div>
     </div>
     <?php
     }//end share icon function
     ?>

     <?php
	//share dialog function
	function share_dialog_big($dir="", $meta_desc=""){
     ?>

     <div id="share_dialog_big" style="display:none; float:right; position:absolute; z-index:1; width:100%;">
         <div style="background-color:#fafafa; padding:10px; float:right; min-width:200px;">
         <!-- Your share button code -->
  <a href=" https://www.facebook.com/sharer/sharer.php?u=https://www.bizrator.com<?php echo $_SERVER['REQUEST_URI']; ?>">
 <img class="share_logo"  src="<?php echo $dir; ?>icons/fb_share_btn.png">
 </a>
       
         &nbsp <a href='whatsapp://send?text=<?php echo $meta_desc; ?>:https://www.bizrator.com<?php echo $_SERVER['REQUEST_URI'];  ?>'  data-action="share/whatsapp/share"><img src="<?php echo $dir; ?>icons/whatsap_share.png" style="width:20px;"></a>
     </div>
     </div>
     <?php
     }//end share icon function
     ?>
	
	
	<?php 
//Footer function
function footer($dir=""){
	?>

<!-- Footer Section Begin -->
    <footer class="footer spad" style="background-color:black;">
        <div class="container">
		<center><p style="color:#aeaeae;"> 
		We are a full service bank with a comprehensive menu of products and expertise: personal, business, and real estate(residential and mortgage) banking and trust services.
		</p> </center>
            <div class="row">
			<div class="col-sm-6 col-6">
			<img style="width:200px;" src="<?php echo $dir; ?>img/icon/fdi_lender.png">
			</div>
			<div class="col-sm-6 col-6">
			<img src="<?php echo $dir; ?>img/icon/sba_lender.png">
			</div>
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> <a href="" target="_blank"style="color:#fff;" >Barclays Bank Online</a>  All rights reserved 
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="<?php echo $dir; ?>img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->


    <!-- Js Plugins -->
    <script src="<?php echo $dir;  ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $dir;  ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $dir;  ?>js/jquery.nice-select.min.js"></script>
    <script src="<?php echo $dir;  ?>js/jquery-ui.min.js"></script>
    <script src="<?php echo $dir;  ?>js/jquery.slicknav.js"></script>
    <script src="<?php echo $dir;  ?>js/mixitup.min.js"></script>
    <script src="<?php echo $dir;  ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo $dir;  ?>js/main.js"></script>
    <script src="<?php echo $dir;  ?>js/bizr-profile-1.js"></script>
    <script src="<?php echo $dir;  ?>js/cart.js"></script>
	
     
</body>
</html>
	<?php 
}//end function footer
	?>



	<?php 
//notification modal display function
function notif_dialog($dir=""){
	?>
 <!-- The Modal -->
<div id="myNotif" class="notif" style="display:none;">

  <!-- Modal content -->
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 "  role="dialog" style="background-color:#000066; padding:0px;margin:auto;" class="modal-content-notif">
    <div id="modal_title" style="margin-top:15px; padding-left:10px; color:white; font-size:16px; float:left; text-align:center; width:80%;"></div> <span id="close_notif" class="close_notif">&times;</span>
	<br>
	<br>
	<center> <div style="padding:10px; color:#fff;" id="err_msg"> </div></center>
 <div id="sbmt_loader" style="display:none; padding:10px;">
     <center>
        <img  style="width:50px; top:50%;" src="<?php echo $dir;?>icons/loading.gif">
        <div style="color:#aeaeae;" >processing..</div>
         </center>
        </div>
	<div id="notif_display" class="col-sm-12 col-xs-12" style="padding:0px; min-width:300px;">
	<center>
        <div id="loader" style="display:none; padding:10px;">
        <img  style="width:50px; top:50%;" src="<?php echo $dir;?>icons/loading.gif">
        <div style="color:#aeaeae;">processing...</div>
		<span id="get_dir" style="display:none;"><?php echo $dir;?></span>
        </div>
        </center>
   </div>
	
     
  </div>

</div>

<?php
}//end function notif_dialog
?>

<?php 
//general modal display function
function modal($dir=""){
	?>
<div id="myModal" class="modal" style="display:none;">

  <!-- Modal content -->
  <div class="modal-content col-md-6 col-sm-6 col-xs-12 col-sm-offset-3 col-md-offset-3" style="padding:0px;">
    <span class="close">&times;</span>
	<br>
	<br>
	<div id="my_form">
	<center><img id="pre_loader" style="width:50px; display:none; top:50%;" src="<?php echo $dir;?>icons/loading.gif"> </center>
	</div>
     
  </div>

</div>
<?php
}//end function modal
?>

<?php
function login_option($dir=""){
$option ="<div id='loginOption' class='row' style='background-color:#eaeaea; padding:0px !important; margin:1px !important;'> <center> <br> <span style='color:green; margin-top:5px; font-weight:bold;' >Login Here</span> </center> <div class='col-sm-6 col-xs-6col-sm-6 col-xs-6'><span class='btn btn-default pull-right' onclick='userLogin();'><span style='color:grey; margin-right:2px;' class='glyphicon glyphicon-user'> </span>  Personal Account</span> </div> <div class='col-sm-6 col-xs-6'><span class='btn btn-default' onclick='companyLogin();'> <span style='color:grey; margin-right:2px;' class='glyphicon glyphicon-briefcase'> </span> Business Account</span> </div><center> <div style='font-weight:bold; display:block; margin-top:58px; margin-bottom:-10px; color:green; display:block;'>Are you new? </div> <button class='profile_btn' onclick='allSignup();' style='margin:20px 15px; padding:5px;'>Signup</button> </center> </div> ";
return $option;
}//end function login_option
?>

<?php
function company_login($dir=""){
?>
<div id="company_login" style='display:none; background-color:#fefefe; color:white !important;'>
<div class="popup_border">
<form method="post">
    <div class="sub_head bd_b"> <center> <img src="<?php echo $dir; ?>icons/login.png" style="width:20px;">  Company Login </center> </div> 
<span class="input_title">Enter your email</span>
  <input class="modal_input" type="text" name="username" required="required">
  <span class="input_title">Enter your password</span>
  <input class="modal_input" type="password" name="password" required="required">
  <br>
    <input style="margin:10px 0px 10px 10px; " type="checkbox" name="keep_me_in" value="signed_in"> <span style=" color:navy; font-weight:bold;"><i>Keep me signed in</i></span> <a href="<?php echo $dir; ?>recover/"><span style="float:right; margin:10px 10px 10px 10px; color:red; font-weight:bold;"><i>Forgot Password?</i></span></a>
	<br>
 <center> <button class="login_btn"  type="submit" name="submit_login_company">Login</button> </center>

  </form>
<div onclick='backLogin();' class="back"> Back </div>
</div>
</div>
<?php
}//end function company_login
?>

<?php
function user_login($dir=""){
?>
<div id="user_login" class="form_modal" style="display:none;">
<div class="popup_border">
<form method="POST" >
    <div class="sub_head bd_b">  <center> <img src="<?php echo $dir; ?>icons/login.png" style="width:20px;"> User Login </center> </div> 
<span class="input_title">Enter your email</span>
  <input class="modal_input" type="text" name="username" required="required">
  <span class="input_title">Enter your password</span>
  <input class="modal_input" type="password" name="password" required="required">
  <br>
    <input style="margin:10px 0px 10px 10px; " type="checkbox" name="keep_me_in" value="signed_in"> <span style=" color:navy; font-weight:bold;"><i>Keep me signed in</i></span> <a href="<?php echo $dir; ?>recover/"><span style="float:right; margin:10px 10px 10px 10px; color:red; font-weight:bold;"><i>Forgot Password?</i></span></a>
  <br>
  <center> <button class="login_btn"  type="submit" name="submit_login_user">Login</button> </center>
</form>
<div onclick="backLogin();" class="back">Back </div>
</div>
</div>
<?php
}//end function user_login
?>

<?php
function user_signup($dir=""){
?>

<div id='signupOption' class='row' style="display:none; background-color:#eaeaea; padding:0px !important; margin:1px !important;">
<center> 
<button class='profile_btn' style='margin:5px; padding:5px;' onclick="userSignup();"><span style="color:grey; margin-right:2px;" class="glyphicon glyphicon-user"> </span> Personal Account</button>

<a href='<?php echo $dir; ?>company_listing/'> 
<button class='profile_btn' style='margin:5px; padding:5px;'><span style="color:grey; margin-right:2px;" class="glyphicon glyphicon-briefcase"> </span>  Business Account</button>
</a>
<br>
<hr>
<b style="color:green;"> Already have account? </b>
<br>
 <button class='profile_btn' onclick="backLogin();"> Login </button>
 <br>
 <div onclick="backLogin();" class="back">Back </div>
</center></div>

<div id="signup_form" class="form_modal" style="display:none; padding:10px;">
<div class="popup_border">
<div class="sub_head text-center bd_b"> Personal Account</div>
<form method="POST">
<span class="input_title">Full Name </span>
  <input id="full_name" class="modal_input" type="text" name="company_name" required="required">
  <div id="fn_msg" style="color:red;">  </div>
  <span class="input_title">Email</span>
  <input id="user_email" class="modal_input" type="text" name="email" required="required">
  <div id="email_message" style="color:red;">  </div>
  <span class="input_title">Phone No</span>
  <input id="user_ph" class="modal_input" type="text" name="phone" required="required">
  <div id="user_phone" style="color:red;">  </div>
  <span class="input_title">Password (<i> Not less than 6 </i>)</span>
  <input id="user_pw" class="modal_input" type="password" name="password" required="required">
  <div id="pw1" style="color:red;">  </div>
  <span class="input_title">Confirm Password</span>
  <input id="re_user_pw" class="modal_input" type="password" name="re_password" required="required">
  <div id="pw2" style="color:red;">  </div>
  <div class="col-xs-12"> By signing up, you agree to the bizrator.com's <a href="<?php echo $dir;?>policy/">privacy policy</a> and <a href="<?php echo $dir;?>terms-of-use/">Terms of use</a> </div>
 <center> <button onclick="return validate_user();" id="signup_user" class="reg_btn" type="submit" name="submit_register">Signup</button> </center>
 </form>
<div onclick="backLogin();" class="back"> Back </div> 

</div>
</div>
<?php
}//end function user_signup
?>


