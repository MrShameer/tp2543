<!DOCTYPE html>
<html>
<head>
  <title>Hypers Ordering System : Products</title>
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
    <table border="1">
      <tr>
        <td>Product ID</td>
        <td>Name</td>
        <td>Price</td>
        <td>Type</td>
        <td>Brand</td>
        <td>Description</td>
        <td>Quantity</td>
        <td>Material</td>
        <td></td>
      </tr>
      <tr>
        <td>P001</td>
        <td>Knight Optimus Prime</td>
        <td>175</td>
        <td>Action Figure</td>
        <td>Hasbro</td>
        <td>Children's Boy Movable Combination Toy</td>
        <td>120</td>
        <td>Plastic</td>
        <td>
          <a href="products_details.php">Details</a>
          <a href="products.php">Edit</a>
          <a href="products.php">Delete</a>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>