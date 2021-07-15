<?php
include_once 'staffs_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hypers Ordering System : Staffs</title>
	<?php include_once 'nav_bar.php';?>
</head>
<body>
	<div class="container-fluid">
		<?php if($_SESSION['user']['fld_staff_role'] == 'Admin'){ ?>
		<div class="row" id="form">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="page-header">
					<h2>Create New Staff</h2>
				</div>
				<?php
					if (isset($_SESSION['error'])) {
						echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
						unset($_SESSION['error']);
					}
				?>
				<form action="staffs.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="sid" class="col-sm-3 control-label">Staff ID</label>
						<div class="col-sm-9">
							<input name="sid" class="form-control" placeholder="Staff ID" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; else echo $num; ?>" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Name</label>
						<div class="col-sm-9">
							<input id="name" name="name" placeholder="Staff Name" type="text" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>"required>
						</div>
					</div>

					<div class="form-group">
						<label for="phoneno" class="col-sm-3 control-label">Phone Number</label>
						<div class="col-sm-9">
							<input id="phoneno" name="phoneno" placeholder="Staff Phone" type="text" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phoneno']; ?>"required>
						</div>
					</div>

					<div class="form-group">
						<label for="role" class="col-sm-3 control-label">Role</label>
						<div class="col-sm-9">
							<select name="role" class="form-control" id="role" required>
								<option value="Admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_role']=="Admin") echo "selected"; ?>>Admin</option>
								<option value="Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_role']=="Staff") echo "selected"; ?>>Staff</option>
							</select> 
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input id="email" name="email" placeholder="Staff Email" type="text" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>"required>
						</div>
					</div>

					<div class="form-group">
						<label for="pass" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input id="pass" name="pass" placeholder="Staff Password" type="password" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>"required>
						</div>
					</div>

					<div class="form-group">
						<label for="confirmpass" class="col-sm-3 control-label">Confirm Password</label>
						<div class="col-sm-9">
							<input id="confirmpass" name="confirmpass" placeholder="Confirm Password" type="password" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>"required>
							<span id='message'></span>
						</div>
					</div>
					<!-- saja je letak confirm pass -->
					<script type="text/javascript">
						$('#pass, #confirmpass').on('keyup', function () {
							if ($('#pass').val() == $('#confirmpass').val()) {
								$('#message').html('Matching').css('color', 'green');
							} else
								$('#message').html('Not Matching').css('color', 'red');
							});
					</script>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<?php if (isset($_GET['edit'])) { ?>
								<input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
								<button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
							<?php } else { ?>
								<button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
							<?php } ?>
							<button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- <?php 
			/*if($_SESSION['user']['fld_staff_role'] == 'Staff'){
				//kalo nk disable form je
				echo '<script>$("form :input").prop("disabled", true);</script>';
			}*/
		?> -->
		<?php } ?>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<div class="page-header">
					<h2>Staff List</h2>
				</div>

				<table class="table table-striped table-bordered">
					<tr>
						<th>Staff ID</th>
						<th>Name</th>
						<th>Phone Number</th>
						<th>Email</th>
						<th>Role</th>
						<?php
							if($_SESSION['user']['fld_staff_role'] == 'Admin') echo '<th></th>'
						?>
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
						$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173586 LIMIT $start_from, $per_page");
						$stmt->execute();
						$result = $stmt->fetchAll();
					}
					catch(PDOException $e){
						echo "Error: " . $e->getMessage();
					}
					foreach($result as $readrow) {
						?>
						<tr>
							<td><?php echo $readrow['fld_staff_id']; ?></td>
							<td><?php echo $readrow['fld_staff_name']; ?></td>
							<td><?php echo $readrow['fld_staff_phoneno']; ?></td>
							<td><?php echo $readrow['fld_staff_email']; ?></td>
							<td><?php echo $readrow['fld_staff_role']; ?></td>
							<?php
								if($_SESSION['user']['fld_staff_role'] == 'Admin'){ ?>
									<td>
										<a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
										<a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
									</td>
							<?php } ?>
							
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
							$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173586");
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
							<li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<?php
						}
						for ($i=1; $i<=$total_pages; $i++)
							if ($i == $page)
								echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
							else
								echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
							?>
							<?php if ($page==$total_pages) { ?>
								<li class="disabled"><span aria-hidden="true">»</span></li>
							<?php } else { ?>
								<li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</div>

		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
	</html>