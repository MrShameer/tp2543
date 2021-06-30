<?php
include_once 'database.php';
 
//Create
if (isset($_POST['addproduct'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_transactions_a173586(fld_transaction_id,
      fld_order_id, fld_product_id, fld_quantity) VALUES(:tid, :oid,
      :pid, :quantity)");
   
    $stmt->bindParam(':tid', $tid, PDO::PARAM_STR);
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
       
    $tid = uniqid('T', true);
    $oid = $_POST['oid'];
    $pid = $_POST['pid'];
    $quantity= $_POST['quantity'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  $_GET['oid'] = $oid;
  header("Location: orders_details.php?oid=".$_GET['oid']);
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_transactions_a173586 where fld_transaction_id = :tid");
   
    $stmt->bindParam(':tid', $tid, PDO::PARAM_STR);
       
    $tid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: orders_details.php?oid=".$_GET['oid']);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
?>