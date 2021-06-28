<?php
include_once 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hypers Ordering System : Products Details</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<?php include_once 'nav_bar.php'; ?>

	<?php
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM tbl_products_a173586 WHERE fld_product_id = :pid");
		$stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
		$pid = $_GET['pid'];
		$stmt->execute();
		$readrow = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
	?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
				<?php if(file_exists('products/'. $readrow['fld_product_id'].'.jpg')){
					echo '<img style="width:100%" src="products/'.$readrow['fld_product_id'].'.jpg"'.' class="img-responsive">';
				}
				else{
					echo '<img src="products/nophoto.jpg"'.' class="img-responsive">';
				}?>
			</div>

			<div class="col-xs-12 col-sm-5 col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Product Details</strong></div>
					<div class="panel-body">
						Below are specifications of the product.
					</div>
					<table class="table">
						<tr>
							<td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
							<td><?php echo $readrow['fld_product_id'] ?></td>
						</tr>
						<tr>
							<td><strong>Name</strong></td>
							<td><?php echo $readrow['fld_product_name'] ?></td>
						</tr>
						<tr>
							<td><strong>Price</strong></td>
							<td>RM <?php echo $readrow['fld_product_price'] ?></td>
						</tr>
						<tr>
							<td><strong>Brand</strong></td>
							<td><?php echo $readrow['fld_product_type'] ?></td>
						</tr>
						<tr>
							<td><strong>Brand</strong></td>
							<td><?php echo $readrow['fld_product_brand'] ?></td>
						</tr>
						<tr>
							<td><strong>Condition</strong></td>
							<td><?php echo $readrow['fld_product_description'] ?></td>
						</tr>
						<tr>
							<td><strong>Manufacturing Year</strong></td>
							<td><?php echo $readrow['fld_product_quantity'] ?></td>
						</tr>
						<tr>
							<td><strong>Quantity</strong></td>
							<td><?php echo $readrow['fld_product_material'] ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>

</body>
</html>