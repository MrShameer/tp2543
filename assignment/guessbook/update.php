<?php
 
if (isset($_POST['edit_form'])) {
 
  include "db.php";
 
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    /*$stmt = $conn->prepare("UPDATE assignment2 SET user = :name, email = :email, find=:find, tick=:tick, comment = :comment WHERE id = :record_id");*/

    $stmt = $conn->prepare("UPDATE assignment2 SET user = :name, email = :email, find=:find, front = :front, form = :form, ui = :ui, comment = :comment WHERE id = :record_id");
 
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':find', $find, PDO::PARAM_STR);
    //$stmt->bindParam(':tick', $tick, PDO::PARAM_STR);
    $stmt->bindParam(':front', $like_front, PDO::PARAM_INT);
    $stmt->bindParam(':form', $like_form, PDO::PARAM_INT);
    $stmt->bindParam(':ui', $like_ui, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':record_id', $id, PDO::PARAM_INT);
       
    $name = $_POST['name'];
    $email = $_POST['email'];
    $find = $_POST['find'];
    //$tick = implode(" | ",$_POST['tick']);
    $like_front = (isset($_POST['front']) ? 1 : 0);
    $like_form = (isset($_POST['form']) ? 1 : 0);
    $like_ui = (isset($_POST['ui']) ? 1 : 0);
    $comment = $_POST['comment'];
    $id = $_POST['id'];
 
    $stmt->execute();
     
    header("Location:list.php");
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