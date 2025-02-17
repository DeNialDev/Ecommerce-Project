<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['update'])) {
		$name = $_POST['name'];
		$contactno = $_POST['contactno'];
		$query = mysqli_query($con, "update users set name='$name',contactno='$contactno' where id='" . $_SESSION['id'] . "'");
		if ($query) {
			echo "<script>alert('Información actualizada correctamente');</script>";
		}
	}
	date_default_timezone_set('America/Mexico_City');
	$currentTime = date('d-m-Y h:i:s A', time());
	if (isset($_POST['submit'])) {
		$sql = mysqli_query($con, "SELECT password FROM  users where password='" . md5($_POST['cpass']) . "' && id='" . $_SESSION['id'] . "'");
		$num = mysqli_fetch_array($sql);
		if ($num > 0) {
			$con = mysqli_query($con, "update students set password='" . md5($_POST['newpass']) . "', updationDate='$currentTime' where id='" . $_SESSION['id'] . "'");
			echo "<script>alert('COntraseña actualizada con exito');</script>";
		} else {
			echo "<script>alert('La contraseña actual no coincide');</script>";
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
		<meta name="keywords" content="">
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
		<script type="text/javascript">
			function valid() {
				if (document.chngpwd.cpass.value == "") {
					alert("El campo de la contraseña actual está vacio");
					document.chngpwd.cpass.focus();
					return false;
				} else if (document.chngpwd.newpass.value == "") {
					alert("El campo de la contraseña nueva está vacio");
					document.chngpwd.newpass.focus();
					return false;
				} else if (document.chngpwd.cnfpass.value == "") {
					alert("El campo para confirmar nueva contraseña esta vacio");
					document.chngpwd.cnfpass.focus();
					return false;
				} else if (document.chngpwd.newpass.value != document.chngpwd.cnfpass.value) {
					alert("Las contraseñas no coinciden");
					document.chngpwd.cnfpass.focus();
					return false;
				}
				return true;
			}
		</script>
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
						<li class='active'>Comprar</li>
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
												<span>1</span>Mi perfil
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="row">
												<h4>Informacion personal</h4>
												<div class="col-md-12 col-sm-12 already-registered-login">
													<?php
														$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
														while ($row = mysqli_fetch_array($query)) {
															?>
														<form class="register-form" role="form" method="post">
															<div class="form-group">
																<label class="info-title" for="name">Nombre<span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" value="<?php echo $row['name']; ?>" id="name" name="name" required="required">
															</div>
															<div class="form-group">
																<label class="info-title" for="exampleInputEmail1">Correo<span>*</span></label>
																<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="<?php echo $row['email']; ?>" readonly>
															</div>
															<div class="form-group">
																<label class="info-title" for="Contact No.">Número de contacto<span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" required="required" value="<?php echo $row['contactno']; ?>" maxlength="10">
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
												<span>2</span>Cambiar contraseña
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<form class="register-form" role="form" method="post" name="chngpwd" onSubmit="return valid();">
												<div class="form-group">
													<label class="info-title" for="Current Password">Contraseña actual<span>*</span></label>
													<input type="password" class="form-control unicase-form-control text-input" id="cpass" name="cpass" required="required">
												</div>
												<div class="form-group">
													<label class="info-title" for="New Password">Nueva contraseña<span>*</span></label>
													<input type="password" class="form-control unicase-form-control text-input" id="newpass" name="newpass">
												</div>
												<div class="form-group">
													<label class="info-title" for="Confirm Password">Confirma la nueva contraseñas<span>*</span></label>
													<input type="password" class="form-control unicase-form-control text-input" id="cnfpass" name="cnfpass" required="required">
												</div>
												<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Cambiar</button>
											</form>
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
	</body>
	</html>
<?php } ?>