<?php
include_once 'products_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hypers Ordering System : Products</title>
	<?php include_once 'nav_bar.php';?>
	<style type="text/css"></style>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
	<style type="text/css">
		tr .btn{
			width: 100%;
			margin: 5px 0;
		}
		input[type="file"] {
			display: none;
		}
		td img {cursor: pointer;}
		body{
			padding-bottom: 20px;
			/*background-image: linear-gradient(#bdc3c7, #2c3e50);
			background-attachment: fixed;*/
		}
		
	</style>
</head>
<body>
	<div class="container-fluid">
		<?php if($_SESSION['user']['fld_staff_role'] == 'Admin'){ ?>
			<div class="container">
				<div class="row" id="form">
					<div class="page-header">
						<h2>Create New Product</h2>
					</div>
					<?php
						if (isset($_SESSION['error'])) {
							echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
							unset($_SESSION['error']);
						}
					?>
					<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" style="backdrop-filter: blur(10px);">
						<div class="col-md-8">
							<div class="form-group">
								<label for="pid" class="col-sm-3 control-label">ID</label>
								<div class="col-sm-9">
									<input name="pid"class="form-control" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; else echo $num?>" readonly> 
								</div>
							</div>
							<div class="form-group">
								<label for="productname" class="col-sm-3 control-label">Name</label>
								<div class="col-sm-9">
									<input name="name" class="form-control" type="text" placeholder="Product Name" id="productname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name'];?>" required> 
								</div>
							</div>
							<div class="form-group">
								<label for="productprice" class="col-sm-3 control-label">Price</label>
								<div class="col-sm-9">
									<input name="price" class="form-control" type="number" step="0.01" placeholder="Product Price" id="productprice" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; else echo 1 ?>" required> 
								</div>
							</div>
							<div class="form-group">
								<label for="producttype" class="col-sm-3 control-label">Type</label>
								<div class="col-sm-9">
									<select name="type" class="form-control" id="producttype">
										<option value="Action Figure" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Action Figure") echo "selected"; ?>>Action Figure</option>
										<option value="Building" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Building") echo "selected"; ?>>Building</option>
										<option value="Vehicle" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Vehicle") echo "selected"; ?>>Vehicle</option>
										<option value="Weapon" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Weapon") echo "selected"; ?>>Weapon</option>
										<option value="Electronic" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Electronic") echo "selected"; ?>>Electronic</option>
										<option value="Other" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Other") echo "selected"; ?>>Other</option>
									</select> 
								</div>
							</div>
							<div class="form-group">
								<label for="productbrand" class="col-sm-3 control-label">Brand</label>
								<div class="col-sm-9">
									<select name="brand" class="form-control" id="productbrand">
										<option value="Hasbro" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Hasbro") echo "selected"; ?>>Hasbro</option>
										<option value="Lego" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Lego") echo "selected"; ?>>Lego</option>
										<option value="Knex" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Knex") echo "selected"; ?>>Knex</option>
										<option value="ToysRUs" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="ToysRUs") echo "selected"; ?>>ToysRUs</option>
										<option value="Nintendo" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Nintendo") echo "selected"; ?>>Nintendo</option>
										<option value="Playmobil" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Playmobil") echo "selected"; ?>>Playmobil</option>
										<option value="Other" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Other") echo "selected"; ?>>Other</option>
									</select> 
								</div>
							</div>
							<div class="form-group">
								<label for="productdesc" class="col-sm-3 control-label">Description</label>
								<div class="col-sm-9">
									<input name="description" class="form-control" placeholder="Product Description" type="text" id="productdesc" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_description']; ?>" required> 
								</div>
							</div>
							<div class="form-group">
								<label for="productq" class="col-sm-3 control-label">Quantity</label>
								<div class="col-sm-9">
									<input type="number" placeholder="Product Quantity" class="form-control" name="quantity" id="productq" min="1" max="900" step="1" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>" required> 
								</div>
							</div>
							<div class="form-group">
								<label for="productmat" class="col-sm-3 control-label">Material</label>
								<div class="col-sm-9">
									<select name="material" class="form-control" id="productmat">
										<option value="Plastic" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Plastic") echo "selected"; ?>>Plastic</option>
										<option value="Metal" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Metal") echo "selected"; ?>>Metal</option>
										<option value="Flexible Plastic" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Flexible Plastic") echo "selected"; ?>>Flexible Plastic</option>
										<option value="Paper" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Paper") echo "selected"; ?>>Paper</option>
										<option value="Fur" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Fur") echo "selected"; ?>>Fur</option>
										<option value="CD" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="CD") echo "selected"; ?>>CD</option>
										<option value="Other" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Other") echo "selected"; ?>>Other</option>
									</select> 
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<?php 
										if (isset($_GET['edit'])) { ?>
											<input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
											<button class="btn btn-default" type="submit" name="update">
											<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
											<?php 
										}else{ ?>
											<button class="btn btn-default" type="submit" name="create">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
											<?php 
										} ?>
									<button class="btn btn-default"  type="reset">
									<span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
								</div>
							</div>

						</div>
						<div class="col-md-4" style="height: 100%">
							<div class="thumbnail dark-1">
								<img src="products/<?php echo(isset($_GET['edit']) ? $editrow['fld_product_image'] : '') ?>"
									 onerror="this.onerror=null;this.src='products/nophoto.jpg';" id="productPhoto"
									 alt="Product Image" style="width: 100%;height: 225px;">
								<div class="caption text-center">
									<h3 id="productImageTitle" style="word-break: break-all;">Product Image</h3>
									<p>
										<label class="btn btn-primary">
											<input type="file" accept="image/*" name="fileToUpload" id="inputImage"
												   onchange="loadFile(event);"/>
											<input type="hidden" name="filename" value="<?php echo $editrow['fld_product_image']; ?>">
											<span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> Browse
										</label>
										<!-- <?php
										// if (isset($_GET['edit']) && $editrow['fld_product_image'] != '') {
										// 	echo '<a href="#" class="btn btn-danger disabled" role="button">Delete</a>';
										// }
										?> -->
									</p>
								</div>
							</div>
						</div>

					</form>	
					<!-- <?php 
						/*if($_SESSION['user']['fld_staff_role'] == 'Staff'){
							kalo nk disable form je
							echo '<script>$("form :input").prop("disabled", true);</script>';
						}*/
					?> -->
				</div>
			</div>
		<?php } ?>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h2>Products List</h2>
				</div>
				<table id="productlist" class="table-dark table-striped table-bordered hover" id="table">
					<thead>
					<tr>
						<th>Product ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Type</th>
						<th>Brand</th>
						<!-- <th>Description</th> -->
						<th>Quantity</th>
						<th>Material</th>
						<th>Imange<br><small>(Clickable)</small></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
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
							<!-- <td><?php //echo $readrow['fld_product_description']; ?></td> -->
							<td><?php echo $readrow['fld_product_quantity']; ?></td>
							<td><?php echo $readrow['fld_product_material']; ?></td>
							<?php if(file_exists('products/'. $readrow['fld_product_image']) && isset($readrow['fld_product_image'])){
								$img = 'products/'.$readrow['fld_product_image'];
								echo '<td><img data-toggle="modal" data-target="#'.$readrow['fld_product_id'].'" width=150px; src="'.$img.'"></td>';
							}
							else{
								echo '<td><img width=70%; data-toggle="modal" data-target="#'.$readrow['fld_product_id'].'" src="products/nophoto.jpg"'.'></td>';
							} ?>

							<div id="<?php echo $readrow['fld_product_id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-body">
									<img src="<?php echo $img ?>" class="img-responsive">
								</div>
							</div>


							<td>
								<a href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
								<?php
									if($_SESSION['user']['fld_staff_role'] == 'Admin'){ ?>
										<a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
										<a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
								<?php } ?>
							</td>
						</tr>

						<?php
					}
					$conn = null;
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="application/javascript">
	var loadFile = function (event) {
		var reader = new FileReader();
		reader.onload = function () {
			var output = document.getElementById('productPhoto');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
		document.getElementById('productImageTitle').innerText = event.target.files[0]['name'];
	};

	//yg ni korg tk perlu
	$(document).ready(function () {
		$("#productlist").DataTable({
		"lengthMenu": [[5, 20, 50, -1], [5, 20, 50, "All"]]
	});
	});
</script>
</body>
</html>