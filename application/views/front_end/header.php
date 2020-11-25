<!doctype html>
<html class="no-js" lang="zxx">
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Turban Restaurant</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="manifest" href="site.php"> -->
		<link rel="shortcut icon" type="image/x-icon" href="assets/front/img/favicon.ico">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="assets/front/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/front/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/front/css/animate.min.css">
        <link rel="stylesheet" href="assets/front/css/nice-select.css">
        <link rel="stylesheet" href="assets/front/css/themify-icons.css">
        <link rel="stylesheet" href="assets/front/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/front/css/meanmenu.css">
		<link rel="stylesheet" href="assets/front/css/fontawesome-all.min.css">
		<link rel="stylesheet" href="assets/front/css/slick.css">
		<link rel="stylesheet" href="assets/front/css/default.css">
		<link rel="stylesheet" href="assets/front/css/style.css">
		<link rel="stylesheet" href="assets/front/css/responsive.css">
	</head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

		<!-- header-start -->
		<header>
			<div id="sticky-header" class="header-top-area header-2 pr-60 pl-60">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-3 col-lg-2" style="
						padding-bottom: 20px;
					">
							<div class="logo">
								<a href="index.php"><img src="assets/front/img/logo/logo.png" width="20%" /></a>
							</div>
						</div>
						<div class="col-xl-6 col-lg-8" style="
						padding-top: 20px;
					">
							<div class="main-menu text-center">
								<nav id="mobile-menu">
									<ul>
										<li class="active"><a href="index.php">home </a>	
										</li>
										<li><a href="about">about</a></li>
										<li><a href="menu">Menu</a>
										</li>								
										<li><a href="contact">contact</a></li>
										<li>
										
										<?php 
									$user_data = $this->session->all_userdata(); #print_r($user_data); 
									if(isset($user_data['user_id'])) {
								?>
									<div class="dropdown">
									  <button class="genric-btn primary-border small dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Hi, <?php echo $user_data['user_name']; ?>
									  </button>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
										<a class="dropdown-item" href="logout">Logout</a>						
									  </div>
									</div>	
								<?php } else {?>
									<div class="dropdown">
									  <button class="genric-btn primary-border small dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #888484;">
										Account
									  </button>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
										<a class="dropdown-item" href="register">Register</a>
										<a class="dropdown-item" href="login">Login</a>						
									  </div>
									</div>
								<?php } ?>
								</li>
									</ul>

									
								</nav>
							</div>
							<div class="mobile-menu"></div>
						</div>
						<div class="col-xl-3 col-lg-2">
						       
							   
                       
							<div class="header-right f-right d-none d-md-none d-lg-block">
								
                               <ul
								style="
								padding-top: 20px;">
			<li><a href="res" class="btn" style="padding: 10px;font-size: 12px;">Book A table</a></li>
                                   <li><a href="#" data-toggle="modal" data-target="#search-modal"><span class="ti-search"></span></a>
                                    </li>
                                   <li><a href="cart"><span class="ti-shopping-cart"></span></a></li>
                                   <li class="info-bar"><a href="javascript:void(0)"><span class="ti-align-right"></span></a></li>
                               </ul>
                           </div>
						</div>

					</div>
				</div>
			</div>
			<div class="extra-info">
				<div class="close-icon">
					<button>
						<i class="far fa-window-close"></i>
					</button>
				</div>
				<div class="logo-side mb-30" style="text-align:center;">
					<a href="index.php">
						<img src="assets/front/img/logo/logo.png" alt style="width: 50%;" />
					</a>
				</div>
				<div class="side-menu mb-30">
					<ul>
						<li>
							<a href="home">Home</a>
						</li>
						<li>
							<a href="about">About</a>
						</li>
						<li>
							<a href="menu">Menu</a>
						</li>
					
						<li>
							<a href="contact">Contact</a>
						</li>
						
					
					</ul>
				</div>
				<div class="instagram">
					<a href="#">
						<img src="assets/front/img/instagram/1.jpg" alt="">
					</a>
					<a href="#">
						<img src="assets/front/img/instagram/2.jpg" alt="">
					</a>
					<a href="#">
						<img src="assets/front/img/instagram/3.jpg" alt="">
					</a>
					<a href="#">
						<img src="assets/front/img/instagram/4.jpg" alt="">
					</a>
					<a href="#">
						<img src="assets/front/img/instagram/5.jpg" alt="">
					</a>
					<a href="#">
						<img src="assets/front/img/instagram/6.jpg" alt="">
					</a>
				</div>
				<div class="social-icon-right mt-20">
					<a href="#">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a href="#">
						<i class="fab fa-twitter"></i>
					</a>
					<a href="#">
						<i class="fab fa-google-plus-g"></i>
					</a>
					<a href="#">
						<i class="fab fa-instagram"></i>
					</a>
				</div>
			</div>
		</header>
		<!-- header-end -->