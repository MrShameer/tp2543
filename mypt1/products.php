<!DOCTYPE html>
<html>
<head>
	<title>Hypers Ordering System : Products</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
	<center>

		<form action="products.php" method="post">
			Product ID
			<input name="pid" type="text"> <br>
			Name
			<input name="name" type="text"> <br>
			Price
			<input name="price" type="text"> <br>
			Type
			<select name="type">
				<option value="Hasbro">Action Figure</option>
				<option value="Lego">Building</option>
				<option value="Knex">Vehicle</option>
				<option value="ToysRUs">Weapon</option>
				<option value="Nintendo">Electronic</option>
				<option value="Other">Other</option>
			</select> <br>
			Brand
			<select name="brand">
				<option value="Hasbro">Hasbro</option>
				<option value="Lego">Lego</option>
				<option value="Knex">Knex</option>
				<option value="ToysRUs">ToysRUs</option>
				<option value="Nintendo">Nintendo</option>
				<option value="Playmobil">Playmobil</option>
				<option value="Other">Other</option>
			</select> <br>
			Description
			<input name="desc" type="text"> <br>
			Quantity
			<input type="number" name="quantity" min="1" max="100" step="1"> <br>
			Material
			<select name="material">
				<option value="Plastic">Plastic</option>
				<option value="Metal">Metal</option>
				<option value="Flexible Plastic">Flexible Plastic</option>
				<option value="Paper">Paper</option>
				<option value="Fur">Fur</option>
				<option value="CD">CD</option>
				<option value="Other">Other</option>
			</select> <br>
			
			<button type="submit" name="create">Create</button>
			<button type="reset">Clear</button>
		</form>
		<hr>
		<table border="1" id="adds">
			<script type="text/javascript">
				let frs = ['<tr>',
										'<td>Product ID</td>',
										'<td>Name</td>',
										'<td>Price</td>',
										'<td>Type</td>',
										'<td>Brand</td>',
										'<td>Description</td>',
										'<td>Quantity</td>',
										'<td>Material</td>',
										'<td></td>',
										'</tr>',
										]
				function block(a,b,c,d,e,f,g,h) {
					let add = ['<tr>',
											'<td>'+a+'</td>',
											'<td>'+b+'</td>',
											'<td>'+c+'</td>',
											'<td>'+d+'</td>',
											'<td>'+e+'</td>',
											'<td>'+f+'</td>',
											'<td>'+g+'</td>',
											'<td>'+h+'</td>',

											'<td>',
											'<a href="products_details.php">Details</a>',
											'<a href="products.php">Edit</a>',
											'<a href="products.php">Delete</a>',
											'</td>',
											'</tr>'];
					return add.join('\n');
				}

				$(String('#adds')).append(frs.join('\n'));
				let i=0;
				$(String('#adds')).append(block('P00'+(i+=1),'Knight Optimus Prime','175','Action Figure','Hasbro','Children\'s Boy Movable Combination Toy','120','Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Transformers Movie Master MPM10','268', 'Action Figure', 'Hasbro', 'For ages above 14 years of age', '177', 'Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Compatiable Legoge Ninjaoo Building Blocks','40','Building','Lego','Number of Blocks: 810','403','Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Golden Dragon Master Lego Ninjago Movie Minifigures','3','Action Figure','Lego','Material: ABS.  Recommend age:6+','564','Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Nintendo Switch amiibo Splatoon 2 Octopus Tako','106','Other','Nintendo','A brand-new, unused, unopened, undamaged item','125850','Metal'));
				$(String('#adds')).append(block('P00'+(i+=1),'Playmobil 5680 City Life - School Bus','139','Vehicle','Playmobil','Children can use the bus to transports','5','Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Playmobil skater','18','Vehicle','Playmobil','9094 skater with ramp','40','Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Fortnite Nert AR L','230','Weapon','ToysRUs','Fortnite Nert AR L from Toys','3','Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Avengers Captain America Toy Gun','25','Weapon','ToysRUs','Defects and damages are due to misuse','6','Plastic'));
				$(String('#adds')).append(block('P00'+(i+=1),'Furby boom','159','Electronic','Hasbro','Used, comes without box, batteries or instructions','3','Fur'));
			</script>
		</table>
	</center>
</body>
</html>