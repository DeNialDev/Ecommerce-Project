<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="robots" content="all">
	<title>Localizar orden</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/blue.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="assets/css/config.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body class="cnt-home">
	<header class="header-style-1">
		<?php include('includes/top-header.php'); ?>
		<?php include('includes/main-header.php'); ?>
		<?php include('includes/menu-bar.php'); ?>
	</header>
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="home.html">Inicio</a></li>
					<li class='active'>Localiza tu orden</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="body-content outer-top-bd">
		<div class="container">
			<div class="track-order-page inner-bottom-sm">
				<div class="row">
					<div class="col-md-12">
						<h2>Rastrear orden</h2>
						<span class="title-tag inner-top-vs">Porfavor ingrese el id de su orden</span>
						<form class="register-form outer-top-xs" role="form" method="post" action="order-details.php">
							<div class="form-group">
								<label class="info-title" for="exampleOrderId1">ID orden</label>
								<input type="text" class="form-control unicase-form-control text-input" name="orderid" id="exampleOrderId1">
							</div>
							<div class="form-group">
								<label class="info-title" for="exampleBillingEmail1">Correo registrado</label>
								<input type="email" class="form-control unicase-form-control text-input" name="email" id="exampleBillingEmail1">
							</div>
							<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Localizar</button>
						</form>
					</div>
				</div>
			</div>
			<div <?php echo include('includes/brands-slider.php'); ?> </div> </div> <?php include('includes/footer.php'); ?> <script src="assets/js/jquery-1.11.1.min.js">
				</script>
				<script src="assets/js/bootstrap.min.js"></script>
				<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
				<script src="assets/js/owl.carousel.min.js"></script>
				<script src="assets/js/echo.min.js"></script>
				<script src="assets/js/jquery.easing-1.3.min.js"></script>
				<script src="assets/js/bootstrap-slider.min.js"></script>
				<script src="assets/js/jquery.rateit.min.js"></script>
				<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
				<script src="assets/js/bootstrap-select.min.js"></script>
				<script src="assets/js/wow.min.js"></script>
				<script src="assets/js/scripts.js"></script>
</body>
</html>