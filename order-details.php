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
	<title>Detalles de ordenes</title>
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
	<script language="javascript" type="text/javascript">
		var popUpWin = 0;
		function popUpWindow(URLStr, left, top, width, height) {
			if (popUpWin) {
				if (!popUpWin.closed) popUpWin.close();
			}
			popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
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
					<li class='active'>Carrito de compras</li>
				</ul>
			</div> 
		</div> 
	</div> 
	<div class="body-content outer-top-xs">
		<div class="container">
			<div class="row inner-bottom-sm">
				<div class="shopping-cart">
					<div class="col-md-12 col-sm-12 shopping-cart-table ">
						<div class="table-responsive">
							<form name="cart" method="post">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="cart-romove item">#</th>
											<th class="cart-description item">Imagen</th>
											<th class="cart-product-name item">Nombre del producto</th>
											<th class="cart-qty item">Cantidad</th>
											<th class="cart-sub-total item">Precio por unidad</th>
											<th class="cart-total item">Precio final</th>
											<th class="cart-total item">Método de pago</th>
											<th class="cart-description item">Fecha</th>
											<th class="cart-total last-item">Accion</th>
										</tr>
									</thead> 
									<tbody>
										<?php
										$orderid = $_POST['orderid'];
										$email = $_POST['email'];
										$ret = mysqli_query($con, "select t.email,t.id from (select usr.email,odrs.id from users as usr join orders as odrs on usr.id=odrs.userId) as t where  t.email='$email' and (t.id='$orderid')");
										$num = mysqli_num_rows($ret);
										if ($num > 0) {
											$query = mysqli_query($con, "select products.productImage1 as pimg1,products.productName as pname,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.id='$orderid' and orders.paymentMethod is not null");
											$cnt = 1;
											while ($row = mysqli_fetch_array($query)) {
												?>
												<tr>
													<td><?php echo $cnt; ?></td>
													<td class="cart-image">
														<a class="entry-thumbnail" href="detail.html">
															<img src="admin/productimages/<?php echo $row['pname']; ?>/<?php echo $row['pimg1']; ?>" alt="" width="84" height="146">
														</a>
													</td>
													<td class="cart-product-name-info">
														<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo $row['opid']; ?>">
																<?php echo $row['pname']; ?></a></h4>
													</td>
													<td class="cart-product-quantity">
														<?php echo $qty = $row['qty']; ?>
													</td>
													<td class="cart-product-sub-total"><?php echo $price = $row['pprice']; ?> </td>
													<td class="cart-product-grand-total"><?php echo $qty * $price; ?></td>
													<td class="cart-product-sub-total"><?php echo $row['paym']; ?> </td>
													<td class="cart-product-sub-total"><?php echo $row['odate']; ?> </td>
													<td>
														<a href="javascript:void(0);" onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['orderid']); ?>');" title="Track order">
															Pista</td>
												</tr>
											<?php $cnt = $cnt + 1;
												}
											} else { ?>
											<tr>
												<td colspan="8">El ID del pedido o el ID del correo electrónico registrado no es válido</td>
											</tr>
										<?php } ?>
									</tbody> 
								</table> 
						</div>
					</div>
				</div> 
			</div>  
			</form>
			<?php echo include('includes/brands-slider.php'); ?>
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