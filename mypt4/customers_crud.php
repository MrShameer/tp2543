<?php
include_once 'database.php';

if (!isset($_SESSION['loggedin']))
	header("LOCATION: login.php");
//Create
if (isset($_POST['create'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("INSERT INTO tbl_customers_a173586(fld_customer_id, fld_customer_name, fld_customer_phone, fld_customer_email, fld_customer_address, fld_customer_age) VALUES(:cid, :name, :phone, :email, :address, :age)");

			$stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':address', $address, PDO::PARAM_STR);
			$stmt->bindParam(':age', $age, PDO::PARAM_STR);


			$cid = $_POST['cid'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$age = $_POST['age'];

			$stmt->execute();
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error while Creating: " . $e->getMessage();
		}
	} else {
		$_SESSION['error'] = "Sorry, but you don't have permission to create a new customer.";
	}

	header("LOCATION: {$_SERVER['REQUEST_URI']}");
	exit();
}

//Update
if (isset($_POST['update'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("UPDATE tbl_customers_a173586 SET fld_customer_id = :cid, fld_customer_name = :name, fld_customer_phone = :phone, fld_customer_email = :email, fld_customer_address = :address, fld_customer_age = :age
				WHERE fld_customer_id = :oldcid");

			$stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':address', $address, PDO::PARAM_STR);
			$stmt->bindParam(':age', $age, PDO::PARAM_STR);
			$stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_INT);

			$cid = $_POST['cid'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$age = $_POST['age'];
			$oldcid = $_POST['oldcid'];

			$stmt->execute();
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error while Updating: " . $e->getMessage();
			header("LOCATION: {$_SERVER['REQUEST_URI']}");
			exit();
		}
	}else {
		$_SESSION['error'] = "Sorry, but you don't have permission to update customer.";
	}
	header("LOCATION: {$_SERVER['PHP_SELF']}");
	exit();
}

//Delete
if (isset($_GET['delete'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("DELETE FROM tbl_customers_a173586 WHERE fld_customer_id = :cid");
			$stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
			$cid = $_GET['delete'];
			$stmt->execute();
			header("Location: customers.php");
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error while Deleting: " . $e->getMessage();
		}
	} else {
		$_SESSION['error'] = "Sorry, but you don't have permission to delete customer.";
	}

	header("LOCATION: {$_SERVER['PHP_SELF']}");
	exit();
}

//Edit
if (isset($_GET['edit'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("SELECT * FROM tbl_customers_a173586 WHERE fld_customer_id = :cid");
			$stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
			$cid = $_GET['edit'];
			$stmt->execute();
			$editrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error while Editing: " . $e->getMessage();
		}
	} else {
		$_SESSION['error'] = "Sorry, but you don't have permission to edit a customer.";
		header("LOCATION: {$_SERVER['PHP_SELF']}");
		exit();
	}
}
//coding ni tk perlu guna. ni untuk aku punye auto increment je
$num = $conn->query("SELECT MAX(fld_customer_id) AS pid FROM tbl_customers_a173586")->fetch()['pid'];
if ($num){
	$num = ltrim($num, 'C')+1;
	$num = 'C'.str_pad($num,3,"0",STR_PAD_LEFT);
}
else{
	$num = 'C'.str_pad(1,3,"0",STR_PAD_LEFT);
}
?>