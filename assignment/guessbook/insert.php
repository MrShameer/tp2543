<?php
 
if (isset($_POST['add_form'])) {
 
  include "db.php";
 
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
      // Prepare the SQL statement

      /*$stmt = $conn->prepare("INSERT INTO assignment2(user, email, find, tick, front, form, ui, postdate, posttime,
        comment) VALUES (:user, :email, :find, :tick, :front, :form, :ui, :pdate, :ptime, :comment)");*/

      $stmt = $conn->prepare("INSERT INTO assignment2(user, email, find, front, form, ui, postdate, posttime,
        comment) VALUES (:user, :email, :find, :front, :form, :ui, :pdate, :ptime, :comment)");
     
      // Bind the parameters
      $stmt->bindParam(':user', $name, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':find', $find, PDO::PARAM_STR);
      //$stmt->bindParam(':tick', $tick, PDO::PARAM_STR);
      $stmt->bindParam(':front', $front, PDO::PARAM_INT);
      $stmt->bindParam(':form', $form, PDO::PARAM_INT);
      $stmt->bindParam(':ui', $ui, PDO::PARAM_INT);
      $stmt->bindParam(':pdate', $postdate, PDO::PARAM_STR);
      $stmt->bindParam(':ptime', $posttime, PDO::PARAM_STR);
      $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
       


      $name = $_POST['name'];
      $email = $_POST['email'];
      $find = $_POST['find'];
      //$tick = implode(" | ",$_POST['tick']);
      $front = (isset($_POST['front']) ? 1 : 0);
      $form = (isset($_POST['form']) ? 1 : 0);
      $ui = (isset($_POST['ui']) ? 1 : 0);
      $postdate = date("Y-m-d",time());
      $posttime = date("H:i:s",time());
      $comment = $_POST['comment'];

     
    $stmt->execute();
 
      echo "New records created successfully";
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