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
      <input name="cid" type="text"> <br>
      Name
      <input name="fname" type="text"> <br>
      Phone Number
      <input name="phone" type="text"> <br>
      Email
      <input name="email" type="text"> <br>
      Address
      <input name="address" type="text"> <br>
      Age
      <input name="age" type="number" min="18" step="1"> <br>
      
      <button type="submit" name="create">Create</button>
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
      <tr>
        <td>C001</td>
        <td>Shameer</td>
        <td>01140448922</td>
        <td>a173586@siswa.ukm.edu.my</td>
        <td>Mersing</td>
        <td>21</td>
        <td>
          <a href="customers.php">Edit</a>
          <a href="customers.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>C001</td>
        <td>Ali</td>
        <td>01234567</td>
        <td>a177123@siswa.ukm.edu.my</td>
        <td>Kota Tinggi, Johor</td>
        <td>20</td>
        <td>
          <a href="customers.php">Edit</a>
          <a href="customers.php">Delete</a>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>