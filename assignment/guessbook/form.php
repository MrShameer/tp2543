<!DOCTYPE html>
<html>
<head>
	<title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="insert.php">
	Nama :
	<input type="text" name="name" size="40" required>
	<br>
	Email :
	<input type="text" name="email" size="25" required>
	<br>
	How did you find me? 
	<select name="find" id="find">
		<option value="From a friend" required>From a friend</option>
		<option value="I google you" required>I google you</option>
		<option value="Just surf on in" required>Just surf on in</option>
		<option value="From your facebook" required>From your facebook</option>
		<option value="I clicked on ads" required>I clicked on ads</option>
	</select>
	<br>
	I like your :<br>
	<!--input type="checkbox" id="tick1" name="tick[]" value="frontpage">
	<label for="tick1">Front Page</label><br>
	<input type="checkbox" id="tick2" name="tick[]" value="form">
	<label for="tick2">Form</label><br>
	<input type="checkbox" id="tick3" name="tick[]" value="userinterface">
	<label for="tick3">User Interface</label-->

	<input type="checkbox" id="tick1" name="front" value="1">
	<label for="tick1">Front Page</label><br>
	<input type="checkbox" id="tick2" name="form" value="1">
	<label for="tick2">Form</label><br>
	<input type="checkbox" id="tick3" name="ui" value="1">
	<label for="tick3">User Interface</label>
  <br><br>
	Comments :<br>
	<textarea name="comment" cols="30" rows="8" required></textarea>
	<br>
	<input type="submit" name="add_form" value="Add a New Comment">
	<input type="reset">
	<br>
</form>
 
</body>
</html>