<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome To Hypers</title>
	<link rel="shortcut icon" type="image/x-icon" href="products/hypers logo.ico"/>
	<link href="login/login.css" rel="stylesheet">
	<script src="../three.min.js"></script>
	<script src='https://cdn.jsdelivr.net/gh/mrdoob/Three.js@r92/examples/js/loaders/GLTFLoader.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
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
				gltf.scene.position.set(random(-15,15),random(10,20),0);
				gltf.scene.traverse( function ( child ) {
					if ( child.isMesh ) {
						child.material.emissive =  child.material.color;
						child.material.emissiveMap = child.material.map ;
					}
				});
				scene.add( gltf.scene );
				roadStripArray.push(gltf.scene);

			}, undefined, function ( error ) {
				console.log( error );
			});
		}

		camera.position.z = 10;

		const light = new THREE.AmbientLight( 0xf0f0f0, 1);
		scene.add( light );
		const animate = function () {
			requestAnimationFrame( animate );

			for(let a of roadStripArray){
				a.position.y -= 0.02;
				a.rotation.x += 0.01;
				a.rotation.y += 0.01;
				/*a.position.addScaledVector(direction, speed * delta);*/
				if (a.position.y <= -10) {
					a.position.set(random(-15,15),random(10,20),0);
				} else {
				}

			}
			renderer.render( scene, camera );
		};

		animate();
	</script>

	<div class="container">
		<form>
			<p>Welcome</p>
			<input type="email" placeholder="Email"><br>
			<input type="password" placeholder="Password"><br>
			<input type="button" value="Sign in"><br>
			<a href="#" id="hint">Hint?</a>
			<script type="text/javascript">
				$(document).on("click","#hint",function(){
					alert("A");
				});
			</script>
		</form>

		<div class="drops">
			<div class="drop drop-1"></div>
			<div class="drop drop-2"></div>
			<div class="drop drop-3"></div>
			<div class="drop drop-4"></div>
			<div class="drop drop-5"></div>
		</div>

	</div>
</body>
</html>
