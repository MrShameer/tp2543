<?php
  include_once 'orders_details_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Hypers Ordering System : Order Details</title>
</head>
<body>
  <object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
  <center>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_orders_a173586, tbl_staffs_a173586,
          tbl_customers_a173586 WHERE tbl_orders_a173586.fld_staff_id = tbl_staffs_a173586.fld_staff_id AND tbl_orders_a173586.fld_customer_id = tbl_customers_a173586.fld_customer_id AND fld_order_id = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
        $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    Order ID: <?php echo $readrow['fld_order_id'] ?> <br>
    Order Date: <?php echo $readrow['fld_order_date'] ?> <br>
    Staff: <?php echo $readrow['fld_staff_name'];?> <br>
    Customer: <?php echo $readrow['fld_customer_name'];?> <br>
    <hr>
    <form action="orders_details.php" method="post">
      Product
      <select name="pid">
        <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a173586");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $productrow) {
      ?>
        <option value="<?php echo $productrow['fld_product_id']; ?>"><?php echo $productrow['fld_product_brand']." ".$productrow['fld_product_name']; ?></option>
      <?php
      }
      $conn = null;
      ?>
      </select>
      Quantity
      <input name="quantity" type="text">
      <input name="oid" type="hidden" value="<?php echo $readrow['fld_order_id'] ?>">
      <button type="submit" name="addproduct">Add Product</button>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order Detail ID</td>
        <td>Product</td>
        <td>Quantity</td>
        <td></td>
      </tr>
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_transactions_a173586,
            tbl_products_a173586 WHERE
            tbl_transactions_a173586.fld_product_id = tbl_products_a173586.fld_product_id AND
          fld_order_id = :oid");
          $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $detailrow['fld_transaction_id']; ?></td>
        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_quantity']; ?></td>
        <td>
          <a href="orders_details.php?delete=<?php echo $detailrow['fld_transaction_id']; ?>&oid=<?php echo $_GET['oid']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
    <hr>
    <a href="invoice.php?oid=<?php echo $_GET['oid']; ?>" target="_blank">Generate Invoice</a>
  </center>
</body>
</html>