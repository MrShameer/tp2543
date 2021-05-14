<?php
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hypers Ordering System : Products</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
	<center>

		<form action="products.php" method="post">
			Product ID
			<input name="pid" type="text" id="pid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id'];?>" readonly> <br>
			Name
			<input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required> <br>
			Price
			<input name="price" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required> <br>
			Type
			<select name="type">
				<option value="Action Figure" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Action Figure") echo "selected"; ?>>Action Figure</option>
				<option value="Building" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Building") echo "selected"; ?>>Building</option>
				<option value="Vehicle" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Vehicle") echo "selected"; ?>>Vehicle</option>
				<option value="Weapon" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Weapon") echo "selected"; ?>>Weapon</option>
				<option value="Electronic" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Electronic") echo "selected"; ?>>Electronic</option>
				<option value="Other" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Other") echo "selected"; ?>>Other</option>
			</select> <br>
			Brand
			<select name="brand">
				<option value="Hasbro" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Hasbro") echo "selected"; ?>>Hasbro</option>
				<option value="Lego" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Lego") echo "selected"; ?>>Lego</option>
				<option value="Knex" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Knex") echo "selected"; ?>>Knex</option>
				<option value="ToysRUs" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="ToysRUs") echo "selected"; ?>>ToysRUs</option>
				<option value="Nintendo" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Nintendo") echo "selected"; ?>>Nintendo</option>
				<option value="Playmobil" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Playmobil") echo "selected"; ?>>Playmobil</option>
				<option value="Other" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Other") echo "selected"; ?>>Other</option>
			</select> <br>
			Description
			<input name="description" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_description']; ?>" required> <br>
			Quantity
			<input type="number" name="quantity" min="1" max="900" step="1" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>"> <br>
			Material
			<select name="material">
				<option value="Plastic">Plastic</option>
				<option value="Metal">Metal</option>
				<option value="Flexible Plastic">Flexible Plastic</option>
				<option value="Paper">Paper</option>
				<option value="Fur">Fur</option>
				<option value="CD">CD</option>
				<option value="Other">Other</option>
			</select> <br>

			<?php if (isset($_GET['edit'])) { ?>
				<input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
				<button type="submit" name="update">Update</button>
			<?php } else { ?>
				<button type="submit" name="create">Create</button>
			<?php } ?>
			<button type="reset">Clear</button>
		</form>
		<hr>
		<table style="text-align:center" border="1" id="adds">
			<tr>
				<td>Product ID</td>
				<td>Name</td>
				<td>Price</td>
				<td>Type</td>
				<td>Brand</td>
				<td>Description</td>
				<td>Quantity</td>
				<td>Material</td>
				<td>Imange</td>
				<td></td>
			</tr>
			<?php
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $conn->prepare("SELECT * FROM tbl_products_a173586");
				$stmt->execute();
				$result = $stmt->fetchAll();
			}
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
			foreach($result as $readrow) {
				?>   
				<tr>
					<td><?php echo $readrow['fld_product_id'];?></td>
					<td><?php echo $readrow['fld_product_name']; ?></td>
					<td><?php echo 'RM'.$readrow['fld_product_price']; ?></td>
					<td><?php echo $readrow['fld_product_type']; ?></td>
					<td><?php echo $readrow['fld_product_brand']; ?></td>
					<td><?php echo $readrow['fld_product_description']; ?></td>
					<td><?php echo $readrow['fld_product_quantity']; ?></td>
					<td><?php echo $readrow['fld_product_material']; ?></td>
					<td><?php echo '<img width=70%; src="products/'. $readrow['fld_product_image'].'"><br />'; ?></td>
					<td>
						<a href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>">Details</a>
						<a href="products.php?edit=<?php echo $readrow['fld_product_id'];?>">Edit</a>
						<a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
					</td>
				</tr>

				<?php
			}
			if (!isset($_GET['edit'])){
				$num = ltrim($readrow['fld_product_id'], 'P')+1;
				$num = 'P'.str_pad($num,3,"0",STR_PAD_LEFT);
			}

			$conn = null;
			?>
			<script type="text/javascript">
				if("<?php echo $num ?>" !== null && "<?php echo $num ?>" !== ""){
					var pid = document.getElementById("pid");
					pid.value = "<?php echo $num ?>";
					//pid.readOnly = true;
				}
			</script>
		</table>
	</center>
</body>
</html>