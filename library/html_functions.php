<?php
//main menu function
//$dir is use to set directory level for individual pages
//$menu_search is use to set if menu mobile search will be displayed or not
 
function main_menu($title, $meta_key, $meta_desc, $dir = "", $pg="", $pg2=""){
	?>
	
<!DOCTYPE html>
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
    <meta name="keywords" content="HTML,CSS,JavaScript">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=1200, initial-scale=0.0">
		<link rel="icon" href="https://www.vortexcrypto-raise.org/assets/images/favicon.png" type="image/ico">
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="<?php echo $dir; ?>asset/w3.css">
		<!-- CSS -->
		<!-- Bootstrap -->
    <link href="<?php echo $dir; ?>asset/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $dir; ?>asset/jquery.css" rel="stylesheet">
    <link href="<?php echo $dir; ?>asset/cryptocoins.css" rel="stylesheet">
		<!-- Simple line icons -->
		<link href="<?php echo $dir; ?>asset/simple-line-icons.css" rel="stylesheet">
    <!-- Font awesome icons -->
    <link href="<?php echo $dir; ?>asset/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $dir; ?>asset/font-awesome-animation.css" rel="stylesheet">
    <!-- Calendar -->
    <link rel="stylesheet" href="<?php echo $dir; ?>asset/w3.css">
    <link rel="stylesheet" href="<?php echo $dir; ?>asset/font-awesome_002.css">
    <link href="<?php echo $dir; ?>asset/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo $dir; ?>asset/jquery_002.css" rel="stylesheet">
		<!-- Custom Style -->
    <link href="<?php echo $dir; ?>asset/select2.css" rel="stylesheet">
		<link href="<?php echo $dir; ?>asset/custom.css" rel="stylesheet">
    <link id="ui-current-skin" href="<?php echo $dir; ?>asset/skin-yellow.css" rel="stylesheet">
    <link href="<?php echo $dir; ?>asset/media.css" rel="stylesheet">
    <!-- Charts -->
    <link href="<?php echo $dir; ?>asset/rickshaw.css" rel="stylesheet">
    <!-- Custom Font -->
    <link href="<?php echo $dir; ?>asset/css.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $dir; ?>css/custom_css.css" type="text/css" media="all" />
	<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style><style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>
  <body class="preloader-off developer-mode pace-done nav-md"><div id="chat-application" style="display: block; z-index: 2147483647; position: fixed; overflow: hidden; bottom: 8px; left: initial; right: 6px; max-height: 58px; max-width: 61px; height: 58px; width: 61px; background: transparent none repeat scroll 0% 0%;"><iframe id="chat-application-iframe" title="Smartsupp" aria-hidden="true" style="width: 100%; height: 100%; border: medium none; position: absolute; left: 0px; z-index: 10000001;"></iframe></div><div class="pace  pace-inactive"><div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%" data-progress="99">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
    <div class="pace-cover"></div>
    <div id="st-container" class="st-container st-effect">
      <!-- MAIN PAGE CONTAINER -->
      <div class="container body">
        <div class="main_container">
          <!-- LEFT PRIMARY NAVIGATION -->
          <div class="col-md-3 left_col">
            <div class="scroll-view">
              <div class="navbar nav_title">
                <h1 class="logo_wrapper">
                  <a href="<?php echo $dir; ?>" class="site_logo">
                    <img class="logo" src="<?php echo $dir; ?>img/logo_bank.png" alt="cryptic logo">
                    
                  </a>
                </h1>
              </div>
              <div class="clearfix"></div>
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section active">
                  <h3>Hello <?php echo $_SESSION['user_n']; ?>!</h3>
                  <div class="clearfix"></div>
                  <ul class="nav side-menu">
                    <li class="active">
                      <a href="<?php echo $dir; ?>dashboard/"><i class="fa fa-home"></i> <span>Account</span></a>
                      
                    </li>
					<li><a><i class="fa fa-refresh"></i> <span>Transfer <span class="fa fa-angle-down"></span></span> </a>
                      <ul class="nav child_menu">
                        <li><a href="../transfer-own-bank/"> <span>Own Bank</span></a></li>
                        <li><a href="../transfer-other-bank/"> <span>International Bank Transfer</span></a></li>
                        <li><a href="../e-currency/"> <span>E-Currency</span></a></li>
                      </ul>
                    </li>
                    <!--<li class="current-page"><a href="<?php echo $dir; ?>invest-now/"><i class="fa fa-credit-card"></i> <span>Deposit <span class="label label-danger">Hot</span></span></a>
                      
                    </li>-->
                     <li><a href="../statement/"><i class="fa fa-database"></i> <span>Account Statement</span></a></li>
                    <li>
                      <a href="../e-deposit/"><i class="fa fa-credit-card"></i> <span>E-Deposit</span></a>
                      
                    </li>
                    
                   
                    <li>
                      <a href="../our-branch/"><i class="fa fa-external-link"></i> <span>Our Branch</span></a>
                      
                    </li>
                   
                    <li><a href="<?php echo $dir; ?>profile/"><i class="fa fa-user-plus"></i> <span>Account Settings</span></a>
                      
                    </li>
					
					<li><a href="<?php echo $dir; ?>reset/"><i class="fa fa-edit"></i> <span>Change Password</span></a>
                      
                    </li>
					<li><a href="<?php echo $dir; ?>logout/"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                      
                    </li>
                    
                </ul></div>
                
                
              </div>
              <!-- /sidebar menu -->
              
            </div>
          </div>
          <!-- TOP SECONDARY NAVIGATION -->
          <div class="top_nav" style="padding-left:10px;">
            <div class="nav_menu">
              <ul class="nav navbar-nav navbar-left">
                <li class="toggle-li">
                  <div class="nav toggle burger-nav">
                    <a id="menu_toggle">
                      <div class="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>
                    </a>
                  </div>
                </li>
                <li class="megamenu-li">                  
                  <!-- megamenu -->
                  <div class="megamenu-dropdown-wrapper">
                    <a class="megamenu-dropdown-trigger megamenu-trigger" href="#0">
                      <i class="fa fa-refresh"></i>
                      <span> Transfer </span>
                      <span class="fa fa-angle-down"></span>
                    </a>
                    <nav class="megamenu-dropdown">
                      <a href="#0" class="megamenu-close">Close</a>
                      <ul class="megamenu-dropdown-content">
                        <li>
                          <a href="../transfer-own-bank/">Own Bank <!--<span class="label label-danger">0.00</span>--></a>
                           
                        </li> <!-- .has-children -->
						<li>
                          <a href="../transfer-other-bank/">International Bank Transfer <!--<span class="label label-danger">0.00</span>--></a>
                           
                        </li> <!-- .has-children -->
                        <!--<li>
                          <a href="#">Litecoin <span class="label label-danger">0.00</span></a>
                          
                        </li> <!-- .has-children -->
                        <!--<li>
                          <a href="#">Ethereum <span class="label label-danger">0.00</span></a>
                          
                        </li> <!-- .has-children -->
                        <!--<li>
                          <a href="#">DASH <span class="label label-danger">0.00</span></a>
                          
                        </li> <!-- .has-children -->
                        
                      </ul> <!-- .megamenu-dropdown-content -->
                    </nav> <!-- .megamenu-dropdown -->
                  </div> <!-- .megamenu-dropdown-wrapper -->
                  <!-- megamenu -->              
                </li>
                
                
              </ul> <!-- top menu ul -->
              <ul class="nav navbar-nav navbar-right">
                
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				  			<?php 
	if(empty($_SESSION['passport'])){
	?>
                    <img src="<?php echo $dir; ?>img/icon/avatar.jpg" alt="">
					<?php
	}else{
		
	?>
	<img src="<?php echo $dir; ?>passport/<?php echo $_SESSION['passport']; ?>" alt="">
	<?php
	}//end if
	?>
                  </a> 
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo $dir; ?>profile/">Profile</a></li>
                   
                    <li><a href="../reset/">Change Password</a></li>
                    <li><a href="<?php echo $dir; ?>logout/"><i class="fa fa-sign-out pull-right"></i>Log Out</a></li>
                  </ul>
                </li>
               
                
                
              </ul>
            </div>
			
          </div>
		  
	<!--<div style="margin-top:130px;"> </div>-->
	
	<!-- Loader icon bootstrap -->
	 <div id="round_loader" class="spinner-border  float-right" role="status" style="top:0; right:0; position:fixed; display:inline-block; z-index:99999999; color:purple; margin-right:20px; display:none;">
 </div>
	
	
						
	<div class="row">
		<?php
modal($dir);
notif_dialog($dir);
//rotate();
//echo $_SESSION['notification'];
//unset($_SESSION['notification']);
?>

	</div>
	<div id="msg">  </div>
	

	<div class="right_col" id="dashboard-v2" role="main" style="min-height: 349px;">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
	
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
//Footer function
function footer1($dir=""){
	?>

<a href="#" class="scrollToTop"><i class="fa fa-chevron-up text-white" aria-hidden="true"></i></a>
</div>
         
 <div class="spacer_30"></div>
<!-- PAGE FOOTER -->
          <footer>
					
					 <div class="pull-right" >
          <a href="mailto:info@babankonline.com" style="color:blue;"> <i class="fa fa-envelope"></i> info@babankonline.com</a>         
			  </div>

			  <div class="pull-right" style="margin-right:20px;">
              &copy Babankonline.com           
			  </div>
			  
			 
            <div class="clearfix"></div>
          </footer>
        </div>
        <!-- RIGHT SIDE SIDEBAR NAVIGATION -->
        
      </div>
      <!-- RIGHT SIDE: SEARCH FORM -->
      <div class="search search-main">
        <div id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
          <i class="fa fa-times"></i>
        </div>
        <form class="search__form" action="search.html"><input type="hidden" name="form_id" value="15928110175518"><input type="hidden" name="form_token" value="0968533ce3566651856005312c6d4a7c">
          <input class="search__input" name="search" type="search" placeholder="Hash, transactions..." autocomplete="off" autocapitalize="none" spellcheck="false">
          <span class="search__info">Hit enter to search or ESC to close</span>
        </form>
      </div>
      <!-- JS SCRIPTS -->
      <script src="<?php echo $dir; ?>asset/jquery_005.js"></script>
      <script src="<?php echo $dir; ?>asset/jquery_004.js"></script>
      <script src="<?php echo $dir; ?>asset/modernizr.js"></script>
      <script src="<?php echo $dir; ?>asset/classie.js"></script>  
      <script src="<?php echo $dir; ?>asset/bootstrap.js"></script>
      <script src="<?php echo $dir; ?>asset/jquery_003.js"></script>
      <!-- CALENDAR -->
      <script src="<?php echo $dir; ?>asset/moment.js"></script>
      <script src="<?php echo $dir; ?>asset/fullcalendar.js"></script>
      <script src="<?php echo $dir; ?>asset/jquery.js"></script>
      <!-- Custom Charts Scripts -->
      <script src="<?php echo $dir; ?>asset/Chart.js"></script>
      <script src="<?php echo $dir; ?>asset/utils.js"></script>
      <script src="<?php echo $dir; ?>asset/charts.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="<?php echo $dir; ?>asset/custom.js"></script>
      <script src="<?php echo $dir; ?>asset/preloader.js"></script>
      <script>
        $(document).ready(function(){
          $('#data-tables-markets-1').DataTable();
        });
      </script>
      <script src="<?php echo $dir; ?>asset/jquery_002.js"></script>
      <script src="<?php echo $dir; ?>asset/jquery_003.js"></script>
      <script src="<?php echo $dir; ?>js/bizr-profile-1.js"></script>
    <script src="<?php echo $dir;  ?>js/cart.js"></script>

    </div>



</body></html>

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


