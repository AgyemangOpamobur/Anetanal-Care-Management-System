<?php
session_start();
require_once 'class.php';
$sendMessage = new Methods();

if (isset($_POST['btn-Send'])) {
	$sendMessage->Emergency_counsultation();
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Antenatal Care Management System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />


	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>

	<!-- Favicon link -->
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>
<body>
	<!-- input shadow style -->
<style media="screen">
	#bordershadow{
		border-radius : 2px ;
			box-shadow : 0 0 1px 2px #123456 ;
	}
</style>

	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="">
							<div id="colorlib-logo"><img src="images/logoAntenatal.png" style="width=20%"><a href="#"><span>ANTENATAL CARE MANAGEMENT SYSTEM</span></a></div>
						</div>
						<div class="col-md-10 text-right menu-1">
							<ul>
								<li class="active"><a href="index.php">Home</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li class="btn-cta"><a href="userportal.php"><span>USER PORTAL</span></a></li>

							</ul>
						</div>
					</div>

				</div>
			</div>
		</nav>

		<aside id="colorlib-hero" class="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
					<li style="background-image: url(images/firstImage.jpg);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
									<div class="slider-text-inner">
										<h1>We help to solve maternal and infant mortalities facing Ghana</h1>
										<h2>Your quailty Antenatal Care service starts here!</h2>
										<p><a class="btn btn-primary btn-lg" href="userportal.php"> USER PORTAL</a></p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li style="background-image: url(images/secondImage.jpg);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
									<div class="slider-text-inner">
										<h1>Safe delivery is our concern</h1>
										<h2>Please call this numbers for any emergency case! <a href="#" target="_blank">+233 0302459879</a></h2>
										<p><a class="btn btn-primary btn-lg btn-learn" href="userportal.php">USER PORTAL</a></p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li style="background-image: url(images/thirdImage.jpg);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
									<div class="slider-text-inner">
										<h1>Early Antenatal Care is the solution to safe delivery</h1>
										<h2>Please call this numbers for any emergency case! <a href="#" target="_blank">+233 0302459879</a></h2>
										<p><a class="btn btn-primary btn-lg btn-learn" href="userportal.php">USER PORTAL</a></p>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		<div id="intro-bg">
			<div class="container">
				<div id="colorlib-intro">
					<div class="third-col">
						<span class="icon"><i class="icon-cog"></i></span>
						<h2>Need Antenatal Care Services?</h2>
						<p>Please scroll down and fill the form below to apply from Emergency Antenatal Care consultation.</p>
					</div>
					<div class="third-col third-col-color">
						<span class="icon"><i class="icon-old-phone"></i></span>
						<h2>Call now +233 0302459879</h2>
						<h2>Email us @ <a href="#">antenatalcare@gmail.com</a></h2>
					</div>
				</div>
			</div>
		</div>
		<center>
			<div class="col-md-4">
				<?php
				if(isset($_GET['success']))
				{
					?>
					<div class='alert alert-error'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Message sent, a nurse will contact you shortly.</strong>
					</div>
					<?php
				}
				?>
				<?php
				if(isset($_GET['dataerror']))
				{
					?>
					<div class='alert alert-error'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong><?php echo $_SESSION['database_error']; ?></strong>
					</div>
					<?php
				}
				?>
			</div>
		</center>

		<div id="colorlib-consult">
			<div class="video colorlib-video" style="background-image: url(images/videoImage.png);" data-stellar-background-ratio="0.5">
			</div>
			<div class="col-md-6 animate-box">
				<div class="colorlib-heading">
					<h2>Emergency Antenatal Care Consultation</h2>
				</div>
				<form action="index.php" method="post">
					<div class="row form-group">
						<div class="col-md-6">

							<input type="text" id="bordershadow" class="form-control" placeholder="Your firstname" name="fname"required>
						</div>
						<div class="col-md-6">

							<input type="text" id="bordershadow" class="form-control" placeholder="Your lastname" name="lname" required>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="email">Email</label> -->
							<input type="number" id="bordershadow" class="form-control" placeholder="Contact Number" name="contact" maxlength="10" required>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="subject">Subject</label> -->
							<input type="text" id="bordershadow" class="form-control" placeholder="Your subject of this message" name="subject" required>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<!-- <label for="message">Message</label> -->
							<textarea name="message" id="bordershadow" cols="30" rows="10" class="form-control" placeholder="Details of the message" name="message" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<input type="submit"  name="btn-Send" value="Send Message" class="btn btn-primary">
					</div>

				</form>
			</div>
		</div>

		<div id="colorlib-blog">

		</div>


	</div>
</div>

<footer id="colorlib-footer" role="contentinfo">
	<div class="container">
		<div class="row row-pb-md">
			<div class="col-md-3 colorlib-widget">
				<h4></h4>

			</div>
			<div class="col-md-3 col-md-push-1">
				<h4>Navigation</h4>
				<ul class="colorlib-footer-links">
					<li><a href="index.php">Home</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">About us</a></li>
				</ul>
			</div>

			<div class="col-md-3 col-md-push-1">
				<h4>Contact Information</h4>
				<ul class="colorlib-footer-links">
					<li>Ghana Health Service, <br> Ghana</li>
					<li><a href="#">+233 0302459879</a></li>
					<li><a href="#">antenatalcare@gmail.com</a></li>
				</ul>
			</div>


		</div>

		<div class="row copyright">
			<div class="col-md-12 text-center">
				<p>
					<small class="block">&copy; 2018 Antenatal Care Management System. All Rights Reserved. Created by Agyemang Alex(217EI11005226).
					</p>

				</div>
			</div>

		</div>
	</footer>
</div>



<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="js/jquery.stellar.min.js"></script>
<!-- Carousel -->
<script src="js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="js/jquery.flexslider-min.js"></script>
<!-- countTo -->
<script src="js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>
<!-- Main -->
<script src="js/main.js"></script>

</body>
</html>
