<!--
  Matric Number: A173586
  Name: Mohamed Shameer Ali 
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hypers Toy Store</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/hypers logo.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    body{
        overflow: hidden; 
    }
</style>
</head>

<body>
    <?php include_once 'nav_bar.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <div id="img">
     <script type="text/javascript">
        var bd = document.body;
        var suns = document.querySelector("#img")
        function rot(event) {
            var w = window.innerWidth / 2;
            var x = event.clientX;
            if (x > w + 100) {
                suns.style.transform = "perspective(1000px) rotateY(30deg)";
            }
            if (x > w - 100 && x < w + 100) {
                suns.style.transform = "perspective(1000px) rotateY(0deg)";
            }
            if (x < w - 100) {
                suns.style.transform = "perspective(1000px) rotateY(-30deg)";
            }
        }
        bd.addEventListener("mousemove", rot);
    </script>
</div>
</body>
</html>