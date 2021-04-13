<!DOCTYPE html>
<html>
<head>
  <title>Hypers Ordering System : Staffs</title>
</head>
<body>
  <object name="menu" type="text/html" data="menu.html" width="100%" height="50px"></object>
  <center>
    <form action="staffs.php" method="post">
      Staff ID
      <input name="sid" type="text"> <br>
      Name
      <input name="fname" type="text"> <br>
      Phone Number
      <input name="phone" type="text"> <br>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Staff ID</td>
        <td>First</td>
        <td>Phone Number</td>
        <td></td>
      </tr>
      <tr>
        <td>S001</td>
        <td>Abu</td>
        <td>013-3922010</td>
        <td>
          <a href="staffs.php">Edit</a>
          <a href="staffs.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>S002</td>
        <td>Kamal</td>
        <td>019-8321266</td>
        <td>
          <a href="staffs.php">Edit</a>
          <a href="staffs.php">Delete</a>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>