<?php
	include_once 'orders_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hypers Ordering System : Orders</title>
</head>
<body>
	<object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
	<center>
		<form action="orders.php" method="post">
			Order ID
			<input name="oid" type="text" id="oid" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_id']; ?>"> <br>
			Order Date
			<input name="orderdate" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>"> <br>
			Staff
			<select name="sid">
				<?php
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
			foreach($result as $staffrow) {
			?>
				<?php if((isset($_GET['edit'])) && ($editrow['fld_staff_id']==$staffrow['fld_staff_id'])) { ?>
					<option value="<?php echo $staffrow['fld_staff_id']; ?>" selected><?php echo $staffrow['fld_staff_name'];?></option>
				<?php } else { ?>
					<option value="<?php echo $staffrow['fld_staff_id']; ?>"><?php echo $staffrow['fld_staff_name'];?></option>
				<?php } ?>
			<?php
			} // while
			$conn = null;
			?> 
			</select> <br>
			Customer
			<select name="cid">
			 <?php
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM tbl_customers_a173586");
				$stmt->execute();
				$result = $stmt->fetchAll();
			}
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
			foreach($result as $custrow) {
			?>
				<?php if((isset($_GET['edit'])) && ($editrow['fld_customer_id']==$custrow['fld_customer_id'])) { ?>
					<option value="<?php echo $custrow['fld_customer_id']; ?>" selected><?php echo $custrow['fld_customer_name'];?></option>
				<?php } else { ?>
					<option value="<?php echo $custrow['fld_customer_id']; ?>"><?php echo $custrow['fld_customer_name'];?></option>
				<?php } ?>
			<?php
			} // while
			$conn = null;
			?> 
			</select> <br>
			<?php if (isset($_GET['edit'])) { ?>
			<button type="submit" name="update">Update</button>
			<?php } else { ?>
			<button type="submit" name="create">Create</button>
			<?php } ?>
			<button type="reset">Clear</button>
		</form>
		<hr>
		<table border="1">
			<tr>
				<td>Order ID</td>
				<td>Order Date</td>
				<td>Staff ID</td>
				<td>Customer ID</td>
				<td></td>
			</tr>
			<?php
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "SELECT * FROM tbl_orders_a173586, tbl_staffs_a173586, tbl_customers_a173586 WHERE ";
				$sql = $sql."tbl_orders_a173586.fld_staff_id = tbl_staffs_a173586.fld_staff_id and ";
				$sql = $sql."tbl_orders_a173586.fld_customer_id = tbl_customers_a173586.fld_customer_id";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
			}
			catch(PDOException $e){ 
						echo "Error: " . $e->getMessage();
			}
			foreach($result as $orderrow) {
			?>
			<tr>
				<td><?php echo $orderrow['fld_order_id']; ?></td>
				<td><?php echo $orderrow['fld_order_date']; ?></td>
				<td><?php echo $orderrow['fld_staff_name'];?></td>
				<td><?php echo $orderrow['fld_customer_name'];?></td>
				<td>
					<a href="orders_details.php?oid=<?php echo $orderrow['fld_order_id']; ?>">Details</a>
					<a href="orders.php?edit=<?php echo $orderrow['fld_order_id']; ?>">Edit</a>
					<a href="orders.php?delete=<?php echo $orderrow['fld_order_id']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
				</td>
			</tr>
			<?php
			}
			if (!isset($_GET['edit'])&&$stmt->rowCount()>0){
				$num = ltrim($orderrow['fld_order_id'], 'O')+1;
				$num = 'O'.str_pad($num,5,"0",STR_PAD_LEFT);
			}
			elseif(!isset($_GET['edit'])){
				$num = 'O'.str_pad(1,5,"0",STR_PAD_LEFT);
			}
		$conn = null;
		?>
		<script type="text/javascript">
			if("<?php echo $num ?>" !== null && "<?php echo $num ?>" !== ""){
			var oid = document.getElementById("oid");
			oid.value = "<?php echo $num ?>";
			}
		</script>
		</table>
	</center>
</body>
</html>