<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['update'])) {
		$baddress = $_POST['billingaddress'];
		$bstate = $_POST['bilingstate'];
		$bcity = $_POST['billingcity'];
		$bpincode = $_POST['billingpincode'];
		$card = $_POST['card'];
		$date = $_POST['datecc'];
		$query = mysqli_query($con, "update users set card='$card', dateval='$date,'billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='" . $_SESSION['id'] . "'");
		if ($query) {
			echo "<script>alert('Dirección de facturacion actualizada');</script>";
		} else {
			echo "<script>alert('Error');</script>";
		}
	}

	if (isset($_POST['shipupdate'])) {
		$saddress = $_POST['shippingaddress'];
		$sstate = $_POST['shippingstate'];
		$scity = $_POST['shippingcity'];
		$spincode = $_POST['shippingpincode'];
		$query = mysqli_query($con, "update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='" . $_SESSION['id'] . "'");
		if ($query) {
			echo "<script>alert('Direecion de envío actualizada');</script>";
		}
	}
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
		<title>Mi cuenta</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/blue.css">
		<link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
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
						<li><a href="#">Inicio</a></li>
						<li class='active'>Pagar</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="body-content outer-top-bd">
			<div class="container">
				<div class="checkout-box inner-bottom-sm">
					<div class="row">
						<div class="col-md-8">
							<div class="panel-group checkout-steps" id="accordion">
								<div class="panel panel-default checkout-step-01">
									<div class="panel-heading">
										<h4 class="unicase-checkout-title">
											<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
												<span>1</span>Tarjeta
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12 col-sm-12 already-registered-login">
													<?php
														$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
														while ($row = mysqli_fetch_array($query)) {
															?>
														<div class="form-group">
															<label class="info-title" for="Card.">Número de tarjeta<span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="card" name="card" required="required" value="<?php base64_decode($row['card']); ?>">

														</div>
														<div class="form-group">
															<label class="info-title" for="card">Fecha de expiración <span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="datecc" name="datecc" pattern="[0-9]{4}" required value="<?php $row['dateval'];?>">
														</div>
														<button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Actualizar</button>
														</form>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="panel panel-default checkout-step-02">
									<div class="panel-heading">
										<h4 class="unicase-checkout-title">
											<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
												<span>2</span>Dirección de envío
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<?php
												$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
												while ($row = mysqli_fetch_array($query)) {
													?>
												<form class="register-form" role="form" method="post">
													<div class="form-group">
														<label class="info-title" for="Shipping Address">Dirección de envío<span>*</span></label>
														<textarea class="form-control unicase-form-control text-input" " name=" shippingaddress" required="required"><?php echo $row['shippingAddress']; ?></textarea>
													</div>
													<div class="form-group">
														<label class="info-title" for="Billing State ">Estado de envío <span>*</span></label>
														<input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" value="<?php echo $row['shippingState']; ?>" required>
													</div>
													<div class="form-group">
														<label class="info-title" for="Billing City">Ciudad de envío<span>*</span></label>
														<input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shippingCity']; ?>">
													</div>
													<div class="form-group">
														<label class="info-title" for="Billing Pincode">CP <span>*</span></label>
														<input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shippingPincode']; ?>">
													</div>
													<button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Actualizar</button>
												</form>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php include('includes/myaccount-sidebar.php'); ?>
					</div>
				</div>
				<?php include('includes/brands-slider.php'); ?>
			</div>
		</div>
		<?php include('includes/footer.php'); ?>
		<script src="assets/js/jquery-1.11.1.min.js"></script>
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
		<script src="switchstylesheet/switchstylesheet.js"></script>
	</body>

	</html>
<?php } ?>