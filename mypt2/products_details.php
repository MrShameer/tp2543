<?php
include_once 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hypers Ordering System : Products Details</title>
</head>
<body>
	<object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
	<center>
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
		Product ID: <?php echo $readrow['fld_product_id'] ?> <br>
		Name: <?php echo $readrow['fld_product_name'] ?> <br>
		Price: RM <?php echo $readrow['fld_product_price'] ?> <br>
		Type: <?php echo $readrow['fld_product_type'] ?> <br>
		Brand: <?php echo $readrow['fld_product_brand'] ?> <br>
		Description: <?php echo $readrow['fld_product_description'] ?> <br>
		Quantity: <?php echo $readrow['fld_product_quantity'] ?> <br>
		Material: <?php echo $readrow['fld_product_material'] ?> <br>
		<?php if(file_exists('products/'. $readrow['fld_product_id'].'.jpg')){
			echo '<td><img width=70%; src="products/'.$readrow['fld_product_id'].'.jpg"'.'><br/></td>';
		}
		else{
			echo '<td><img width=70%; src="products/nophoto.jpg"'.'><br/></td>';
		}?>
	</center>
</body>
</html>