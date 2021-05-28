<?php
	include_once 'staffs_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hypers Ordering System : Staffs</title>
	<link rel="shortcut icon" type="image/x-icon" href="products/hypers logo.ico"/>
</head>
<body>
	<object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
	<center>
		<form action="staffs.php" method="post">
			Staff ID
			<input name="sid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; else echo $num; ?>" readonly required> <br>
			Name
			<input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>"required> <br>
			Phone Number
			<input name="phoneno" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phoneno']; ?>"required> <br>

			<?php if (isset($_GET['edit'])) { ?>
			<input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
			<button type="submit" name="update">Update</button>
			<?php } else { ?>
			<button type="submit" name="create">Create</button>
			<?php } ?>
			<button type="reset">Clear</button>
		</form>
		<hr>
		<table border="1">
			<tr>
				<td>Staff ID</td>
				<td>Name</td>
				<td>Phone Number</td>
				<td></td>
			</tr>
			<?php
			// Read
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173586");
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
				<td>
					<a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>">Edit</a>
					<a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
				</td>
			</tr>
			<?php
			}
			$conn = null;
			?>
		</table>
	</center>
</body>
</html>