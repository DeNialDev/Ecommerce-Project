<?php
session_start();
error_reporting(0);
include('includes/config.php');
//Registrar
if (isset($_POST['submit'])) {
	$name = $_POST['fullname'];
	$email = $_POST['emailid'];
	$contactno = $_POST['contactno'];
	$password = md5($_POST['password']);
	$card = base64_encode($_POST['card']);
	$datecc = $_POST['datecc'];
	$query = mysqli_query($con, "insert into users(name,email,contactno,password,card,dateval) values('$name','$email','$contactno','$password','$card','$datecc')");
	if ($query) {
		echo "<script>alert('Has sido registrado con exito');</script>";
	} else {
		echo "<script>alert('Ops, ha ocurrido un problema');</script>";
	}
}
// log
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' and password='$password'");
	$num = mysqli_fetch_array($query);
	if ($num > 0) {
		$extra = "index.php";
		$_SESSION['login'] = $_POST['email'];
		$_SESSION['id'] = $num['id'];
		$_SESSION['username'] = $num['name'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 1;
		$log = mysqli_query($con, "insert into userlog(userEmail,userip,status) values('" . $_SESSION['login'] . "','$uip','$status')");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	} else {
		$extra = "login.php";
		$email = $_POST['email'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;
		$log = mysqli_query($con, "insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		$_SESSION['errmsg'] = "Correo Invalido";
		exit();
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
	<title>FitStyle | Iniciar Sesión | Registrarse</title>
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
			if (document.register.password.value != document.register.confirmpassword.value) {
				alert("Password and Confirm Password Field do not match  !!");
				document.register.confirmpassword.focus();
				return false;
			}
			return true;
		}
	</script>
	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
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
					<li><a href="home.html">Inicio</a></li>
					<li class='active'>Autenticación</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="body-content outer-top-bd">
		<div class="container">
			<div class="sign-in-page inner-bottom-sm">
				<div class="row">
					<div class="col-md-6 col-sm-6 sign-in">
						<h4 class="">Iniciar sesión</h4>
						<p class="">Bienvenido.</p>
						<form class="register-form outer-top-xs" method="post">
							<span style="color:red;">
								<?php
								echo htmlentities($_SESSION['errmsg']);
								?>
								<?php
								echo htmlentities($_SESSION['errmsg'] = "");
								?>
							</span>
							<div class="form-group">
								<label class="info-title" for="exampleInputEmail1">Correo <span>*</span></label>
								<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
							</div>
							<div class="form-group">
								<label class="info-title" for="exampleInputPassword1">Contraseña <span>*</span></label>
								<input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
							</div>
							<div class="radio outer-xs">
								<a href="forgot-password.php" class="forgot-password pull-right">¿Olvidaste tu contraseña?</a>
							</div>
							<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">Iniciar Sesión</button>
						</form>
					</div>
					<div class="col-md-6 col-sm-6 create-new-account">
						<h4 class="checkout-subtitle">Crear una nueva cuenta</h4>
						<p class="text title-tag-line">Crea tu propia cuenta en nuestra tienda.</p>
						<form class="register-form outer-top-xs" role="form" method="post" name="register" onSubmit="return valid();">
							<div class="form-group">
								<label class="info-title" for="fullname">Nombre completo<span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="fullname" name="fullname" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" required="required">
							</div>
							<div class="form-group">
								<label class="info-title" for="exampleInputEmail2">Correo electronico<span>*</span></label>
								<input type="text" title="esto no parece ser un correo válido" class="form-control unicase-form-control text-input" id="email" onBlur="userAvailability()" name="emailid" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required>
								<span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							<div class="form-group">
								<label class="info-title" for="contactno">Número de contacto <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" pattern="[0-9]{10}" required>
							</div>
							<div class="form-group">
								<label class="info-title" for="password">Contraseña(Contraseña de 8 a 16 digítos con valores de A-Z y de 0-9) <span>*</span></label>
								<input  type="password" class="form-control unicase-form-control text-input" id="password" name="password" pattern="[A-Za-z0-9!?-]{8,16}" required>
							</div>
							<div class="form-group">
								<label class="info-title" for="confirmpassword">Confirma tu contraseña <span>*</span></label>
								<input type="password" class="form-control unicase-form-control text-input" id="confirmpassword" name="confirmpassword" required>
							</div>
							<div class="form-group">
								<label class="info-title" for="card">Tarjeta de credito (16 digítos de su tarjeta) <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" pattern="5[1-5][0-9]{14}$" id="card" name="card" required>
							</div>
							<div class="form-group">
								<label class="info-title" for="card">Fecha de expiración <span>*</span></label>
								<input type="text"  class="form-control unicase-form-control text-input" id="datecc" name="datecc" pattern="[0-9]{4}" required>
							</div>
							<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Registrarse</button>
						</form>
						<span class="checkout-subtitle outer-top-xs">Registrate ahora y podras: </span>
						<div class="checkbox">
							<label class="checkbox">
								Rastrear tus pedidos facilemente.
							</label>
							<label class="checkbox">
								Llevar el registro de todas sus compras.
							</label>
						</div>
					</div>
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