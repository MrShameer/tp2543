<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a173586(fld_product_id,fld_product_name,fld_product_price,fld_product_type,fld_product_brand,fld_product_description,fld_product_quantity,fld_product_material) VALUES(:pid, :name, :price, :type,:brand,:description,:quantity,:material)");
     

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
      $stmt->bindParam(':material', $material, PDO::PARAM_INT);
     // $stmt->bindParam(':image', $image, PDO::PARAM_INT);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $brand =  $_POST['brand'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $material = $_POST['material'];
    //$image = $_POST['image'];
     
    $stmt->execute();
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
 
  try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a173586 SET fld_product_id = :pid,fld_product_name = :name,fld_product_price = :price,fld_product_type = :type,fld_product_brand = :brand,fld_product_description = :description,fld_product_quantity = :quantity,fld_product_material = :material
        WHERE fld_product_id = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
      $stmt->bindParam(':material', $material, PDO::PARAM_INT);
     // $stmt->bindParam(':image', $image, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $brand =  $_POST['brand'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $material = $_POST['material'];
    //$image = $_POST['image'];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a173586 WHERE fld_product_id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a173586 WHERE fld_product_id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

  $num = $conn->query("SELECT MAX(fld_product_id) AS pid FROM tbl_products_a173586")->fetch()['pid'];

  if ($num){
    $num = ltrim($num, 'P')+1;
    $num = 'P'.str_pad($num,3,"0",STR_PAD_LEFT);
  }
  else{
    $num = 'P'.str_pad(1,3,"0",STR_PAD_LEFT);
  }
  
  $conn = null;
?>