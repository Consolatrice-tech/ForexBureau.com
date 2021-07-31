<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Money Transfer</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="/Exchange/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/Exchange/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="/Exchange/css/flaticon.css"/>
	<link rel="stylesheet" href="/Exchange/css/slicknav.min.css"/>
	<link rel="stylesheet" href="/Exchange/css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="/Exchange/css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="/Exchange/css/animate.css"/>
	<link rel="stylesheet" href="/Exchange/css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.html" class="site-logo">
							<img src="/Exchange/img/Money7.jpg" width="50" alt="">
						</a>
					</div>
                    @if(Auth::check())
                    <div class="col-xl-6 col-lg-5">

					</div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="user-panel">
                            <div class="up-item" style="float: right">
                                <i class="flaticon-profile"></i>
                                <a href="" style="pointer-events: none;cursor: default;">{{ Auth()->user()->fname }} {{ Auth()->user()->lname }}</a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-xl-6 col-lg-5">

					</div>
					<div class="col-xl-4 col-lg-5">
                        <div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="{{ route('login') }}">Sign In </a> or <a href="{{ route('register') }}">Create Account</a>
							</div>
						</div>
					</div>
                    @endif
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="/">Home</a></li>
                    <li><a href="/transactionOfPaypal">PayPal Transactions</a></li>
                    <li><a href="/transactionOfOltranz">Oltranz Transactions</a></li>
                    <li><a href="{{ route('exchangePage') }}">Currency Exchange</a></li>
                    @if(Auth()->check())
                    <li style="float: right"><a href="#">My Account</a>
						<ul class="sub-menu">
                             <li><a href="{{ route('MyTransactions') }}">My Transactions</a></li>
                             <li><a href="">My Exchanges</a></li>
                            <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
						</ul>
					</li>
                    @endif
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->



@yield('content')
@if(!\Request::is('MyTransactions'))
	<section class="footer-section">
		<div class="social-links-warp">
			<div class="container">
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>

			</div>
		</div>
    </section>
    @endif


	<!--====== Javascripts & Jquery ======-->
	<script src="/Exchange/js/jquery-3.2.1.min.js"></script>
	<script src="/Exchange/js/bootstrap.min.js"></script>
	<script src="/Exchange/js/jquery.slicknav.min.js"></script>
	<script src="/Exchange/js/owl.carousel.min.js"></script>
	<script src="/Exchange/js/jquery.nicescroll.min.js"></script>
	<script src="/Exchange/js/jquery.zoom.min.js"></script>
	<script src="/Exchange/js/jquery-ui.min.js"></script>
	<script src="/Exchange/js/main.js"></script>

	</body>
</html>
