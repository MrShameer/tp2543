<?php
 
if (isset($_GET['id'])) {
 
  include "db.php";
 
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      $stmt = $conn->prepare("SELECT * FROM assignment2 WHERE id = :record_id");
      $stmt->bindParam(':record_id', $id, PDO::PARAM_INT);
      $id = $_GET['id'];
 
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
      }
 
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
 
    $conn = null;
  }
else {
  echo "Error: You have execute a wrong PHP. Please contact the web administrator.";
  die();
}
 
 ?>
 
<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="update.php">
  Nama :
  <input type="text" name="name" size="40" required value="<?php echo $result["user"]; ?>">
  <br>
  Email :
  <input type="text" name="email" size="25" required value="<?php echo $result["email"]; ?>">
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
  <? echo $result["tick"];?>
  <input type="checkbox" id="tick1" name="tick[]" value="frontpage" <?php echo (strpos($result["tick"], 'frontpage')!== false ? 'checked' : '');?>>
  <label for="tick1">Front Page</label><br>
  <input type="checkbox" id="tick2" name="tick[]" value="form" <?php echo (strpos($result["tick"], 'form')!== false ? 'checked' : '');?>>
  <label for="tick2">Form</label><br>
  <input type="checkbox" id="tick3" name="tick[]" value="userinterface" <?php echo (strpos($result["tick"], 'userinterface')!== false ? 'checked' : '');?>>
  <label for="tick3">User Interface</label><br><br>


  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required><?php echo $result["comment"]; ?></textarea>
  <br>
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  <input type="submit" name="edit_form" value="Modify Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>