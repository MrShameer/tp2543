<?php
	require_once 'database.php';
	if (isset($_SESSION['loggedin']))
    	header("LOCATION: index.php");

    if (isset($_POST['userid'], $_POST['password'])) {
    $UserID = htmlspecialchars($_POST['userid']);
    $Pass = $_POST['password'];

    if (empty($UserID) || empty($Pass)) {
        $_SESSION['error'] = 'Please fill in the blanks.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173586 WHERE (fld_staff_id = :id OR fld_staff_email = :id) LIMIT 1");
        $stmt->bindParam(':id', $UserID);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($user['fld_staff_id'])) {
            if ($user['fld_staff_password'] == $Pass) {
                unset($user['fld_staff_password']);
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user;

                header("LOCATION: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Invalid login credentials. Please try again.';
            }
        } else {
            $_SESSION['error'] = 'Account does not exist.';
        }
    }

    header("LOCATION: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome To Hypers</title>
	<link rel="shortcut icon" type="image/x-icon" href="products/hypers logo.ico"/>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="login/login.css" rel="stylesheet">
</head>
<body>
	<h6>Three Js By Shameer Ali</h6> 
	<?php include_once 'login/background.php'; ?>
	<div class="containers">
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
			<p>Welcome To Hypers<br>Toy Store</p>
			<input type="email" placeholder="Email" name="userid"><br>
			<input type="password" placeholder="Password" name="password"><br>
			                <?php
                if (isset($_SESSION['error'])) {
                    echo "<p id='error' class='text-danger text-center'>{$_SESSION['error']}</p>";
                    unset($_SESSION['error']);
                }
                ?>
			<input type="submit" value="Sign in"><br>
			<a href="#" data-toggle="modal" data-target="#myModal">Hint?</a>
		</form>

		<div class="drops">
			<div class="drop drop-1"></div>
			<div class="drop drop-2"></div>
			<div class="drop drop-3"></div>
			<div class="drop drop-4"></div>
			<div class="drop drop-5"></div>
		</div>

	</div>

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Testing Account</h4>
				</div>
				<div class="modal-body">
					<div class="list-group">
						<div href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Admin Account</h4>
							<p class="list-group-item-text">
								<dl class="dl-horizontal">
									<dt>Email</dt>
									<dd>admin@hypers.com.my</dd>
									<dt>Password</dt>
									<dd>123</dd>
								</dl>
							</p>
						</div>

						<div href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Normal Staff Account</h4>
							<p class="list-group-item-text">
								<dl class="dl-horizontal">
									<dt>Email</dt>
									<dd>staff@hypers.com.my</dd>
									<dt>Password</dt>
									<dd>123</dd>
								</dl>
							</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
