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
	<style type="text/css">
		tr .btn{
			width: 100%;
			margin: 5px 0;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="page-header">
					<h2>Create New Product</h2>
				</div>
				<form action="products.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="pid" class="col-sm-3 control-label">ID</label>
						<div class="col-sm-9">
							<input name="pid"class="form-control" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; else echo $num?>" readonly> 
						</div>
					</div>
					<div class="form-group">
						<label for="productname" class="col-sm-3 control-label">Name</label>
						<div class="col-sm-9">
							<input name="name" class="form-control" type="text" placeholder="Product Name" id="productname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required> 
						</div>
					</div>
					<div class="form-group">
						<label for="productprice" class="col-sm-3 control-label">Price</label>
						<div class="col-sm-9">
							<input name="price" class="form-control" type="number" placeholder="Product Price" id="productprice" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required> 
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
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h2>Products List</h2>
				</div>
				<table class="table table-striped table-bordered text-center data-detail-filter" id="table">
					<tr>
						<th>Product ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Type</th>
						<th>Brand</th>
						<!-- <th>Description</th> -->
						<th>Quantity</th>
						<th>Material</th>
						<th>Imange</th>
						<th></th>
					</tr>
					<?php
					$per_page = 5;
					if (isset($_GET["page"]))
						$page = $_GET["page"];
					else
						$page = 1;
					$start_from = ($page-1) * $per_page;
					try {
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $conn->prepare("SELECT * FROM tbl_products_a173586 LIMIT $start_from, $per_page");
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
								$img = 'products/nophoto.jpg';
								echo '<td><img width=150px; data-toggle="modal" data-target="#'.$readrow['fld_product_id'].'" src="products/nophoto.jpg"'.'></td>';
							} ?>

							<!--ni haa tuk kluar gmbr tu-->
							<div id="<?php echo $readrow['fld_product_id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-body">
									<img src="<?php echo $img ?>" class="img-responsive">
								</div>
							</div>


							<td>
								<a href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
								<a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
								<a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
							</td>
						</tr>

						<?php
					}
					$conn = null;
					?>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<nav>
					<ul class="pagination">
						<?php
						try {
							$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$stmt = $conn->prepare("SELECT * FROM tbl_products_a173586");
							$stmt->execute();
							$result = $stmt->fetchAll();
							$total_records = count($result);
						}
						catch(PDOException $e){
							echo "Error: " . $e->getMessage();
						}
						$total_pages = ceil($total_records / $per_page);
						if ($page==1){ ?>
							<li class="disabled"><span aria-hidden="true">«</span></li>
						<?php
						}else{ ?>
							<li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<?php }
						for ($i=1; $i<=$total_pages; $i++)
							if ($i == $page)
								echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
							else
								echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
						if ($page==$total_pages){?>
							<li class="disabled"><span aria-hidden="true">»</span></li>
						<?php }else{ ?>
							<li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
	<script src="js/bootstrap.min.js"></script>
</body>
</html>