<?php
session_start();
include('library/library.php');
$dir = "";	
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="The smartest bank for business and economic growth">
    <meta name="keywords" content="Barclays bank">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="img/fav.jpeg">
    <title>World Largest Bank</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
	
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/multi-animated-counter.js"></script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/animate.css" type="text/css">
    <link rel="stylesheet" href="css/owl.transitions.css" type="text/css">
    <link rel="stylesheet" href="css/custom_css.css" type="text/css">
    <link rel="stylesheet" href="css/hallooou.css" type="text/css">
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
							<li><a href="#about-us">About</a></li>
                            <li><a href="#services">Services</a>
                                <ul class="header__menu__dropdown">
                            <li><a href="#">Loan</a></li>
                                </ul>
                            </li>
                            <li><a href="./gallery/">Gallery</a></li>
                            <li><a href="#team">Team</a></li>
                            <li><a href="#testimonial">Testimonial</a></li>
                            <li><a href="#contact">Contact</a></li>
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
                                +2348169920495 
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
							<div class="header__top__right__auth"> <a href="sign-up/">Register</a> </div> |
                            <div class="header__top__right__auth" style="max-width:132px">
							
							<?php if(isset($_SESSION['user_id'])){ $account = $dir."account/"; echo "<a title='view Profile' href='$account'><i style='font-size:18px;' class='fa fa-user'></i> ".$_SESSION['user_name']."</a>";}else{ ?>
                               <a href="login/" style="cursor:pointer;"><i class="fa fa-user"></i> Login </a>
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
					<a href="login/">  Login</a>
					</div> |
                            <div class="header__top__right__auth" style="max-width:132px">
                      
					<a href="sign-up/">Register</a> 
							
                        </div>
                    </div>
                </div>
		
        <div class="" style="background-color:#000066; width:100% !important; height:70px; box-shadow:0px 1px 1px 0px black; -moz-box-shadow:0px 1px 1px 0px black; -webkit-box-shadow:0px 1px 1px 0px black;">

            <div class="row">
                <div class="col-lg-3" style="padding:0px;">
                    <div class="header__logo">
                        <a href="<?php echo $dir ?>"><img class="logo_img" src="img/logo_bank.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="<?php echo $dir; ?>">Home</a></li>
							<li><a href="#about-us">About</a></li>
                            <li><a href="#services">Services</a>
                                <ul class="header__menu__dropdown">
                            <li><a href="#">Loan</a></li>
                                </ul>
                            </li>
                            <li><a href="./gallery/">Gallery</a></li>
                            <li><a href="#team">Team</a></li>
                            <li><a href="#testimonial">Testimonial</a></li>
                            <li><a href="#contact">Contact</a></li>
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
modal();
notif_dialog();
//echo $_SESSION['notification'];
//unset($_SESSION['notification']);
?>
	</div>
	<div id="msg">  </div>
	
	
    <!-- Hero Section Begin -->
    <section class="hero hero-normal" style="margin-top:-20px; padding:0px !important;">
        <div class="container" style="padding:0px; margin:0px !important;">
            <div class="row slide_row" style="width:105% !important; margin:0px !important;">
                <div class="col-lg-12" style="margin:0px; width:100%; padding:0px;">
					
					
					<div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item" style="background-image:url('img/slide/bslide.png');">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__text">
                                            </div>
                                        </a>
                                    </div>
									<div class="latest-prdouct__slider__item" style="background-image:url('img/slide/mo_slide.png');">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__text">
                                            </div>
                                        </a>
                                    </div>
									
                                    <div class="latest-prdouct__slider__item" style="background-image:url('img/slide/barclay_slide1.png');">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__text">
                                            </div>
                                        </a>
                                    </div>
                                </div>
					
					
					
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

	 <!-- Featured Section Begin -->
    <section id="services" class="featured spad" style="margin-top:10px; scroll-margin-top:120px;"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
			
			We offer a breath of expertise, catering to the executive and business professional. Our bank are committed to providing tailor-made solutions for each of our clients, pairing you with the financial tools you will need for continued success.
			
			<div class="container">
			<div class="row">
			
			<div class="col-sm-4 col-md-4 col-lg-4 service_div">
			<div class="wow fadeInRight service_img" data-wow-delay="0.3s" > 
			<img class="img_icon" src="img/icon/loan.png">
			</div>
			<h2>Loans</h2>
			<p> 
			We give loan to our regular customers within 24 hours
			</p>
			</div>
			
			<div class="col-sm-4 col-md-4 col-lg-4 service_div">
			<div class="wow fadeInRight service_img" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/savings.png">
			</div>
			<h2>Savings</h2>
			<p> 
			As your account balance grows, your interest rate has the potential to increase too
			</p>
			</div>
			
			<div class="col-sm-4 col-md-4 col-lg-4 service_div">
			<div class="wow fadeInRight service_img" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/fund_t.png">
			</div>
			<h2>Funds Transfer</h2>
			<p> 
			We help our customers tranfer fund to any part of the world without any extra charges
			</p>
			</div>
			
			<div class="col-sm-4 col-md-4 col-lg-4 service_div">
			<div class="wow fadeInLeft service_img" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/online-banking.png">
			</div>
			<h2>Online Banking</h2>
			<p> 
			keep track of your banking activities, view your banking statement, financial coaching and lots more on our online platform
			</p>
			</div>
			
			<div class="col-sm-4 col-md-4 col-lg-4 service_div">
			<div class="wow fadeInLeft service_img" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/prepaid-card.png">
			</div>
			<h2>Prepaid Card</h2>
			<p> 
			We provide different card solutions for convinient banking online and offline
			</p>
			</div>
			
			<div class="col-sm-4 col-md-4 col-lg-4 service_div">
			<div class="wow fadeInLeft service_img" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/private.png">
			</div>
			<h2>Private Banking</h2>
			<p> 
			Our bank provide personalized banking services for individual customers on request
			</p>
			<p>
			</div>
			
			</div>
				
            </div>
            </div>
			
			
        </div>
		
    </section>
    <!-- Featured Section End -->
	

	
	
	 <!-- About us Begin -->
    <section id="about-us"  class="featured spad counter-section" style="margin-top:10px; padding:20px; background-color:black; color:white; scroll-margin-top:120px;"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 style="color:white;">About Us</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
			
			<p style="color:#aeaeae;">
			We are proud to be a leading bank, but we don't rest on a local laurels. We strive to be high touch and high tech. We are leading the market with advanced technology to provide convinience and security, but we still love to interact with our customers in personalized and awesomely unexpected ways. We are bank with super-impressive services and capabilities.
			</p>
			
			
			<div class="col-sm-3 col-md-3 col-lg-3 text-center">
			<div class="margin_top_10">
			<div class="wow fadeInRight" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/branch.png">
			</div>
			 <div id="counters_1">
            <div class="counter" data-TargetNum="120" data-Speed="2000">120</div>
			</div>
			  <h5 class="text-white"><b>Branches</b></h5>
			</div>
			</div>
			
			<div class="col-sm-3 col-md-3 col-lg-3 text-center">
			<div class="margin_top_10">
			<div class="wow fadeInRight" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/assets.png">
			</div>
			   <div id="counters_2">
            <div class="counter" data-TargetNum="2345" data-Speed="2000">2345</div>
			</div>
			  <h5 class="text-white"><b>Personal Loans</b></h5>
			</div>
			</div>
			
			<div class="col-sm-3 col-md-3 col-lg-3 text-center">
			<div class="margin_top_10">
			<div class="wow fadeInRight" data-wow-delay="0.3s">
			<img class="img_icon" src="img/icon/atm.png">
			</div>
			   <div id="counters_3">
            <div class="counter" data-TargetNum="5000" data-Speed="5000">5000</div>
			</div>
			  <h5 class="text-white"><b>ATM's</b></h5>
			</div>
			</div>
			
			<div class="col-sm-3 col-md-3 col-lg-3 text-center">
			<div class="margin_top_10">
			<div class="wow fadeInRight" data-wow-delay="0.3s"> 
			<img class="img_icon" src="img/icon/savings_dep.png">
			
			  <div id="counters_3">
            <div class="counter" data-TargetNum="2050000" data-Speed="2000">2M+</div>
			</div>
			  <h5 class="text-white"><b>Deposit Accounts</b></h5>
			</div>
			</div>
			</div>
			
			<hr style="width:100%; ">
	<div class="row">
	<div class="col-lg-12"> <center>
	<div class="section-title">
                        <h2 style="color:white;">Why Customers Choose Us</h2>
                    </div>
	</center></div>
	
	<div class="col-sm-4 col-md-4 col-lg-4 text-center">
	<div class="why_us">
			<div class="wow fadeInRight" data-wow-delay="0.3s">
			<h4 class="hd_choose"> Purpose And Values</h4>
			</div>
			  <p> 
			  Our common purpose is creating creating opportunities to rise. We are a financial company of opportunity makers working together to help people rise--Our customers, Clients and Society
			  </p>
			</div>
			</div>
			
			<div class="col-sm-4 col-md-4 col-lg-4 text-center">
			<div class="why_us">
			<div class="wow fadeInRight" data-wow-delay="0.3s">
			<h4 class="hd_choose"> Our Strategy </h4>
			<p>
			Our strategy is to deliver strong returns, by building on our strenght as a Transatlantic Consumer and Wholesale Bank, with global reach. This strategy is designed to ensure that we are resilient across the economic cycle by being well diversified both in our business, and in our geographic footprint.
			</p>
			</div>
			  
			</div>
			</div>
			
			<div class="col-sm-4 col-md-4 col-lg-4 text-center">
			<div class="why_us">
			<div class="wow fadeInRight" data-wow-delay="0.3s">
			<h3 class="hd_choose"> Economic  Growth</h3>
			<p>
			Our Bank has been part of the fabric of the UK for over 28 years. In addition to our role in the UK as a leading employer and provider of financial services across all segments of the economy, we will also pursue targeted local economic growth initiatives working in partnership with a range of stakeholders.
			</p>
			</div>
			</div>
			  
			</div>
	
	</div>
	
	</div>
	</div>
	</section>
	
	<br>
	<div class="container">
	<center> <h3><b>Our Core Values</b></h3> </center>
	<div class="row">
	
	<div class="col-sm-8">
	<div style="border-right:2px solid #000066;">
	<div  class="row">
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-6 how_it_works" >
				<div class="how_it_works_item" style="background-color:#000066;">
				<div class="how_it_works_icon"> 1 </div>
				
				<p> 
				Strong, Stable banking partner with a proven track record of success
				</p>
				
				</div>
				</div>
				
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-6">
				<div class="how_it_works_item" style="border:1px solid #000066;">
				<div class="how_it_works_icon s" style="border:1px solid #000066;"> 2 </div>
				<p>
				Premium relationship-based pricing on interest-bearing accounts
				</p>
				</div>
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 how_it_works">
				<div class="how_it_works_item" style="background-color:#000066;">
				<div class="how_it_works_icon"> 3 </div>
				<p>
				Benefit from a dedicated, highly experienced relationship officer
				</p>
				</div>
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-6">
				<div class="how_it_works_item" style="border:1px solid #000066;">
				<div class="how_it_works_icon s" style="border:1px solid #000066;"> 4 </div>
				<p>
				Convenient one-on-one personalized service at your home or office
				</p>
				</div>
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-6 how_it_works">
				<div class="how_it_works_item" style="background-color:#000066;">
				<div class="how_it_works_icon"> 5 </div>
				<p>
				Expedited responses to all banking and loan request
				</p>
				</div>
				</div>
	
	</div>
	
	
	</div>
	
	</div>
	
	<div class="col-sm-4">
	<h4>Our President</h4>
	<p>
	We strive to be the bank that is running ahead of the pack, Creating better options and opportunity for our customers, businesses, and individuals. We are working hard to build a strong team culture, constantly encouraging each other to think creatively for a demanding growth
	</p>
	<div class="row">
	
	<div class="col-sm-6 col-6">
	<img style="width:80px;" src="img/icon/sign.png">
	</div>
	
	<div class="col-sm-6 col-6">
	<h4> Our President/CEO </h4>
	</div>
	
	</div>
	
	
	</div>
	
	</div>
	</div>
	
<br>
    <!-- Banner Begin -->
    <div id="team" class="" style="scroll-margin-top:120px; margin-top:20px; margin-bottom:20px;">
        <div class="container">
		<div style="margin:20px;">
		<center> <h2> Our Professional Team </h2> </center>
		</div>
            <div class="row">
			
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
				<div class="wow fadeInLeft"><img src="img/team/chris.jpg"></div>
				<div style="background-color:black; padding:10px; text-align:center; color:#fff;"> 
				<b> Steven Knapp </b>
				<br>
				Executive Manager
				</div>
                </div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 col-6">
				<div class="wow fadeInLeft"><img src="img/team/mandee.jpg"></div>
				<div style="background-color:black; padding:10px; text-align:center; color:#fff;"> 
				<b> Lindsay Borgeson </b>
				<br>
				Finance Director
				</div>
                </div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 col-6">
				<div class="wow fadeInRight"><img src="img/team/baker.jpg"></div>
				<div style="background-color:black; padding:10px; text-align:center; color:#fff;"> 
				<b>Kathryn Barker </b>
				<br>
				Comercial Lender
				</div>
                </div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 col-6">
				<div class="wow fadeInRight"><img src="img/team/rojer.jpg"></div>
				<div style="background-color:black; padding:10px; text-align:center; color:#fff;"> 
				<b>Derek Liedle </b>
				<br>
				Vice President
				</div>
                </div>
				
               
				
            </div>
        </div>
    </div>
    <!-- Banner End -->
	
	
	<!-- Categories Section Begin -->
    <section id="testimonial" class="categories" style="scroll-margin-top:120px;">
        <div class="container">
		<div style="width:100%; text-align:center; margin-top:20px; margin-bottom:20px;">
		<h2 style="display:inline-block;"> Testimonial</h2>   <span class="sm_login" style="margin:10px; color:#ff4000;"> <i class="fa fa-long-arrow-left"></i> swipe <i class="fa fa-long-arrow-right"></i></span></div> 
            <div class="row">
                <div class="categories__slider owl-carousel">
				
				<div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="categories__item set-bg" data-setbg="img/team/team-6.png">
                            <h5><a href=""><span> Barclays has helped me to be gain financial freedom </span></a></h5>
					
							<a href="">
							<button type="submit" class="order-btn categories_ord_btn">Bradinth Kelv</button>
							</a>
                        </div>
                    </div>
					
					<div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="categories__item set-bg" data-setbg="img/team/team-9.jpeg">
                            <h5><a href=""><span> I am financially free because of Barclays </span></a></h5>
					
							<a href="">
							<button type="submit" class="order-btn categories_ord_btn">Crysty Bryt</button>
							</a>
                        </div>
                    </div>
					
					<div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="categories__item set-bg" data-setbg="img/team/team-7.jpeg">
                            <h5><a href=""><span> My business is in the right track. Thanks to Barclays </span></a></h5>
					
							<a href="">
							<button type="submit" class="order-btn categories_ord_btn">Bonad Freeman</button>
							</a>
                        </div>
                    </div>
					
					<div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="categories__item set-bg" data-setbg="img/team/team-8.jpeg">
                            <h5><a href=""><span> My retirement is an awesome experience with Barclays</span></a></h5>
					
							<a href="">
							<button type="submit" class="order-btn categories_ord_btn">Meredeth Kathryn</button>
							</a>
                        </div>
                    </div>
					
					
                    </div>
				
                </div>
				
            </div>
			
        </div>
		
    </section>
    <!-- Categories Section End -->
	
<br>
    <!-- How we serve you Begin -->
    <section class="how_serve_you" id="contact" style="scroll-margin-top:120px;">
	<div class="container">
	<div class="col-lg-12">
				<div class="section-title from-blog__title">
                        <h2>Contact Us</h2>
                    </div>
				
				</div>
            <div class="row latest-prdouct__slider__ite" style="background-image:url('img/team/customer_care.jpg'); ">
				
				<div class="col-sm-6 col-md-6" style="padding:0px;"> 
				<div style="background:rgba(0,0,0, 0.6); border-radius:8px; padding:10px; color:#fff; margin-bottom:10px;"> 
				<h4 class="text-white"> Get In Touch </h4>
				<span class="fa fa-phone"></span> +440986807 <br>
				<span class="fa fa-envelope"></span> info@babankonline.com <br>
				<span class="fa fa-envelope"></span> Physical address goes here
				
				<hr>
				<h5 class="text-white"> <b>Subscribe to receive customer insights and updates</b> </h5>
				<form>
				<input class="form-control">
				<div style="margin:5px;">
				<center><button class="site-btn"> Subscribe </button></center>
				</div>
				</form>
				
				</div>
				</div>
				
				<div class="col-sm-6 col-md-6" style="padding:0px;"> 
				<div style="background:rgba(0,0,0, 0.6); border-radius:8px; padding:10px; color:#fff; margin-bottom:10px;"> 
				<h4 class="text-white"> <b>Write Us a Message</b> </h4>
				<br>
				
				<form  id="contact_msg" class="ajax-form" method="post" action="contact/send_msg.php">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name..." value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email..." value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Your phone..." value="" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="4" name="msg" placeholder="Your message..." required></textarea>
                                </div>
                                <div class="form-group">
								<input type="hidden" name="submit_contact"/>
                                    <button onclick="ajax_sub('contact_msg');" type="submit" name="submit_contact" class="site-btn"><i class="fa fa-paper-plane fa-fw"></i> Send</button>
                                </div>
                            </form>
							
				</div>
				</div>
				
				</div>
				
				</div>
	
     
	</section>
	<!-- How we serve you End -->

	<!-- Blog Section Begin -->
    <section class="from-blog spad" id="why-customers-choose-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Open a Free Account Today</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/professional-service.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <h5><a href="#"> Savings </a></h5>
                            <p>As your account balance grows, your interest rate has the potential to increase too.  </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/loan.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <h5><a href="#"> Loan </a></h5>
                            <p>We give instant loan to our customers </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/consultation-support.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <h5><a href="#"> Fast Service </a></h5>
                            <p>We are fast in our processes concerning our services, 24/7 customer care support and many more agent that helps in making the service fast</p>
                        </div>
                    </div>
                </div>
            </div>
			
			<center> <a href="sign-up/"> <button class="site-btn"> Create Account </button></a> </center>
			
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad" style="background-color:black;">
        <div class="container">
		<center><p style="color:#aeaeae;"> 
		We are a full service bank with a comprehensive menu of products and expertise: personal, business, and real estate(residential and mortgage) banking and trust services.
		</p> </center>
            <div class="row">
			<div class="col-sm-6 col-6">
			<img style="width:200px;" src="img/icon/fdi_lender.png">
			</div>
			<div class="col-sm-6 col-6">
			<img src="img/icon/sba_lender.png">
			</div>
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> <a href="" target="_blank"style="color:#fff;" >Barclays Bank Online</a>  All rights reserved 
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/hallooou.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bizr-profile-1.js"></script>
    <script src="js/cart.js"></script>
	



</body>

</html>