<?php
  include_once 'customers_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Hypers Ordering System : Customers</title>
</head>
<body>
  <object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
  <center>
    <form action="customers.php" method="post">
      Customer ID
      <input name="cid" type="text" id="cid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_id']; ?>" readonly> <br>
      Name
      <input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>"> <br>
      Phone Number
      <input name="phone" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>"> <br>
      Email
      <input name="email" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_email']; ?>"> <br>
      Address
      <input name="address" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_address']; ?>"> <br>
      Age
      <input type="number" name="age" min="1" max="900" step="1" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_age']; ?>"> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_id']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Customer ID</td>
        <td>Name</td>
        <td>Phone Number</td>
        <td>Email</td>
        <td>Address</td>
        <td>Age</td>
        <td></td>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_customers_a173586");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_customer_id']; ?></td>
        <td><?php echo $readrow['fld_customer_name']; ?></td>
        <td><?php echo $readrow['fld_customer_phone']; ?></td>
        <td><?php echo $readrow['fld_customer_email']; ?></td>
        <td><?php echo $readrow['fld_customer_address']; ?></td>
        <td><?php echo $readrow['fld_customer_age']; ?></td>
        <td>
          <a href="customers.php?edit=<?php echo $readrow['fld_customer_id']; ?>">Edit</a>
          <a href="customers.php?delete=<?php echo $readrow['fld_customer_id']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      if (!isset($_GET['edit'])){
        $num = ltrim($readrow['fld_customer_id'], 'C')+1;
        $num = 'C'.str_pad($num,3,"0",STR_PAD_LEFT);
      }
      else{
        $num = 'C'.str_pad(1,3,"0",STR_PAD_LEFT);
      }
      $conn = null;
      ?>
      <script type="text/javascript">
        if("<?php echo $num ?>" !== null && "<?php echo $num ?>" !== ""){
          var cid = document.getElementById("cid");
          cid.value = "<?php echo $num ?>";
        }
      </script>
    </table>
  </center>
</body>
</html>