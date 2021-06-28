<!--
  Matric Number: A173586
  Name: Mohamed Shameer Ali 
-->

<?php
require 'database.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hypers Toy Store</title>
    <?php include_once 'nav_bar.php'; ?>
    <style type="text/css">
    body{

    }
</style>
</head>

<body>
    <section class="container-fluid">
    <div class="container content">
        <div class="text-center" style="margin-bottom: 3rem;">
            <div class="row">
                <div class="col-md-12">
                    <h1>Hypers Ordering System</h1>
                    <hr style="border-top: 1px solid transparent;"/>
                    <p class="text-muted">Search product by model, type, price or all three.</p>
                </div>
                <div class="col-md-12">
                    <form action="#" method="POST" id="searchForm">
                        <div class="form-group">
                            <input type="text" class="form-control text-center input-lg" id="inputSearch" name="search"
                                   placeholder="Transformer 100.00 Plastic" autocomplete="off" required>
                            <span id="helpBlock2" class="help-block"></span>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container resultList" style="padding: 20px;display: none;">
    <div class="text-center">
        <h2>Result</h2>
        <p>Found <span class="result-count">0</span> results.</p>
    </div>

    <div class="row list-item"></div>
</section>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
    $("#searchForm").submit(function (e) {
        e.preventDefault();

        var input = $("#inputSearch");
        var val = input.val();

        input.parent().removeClass('has-error');
        input.parent().find("#helpBlock2").text("");

        if (val.length > 2) {
            $.get('search.php', {search: val}).done(function (res) {
                $('.list-item').empty();

                if (res.status == 200) {
                    $(".result-count").text(res.data.length);

                    $.each(res.data, function (idx, data) {
                        if (data.fld_product_id === '')
                            data.fld_product_id = data.fld_product_id + '.png';

                        $('.list-item').append(`<div class="col-md-4">
            <div class="thumbnail">
                <img src="products/${data.fld_product_id}" alt="${data.fld_product_name}" style="height: 345px;">
                <div class="caption text-center">
                    <h3>${data.fld_product_name}</h3>
                    <p>
                        <a href="products_details.php?pid=${data.fld_product_name}" class="btn btn-primary" role="button">View</a>
                    </p>
                </div>
            </div>
        </div>`);
                    });
                }
            });

            $(".resultList").show("slow");
        } else {
            input.parent().addClass("has-error");
            input.parent().find("#helpBlock2").text("Please enter more than 2 characters.");

            $('.list-item').empty();
        }
    });
</script>


    <!--div id="img">
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
    </div-->
</body>
</html>