<?php
include_once 'database.php';
if (!isset($_SESSION['loggedin']))
	header("LOCATION: login.php");
//Create
if (isset($_POST['create'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("INSERT INTO tbl_staffs_a173586(fld_staff_id, fld_staff_name, fld_staff_phoneno, fld_staff_email, fld_staff_password, fld_staff_role) VALUES(:sid, :name, :phoneno, :email, :pass, :role)");

			$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':phoneno', $phoneno, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
			$stmt->bindParam(':role', $role, PDO::PARAM_STR);

			$sid = $_POST['sid'];
			$name = $_POST['name'];
			$phoneno = $_POST['phoneno'];
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			$role = $_POST['role'];

			$stmt->execute();
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error while creating: " . $e->getMessage();
		}
	} else {
		$_SESSION['error'] = "Sorry, but you don't have permission to create a new staff.";
	}

	header("LOCATION: {$_SERVER['REQUEST_URI']}");
	exit();
}

//Update
if (isset($_POST['update'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("UPDATE tbl_staffs_a173586 SET
				fld_staff_id = :sid, fld_staff_name = :name, fld_staff_phoneno = :phoneno, fld_staff_email = :email, fld_staff_password = :pass, fld_staff_role = :role
				WHERE fld_staff_id = :oldsid");

			$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':phoneno', $phoneno, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
			$stmt->bindParam(':role', $role, PDO::PARAM_STR);
			$stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);

			$sid = $_POST['sid'];
			$name = $_POST['name'];
			$phoneno = $_POST['phoneno'];
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			$role = $_POST['role'];
			$oldsid = $_POST['oldsid'];

			$stmt->execute();

		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error while updating: " . $e->getMessage();
			header("LOCATION: {$_SERVER['REQUEST_URI']}");
			exit();
		}
	} else {
		$_SESSION['error'] = "Sorry, but you don't have permission to update staff.";
	}

	header("LOCATION: {$_SERVER['PHP_SELF']}");
	exit();
}

//Delete
if (isset($_GET['delete'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("DELETE FROM tbl_staffs_a173586 where fld_staff_id = :sid");
			$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
			$sid = $_GET['delete'];
			$stmt->execute();
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error: " . $e->getMessage();
		}
	} else {
		$_SESSION['error'] = "Sorry, but you don't have permission to delete staff.";
	}

	header("LOCATION: {$_SERVER['PHP_SELF']}");
	exit();
}

//Edit
if (isset($_GET['edit'])) {
	if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
		try {
			$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173586 where fld_staff_id = :sid");
			$stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
			$sid = $_GET['edit'];
			$stmt->execute();
			$editrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Error: " . $e->getMessage();
			header("LOCATION: {$_SERVER['PHP_SELF']}");
			exit();
		}
	} else {
		$_SESSION['error'] = "Sorry, but you don't have permission to edit a staff.";
		header("LOCATION: {$_SERVER['PHP_SELF']}");
		exit();
	}
}
//coding ni tk perlu guna. ni untuk aku punye auto increment je
$num = $conn->query("SELECT MAX(fld_staff_id) AS pid FROM tbl_staffs_a173586")->fetch()['pid'];

if ($num){
	$num = ltrim($num, 'S')+1;
	$num = 'S'.str_pad($num,3,"0",STR_PAD_LEFT);
}
else{
	$num = 'S'.str_pad(1,3,"0",STR_PAD_LEFT);
}
?>