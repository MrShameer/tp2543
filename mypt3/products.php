<?php
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Hypers Ordering System : Products</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="products/hypers logo.ico"/>
</head>
<body>
	<?php include_once 'nav_bar.php';?>

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
							<input name="name" class="form-control" type="text" id="productname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required> 
						</div>
					</div>
					<div class="form-group">
						<label for="productprice" class="col-sm-3 control-label">Price</label>
						<div class="col-sm-9">
							<input name="price" class="form-control" type="text" id="productprice" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required> 
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
								<option value="Hasbro" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Hasbro") echo "selected"; ?>>Hasbro</option>
								<option value="Lego" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Lego") echo "selected"; ?>>Lego</option>
								<option value="Knex" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Knex") echo "selected"; ?>>Knex</option>
								<option value="ToysRUs" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="ToysRUs") echo "selected"; ?>>ToysRUs</option>
								<option value="Nintendo" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Nintendo") echo "selected"; ?>>Nintendo</option>
								<option value="Playmobil" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Playmobil") echo "selected"; ?>>Playmobil</option>
								<option value="Other" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Other") echo "selected"; ?>>Other</option>
							</select> 
						</div>
					</div>
					<div class="form-group">
						<label for="productdesc" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-9">
							<input name="description" class="form-control" type="text" id="productdesc" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_description']; ?>" required> 
						</div>
					</div>
					<div class="form-group">
						<label for="productq" class="col-sm-3 control-label">Quantity</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="quantity" id="productq" min="1" max="900" step="1" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>" required> 
						</div>
					</div>
					<div class="form-group">
						<label for="productmat" class="col-sm-3 control-label">Material</label>
						<div class="col-sm-9">
							<select name="material" class="form-control" id="productmat">
								<option value="Plastic">Plastic</option>
								<option value="Metal">Metal</option>
								<option value="Flexible Plastic">Flexible Plastic</option>
								<option value="Paper">Paper</option>
								<option value="Fur">Fur</option>
								<option value="CD">CD</option>
								<option value="Other">Other</option>
							</select> 
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<?php if (isset($_GET['edit'])) { ?>
								<input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
								<button class="btn btn-default" type="submit" name="update">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
								<?php } else { ?>
									<button class="btn btn-default" type="submit" name="create">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
									<?php } ?>
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
								<h2 class="pull-left" style="margin: 0 50px 0 0;">Products List</h2>
								<form class="form-inline my-2 my-lg-0">
									<input class="form-control mr-sm-2" id="search" type="search" placeholder="Search" aria-label="Search">
									<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
								</form>
								<script type="text/javascript">
									$(document).ready(function(){
										$("#search").on("keyup", function() {
											var value = $(this).val().toLowerCase();
											$("#table tr").filter(function() {
												$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
											});
										});
									});


									/*$(document).ready(function () {
  $('#table').DataTable();
  $('.dataTables_length').addClass('bs-select');
});*/
								</script>
							</div>
							<table class="table table-striped table-bordered text-center data-detail-filter" id="table">
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
										<td><?php echo $readrow['fld_product_description']; ?></td>
										<td><?php echo $readrow['fld_product_quantity']; ?></td>
										<td><?php echo $readrow['fld_product_material']; ?></td>
										<?php if(file_exists('products/'. $readrow['fld_product_id'].'.jpg')){
											$img = 'products/'.$readrow['fld_product_id'].'.jpg';
											echo '<td><img data-toggle="modal" data-target="#'.$readrow['fld_product_id'].'" width=70%; src="products/'.$readrow['fld_product_id'].'.jpg"'.'></td>';
										}
										else{
											$img = 'products/nophoto.jpg';
											echo '<td><img width=70%; data-toggle="modal" data-target="#'.$readrow['fld_product_id'].'" src="products/nophoto.jpg"'.'></td>';
										}?>

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
									?>
									<?php if ($page==1) { ?>
										<li class="disabled"><span aria-hidden="true">«</span></li>
									<?php } else { ?>
										<li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
										<?php
									}
									for ($i=1; $i<=$total_pages; $i++)
										if ($i == $page)
											echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
										else
											echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
										?>
										<?php if ($page==$total_pages) { ?>
											<li class="disabled"><span aria-hidden="true">»</span></li>
										<?php } else { ?>
											<li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
										<?php } ?>
									</ul>
								</nav>
							</div>
						</div>
					</div>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
					<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
					<!-- Include all compiled plugins (below), or include individual files as needed -->
					<script src="js/bootstrap.min.js"></script>
				</body>
				</html>