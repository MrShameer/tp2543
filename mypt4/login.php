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
	<script src="../three.min.js"></script>
	<script src='https://cdn.jsdelivr.net/gh/mrdoob/Three.js@r92/examples/js/loaders/GLTFLoader.js'></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="login/login.css" rel="stylesheet">
</head>
<body>
	<h6>Three Js By Shameer Ali</h6> 
	<?php
	$models = array_diff(scandir('login/models/'), array('..', '.'));
	?>
	
	<script type="text/javascript">
		function random(min, max) {
			min = Math.ceil(min);
			max = Math.floor(max);
			return Math.floor(Math.random() * (max - min + 1) + min); 
		}

		function randomfloat(min, max) {
			return Math.random() * (max - min) + min;
		}

		var models = <?php echo json_encode($models); ?>;

		let roadStripArray = [];
		const scene = new THREE.Scene();
		const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 100000 );

		const renderer = new THREE.WebGLRenderer({antialias: true, alpha: true });
		renderer.setSize( window.innerWidth, window.innerHeight );
		document.body.appendChild( renderer.domElement );
		window.addEventListener('resize', () => {
			renderer.setSize(window.innerWidth,window.innerHeight);
			camera.aspect = window.innerWidth / window.innerHeight;
			camera.updateProjectionMatrix();
		})
		var loader = new THREE.GLTFLoader();

		for(let [key, value] of Object.entries(models)){
			loader.load('login/models/'+value, function ( gltf ) {
				gltf.scene.position.set(random(-15,15),random(10,30),0);
				gltf.scene.traverse( function ( child ) {
					if ( child.isMesh ) {
						child.material.emissive =  child.material.color;
						child.material.emissiveMap = child.material.map ;
					}
				});
				scene.add( gltf.scene );
				roadStripArray.push(gltf.scene);

			}, undefined, function ( error ) {
				//console.warn( error );
			});
		}

		camera.position.z = 10;

		const light = new THREE.AmbientLight( 0xf0f0f0, 1);
		scene.add( light );
		const animate = function () {
			requestAnimationFrame( animate );
			let i=0;
			for(let a of roadStripArray){
				if(i%2==0){
					a.rotation.x += 0.01;
					a.rotation.y += 0.01;
				}
				else{
					a.rotation.x -= 0.01;
					a.rotation.y -= 0.01;
				}
				i+=1;
				a.position.y -= 0.02;
				//a.rotation.x += 0.01;
				//a.rotation.y += 0.01;
				/*a.position.addScaledVector(direction, speed * delta);*/
				if (a.position.y <= -10) {
					a.position.set(random(-15,15),random(10,30),0);
				} else {
				}

			}
			renderer.render( scene, camera );
		};

		animate();
	</script>

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
